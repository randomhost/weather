<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * FeedTest unit test definition
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
namespace randomhost\Weather\Yahoo;

/**
 * Unit test for Feed
 *
 * @category  Weather
 * @package   PHP_Weather
 * @author    Ch'Ih-Yu <chi-yu@web.de>
 * @copyright 2014 random-host.com
 * @license   http://www.debian.org/misc/bsd.license  BSD License (3 Clause)
 * @version   Release: @package_version@
 * @link      https://pear.random-host.com/
 */
class FeedTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests Feed::__construct() without parameters
     *
     * @return void
     */
    public function testConstructWithoutParameters()
    {
        $feed = new Feed();

        $this->assertInstanceOf(__NAMESPACE__ . '\Feed', $feed);
        $this->assertEquals(0, $feed->getLocationId());
        $this->assertEquals('c', $feed->getSystemOfUnits());
    }

    /**
     * Tests Feed::__construct() with set $locationId parameter
     *
     * @return void
     */
    public function testConstructWithLocationId()
    {
        $locationId = 667931;

        $feed = new Feed($locationId);

        $this->assertInstanceOf(__NAMESPACE__ . '\Feed', $feed);
        $this->assertEquals($locationId, $feed->getLocationId());
        $this->assertEquals('c', $feed->getSystemOfUnits());
    }

    /**
     * Tests Feed::__construct() with set $systemOfUnits parameter
     *
     * @return void
     */
    public function testConstructWithSystemOfUnits()
    {
        $systemOfUnits = 'f';

        $feed = new Feed(0, $systemOfUnits);

        $this->assertInstanceOf(__NAMESPACE__ . '\Feed', $feed);
        $this->assertEquals(0, $feed->getLocationId());
        $this->assertEquals($systemOfUnits, $feed->getSystemOfUnits());
    }

    /**
     * Tests Feed::__construct() with an empty $systemOfUnits parameter
     *
     * @return void
     */
    public function testConstructWithEmptySystemOfUnits()
    {
        $feed = new Feed(0, '');

        $this->assertInstanceOf(__NAMESPACE__ . '\Feed', $feed);
        $this->assertEquals(0, $feed->getLocationId());
        $this->assertEquals('c', $feed->getSystemOfUnits());
    }

    /**
     * Tests Feed::fetchData()
     *
     * @return void
     */
    public function testFetchData()
    {
        $feed = new Feed();
        $this->assertInstanceOf(__NAMESPACE__ . '\Feed', $feed);

        $feed->setLocationId(667931);
        $this->assertInstanceOf(__NAMESPACE__ . '\Feed', $feed->fetchData());
    }

    /**
     * Tests Feed::fetchData() with the $locationId not set
     *
     * @expectedException \RuntimeException
     *
     * @return void
     */
    public function testFetchDataException()
    {
        $feed = new Feed();
        $this->assertInstanceOf(__NAMESPACE__ . '\Feed', $feed);

        $feed->fetchData();
    }

    /**
     * Tests Feed::__construct() with set $systemOfUnits parameter
     *
     * @return void
     */
    public function testSetGetLocationId()
    {
        $feed = new Feed();
        $this->assertInstanceOf(__NAMESPACE__ . '\Feed', $feed);

        $locationId = 667931;
        $feed->setLocationId($locationId);
        $this->assertEquals($locationId, $feed->getLocationId());
    }

    /**
     * Tests Feed::__construct() with set $systemOfUnits parameter
     *
     * @return void
     */
    public function testSetGetLocationIdString()
    {
        $feed = new Feed();
        $this->assertInstanceOf(__NAMESPACE__ . '\Feed', $feed);

        $locationId = '667931';
        $feed->setLocationId($locationId);
        $this->assertEquals((int)$locationId, $feed->getLocationId());
    }

    /**
     * Tests Feed::__construct() with set $systemOfUnits parameter
     *
     * @return void
     */
    public function testSetGetSystemOfUnits()
    {
        $feed = new Feed();
        $this->assertInstanceOf(__NAMESPACE__ . '\Feed', $feed);

        $systemOfUnits = 'f';
        $feed->setSystemOfUnits($systemOfUnits);
        $this->assertEquals($systemOfUnits, $feed->getSystemOfUnits());
    }

    /**
     * Tests Feed::__construct() with set $systemOfUnits parameter
     *
     * @expectedException \InvalidArgumentException
     *
     * @return void
     */
    public function testSetGetSystemOfUnitsWithInvalidValue()
    {
        $feed = new Feed();
        $this->assertInstanceOf(__NAMESPACE__ . '\Feed', $feed);
        $feed->setSystemOfUnits('z');
    }

    /**
     * Tests Feed::getLocation()
     *
     * @return void
     */
    public function testGetLocation()
    {
        $feed = new Feed();
        $this->assertInstanceOf(__NAMESPACE__ . '\Feed', $feed);

        $this->assertNull($feed->getLocation());

        $feed->setLocationId(667931);
        $feed->fetchData();
        $this->assertInstanceOf(
            __NAMESPACE__ . '\Data\Location',
            $feed->getLocation()
        );
    }

    /**
     * Tests Feed::getUnits()
     *
     * @return void
     */
    public function testGetUnits()
    {
        $feed = new Feed();
        $this->assertInstanceOf(__NAMESPACE__ . '\Feed', $feed);

        $this->assertNull($feed->getUnits());

        $feed->setLocationId(667931);
        $feed->fetchData();
        $this->assertInstanceOf(
            __NAMESPACE__ . '\Data\Units',
            $feed->getUnits()
        );
    }

    /**
     * Tests Feed::getWind()
     *
     * @return void
     */
    public function testGetWind()
    {
        $feed = new Feed();
        $this->assertInstanceOf(__NAMESPACE__ . '\Feed', $feed);

        $this->assertNull($feed->getWind());

        $feed->setLocationId(667931);
        $feed->fetchData();
        $this->assertInstanceOf(
            __NAMESPACE__ . '\Data\Wind',
            $feed->getWind()
        );
    }

    /**
     * Tests Feed::getAtmosphere()
     *
     * @return void
     */
    public function testGetAtmosphere()
    {
        $feed = new Feed();
        $this->assertInstanceOf(__NAMESPACE__ . '\Feed', $feed);

        $this->assertNull($feed->getAtmosphere());

        $feed->setLocationId(667931);
        $feed->fetchData();
        $this->assertInstanceOf(
            __NAMESPACE__ . '\Data\Atmosphere',
            $feed->getAtmosphere()
        );
    }

    /**
     * Tests Feed::getAstronomy()
     *
     * @return void
     */
    public function testGetAstronomy()
    {
        $feed = new Feed();
        $this->assertInstanceOf(__NAMESPACE__ . '\Feed', $feed);

        $this->assertNull($feed->getAstronomy());

        $feed->setLocationId(667931);
        $feed->fetchData();
        $this->assertInstanceOf(
            __NAMESPACE__ . '\Data\Astronomy',
            $feed->getAstronomy()
        );
    }

    /**
     * Tests Feed::getCondition()
     *
     * @return void
     */
    public function testGetCondition()
    {
        $feed = new Feed();
        $this->assertInstanceOf(__NAMESPACE__ . '\Feed', $feed);

        $this->assertNull($feed->getCondition());

        $feed->setLocationId(667931);
        $feed->fetchData();
        $this->assertInstanceOf(
            __NAMESPACE__ . '\Data\Condition',
            $feed->getCondition()
        );
    }
}
