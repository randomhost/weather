<?php
namespace randomhost\Weather\Yahoo\Data;

/**
 * Unit test for Units
 *
 * @author    Ch'Ih-Yu <chi-yu@web.de>
 * @copyright 2016 random-host.com
 * @license   http://www.debian.org/misc/bsd.license  BSD License (3 Clause)
 * @link      http://github.random-host.com/weather/
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
            // distance, pressure, speed, temperature
            array('km', 'mb', 'km/h', 'C'),
            array('km', 'mb', 'km/h', ''),
            array('', 'mb', 'km/h', 'C'),
            array('km', '', 'km/h', 'C'),
            array('km', 'mb', '', 'C'),
            array('mi', 'in', 'mph', 'F'),
            array('mi', 'in', 'mph', ''),
            array('', 'in', 'mph', 'F'),
            array('mi', '', 'mph', 'F'),
            array('mi', 'in', '', 'F'),
        );
    }

    /**
     * Tests Units::setTemperature() and Units::getTemperature().
     *
     * @param string $distance Units for distance.
     * @param string $pressure Units of barometric pressure.
     * @param string $speed Units of speed.
     * @param string $temperature Degree units for temperature.
     *
     * @dataProvider provider
     */
    public function testSetGetTemperature(
        $distance,
        $pressure,
        $speed,
        $temperature
    ) {
        $units = new Units($distance, $pressure, $speed, $temperature);

        $result = $units->getTemperature();

        $this->assertSame($temperature, $result);
    }

    /**
     * Tests Units::setDistance() and Units::getDistance().
     *
     * @param string $distance Units for distance.
     * @param string $pressure Units of barometric pressure.
     * @param string $speed Units of speed.
     * @param string $temperature Degree units for temperature.
     *
     * @dataProvider provider
     */
    public function testSetGetDistance($distance, $pressure, $speed, $temperature)
    {
        $units = new Units($distance, $pressure, $speed, $temperature);

        $result = $units->getDistance();

        $this->assertSame($distance, $result);
    }

    /**
     * Tests Units::setPressure() and Units::getPressure().
     *
     * @param string $distance Units for distance.
     * @param string $pressure Units of barometric pressure.
     * @param string $speed Units of speed.
     * @param string $temperature Degree units for temperature.
     *
     * @dataProvider provider
     */
    public function testSetGetPressure($distance, $pressure, $speed, $temperature)
    {
        $units = new Units($distance, $pressure, $speed, $temperature);

        $result = $units->getPressure();

        $this->assertSame($pressure, $result);
    }

    /**
     * Tests Units::setSpeed() and Units::getSpeed().
     *
     * @param string $distance Units for distance.
     * @param string $pressure Units of barometric pressure.
     * @param string $speed Units of speed.
     * @param string $temperature Degree units for temperature.
     *
     * @dataProvider provider
     */
    public function testSetGetSpeed($distance, $pressure, $speed, $temperature)
    {
        $units = new Units($distance, $pressure, $speed, $temperature);

        $result = $units->getSpeed();

        $this->assertSame($speed, $result);
    }
}
