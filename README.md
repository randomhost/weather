[![Build Status][0]][1]

randomhost/weather
==================

This package encapsulates functions for easy retrieval of weather data from the
[Yahoo Weather API][2]. It was created as part of `randomhost/webcamoverlay`
but is released as a separate component so it can be used in other packages.

Because it was created as a dependency of `randomhost/webcamoverlay`, it does
only support a subset of the available weather data.

Usage
-----

A basic approach at using this package could look like this:

```php
<?php
namespace randomhost\Weather;

require_once '/path/to/vendor/autoload.php';

// get Yahoo Weather API Feed instance
$feed = new Yahoo\Feed('Cologne', Yahoo\Feed::UNITS_INTL);

echo sprintf(
    'Temperature: %s°%s, Humidity: %s%%',
    $feed->getCondition()->getTemperature(),
    $feed->getUnits()->getTemperature(),
    $feed->getAtmosphere()->getHumidity()
);
```

This will instantiate the class, fetch the weather data and display current
temperature and humidity.

Assuming that you named this file `weather.php`, you should now be able to
access the weather data at `http://example.com/weather.php`

A more detailed example can be found in `src/www/weather/index.php`.

### The Feed object

The `Feed` object is the primary object you will interact with in your application.
It provides all methods required for retrieving data from the Yahoo! Weather API.

#### Constructor

The constructor takes 3 parameters which are all optional:

- `$locationName`  
Location name for retrieving weather data from the Yahoo Weather API.

- `$systemOfUnits`  
System of units to be returned by the feed. This must be either `Feed::UNITS_INTL`
or `Feed::UNITS_US`.

- `$feedUrl`  
Feed URL for retrieving weather data from Yahoo Weather API.

If a `$locationName` is given, `Feed::fetchData()` will be called implicitly
which will automatically retrieve weather data for the given location ID and
populate the data access objects accordingly.  
If you do not want this, you can omit `$locationName` or set it to `''` (an empty
string) and configure the location name yourself using `Feed::setLocationName()`.

The `$systemOfUnits` parameter can be used to determine the system of units to
be used by the weather feed. If not given or set to `''` (an empty string), it
defaults to using international units (Celsius, kilometers, millibars).

`$feedUrl` defines the feed URL for retrieving weather data from the Yahoo!
Weather API. This parameter does not usually need to be changed unless Yahoo!
changes their API.

#### Configuring the feed

The following public methods for configuring the weather feed are available:

- `setFeedUrl($feedUrl)`  
Sets the feed URL for retrieving weather data from the Yahoo! Weather API.

- `getFeedUrl()`  
Returns the last set weather API feed URL.

- `setLocationName($name)`  
Sets the location name for retrieving weather data from Yahoo Weather API.

- `getLocationName()`  
Returns the last set location name for retrieving weather data.

- `setSystemOfUnits($systemOfUnits)`  
Sets the system of units to be returned by the feed.

- `getSystemOfUnits()`  
Returns the last set system of units.

#### Retrieving data from the feed

The following public methods for retrieving data from the feed are available:

- `fetchData()`  
Fetches weather data from the Yahoo Weather API and populates the data access
objects accordingly.  
This method must be called at least once before using any of the methods listed
below.

- `getLocation()`  
Returns a `Data\Location` object holding the location of this forecast.

- `getUnits()`  
Returns a `Data\Units` object holding units for various aspects of the forecast.

- `getWind()`  
Returns a `Data\Wind` object holding forecast information about wind.

- `getAtmosphere()`  
Returns a `Data\Atmosphere` object holding forecast information about current
atmospheric pressure, humidity, and visibility.

- `getAstronomy()`  
Returns a `Data\Astronomy` object holding forecast information about current
astronomical conditions.

- `getCondition()`  
Returns a `Data\Condition` object holding the current weather conditions.

- `getForecast()`  
Returns an array of `Data\Forecast` objects holding the weather forecast for a
specific day.

### The Data\Location object

The `Data\Location` object represents location information of the forecast.

The following public methods for retrieving data are available:

- `getCity()`  
Returns the city name. (string)

- `getRegion()`  
Returns the state, territory, or region. (string)

- `getCountry()`  
Returns the country name. (string)

### The Data\Units object

The `Data\Units` object represents units for various aspects of the forecast.

The following public methods for retrieving data are available:

- `getTemperature()`  
Returns the degree units for temperature. (string)

- `getDistance()`  
Returns the units for distance. (string)

- `getPressure()`  
Returns the units of barometric pressure. (string)

- `getSpeed()`  
Returns the units of speed. (string)

### The Data\Wind object

The `Data\Wind` object represents forecast information about wind.

The following public methods for retrieving data are available:

- `getChill()`  
Returns the wind chill in degrees. (float)

- `getDirection()`  
Returns the wind direction, in degrees. (float)

- `getSpeed()`  
Returns the wind speed. (float)

### The Data\Atmosphere object

The `Data\Atmosphere` object represents forecast information about current
atmospheric pressure, humidity, and visibility.

The following public methods for retrieving data are available:

- `getHumidity()`  
Returns the humidity in percent. (float)

- `getVisibility()`  
Returns the visibility. (float)

- `getPressure()`  
Returns the barometric pressure. (float)

- `getRising()`  
Returns the state of the barometric pressure: steady (0), rising (1),
or falling (2). (int)  

### The Data\Astronomy object

The `Data\Astronomy` object represents forecast information about current
astronomical conditions.

The following public methods for retrieving data are available:

- `getSunrise()`  
Returns today's sunrise time. (\DateTime)

- `getSunset()`  
Returns today's sunset time. (\DateTime)

### The Data\Condition object

The `Data\Condition` object represents the current weather conditions.

The following public methods for retrieving data are available:

- `getText()`  
Returns the textual description of conditions. (string)

- `getCode()`  
Returns the condition code for this forecast. You could use this code to choose
a text description or image for the forecast.  
The possible values for this element are described in [Condition Codes][3]. (int)

- `getTemperature()`  
Returns the current temperature. (float)

- `getDate()`  
Returns the current date and time for which this forecast applies. (\DateTime)

### The Data\Forecast object

The `Data\Forecast` object represents the weather forecast for a specific day.

The following public methods for retrieving data are available:

- `getDate()`  
Returns the date to which this forecast applies. (\DateTime)

- `getLow()`  
Returns the forecasted low temperature for this day. (float)

- `getHigh()`  
Returns the forecasted high temperature for this day. (float)

- `getText()`  
Returns the textual description of conditions. (string)

- `getCode()`  
Returns the condition code for this forecast. You could use this code to choose
a text description or image for the forecast.  
The possible values for this element are described in [Condition Codes][3]. (int)

License
-------

See LICENSE.txt for full license details.


[0]: https://travis-ci.org/randomhost/weather.svg?branch=master
[1]: https://travis-ci.org/randomhost/weather
[2]: http://developer.yahoo.com/weather/
[3]: https://developer.yahoo.com/weather/documentation.html#codes
