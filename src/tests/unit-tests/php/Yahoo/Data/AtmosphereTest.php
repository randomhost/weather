<?php
namespace randomhost\Weather\Yahoo\Data;

/**
 * Unit test for Atmosphere
 *
 * @author    Ch'Ih-Yu <chi-yu@web.de>
 * @copyright 2016 random-host.com
 * @license   http://www.debian.org/misc/bsd.license  BSD License (3 Clause)
 * @link      http://github.random-host.com/weather/
 */
class AtmosphereTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Data provider for most test cases.
     *
     * @return array
     */
    public function provider()
    {
        return array(
            // humidity, pressure, rising, visibility
            array(87, 1015.92, 0, 5,),
            array(45.1, 980, 0, 3.4),
            array(14, 940, 1, 3),
            array("87", "1015.92", "0", "5"),
        );
    }

    /**
     * Tests Atmosphere::setHumidity() and Atmosphere::getHumidity().
     *
     * @param float $humidity   Humidity in percent.
     * @param float $pressure   Barometric pressure.
     * @param int   $rising     State of the barometric pressure.
     * @param float $visibility Visibility.
     *
     * @dataProvider provider
     */
    public function testSetGetHumidity(
        $humidity,
        $pressure,
        $rising,
        $visibility
    ) {
        $atmosphere = new Atmosphere(
            $humidity,
            $pressure,
            $rising,
            $visibility
        );

        $result = $atmosphere->getHumidity();

        $this->assertInternalType('float', $result);
        $this->assertEquals($humidity, $result);
    }

    /**
     * Tests Atmosphere::setVisibility() and Atmosphere::getVisibility().
     *
     * @param float $humidity   Humidity in percent.
     * @param float $pressure   Barometric pressure.
     * @param int   $rising     State of the barometric pressure.
     * @param float $visibility Visibility.
     *
     * @dataProvider provider
     */
    public function testSetGetVisibility(
        $humidity,
        $pressure,
        $rising,
        $visibility
    ) {
        $atmosphere = new Atmosphere(
            $humidity,
            $pressure,
            $rising,
            $visibility
        );

        $result = $atmosphere->getVisibility();

        $this->assertInternalType('float', $result);
        $this->assertEquals($visibility, $result);
    }

    /**
     * Tests Atmosphere::setPressure() and Atmosphere::getPressure().
     *
     * @param float $humidity   Humidity in percent.
     * @param float $pressure   Barometric pressure.
     * @param int   $rising     State of the barometric pressure.
     * @param float $visibility Visibility.
     *
     * @dataProvider provider
     */
    public function testSetGetPressure(
        $humidity,
        $pressure,
        $rising,
        $visibility
    ) {
        $atmosphere = new Atmosphere(
            $humidity,
            $pressure,
            $rising,
            $visibility
        );

        $result = $atmosphere->getPressure();

        $this->assertInternalType('float', $result);
        $this->assertEquals($pressure, $result);
    }

    /**
     * Tests Atmosphere::setRising() and Atmosphere::getRising().
     *
     * @param float $humidity   Humidity in percent.
     * @param float $pressure   Barometric pressure.
     * @param int   $rising     State of the barometric pressure.
     * @param float $visibility Visibility.
     *
     * @dataProvider provider
     */
    public function testSetGetRising(
        $humidity,
        $pressure,
        $rising,
        $visibility
    ) {
        $atmosphere = new Atmosphere(
            $humidity,
            $pressure,
            $rising,
            $visibility
        );

        $result = $atmosphere->getRising();

        $this->assertInternalType('int', $result);
        $this->assertEquals($rising, $result);
    }
}
