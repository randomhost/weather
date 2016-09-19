<?php
namespace randomhost\Weather\Yahoo\Data;

/**
 * Unit test for Location
 *
 * @author    Ch'Ih-Yu <chi-yu@web.de>
 * @copyright 2016 random-host.com
 * @license   http://www.debian.org/misc/bsd.license  BSD License (3 Clause)
 * @link      http://github.random-host.com/weather/
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
            // city, country, region
            array('Cologne', 'Germany', 'NW'),
            array('', 'Germany', 'NW'),
            array('Cologne', 'Germany', ''),
            array('Cologne', '', 'NW'),
            array('', '', ''),
        );
    }

    /**
     * Tests Location::setCity() and Location::getCity().
     *
     * @param string $city    City name.
     * @param string $country Country name.
     * @param string $region  State, territory, or region.
     *
     * @dataProvider provider
     */
    public function testSetGetCity($city, $country, $region)
    {
        $location = new Location($city, $country, $region);

        $result = $location->getCity();

        $this->assertSame($city, $result);
    }

    /**
     * Tests Location::setRegion() and Location::getRegion().
     *
     * @param string $city    City name.
     * @param string $country Country name.
     * @param string $region  State, territory, or region.
     *
     * @dataProvider provider
     */
    public function testSetGetRegion($city, $country, $region)
    {
        $location = new Location($city, $country, $region);

        $result = $location->getRegion();

        $this->assertSame($region, $result);
    }

    /**
     * Tests Location::setCountry() and Location::getCountry().
     *
     * @param string $city    City name.
     * @param string $country Country name.
     * @param string $region  State, territory, or region.
     *
     * @dataProvider provider
     */
    public function testSetGetCountry($city, $country, $region)
    {
        $location = new Location($city, $country, $region);

        $result = $location->getCountry();

        $this->assertSame($country, $result);
    }
}
