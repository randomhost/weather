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
     * Default feed URL in case no feed URL is set manually
     *
     * @var string
     */
    const DEFAULT_FEED = 'http://weather.yahooapis.com/forecastrss?w=%1$u&u=%2$s';

    /**
     * Path to test data directory
     *
     * @var string
     */
    const TEST_DATA_DIR = '../../../testdata';

    /**
     * Test feed file with valid data
     *
     * @var string
     */
    const TEST_FEED_VALID = 'feedValid.xml';

    /**
     * Test feed file with missing namespace
     *
     * @var string
     */
    const TEST_FEED_NAMESPACE_ERROR = 'feedNamespaceError.xml';

    /**
     * Test feed file with missing fields
     *
     * @var string
     */
    const TEST_FEED_MISSING_FIELD_ERROR = 'feedMissingFieldError.xml';

    /**
     * Tests Feed::__construct() without parameters
     *
     * @return void
     */
    public function testConstructWithoutParameters()
    {
        $feed = new Feed();

        $this->assertInstanceOf(__NAMESPACE__ . '\Feed', $feed);
        $this->assertSame(0, $feed->getLocationId());
        $this->assertSame('c', $feed->getSystemOfUnits());
        $this->assertSame(self::DEFAULT_FEED, $feed->getFeedUrl());
    }

    /**
     * Tests Feed::__construct() with set $locationId parameter
     *
     * @return void
     */
    public function testConstructWithLocationId()
    {
        $locationId = 667931;

        $feed = new Feed(
            $locationId,
            '',
            $this->getTestFeedPath(self::TEST_FEED_VALID)
        );

        $this->assertInstanceOf(__NAMESPACE__ . '\Feed', $feed);
        $this->assertSame($locationId, $feed->getLocationId());
        $this->assertSame('c', $feed->getSystemOfUnits());
    }

    /**
     * Tests Feed::__construct() with set $systemOfUnits parameter
     *
     * @return void
     */
    public function testConstructWithSystemOfUnits()
    {
        $systemOfUnits = 'f';

        $feed = new Feed(
            0,
            $systemOfUnits,
            $this->getTestFeedPath(self::TEST_FEED_VALID)
        );

        $this->assertInstanceOf(__NAMESPACE__ . '\Feed', $feed);
        $this->assertSame(0, $feed->getLocationId());
        $this->assertSame($systemOfUnits, $feed->getSystemOfUnits());
    }

    /**
     * Tests Feed::__construct() with an empty $systemOfUnits parameter
     *
     * @return void
     */
    public function testConstructWithEmptySystemOfUnits()
    {
        $feed = new Feed(
            0,
            '',
            $this->getTestFeedPath(self::TEST_FEED_VALID)
        );

        $this->assertInstanceOf(__NAMESPACE__ . '\Feed', $feed);
        $this->assertSame(0, $feed->getLocationId());
        $this->assertSame('c', $feed->getSystemOfUnits());
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
        $feed->setFeedUrl($this->getTestFeedPath(self::TEST_FEED_VALID));
        $this->assertInstanceOf(__NAMESPACE__ . '\Feed', $feed->fetchData());
    }

    /**
     * Tests Feed::fetchData() with in invalid feed URL
     *
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Couldn't fetch feed from doesNotExist.xml
     *
     * @return void
     */
    public function testFetchDataInvalidFeedUrl()
    {
        $feed = new Feed();
        $this->assertInstanceOf(__NAMESPACE__ . '\Feed', $feed);

        $feed->setLocationId(667931);

        $feedUrl = 'doesNotExist.xml';
        $feed->setFeedUrl($feedUrl);
        $this->assertSame($feedUrl, $feed->getFeedUrl());
        $feed->fetchData();
    }

    /**
     * Tests Feed::fetchData() with a missing namespace in the feed
     *
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Namespace "yweather" not found
     *
     * @return void
     */
    public function testFetchDataNamespaceError()
    {
        $feed = new Feed();
        $this->assertInstanceOf(__NAMESPACE__ . '\Feed', $feed);

        $feed->setLocationId(667931);
        $feed->setFeedUrl(
            $this->getTestFeedPath(self::TEST_FEED_NAMESPACE_ERROR)
        );
        $feed->fetchData();
    }

    /**
     * Tests Feed::fetchData() with a missing field in the feed
     *
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Element "location" not found in namespace
     *
     * @return void
     */
    public function testFetchDataMissingFieldError()
    {
        $feed = new Feed();
        $this->assertInstanceOf(__NAMESPACE__ . '\Feed', $feed);

        $feed->setLocationId(667931);
        $feed->setFeedUrl(
            $this->getTestFeedPath(self::TEST_FEED_MISSING_FIELD_ERROR)
        );
        $feed->fetchData();
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
        $this->assertSame($locationId, $feed->getLocationId());
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
        $this->assertSame((int)$locationId, $feed->getLocationId());
    }

    /**
     * Tests Feed::__construct() with set $systemOfUnits parameter
     *
     * @return void
     */
    public function testSetGetFeedUrl()
    {
        $feed = new Feed();
        $this->assertInstanceOf(__NAMESPACE__ . '\Feed', $feed);

        $feedUrl = 'testValid.xml';
        $feed->setFeedUrl($feedUrl);
        $this->assertSame($feedUrl, $feed->getFeedUrl());
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
        $this->assertSame($systemOfUnits, $feed->getSystemOfUnits());
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
        $feed->setFeedUrl($this->getTestFeedPath(self::TEST_FEED_VALID));
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
        $feed->setFeedUrl($this->getTestFeedPath(self::TEST_FEED_VALID));
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
        $feed->setFeedUrl($this->getTestFeedPath(self::TEST_FEED_VALID));
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
        $feed->setFeedUrl($this->getTestFeedPath(self::TEST_FEED_VALID));
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
        $feed->setFeedUrl($this->getTestFeedPath(self::TEST_FEED_VALID));
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
        $feed->setFeedUrl($this->getTestFeedPath(self::TEST_FEED_VALID));
        $feed->fetchData();
        $this->assertInstanceOf(
            __NAMESPACE__ . '\Data\Condition',
            $feed->getCondition()
        );
    }

    /**
     * Tests Feed::getForecast()
     *
     * @return void
     */
    public function testGetForecast()
    {
        $feed = new Feed();
        $this->assertInstanceOf(__NAMESPACE__ . '\Feed', $feed);

        $forecast = $feed->getForecast();
        $this->assertInternalType('array', $forecast);
        $this->assertEmpty($forecast);

        $feed->setLocationId(667931);
        $feed->setFeedUrl($this->getTestFeedPath(self::TEST_FEED_VALID));
        $feed->fetchData();

        $forecast = $feed->getForecast();
        $this->assertInternalType('array', $forecast);
        foreach ($forecast as $object) {
            $this->assertInstanceOf(
                __NAMESPACE__ . '\Data\Forecast',
                $object
            );
        }
    }

    /**
     * Returns the path to the given test feed.
     *
     * @param string $feedName Test feed name.
     *
     * @return string
     * @throws \Exception Thrown in case the test feed could not be read.
     */
    protected function getTestFeedPath($feedName)
    {
        $dir = __DIR__ . '/' . self::TEST_DATA_DIR;
        if (!is_dir($dir) || !is_readable($dir)) {
            throw new \Exception(
                sprintf(
                    'Test data directory %s not found',
                    $dir
                )
            );
        }

        $path = realpath($dir) . '/' . $feedName;
        if (!is_file($path) || !is_readable($path)) {
            throw new \Exception(
                sprintf(
                    'Test feed %s not found',
                    $path
                )
            );
        }

        return realpath($path);
    }
}
