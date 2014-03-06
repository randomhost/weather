<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * AtmosphereTest unit test definition
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
 * Unit test for AtmosphereTest
 *
 * @category  Weather
 * @package   PHP_Weather
 * @author    Ch'Ih-Yu <chi-yu@web.de>
 * @copyright 2014 random-host.com
 * @license   http://www.debian.org/misc/bsd.license  BSD License (3 Clause)
 * @version   Release: @package_version@
 * @link      https://pear.random-host.com/
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
            // humidity, visibility, pressure, rising
            array(87, 5, 1015.92, 0),
            array(45.1, 3.4, 980, 0),
            array(14, 3, 940, 1),
            array("87", "5", "1015.92", "0"),
        );
    }

    /**
     * Tests Atmosphere::setHumidity() and Atmosphere::getHumidity()
     *
     * @param float $humidity   Humidity in percent.
     * @param float $visibility Visibility.
     * @param float $pressure   Barometric pressure.
     * @param int   $rising     State of the barometric pressure.
     *
     * @dataProvider provider
     *
     * @return void
     */
    public function testSetGetHumidity(
        $humidity, $visibility, $pressure, $rising
    ) {
        $atmosphere = new Atmosphere(
            $humidity,
            $visibility,
            $pressure,
            $rising
        );

        $result = $atmosphere->getHumidity();

        $this->assertInternalType('float', $result);
        $this->assertEquals($humidity, $result);

    }

    /**
     * Tests Atmosphere::setVisibility() and Atmosphere::getVisibility()
     *
     * @param float $humidity   Humidity in percent.
     * @param float $visibility Visibility.
     * @param float $pressure   Barometric pressure.
     * @param int   $rising     State of the barometric pressure.
     *
     * @dataProvider provider
     *
     * @return void
     */
    public function testSetGetVisibility(
        $humidity, $visibility, $pressure, $rising
    ) {
        $atmosphere = new Atmosphere(
            $humidity,
            $visibility,
            $pressure,
            $rising
        );

        $result = $atmosphere->getVisibility();

        $this->assertInternalType('float', $result);
        $this->assertEquals($visibility, $result);

    }

    /**
     * Tests Atmosphere::setPressure() and Atmosphere::getPressure()
     *
     * @param float $humidity   Humidity in percent.
     * @param float $visibility Visibility.
     * @param float $pressure   Barometric pressure.
     * @param int   $rising     State of the barometric pressure.
     *
     * @dataProvider provider
     *
     * @return void
     */
    public function testSetGetPressure(
        $humidity, $visibility, $pressure, $rising
    ) {
        $atmosphere = new Atmosphere(
            $humidity,
            $visibility,
            $pressure,
            $rising
        );

        $result = $atmosphere->getPressure();

        $this->assertInternalType('float', $result);
        $this->assertEquals($pressure, $result);

    }

    /**
     * Tests Atmosphere::setRising() and Atmosphere::getRising()
     *
     * @param float $humidity   Humidity in percent.
     * @param float $visibility Visibility.
     * @param float $pressure   Barometric pressure.
     * @param int   $rising     State of the barometric pressure.
     *
     * @dataProvider provider
     *
     * @return void
     */
    public function testSetGetRising(
        $humidity, $visibility, $pressure, $rising
    ) {
        $atmosphere = new Atmosphere(
            $humidity,
            $visibility,
            $pressure,
            $rising
        );

        $result = $atmosphere->getRising();

        $this->assertInternalType('int', $result);
        $this->assertEquals($rising, $result);

    }
}
