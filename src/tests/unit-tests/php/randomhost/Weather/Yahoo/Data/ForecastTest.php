<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * ForecastTest unit test definition
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
 * Unit test for Forecast
 *
 * @category  Weather
 * @package   PHP_Weather
 * @author    Ch'Ih-Yu <chi-yu@web.de>
 * @copyright 2014 random-host.com
 * @license   http://www.debian.org/misc/bsd.license  BSD License (3 Clause)
 * @version   Release: @package_version@
 * @link      https://pear.random-host.com/
 */
class ForecastTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Data provider for most test cases.
     *
     * @return array
     */
    public function provider()
    {
        return array(
            // date, low, high, text, code
            array('14 Mar 2014', 8, 16, 'Sunny', 32),
            array('14 Mar 2014', 8.5, 16.3, 'Sunny', 32),
            array('14 Mar 2014', 0, 16, 'Sunny', 32),
            array('14 Mar 2014', 8, 0, 'Sunny', 32),
            array('14 Mar 2014', 8, 16, '', 32),
            array('14 Mar 2014', 8, 16, 'Sunny', 0),
        );
    }

    /**
     * Tests Forecast::setDate() and Forecast::getDate()
     *
     * @param string $date Date and time for which this forecast applies.
     * @param float  $low  Forecasted low temperature for this day.
     * @param float  $high Forecasted high temperature for this day.
     * @param string $text Textual description of conditions.
     * @param int    $code Condition code for this forecast.
     *
     * @dataProvider provider
     *
     * @return void
     */
    public function testSetGetDate($date, $low, $high, $text, $code)
    {
        $forecast = new Forecast(
            $date,
            $low,
            $high,
            $text,
            $code
        );

        $result = $forecast->getDate();

        $this->assertInstanceOf('\DateTime', $result);
        $this->assertSame($date, $result->format('d M Y'));
    }

    /**
     * Tests Forecast::setLow() and Forecast::getLow()
     *
     * @param string $date Date and time for which this forecast applies.
     * @param float  $low  Forecasted low temperature for this day.
     * @param float  $high Forecasted high temperature for this day.
     * @param string $text Textual description of conditions.
     * @param int    $code Condition code for this forecast.
     *
     * @dataProvider provider
     *
     * @return void
     */
    public function testSetGetLow($date, $low, $high, $text, $code)
    {
        $forecast = new Forecast(
            $date,
            $low,
            $high,
            $text,
            $code
        );

        $result = $forecast->getLow();

        $this->assertInternalType('float', $result);
        $this->assertEquals($low, $result);
    }

    /**
     * Tests Forecast::setHigh() and Forecast::getHigh()
     *
     * @param string $date Date and time for which this forecast applies.
     * @param float  $low  Forecasted low temperature for this day.
     * @param float  $high Forecasted high temperature for this day.
     * @param string $text Textual description of conditions.
     * @param int    $code Condition code for this forecast.
     *
     * @dataProvider provider
     *
     * @return void
     */
    public function testSetGetHigh($date, $low, $high, $text, $code)
    {
        $forecast = new Forecast(
            $date,
            $low,
            $high,
            $text,
            $code
        );

        $result = $forecast->getHigh();

        $this->assertInternalType('float', $result);
        $this->assertEquals($high, $result);
    }

    /**
     * Tests Forecast::setText() and Forecast::getText()
     *
     * @param string $date Date and time for which this forecast applies.
     * @param float  $low  Forecasted low temperature for this day.
     * @param float  $high Forecasted high temperature for this day.
     * @param string $text Textual description of conditions.
     * @param int    $code Condition code for this forecast.
     *
     * @dataProvider provider
     *
     * @return void
     */
    public function testSetGetText($date, $low, $high, $text, $code)
    {
        $forecast = new Forecast(
            $date,
            $low,
            $high,
            $text,
            $code
        );

        $result = $forecast->getText();

        $this->assertSame($text, $result);
    }

    /**
     * Tests Forecast::setCode() and Forecast::getCode()
     *
     * @param string $date Date and time for which this forecast applies.
     * @param float  $low  Forecasted low temperature for this day.
     * @param float  $high Forecasted high temperature for this day.
     * @param string $text Textual description of conditions.
     * @param int    $code Condition code for this forecast.
     *
     * @dataProvider provider
     *
     * @return void
     */
    public function testSetGetCode($date, $low, $high, $text, $code)
    {
        $forecast = new Forecast(
            $date,
            $low,
            $high,
            $text,
            $code
        );

        $result = $forecast->getCode();

        $this->assertSame($code, $result);
    }
}
