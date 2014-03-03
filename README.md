PHP_Weather
===========

This package encapsulates SimpleXML functions for easy retrieval of weather data
from the [Yahoo Weather API](http://developer.yahoo.com/weather/). It
was created as part of the PHP_Webcam_Overlay package but is released as a
separate component so it can be used in other packages.

Because it was created as a dependency of the PHP_Webcam_Overlay package, it
does only support a subset of the available weather data.

System-Wide Installation
------------------------

PHP_Weather should be installed using the [PEAR Installer](http://pear.php.net).
This installer is the PHP community's de-facto standard for installing PHP
components.

    sudo pear channel-discover pear.random-host.com
    sudo pear install --alldeps randomhost/PHP_Weather

As A Dependency On Your Component
---------------------------------

If you are creating a component that relies on PHP_Weather, please make sure that
you add PHP_Weather to your component's package.xml file:

```xml
<dependencies>
  <required>
    <package>
      <name>PHP_Weather</name>
      <channel>pear.random-host.com</channel>
      <min>1.0.0</min>
      <max>1.999.9999</max>
    </package>
  </required>
</dependencies>
```

Usage
-----

A basic approach at using this package could look like this:

```php
<?php
namespace randomhost\Weather;

require 'psr0.autoloader.php';

// get Yahoo Weather API Feed instance
$feed = new Yahoo\Feed(667931, Yahoo\Feed::UNITS_INTL);

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

A more detailed example can be found in `src/www/weather/index.php` which will
also be installed to your PEAR www directory (usually `/usr/share/php/htdocs`).

Development Environment
-----------------------

If you want to patch or enhance this component, you will need to create a
suitable development environment. The easiest way to do that is to install
phix4componentdev:

    # phix4componentdev
    sudo apt-get install php5-xdebug
    sudo apt-get install php5-imagick
    sudo pear channel-discover pear.phix-project.org
    sudo pear -D auto_discover=1 install -Ba phix/phix4componentdev

You can then clone the git repository:

    # PHP_Webcam_Overlay
    git clone https://github.com/Random-Host/PHP_Weather.git

Then, install a local copy of this component's dependencies to complete the
development environment:

    # build vendor/ folder
    phing build-vendor

To make life easier for you, common tasks (such as running unit tests,
generating code review analytics, and creating the PEAR package) have been
automated using [phing](http://phing.info).  You'll find the automated steps
inside the build.xml file that ships with the component.

Run the command 'phing' in the component's top-level folder to see the full list
of available automated tasks.

License
-------

See LICENSE.txt for full license details.
