<?php
namespace randomhost\Weather\Yahoo;

/**
 * Unit test for Feed
 *
 * @author    Ch'Ih-Yu <chi-yu@web.de>
 * @copyright 2016 random-host.com
 * @license   http://www.debian.org/misc/bsd.license  BSD License (3 Clause)
 * @link      http://github.random-host.com/weather/
 */
class FeedTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Default feed URL in case no feed URL is set manually.
     *
     * @var string
     */
    const DEFAULT_FEED = 'https://query.yahooapis.com/v1/public/yql';

    /**
     * Path to test data directory.
     *
     * @var string
     */
    const TEST_DATA_DIR = '/test/';

    /**
     * Test feed file with valid data.
     *
     * @var string
     */
    const TEST_FEED_VALID = 'feedValid.json';

    /**
     * Test feed file with invalid data.
     *
     * @var string
     */
    const TEST_FEED_INVALID = 'feedInvalid.json';

    /**
     * Test feed file with missing fields.
     *
     * @var string
     */
    const TEST_FEED_MISSING_FIELD_ERROR = 'feedMissingFieldError.json';

    /**
     * Test feed file with missing sub paths.
     *
     * @var string
     */
    const TEST_FEED_MISSING_SUB_PATH_ERROR = 'feedMissingSubPathError.json';

    /**
     * Test feed file with missing sub path fields.
     *
     * @var string
     */
    const TEST_FEED_MISSING_SUB_PATH_FIELD_ERROR = 'feedMissingSubPathFieldError.json';

    /**
     * Tests Feed::__construct() without parameters.
     */
    public function testConstructWithoutParameters()
    {
        $feed = $this->getFeedMock();

        $this->assertInstanceOf(__NAMESPACE__ . '\Feed', $feed);
        $this->assertSame('', $feed->getLocationName());
        $this->assertSame('c', $feed->getSystemOfUnits());
        $this->assertSame(self::DEFAULT_FEED, $feed->getFeedUrl());
    }

    /**
     * Tests Feed::__construct() with set $locationName parameter.
     */
    public function testConstructWithLocationName()
    {
        $locationName = 'Cologne';

        $feed = $this->getFeedMock(
            $locationName,
            '',
            $this->getTestFeedPath(self::TEST_FEED_VALID)
        );

        $this->assertInstanceOf(__NAMESPACE__ . '\Feed', $feed);
        $this->assertSame($locationName, $feed->getLocationName());
        $this->assertSame('c', $feed->getSystemOfUnits());
    }

    /**
     * Tests Feed::__construct() with set $systemOfUnits parameter.
     */
    public function testConstructWithSystemOfUnits()
    {
        $systemOfUnits = 'f';

        $feed = $this->getFeedMock(
            '',
            $systemOfUnits,
            $this->getTestFeedPath(self::TEST_FEED_VALID)
        );

        $this->assertInstanceOf(__NAMESPACE__ . '\Feed', $feed);
        $this->assertSame('', $feed->getLocationName());
        $this->assertSame($systemOfUnits, $feed->getSystemOfUnits());
    }

    /**
     * Tests Feed::__construct() with an empty $systemOfUnits parameter.
     */
    public function testConstructWithEmptySystemOfUnits()
    {
        $feed = $this->getFeedMock(
            '',
            '',
            $this->getTestFeedPath(self::TEST_FEED_VALID)
        );

        $this->assertInstanceOf(__NAMESPACE__ . '\Feed', $feed);
        $this->assertSame('', $feed->getLocationName());
        $this->assertSame('c', $feed->getSystemOfUnits());
    }

    /**
     * Tests Feed::fetchData().
     */
    public function testFetchData()
    {
        $feed = $this->getFeedMock();
        $this->assertInstanceOf(__NAMESPACE__ . '\Feed', $feed);

        $feed->setLocationName('Cologne');
        $feed->setFeedUrl($this->getTestFeedPath(self::TEST_FEED_VALID));
        $this->assertInstanceOf(__NAMESPACE__ . '\Feed', $feed->fetchData());
    }

    /**
     * Tests Feed::fetchData() with in invalid feed URL.
     *
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Couldn't fetch feed from doesNotExist.json
     */
    public function testFetchDataInvalidFeedUrl()
    {
        $feed = $this->getFeedMock();
        $this->assertInstanceOf(__NAMESPACE__ . '\Feed', $feed);

        $feed->setLocationName('Cologne');

        $feedUrl = 'doesNotExist.json';
        $feed->setFeedUrl($feedUrl);
        $this->assertSame($feedUrl, $feed->getFeedUrl());
        $feed->fetchData();
    }

    /**
     * Tests Feed::fetchData() with in invalid feed URL.
     *
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Couldn't fetch feed from
     */
    public function testFetchDataInvalidJson()
    {
        $feed = $this->getFeedMock();
        $this->assertInstanceOf(__NAMESPACE__ . '\Feed', $feed);

        $feed->setLocationName('Cologne');

        $feedUrl = $this->getTestFeedPath(self::TEST_FEED_INVALID);

        $feed->setFeedUrl($feedUrl);
        $this->assertSame($feedUrl, $feed->getFeedUrl());
        $feed->fetchData();
    }

    /**
     * Tests Feed::fetchData() with a missing field in the feed.
     *
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Key "location" not found
     */
    public function testFetchDataMissingFieldError()
    {
        $feed = $this->getFeedMock();
        $this->assertInstanceOf(__NAMESPACE__ . '\Feed', $feed);

        $feed->setLocationName('Cologne');
        $feed->setFeedUrl(
            $this->getTestFeedPath(self::TEST_FEED_MISSING_FIELD_ERROR)
        );
        $feed->fetchData();
    }

    /**
     * Tests Feed::fetchData() with a missing field in the feed.
     *
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Sub path "item" not found
     */
    public function testFetchDataMissingSubPathError()
    {
        $feed = $this->getFeedMock();
        $this->assertInstanceOf(__NAMESPACE__ . '\Feed', $feed);

        $feed->setLocationName('Cologne');
        $feed->setFeedUrl(
            $this->getTestFeedPath(self::TEST_FEED_MISSING_SUB_PATH_ERROR)
        );
        $feed->fetchData();
    }

    /**
     * Tests Feed::fetchData() with a missing field in the feed.
     *
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Key "condition" not found in sub path "item"
     */
    public function testFetchDataMissingSubPathFieldError()
    {
        $feed = $this->getFeedMock();
        $this->assertInstanceOf(__NAMESPACE__ . '\Feed', $feed);

        $feed->setLocationName('Cologne');
        $feed->setFeedUrl(
            $this->getTestFeedPath(self::TEST_FEED_MISSING_SUB_PATH_FIELD_ERROR)
        );
        $feed->fetchData();
    }

    /**
     * Tests Feed::fetchData() with the $locationName not set.
     *
     * @expectedException \RuntimeException
     */
    public function testFetchDataException()
    {
        $feed = $this->getFeedMock();
        $this->assertInstanceOf(__NAMESPACE__ . '\Feed', $feed);

        $feed->fetchData();
    }

    /**
     * Tests Feed::__construct() with set $systemOfUnits parameter.
     */
    public function testSetGetLocationName()
    {
        $feed = $this->getFeedMock();
        $this->assertInstanceOf(__NAMESPACE__ . '\Feed', $feed);

        $locationName = 'Cologne';
        $feed->setLocationName($locationName);
        $this->assertSame($locationName, $feed->getLocationName());
    }

    /**
     * Tests Feed::__construct() with set $systemOfUnits parameter.
     */
    public function testSetGetLocationNameString()
    {
        $feed = $this->getFeedMock();
        $this->assertInstanceOf(__NAMESPACE__ . '\Feed', $feed);

        $locationName = '667931';
        $feed->setLocationName($locationName);
        $this->assertSame($locationName, $feed->getLocationName());
    }

    /**
     * Tests Feed::__construct() with set $systemOfUnits parameter.
     */
    public function testSetGetFeedUrl()
    {
        $feed = $this->getFeedMock();
        $this->assertInstanceOf(__NAMESPACE__ . '\Feed', $feed);

        $feedUrl = 'testValid.json';
        $feed->setFeedUrl($feedUrl);
        $this->assertSame($feedUrl, $feed->getFeedUrl());
    }

    /**
     * Tests Feed::__construct() with set $systemOfUnits parameter.
     */
    public function testSetGetSystemOfUnits()
    {
        $feed = $this->getFeedMock();
        $this->assertInstanceOf(__NAMESPACE__ . '\Feed', $feed);

        $systemOfUnits = 'f';
        $feed->setSystemOfUnits($systemOfUnits);
        $this->assertSame($systemOfUnits, $feed->getSystemOfUnits());
    }

    /**
     * Tests Feed::__construct() with set $systemOfUnits parameter.
     *
     * @expectedException \InvalidArgumentException
     */
    public function testSetGetSystemOfUnitsWithInvalidValue()
    {
        $feed = $this->getFeedMock();
        $this->assertInstanceOf(__NAMESPACE__ . '\Feed', $feed);
        $feed->setSystemOfUnits('z');
    }

    /**
     * Tests Feed::getLocation().
     */
    public function testGetLocation()
    {
        $feed = $this->getFeedMock();
        $this->assertInstanceOf(__NAMESPACE__ . '\Feed', $feed);

        $this->assertNull($feed->getLocation());

        $feed->setLocationName('Cologne');
        $feed->setFeedUrl($this->getTestFeedPath(self::TEST_FEED_VALID));
        $feed->fetchData();
        $this->assertInstanceOf(
            __NAMESPACE__ . '\Data\Location',
            $feed->getLocation()
        );
    }

    /**
     * Tests Feed::getUnits().
     */
    public function testGetUnits()
    {
        $feed = $this->getFeedMock();
        $this->assertInstanceOf(__NAMESPACE__ . '\Feed', $feed);

        $this->assertNull($feed->getUnits());

        $feed->setLocationName('Cologne');
        $feed->setFeedUrl($this->getTestFeedPath(self::TEST_FEED_VALID));
        $feed->fetchData();
        $this->assertInstanceOf(
            __NAMESPACE__ . '\Data\Units',
            $feed->getUnits()
        );
    }

    /**
     * Tests Feed::getWind().
     */
    public function testGetWind()
    {
        $feed = $this->getFeedMock();
        $this->assertInstanceOf(__NAMESPACE__ . '\Feed', $feed);

        $this->assertNull($feed->getWind());

        $feed->setLocationName('Cologne');
        $feed->setFeedUrl($this->getTestFeedPath(self::TEST_FEED_VALID));
        $feed->fetchData();
        $this->assertInstanceOf(
            __NAMESPACE__ . '\Data\Wind',
            $feed->getWind()
        );
    }

    /**
     * Tests Feed::getAtmosphere().
     */
    public function testGetAtmosphere()
    {
        $feed = $this->getFeedMock();
        $this->assertInstanceOf(__NAMESPACE__ . '\Feed', $feed);

        $this->assertNull($feed->getAtmosphere());

        $feed->setLocationName('Cologne');
        $feed->setFeedUrl($this->getTestFeedPath(self::TEST_FEED_VALID));
        $feed->fetchData();
        $this->assertInstanceOf(
            __NAMESPACE__ . '\Data\Atmosphere',
            $feed->getAtmosphere()
        );
    }

    /**
     * Tests Feed::getAstronomy().
     */
    public function testGetAstronomy()
    {
        $feed = $this->getFeedMock();
        $this->assertInstanceOf(__NAMESPACE__ . '\Feed', $feed);

        $this->assertNull($feed->getAstronomy());

        $feed->setLocationName('Cologne');
        $feed->setFeedUrl($this->getTestFeedPath(self::TEST_FEED_VALID));
        $feed->fetchData();
        $this->assertInstanceOf(
            __NAMESPACE__ . '\Data\Astronomy',
            $feed->getAstronomy()
        );
    }

    /**
     * Tests Feed::getCondition().
     */
    public function testGetCondition()
    {
        $feed = $this->getFeedMock();
        $this->assertInstanceOf(__NAMESPACE__ . '\Feed', $feed);

        $this->assertNull($feed->getCondition());

        $feed->setLocationName('Cologne');
        $feed->setFeedUrl($this->getTestFeedPath(self::TEST_FEED_VALID));
        $feed->fetchData();
        $this->assertInstanceOf(
            __NAMESPACE__ . '\Data\Condition',
            $feed->getCondition()
        );
    }

    /**
     * Tests Feed::getForecast().
     */
    public function testGetForecast()
    {
        $feed = $this->getFeedMock();
        $this->assertInstanceOf(__NAMESPACE__ . '\Feed', $feed);

        $forecast = $feed->getForecast();
        $this->assertInternalType('array', $forecast);
        $this->assertEmpty($forecast);

        $feed->setLocationName('Cologne');
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
     * Tests Feed::getTitle().
     */
    public function testGetTitle()
    {
        $feed = $this->getFeedMock();
        $this->assertInstanceOf(__NAMESPACE__ . '\Feed', $feed);

        $title = $feed->getTitle();
        $this->assertInternalType('string', $title);
        $this->assertEmpty($title);

        $feed->setLocationName('Cologne');
        $feed->setFeedUrl($this->getTestFeedPath(self::TEST_FEED_VALID));
        $feed->fetchData();

        $title = $feed->getTitle();
        $this->assertInternalType('string', $title);
        $this->assertEquals(
            'Yahoo! Weather - Cologne, NW, DE',
            $title
        );
    }

    /**
     * Tests Feed::getLink().
     */
    public function testGetLink()
    {
        $feed = $this->getFeedMock();
        $this->assertInstanceOf(__NAMESPACE__ . '\Feed', $feed);

        $link = $feed->getLink();
        $this->assertInternalType('string', $link);
        $this->assertEmpty($link);

        $feed->setLocationName('Cologne');
        $feed->setFeedUrl($this->getTestFeedPath(self::TEST_FEED_VALID));
        $feed->fetchData();

        $link = $feed->getLink();
        $this->assertInternalType('string', $link);
        $this->assertEquals(
            'http://us.rd.yahoo.com/dailynews/rss/weather/Country__Country/*' .
            'https://weather.yahoo.com/country/state/city-667931/',
            $link
        );
    }

    /**
     * Returns a mocked Feed instance.
     *
     * @param string $locationName  Optional: Location name.
     * @param string $systemOfUnits Optional: One of the self::UNITS_* constants.
     * @param string $feedUrl       Optional: alternative feed URL
     *
     * @return \PHPUnit_Framework_MockObject_MockObject|Feed
     */
    protected function getFeedMock(
        $locationName = '',
        $systemOfUnits = '',
        $feedUrl = ''
    ) {
        $feed = $this->getMockBuilder(__NAMESPACE__ . '\\Feed')
            ->setMethods(array('buildQueryString'))
            ->setConstructorArgs(
                array($locationName, $systemOfUnits, $feedUrl)
            )
            ->getMock();

        $feed->expects($this->any())
            ->method('buildQueryString')
            ->willReturn('');

        return $feed;
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
        $dir = APP_DATADIR . self::TEST_DATA_DIR;
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
