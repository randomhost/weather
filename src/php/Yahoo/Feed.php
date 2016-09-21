<?php
namespace randomhost\Weather\Yahoo;

/**
 * Yahoo Weather API
 *
 * Encapsulates logic for retrieving weather data from the Yahoo Weather API.
 *
 * @author    Ch'Ih-Yu <chi-yu@web.de>
 * @copyright 2016 random-host.comW
 * @license   http://www.debian.org/misc/bsd.license  BSD License (3 Clause)
 * @link      http://github.random-host.com/weather/
 */
class Feed
{
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
    protected $feedUrl = 'https://query.yahooapis.com/v1/public/yql';

    /**
     * Location name for retrieving weather data from Yahoo Weather API.
     *
     * @var int
     */
    protected $locationName = '';

    /**
     * Defines the system of units to be returned by the feed.
     *
     * @var string
     */
    protected $systemOfUnits = self::UNITS_INTL;

    /**
     * Yahoo weather feed data.
     *
     * @var array
     */
    protected $jsonData = array();

    /**
     * Location object instance.
     *
     * @var Data\Location|null
     */
    protected $location = null;

    /**
     * Units object instance.
     *
     * @var Data\Units|null
     */
    protected $units = null;

    /**
     * Wind object instance.
     *
     * @var Data\Wind|null
     */
    protected $wind = null;

    /**
     * Atmosphere object instance.
     *
     * @var Data\Atmosphere|null
     */
    protected $atmosphere = null;

    /**
     * Astronomy object instance.
     *
     * @var Data\Astronomy|null
     */
    protected $astronomy = null;

    /**
     * Condition object instance.
     *
     * @var Data\Condition|null
     */
    protected $condition = null;

    /**
     * Array of forecast object instances.
     *
     * @var Data\Forecast[]|array
     */
    protected $forecast = array();

    /**
     * Weather data title.
     *
     * @var string
     */
    protected $title = '';

    /**
     * Weather data link.
     *
     * @var string
     */
    protected $link = '';

    /**
     * Constructor.
     *
     * If a $locationName is given, $this::fetchData() will be called implicitly.
     * Else, it must be called manually after setting a location name using
     * $this::setLocationName();
     *
     * @param string $locationName  Optional: Location name.
     * @param string $systemOfUnits Optional: One of the self::UNITS_* constants.
     * @param string $feedUrl       Optional: alternative feed URL
     */
    public function __construct(
        $locationName = '',
        $systemOfUnits = '',
        $feedUrl = ''
    ) {
        if ('' !== $systemOfUnits) {
            $this->setSystemOfUnits($systemOfUnits);
        }

        if ('' !== $feedUrl) {
            $this->setFeedUrl($feedUrl);
        }

        if ('' !== $locationName) {
            $this->setLocationName($locationName);
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
        $this->jsonData = $this->loadFeed();

        // turn namespace data into objects
        try {
            $this->location = $this->createObjectFromData('location');
            $this->units = $this->createObjectFromData('units');
            $this->wind = $this->createObjectFromData('wind');
            $this->atmosphere = $this->createObjectFromData('atmosphere');
            $this->astronomy = $this->createObjectFromData('astronomy');
            $this->condition = $this->createObjectFromData('condition', 'item');
            $this->forecast = $this->createForecastObjects();
            $this->title = $this->getElementsFromArray('title');
            $this->link = $this->getElementsFromArray('link');
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
     * Sets the location name for retrieving weather data from Yahoo Weather API.
     *
     * @param int $name Location Name for retrieving weather data from Yahoo Weather API
     *
     * @return $this
     */
    public function setLocationName($name)
    {
        $this->locationName = $name;

        return $this;
    }

    /**
     * Returns the last set location name for retrieving weather data.
     *
     * @return int
     */
    public function getLocationName()
    {
        return $this->locationName;
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
     * Returns an array of Data\Forecast objects holding the weather forecast
     * for a specific day.
     *
     * @return Data\Forecast[]|array
     */
    public function getForecast()
    {
        return $this->forecast;
    }

    /**
     * Returns the title of the weather data.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Returns the link of the weather data.
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Retrieves JSON data from the Yahoo Weather API.
     *
     * @return array
     * @throws \RuntimeException Thrown in case no location name was set or the
     *                           feed could not be loaded.
     */
    protected function loadFeed()
    {
        if ('' === $this->locationName) {
            throw new \RuntimeException('No location name was given');
        }

        $feedUrl = $this->feedUrl . $this->buildQueryString();

        $contextOptions = array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
            ),
        );

        $json = @file_get_contents(
            $feedUrl,
            null,
            stream_context_create($contextOptions)
        );
        if (false === $json) {
            throw new \RuntimeException(
                sprintf('Couldn\'t fetch feed from %s', $feedUrl)
            );
        }

        $data = json_decode($json, true);
        if (!$data || empty($data['query']['results']['channel'])) {
            throw new \RuntimeException(
                sprintf('Couldn\'t fetch feed from %s', $feedUrl)
            );
        }

        return $data['query']['results']['channel'];
    }

    /**
     * Returns the requested data elements from the Yahoo weather data array.
     *
     * @param string $key     Key of the data to be retrieved.
     * @param string $subPath Optional: Sub path to search the element in.
     *
     * @return array Data array.
     *
     * @throws \InvalidArgumentException Thrown if $key is not in the array.
     */
    protected function getElementsFromArray($key, $subPath = '')
    {
        if (!empty($subPath)) {
            if (!array_key_exists($subPath, $this->jsonData)) {
                throw new \InvalidArgumentException(
                    sprintf(
                        'Sub path "%s" not found',
                        $subPath
                    )
                );
            }
            if (!array_key_exists($key, $this->jsonData[$subPath])) {
                throw new \InvalidArgumentException(
                    sprintf(
                        'Key "%s" not found in sub path "%s"',
                        $key,
                        $subPath
                    )
                );
            }

            return $this->jsonData[$subPath][$key];
        }

        if (!array_key_exists($key, $this->jsonData)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Key "%s" not found',
                    $key
                )
            );
        }

        return $this->jsonData[$key];
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
        $data = $this->getElementsFromArray($key, $subPath);
        ksort($data);

        $class = new \ReflectionClass(
            __NAMESPACE__ . '\\Data\\' . ucfirst($key)
        );
        return $class->newInstanceArgs($data);
    }

    /**
     * Returns an array of Forecast objects.
     *
     * @return array
     * @throws \InvalidArgumentException Thrown if forecast data is missing in
     *                                   the feed.
     * @throws \ReflectionException      Thrown if no objects could be created
     *                                   from the returned data.
     */
    protected function createForecastObjects()
    {
        $array = $this->getElementsFromArray('forecast', 'item');

        $class = new \ReflectionClass(
            __NAMESPACE__ . '\\Data\\Forecast'
        );

        $forecasts = array();

        foreach ($array as $forecast) {
            ksort($forecast);

            if (array_key_exists('day', $forecast)) {
                unset($forecast['day']);
            }

            $forecasts[] = $class->newInstanceArgs($forecast);
        }

        return $forecasts;
    }

    /**
     * Returns the query string to be used.
     *
     * @return string
     */
    protected function buildQueryString()
    {
        $query = sprintf(
            'select * from weather.forecast ' .
            'where woeid in ' .
            '(select woeid from geo.places(1) where text="%1$s") ' .
            'and u="%2$s"',
            $this->getLocationName(),
            $this->getSystemOfUnits()
        );

        $params = array(
            'q' => $query,
            'format' => 'json'
        );

        return '?' . http_build_query($params);
    }
}
