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
     * Yahoo Weather API Xpath namespace prefix
     *
     * @var string
     */
    const XPATH_NAMESPACE_PREFIX = 'yweather';

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
     * Weather API feed URL
     *
     * @var string
     */
    protected $feedUrl = 'http://weather.yahooapis.com/forecastrss?w=%1$u&u=%2$s';

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
     * Constructor.
     *
     * If a $locationId is given, $this::fetchData() will be called implicitly.
     * Else, it must be called manually after setting a location ID using
     * $this::setLocationId();
     *
     * @param int    $locationId    Optional: Location ID.
     * @param string $systemOfUnits Optional: One of the self::UNITS_* constants.
     * @param string $feedUrl       Optional: alternative feed URL
     */
    public function __construct(
        $locationId = 0, $systemOfUnits = '', $feedUrl = ''
    ) {
        if ('' !== $systemOfUnits) {
            $this->setSystemOfUnits($systemOfUnits);
        }

        if ('' !== $feedUrl) {
            $this->setFeedUrl($feedUrl);
        }

        if (0 !== $locationId) {
            $this->setLocationId($locationId);
            $this->fetchData();
        }
    }

    /**
     * Fetches weather data from the Yahoo Weather API and sets class properties.
     *
     * @return $this
     *
     * @throws \RuntimeException Thrown in case data could not be retrieved.
     */
    public function fetchData()
    {
        $this->xml = $this->loadFeed();

        // turn namespace data into objects
        try {
            $this->location = $this->createObjectFromData('location');
            $this->units = $this->createObjectFromData('units');
            $this->wind = $this->createObjectFromData('wind');
            $this->atmosphere = $this->createObjectFromData('atmosphere');
            $this->astronomy = $this->createObjectFromData('astronomy');
            $this->condition = $this->createObjectFromData('condition', 'item');
        } catch (\Exception $e) {
            throw new \RuntimeException($e->getMessage(), $e->getCode(), $e);
        }

        return $this;
    }

    /**
     * Sets the feed URL for retrieving weather data from Yahoo Weather API.
     *
     * @param string $feedUrl Weather API feed URL
     *
     * @return $this
     */
    public function setFeedUrl($feedUrl)
    {
        $this->feedUrl = $feedUrl;

        return $this;
    }

    /**
     * Returns the last set weather API feed URL.
     *
     * @return string
     */
    public function getFeedUrl()
    {
        return $this->feedUrl;
    }

    /**
     * Sets the location ID for retrieving weather data from Yahoo Weather API.
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
     * Returns a Data\Location object holding the location of this forecast.
     *
     * @return Data\Location
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Returns a Data\Units object holding units for various aspects of the forecast.
     *
     * @return Data\Units
     */
    public function getUnits()
    {
        return $this->units;
    }

    /**
     * Returns a Data\Wind object holding forecast information about wind.
     *
     * @return Data\Wind
     */
    public function getWind()
    {
        return $this->wind;
    }

    /**
     * Returns a Data\Atmosphere object holding forecast information about
     * current atmospheric pressure, humidity, and visibility.
     *
     * @return Data\Atmosphere
     */
    public function getAtmosphere()
    {
        return $this->atmosphere;
    }

    /**
     * Returns a Data\Astronomy object holding forecast information about
     * current astronomical conditions.
     *
     * @return Data\Astronomy
     */
    public function getAstronomy()
    {
        return $this->astronomy;
    }

    /**
     * Returns a Data\Condition object holding the current weather conditions.
     *
     * @return Data\Condition
     */
    public function getCondition()
    {
        return $this->condition;
    }

    /**
     * Retrieves the XML from the Yahoo Weather API.
     *
     * @return \SimpleXMLElement
     * @throws \RuntimeException Thrown in case no location ID was set or the
     *                           feed could not be loaded.
     */
    protected function loadFeed()
    {
        if (0 === $this->locationId) {
            throw new \RuntimeException('No location ID was given');
        }

        $feedUrl = sprintf(
            $this->feedUrl,
            $this->locationId,
            $this->systemOfUnits
        );

        $xml = @simplexml_load_file($feedUrl);
        if (!$xml) {
            throw new \RuntimeException(
                sprintf('Couldn\'t fetch feed from %s', $feedUrl)
            );
        }

        return $xml;
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
        $result = @$this->xml->xpath(
            sprintf(
                '//channel/%s%s:%s',
                !empty($subPath) ? $subPath . '/' : '',
                self::XPATH_NAMESPACE_PREFIX,
                $key
            )
        );
        if (!is_array($result)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Namespace "%s" not found',
                    self::XPATH_NAMESPACE_PREFIX
                )
            );
        }
        $xml = array_pop($result);
        if (!$xml instanceof \SimpleXMLElement) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Element "%s" not found in namespace "%s"',
                    $key,
                    self::XPATH_NAMESPACE_PREFIX
                )
            );
        }
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
