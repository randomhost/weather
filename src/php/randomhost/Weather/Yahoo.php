<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Yahoo class definition
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
namespace randomhost\Weather;

/**
 * Yahoo Weather API
 *
 * This class encapsulates SimpleXML logic for retrieving weather data from the
 * Yahoo Weather API for being displayed on overlay images produces by the
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
class Yahoo
{
    /**
     * Yahoo Weather API feed URL. Use %1$u as placeholder for location ID.
     *
     * @var string
     */
    const WEATHER_API_URL = 'http://weather.yahooapis.com/forecastrss?w=%1$u&u=c';

    /**
     * Yahoo Weather API Xpath namespace prefix.
     *
     * @var string
     */
    const WEATHER_API_XPATH_NAMESPACE_PREFIX = 'yweather';

    /**
     * Yahoo Weather API Xpath namespace.
     *
     * @var string
     */
    const WEATHER_API_XPATH_NAMESPACE = 'http://xml.weather.yahoo.com/ns/rss/1.0';

    /**
     * Location ID for retrieving weather data from Yahoo Weather API.
     *
     * @var int
     */
    protected $locationId = 0;

    /**
     * @var array
     */
    protected $location = array();

    /**
     * @var array
     */
    protected $units = array();

    /**
     * @var array
     */
    protected $wind = array();

    /**
     * @var array
     */
    protected $atmosphere = array();

    /**
     * @var array
     */
    protected $astronomy = array();

    /**
     * @var array
     */
    protected $condition = array();

    /**
     * Constructor
     *
     * @param int $id (optional) location ID for retrieving weather data from
     *                Yahoo Weather API
     */
    public function __construct($id = 0)
    {
        if (0 !== $id) {
            $this->setLocationId($id);
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
        $weatherFeedUrl = sprintf(self::WEATHER_API_URL, $this->locationId);
        $xml = @simplexml_load_file($weatherFeedUrl);

        if (!$xml) {
            throw new \RuntimeException(
                sprintf('Couldn\'t fetch feed from %s', $weatherFeedUrl)
            );
        }

        // register Yahoo! weather namespace
        $xml->registerXpathNamespace(
            self::WEATHER_API_XPATH_NAMESPACE_PREFIX,
            self::WEATHER_API_XPATH_NAMESPACE
        );

        // assign namespace data to properties
        $this->location = array_pop(
            $xml->xpath('//channel/yweather:location ')
        );
        $this->units = array_pop(
            $xml->xpath('//channel/yweather:units ')
        );
        $this->wind = array_pop(
            $xml->xpath('//channel/yweather:wind')
        );
        $this->atmosphere = array_pop(
            $xml->xpath('//channel/yweather:atmosphere')
        );
        $this->astronomy = array_pop(
            $xml->xpath('//channel/yweather:astronomy')
        );
        $this->condition = array_pop(
            $xml->xpath('//channel/item/yweather:condition')
        );
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
     * Returns forecast information about current astronomical conditions.
     *
     * Format:
     * <pre>array(
     *  'sunrise' => 'h:mm am/pm', // today's sunrise time
     *  'sunset'  => 'h:mm am/pm'  // today's sunset time
     * )</pre>
     *
     * @return \ArrayObject
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
     * @return array
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
     * @return array
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
     * @return array
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
     * @return array
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
     * @return array
     */
    public function getWind()
    {
        return $this->wind;
    }
} 
