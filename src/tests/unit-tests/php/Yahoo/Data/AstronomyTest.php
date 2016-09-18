<?php
namespace randomhost\Weather\Yahoo\Data;

/**
 * Unit test for Astronomy
 *
 * @author    Ch'Ih-Yu <chi-yu@web.de>
 * @copyright 2016 random-host.com
 * @license   http://www.debian.org/misc/bsd.license  BSD License (3 Clause)
 * @link      http://github.random-host.com/weather/
 */
class AstronomyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests Astronomy::setSunrise() and Astronomy::getSunrise().
     */
    public function testSetGetSunrise()
    {
        $sunrise = '7:07 am';
        $sunset = '6:17 pm';
        $astronomy = new Astronomy($sunrise, $sunset);

        $result = $astronomy->getSunrise();

        $this->assertInstanceOf('\DateTime', $result);
        $this->assertSame($sunrise, $result->format('g:i a'));
    }

    /**
     * Tests Astronomy::setSunset() and Astronomy::getSunset().
     */
    public function testSetGetSunset()
    {
        $sunrise = '7:07 am';
        $sunset = '6:17 pm';
        $astronomy = new Astronomy($sunrise, $sunset);

        $result = $astronomy->getSunset();

        $this->assertInstanceOf('\DateTime', $result);
        $this->assertSame($sunset, $result->format('g:i a'));
    }
}
