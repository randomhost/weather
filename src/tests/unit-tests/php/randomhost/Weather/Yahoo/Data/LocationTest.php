<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * LocationTest unit test definition
 *
 * PHP version 5
 *
 * @category  Weather
 * @package   PHP_Weather
 * @author    Ch'Ih-Yu <chi-yu@web.de>
 * @copyright 2014 random-host.com
 * @license   http://www.debian.org/misc/bsd.license BSD License (3 Clause)
 * @link      https://pear.random-host.com/
 */
namespace randomhost\Weather\Yahoo\Data;

/**
 * Unit test for Location
 *
 * @category  Weather
 * @package   PHP_Weather
 * @author    Ch'Ih-Yu <chi-yu@web.de>
 * @copyright 2014 random-host.com
 * @license   http://www.debian.org/misc/bsd.license  BSD License (3 Clause)
 * @version   Release: @package_version@
 * @link      https://pear.random-host.com/
 */
class LocationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Data provider for most test cases.
     *
     * @return array
     */
    public function provider()
    {
        return array(
            // city, region, country
            array('Cologne', 'NW', 'Germany'),
            array('', 'NW', 'Germany'),
            array('Cologne', '', 'Germany'),
            array('Cologne', 'NW', ''),
            array('', '', ''),
        );
    }

    /**
     * Tests Location::setCity() and Location::getCity()
     *
     * @param string $city    City name.
     * @param string $region  State, territory, or region.
     * @param string $country Country name.
     *
     * @dataProvider provider
     *
     * @return void
     */
    public function testSetGetCity($city, $region, $country)
    {
        $location = new Location($city, $region, $country);

        $result = $location->getCity();

        $this->assertSame($city, $result);
    }

    /**
     * Tests Location::setRegion() and Location::getRegion()
     *
     * @param string $city    City name.
     * @param string $region  State, territory, or region.
     * @param string $country Country name.
     *
     * @dataProvider provider
     *
     * @return void
     */
    public function testSetGetRegion($city, $region, $country)
    {
        $location = new Location($city, $region, $country);

        $result = $location->getRegion();

        $this->assertSame($region, $result);
    }

    /**
     * Tests Location::setCountry() and Location::getCountry()
     *
     * @param string $city    City name.
     * @param string $region  State, territory, or region.
     * @param string $country Country name.
     *
     * @dataProvider provider
     *
     * @return void
     */
    public function testSetGetCountry($city, $region, $country)
    {
        $location = new Location($city, $region, $country);

        $result = $location->getCountry();

        $this->assertSame($country, $result);
    }
}
