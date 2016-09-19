<?php
namespace randomhost\Weather\Yahoo\Data;

/**
 * Unit test for Wind
 *
 * @author    Ch'Ih-Yu <chi-yu@web.de>
 * @copyright 2016 random-host.com
 * @license   http://www.debian.org/misc/bsd.license  BSD License (3 Clause)
 * @link      http://github.random-host.com/weather/
 */
class WindTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Data provider for most test cases.
     *
     * @return array
     */
    public function provider()
    {
        return array(
            // chill, direction, speed
            array(32.0, 120.0, 7.0),
            array(32, 120, 7),
            array(0.0, 120.0, 7.0),
            array(32.0, 0.0, 7.0),
            array(32.0, 120.0, 0.0),
        );
    }

    /**
     * Tests Wind::setChill() and Wind::getChill().
     *
     * @param float $chill     Wind chill in degrees.
     * @param float $direction Wind direction, in degrees.
     * @param float $speed     Wind speed.
     *
     * @dataProvider provider
     */
    public function testSetGetChill($chill, $direction, $speed)
    {
        $wind = new Wind($chill, $direction, $speed);

        $result = $wind->getChill();

        $this->assertInternalType('float', $result);
        $this->assertEquals($chill, $result);
    }

    /**
     * Tests Wind::setDirection() and Wind::getDirection().
     *
     * @param float $chill     Wind chill in degrees.
     * @param float $direction Wind direction, in degrees.
     * @param float $speed     Wind speed.
     *
     * @dataProvider provider
     */
    public function testSetGetDirection($chill, $direction, $speed)
    {
        $wind = new Wind($chill, $direction, $speed);

        $result = $wind->getDirection();

        $this->assertInternalType('float', $result);
        $this->assertEquals($direction, $result);
    }

    /**
     * Tests Wind::setSpeed() and Wind::getSpeed().
     *
     * @param float $chill     Wind chill in degrees.
     * @param float $direction Wind direction, in degrees.
     * @param float $speed     Wind speed.
     *
     * @dataProvider provider
     */
    public function testSetGetSpeed($chill, $direction, $speed)
    {
        $wind = new Wind($chill, $direction, $speed);

        $result = $wind->getSpeed();

        $this->assertInternalType('float', $result);
        $this->assertEquals($speed, $result);
    }
}
