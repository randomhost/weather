<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Feed class definition
 *
 * PHP version 5
 *
 * @category  Weather
 * @package   PHP_Weather
 * @author    Ch'Ih-Yu <chi-yu@web.de>
 * @copyright 2014 random-host.com
 * @license   http://www.debian.org/misc/bsd.license  BSD License (3 Clause)
 * @link      https://pear.random-host.com/
 */
namespace randomhost\Weather\Yahoo;

/**
 * Yahoo Weather API
 *
 * Encapsulates SimpleXML logic for retrieving weather data from the
 * Yahoo Weather API for being displayed on overlay images produced by the
 * randomhost\Image\WebcamOverlay class.
 *
 * @category  Weather
 * @package   PHP_Weather
 * @author    Ch'Ih-Yu <chi-yu@web.de>
 * @copyright 2014 random-host.com
 * @license   http://www.debian.org/misc/bsd.license  BSD License (3 Clause)
 * @version   Release: @package_version@
 * @link      https://pear.random-host.com/
 */
class Feed
{
    /**
     * Yahoo Weather API feed URL
     *
     * @var string
     */
    const WEATHER_API_URL = 'http://weather.yahooapis.com/forecastrss?w=%1$u&u=%2$s';

    /**
     * Yahoo Weather API Xpath namespace prefix
     *
     * @var string
     */
    const WEATHER_API_XPATH_NAMESPACE_PREFIX = 'yweather';

    /**
     * Yahoo Weather API Xpath namespace
     *
     * @var string
     */
    const WEATHER_API_XPATH_NAMESPACE = 'http://xml.weather.yahoo.com/ns/rss/1.0';

    /**
     * Triggers usage of international units
     *
     * Temperature: Celsius
     * Distance:    kilometers
     * Pressure:    millibars
     * Speed:       kilometers per hour (km/h)
     *
     * @var string
     */
    const UNITS_INTL = 'c';

    /**
     * Triggers usage of US units
     *
     * Temperature: Fahrenheit
     * Distance:    miles
     * Pressure:    pounds per square inch
     * Speed:       miles per our (mph)
     *
     * @var string
     */
    const UNITS_US = 'f';

    /**
     * Location ID for retrieving weather data from Yahoo Weather API
     *
     * @var int
     */
    protected $locationId = 0;

    /**
     * Defines the system of units to be returned by the feed
     *
     * @var string
     */
    protected $systemOfUnits = self::UNITS_INTL;

    /**
     * Yahoo weather feed as \SimpleXMLElement object instance
     *
     * @var \SimpleXMLElement|null
     */
    protected $xml = null;

    /**
     * Location object instance
     *
     * @var Data\Location|null
     */
    protected $location = null;

    /**
     * Units object instance
     *
     * @var Data\Units|null
     */
    protected $units = null;

    /**
     * Wind object instance
     *
     * @var Data\Wind|null
     */
    protected $wind = null;

    /**
     * Atmosphere object instance
     *
     * @var Data\Atmosphere|null
     */
    protected $atmosphere = null;

    /**
     * Astronomy object instance
     *
     * @var Data\Astronomy|null
     */
    protected $astronomy = null;

    /**
     * Condition object instance
     *
     * @var Data\Condition|null
     */
    protected $condition = null;

    /**
     * Constructor
     *
     * @param int    $locationId    (optional) Location ID.
     * @param string $systemOfUnits (optional) One of the self::UNITS_* constants.
     */
    public function __construct($locationId = 0, $systemOfUnits = '')
    {
        if (0 !== $locationId) {
            $this->setLocationId($locationId);
        }
        if ('' !== $systemOfUnits) {
            $this->setSystemOfUnits($systemOfUnits);
        }
    }

    /**
     * Fetches weather data from the Yahoo Weather API and sets class properties.
     *
     * @return void
     *
     * @throws \RuntimeException
     */
    public function fetchData()
    {
        if (0 === $this->locationId) {
            throw new \RuntimeException('No location ID was given');
        }

        // load xml file
        $feedUrl = sprintf(
            self::WEATHER_API_URL,
            $this->locationId,
            $this->systemOfUnits
        );
        $xml = @simplexml_load_file($feedUrl);
        if (!$xml) {
            throw new \RuntimeException(
                sprintf('Couldn\'t fetch feed from %s', $feedUrl)
            );
        }

        // register Yahoo! weather namespace
        $xml->registerXpathNamespace(
            self::WEATHER_API_XPATH_NAMESPACE_PREFIX,
            self::WEATHER_API_XPATH_NAMESPACE
        );

        $this->xml = $xml;

        // turn namespace data into objects
        $this->location = $this->createObjectFromData('location');
        $this->units = $this->createObjectFromData('units');
        //$this->wind = $this->createObjectFromData('wind');
        //$this->atmosphere = $this->createObjectFromData('atmosphere');
        $this->astronomy = $this->createObjectFromData('astronomy');
        //$this->condition = $this->createObjectFromData('condition', 'item');
    }

    /**
     * Set location ID for retrieving weather data from Yahoo Weather API.
     *
     * @param int $id location ID for retrieving weather data from Yahoo Weather API
     *
     * @return $this
     */
    public function setLocationId($id)
    {
        $this->locationId = (int)$id;
        return $this;
    }

    /**
     * Returns the last set location ID for retrieving weather data.
     *
     * @return int
     */
    public function getLocationId()
    {
        return $this->locationId;
    }

    /**
     * Sets the system of units to be returned by the feed.
     *
     * @param string $systemOfUnits One of the self::UNITS_* constants.
     *
     * @return $this
     * @throws \InvalidArgumentException Thrown in case an invalid system is given.
     */
    public function setSystemOfUnits($systemOfUnits)
    {
        $valid = array(self::UNITS_INTL, self::UNITS_US);
        if (!in_array($systemOfUnits, $valid)) {
            throw new \InvalidArgumentException();
        }
        $this->systemOfUnits = $systemOfUnits;

        return $this;
    }

    /**
     * Returns the last set system of units.
     *
     * @return string
     */
    public function getSystemOfUnits()
    {
        return $this->systemOfUnits;
    }


    /**
     * Returns forecast information about current astronomical conditions.
     *
     * Format:
     * <pre>array(
     *  'sunrise' => 'h:mm am/pm', // today's sunrise time
     *  'sunset'  => 'h:mm am/pm'  // today's sunset time
     * )</pre>
     *
     * @return Data\Astronomy
     */
    public function getAstronomy()
    {
        return $this->astronomy;
    }

    /**
     * Returns forecast information about current atmospheric pressure, humidity,
     * and visibility.
     *
     * Format:
     * <pre>array(
     *  'humidity'    => 95,    // humidity, in percent
     *  'visibility'  => 47.47, // visibility
     *  'pressure'    => 52,    // barometric pressure
     *  'rising'      => 0      // pressure: steady (0), rising (1), or falling (2)
     * )</pre>
     *
     * @return Data\Atmosphere
     */
    public function getAtmosphere()
    {
        return $this->atmosphere;
    }

    /**
     * Returns the current weather conditions.
     *
     * Format:
     * <pre>array(
     *  'text'  => 'Partly Cloudy',              // textual description of conditions
     *  'code'  => 30,                           // condition code for this forecast
     *  'temp'  => 5,                            // current temperature
     *  'date'  => 'Sat, 1 Mar 2014 0:17 am CET' // date and time for this forecast
     * )</pre>
     *
     * @return Data\Condition
     */
    public function getCondition()
    {
        return $this->condition;
    }

    /**
     * Returns the location of this forecast.
     *
     * Format:
     * <pre>array(
     *  'city'    => 'Cologne', // city name
     *  'region'  => 'NRW',     // state, territory, or region, if given
     *  'country' => 'DE'       // two-character country code
     * )</pre>
     *
     * @return Data\Location
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Returns the units for various aspects of the forecast.
     *
     * Format:
     * <pre>array(
     *  'temperature' => 'c',  // f = Fahrenheit, c = Celsius
     *  'distance'    => 'km', // mi = miles, km = kilometers
     *  'pressure'    => 'mb', // in = pounds per square inch, mb = millibars
     *  'speed'       => 'kph' // mph = miles per hour, kph = kilometers per hour
     * )</pre>
     *
     * @return Data\Units
     */
    public function getUnits()
    {
        return $this->units;
    }

    /**
     * Returns forecast information about wind.
     *
     * Format:
     * <pre>array(
     *  'temperature' => 'c',  // f = Fahrenheit, c = Celsius
     *  'distance'    => 'km', // mi = miles, km = kilometers
     *  'pressure'    => 'mb', // in = pounds per square inch, mb = millibars
     *  'speed'       => 'kph' // mph = miles per hour, kph = kilometers per hour
     * )</pre>
     *
     * @return Data\Wind
     */
    public function getWind()
    {
        return $this->wind;
    }

    /**
     * Returns the requested data element from the Yahoo weather namespace.
     *
     * @param string $key     Key of the data to be retrieved.
     * @param string $subPath Optional: Sub path to search the element in.
     *
     * @return array Associative array of feed data.
     * @throws \InvalidArgumentException Thrown if $key is not a valid element
     *                                   in the namespace.
     */
    protected function getDataFromNamespace($key, $subPath = '')
    {
        $result = $this->xml->xpath(
            sprintf(
                '//channel/%s%s:%s',
                !empty($subPath) ? $subPath . '/' : '',
                self::WEATHER_API_XPATH_NAMESPACE_PREFIX,
                $key
            )
        );
        if (!is_array($result)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Element %s not found in namespace %s',
                    $key,
                    self::WEATHER_API_XPATH_NAMESPACE_PREFIX
                )
            );
        }
        $xml = array_pop($result);

        return current($xml->attributes());
    }

    /**
     * Returns a suitable object for the given element key.
     *
     * @param string $key     Key of the data to be retrieved.
     * @param string $subPath Optional: Sub path to search the element in.
     *
     * @return object
     * @throws \InvalidArgumentException Thrown if $key is not a valid element
     *                                   in the namespace.
     * @throws \ReflectionException      Thrown if no object could be created
     *                                   from the returned data.
     */
    protected function createObjectFromData($key, $subPath = '')
    {
        $data = $this->getDataFromNamespace($key, $subPath);
        $class = new \ReflectionClass(
            __NAMESPACE__ . '\\Data\\' . ucfirst($key)
        );
        return $class->newInstanceArgs($data);
    }
} 
