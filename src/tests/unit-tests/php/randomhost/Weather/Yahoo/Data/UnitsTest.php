<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * UnitsTest unit test definition
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
 * Unit test for Units
 *
 * @category  Weather
 * @package   PHP_Weather
 * @author    Ch'Ih-Yu <chi-yu@web.de>
 * @copyright 2014 random-host.com
 * @license   http://www.debian.org/misc/bsd.license  BSD License (3 Clause)
 * @version   Release: @package_version@
 * @link      https://pear.random-host.com/
 */
class UnitsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Data provider for most test cases.
     *
     * @return array
     */
    public function provider()
    {
        return array(
            // temperature, distance, pressure, speed
            array('C', 'km', 'mb', 'km/h'),
            array('', 'km', 'mb', 'km/h'),
            array('C', '', 'mb', 'km/h'),
            array('C', 'km', '', 'km/h'),
            array('C', 'km', 'mb', ''),
            array('F', 'mi', 'in', 'mph'),
            array('', 'mi', 'in', 'mph'),
            array('F', '', 'in', 'mph'),
            array('F', 'mi', '', 'mph'),
            array('F', 'mi', 'in', ''),
        );
    }

    /**
     * Tests Units::setTemperature() and Units::getTemperature()
     *
     * @param string $temperature Degree units for temperature.
     * @param string $distance    Units for distance.
     * @param string $pressure    Units of barometric pressure.
     * @param string $speed       Units of speed.
     *
     * @dataProvider provider
     *
     * @return void
     */
    public function testSetGetTemperature($temperature, $distance, $pressure, $speed)
    {
        $condition = new Units($temperature, $distance, $pressure, $speed);

        $result = $condition->getTemperature();

        $this->assertInternalType('string', $result);
        $this->assertEquals($temperature, $result);
    }

    /**
     * Tests Units::setDistance() and Units::getDistance()
     *
     * @param string $temperature Degree units for temperature.
     * @param string $distance    Units for distance.
     * @param string $pressure    Units of barometric pressure.
     * @param string $speed       Units of speed.
     *
     * @dataProvider provider
     *
     * @return void
     */
    public function testSetGetDistance($temperature, $distance, $pressure, $speed)
    {
        $condition = new Units($temperature, $distance, $pressure, $speed);

        $result = $condition->getDistance();

        $this->assertInternalType('string', $result);
        $this->assertEquals($distance, $result);
    }

    /**
     * Tests Units::setPressure() and Units::getPressure()
     *
     * @param string $temperature Degree units for temperature.
     * @param string $distance    Units for distance.
     * @param string $pressure    Units of barometric pressure.
     * @param string $speed       Units of speed.
     *
     * @dataProvider provider
     *
     * @return void
     */
    public function testSetGetPressure($temperature, $distance, $pressure, $speed)
    {
        $condition = new Units($temperature, $distance, $pressure, $speed);

        $result = $condition->getPressure();

        $this->assertInternalType('string', $result);
        $this->assertEquals($pressure, $result);
    }

    /**
     * Tests Units::setSpeed() and Units::getSpeed()
     *
     * @param string $temperature Degree units for temperature.
     * @param string $distance    Units for distance.
     * @param string $pressure    Units of barometric pressure.
     * @param string $speed       Units of speed.
     *
     * @dataProvider provider
     *
     * @return void
     */
    public function testSetGetSpeed($temperature, $distance, $pressure, $speed)
    {
        $condition = new Units($temperature, $distance, $pressure, $speed);

        $result = $condition->getSpeed();

        $this->assertInternalType('string', $result);
        $this->assertEquals($speed, $result);
    }
}
