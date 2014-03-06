<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * AstronomyTest unit test definition
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
 * Unit test for AstronomyTest
 *
 * @category  Weather
 * @package   PHP_Weather
 * @author    Ch'Ih-Yu <chi-yu@web.de>
 * @copyright 2014 random-host.com
 * @license   http://www.debian.org/misc/bsd.license  BSD License (3 Clause)
 * @version   Release: @package_version@
 * @link      https://pear.random-host.com/
 */
class AstronomyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests Astronomy::setSunrise() and Astronomy::getSunrise()
     *
     * @return void
     */
    public function testSetGetSunrise()
    {
        $sunrise = '7:07 am';
        $sunset = '6:17 pm';
        $astronomy = new Astronomy($sunrise, $sunset);

        $resultSunrise = $astronomy->getSunrise();

        $this->assertInstanceOf('\DateTime', $resultSunrise);
        $this->assertEquals($sunrise, $resultSunrise->format('g:i a'));
    }

    /**
     * Tests Astronomy::setSunset() and Astronomy::getSunset()
     *
     * @return void
     */
    public function testSetGetSunset()
    {
        $sunrise = '7:07 am';
        $sunset = '6:17 pm';
        $astronomy = new Astronomy($sunrise, $sunset);

        $resultSunset = $astronomy->getSunset();

        $this->assertInstanceOf('\DateTime', $resultSunset);
        $this->assertEquals($sunset, $resultSunset->format('g:i a'));
    }
}
