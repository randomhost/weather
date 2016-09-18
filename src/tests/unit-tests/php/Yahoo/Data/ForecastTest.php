<?php
namespace randomhost\Weather\Yahoo\Data;

/**
 * Unit test for Forecast
 *
 * @author    Ch'Ih-Yu <chi-yu@web.de>
 * @copyright 2016 random-host.com
 * @license   http://www.debian.org/misc/bsd.license  BSD License (3 Clause)
 * @link      http://github.random-host.com/weather/
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
            // code, date, high, low, text
            array(32, '14 Mar 2014', 16, 8, 'Sunny',),
            array(32, '14 Mar 2014', 16.3, 8.5, 'Sunny'),
            array(32, '14 Mar 2014', 16, 0, 'Sunny'),
            array(32, '14 Mar 2014', 0, 8, 'Sunny'),
            array(32, '14 Mar 2014', 16, 8, ''),
            array(0, '14 Mar 2014', 16, 8, 'Sunny'),
        );
    }

    /**
     * Tests Forecast::setDate() and Forecast::getDate().
     *
     * @param int    $code Condition code for this forecast.
     * @param string $date Date and time for which this forecast applies.
     * @param float  $high Forecasted high temperature for this day.
     * @param float  $low  Forecasted low temperature for this day.
     * @param string $text Textual description of conditions.
     *
     * @dataProvider provider
     */
    public function testSetGetDate($code, $date, $high, $low, $text)
    {
        $forecast = new Forecast(
            $code,
            $date,
            $high,
            $low,
            $text
        );

        $result = $forecast->getDate();

        $this->assertInstanceOf('\DateTime', $result);
        $this->assertSame($date, $result->format('d M Y'));
    }

    /**
     * Tests Forecast::setLow() and Forecast::getLow().
     *
     * @param int    $code Condition code for this forecast.
     * @param string $date Date and time for which this forecast applies.
     * @param float  $high Forecasted high temperature for this day.
     * @param float  $low  Forecasted low temperature for this day.
     * @param string $text Textual description of conditions.
     *
     * @dataProvider provider
     */
    public function testSetGetLow($code, $date, $high, $low, $text)
    {
        $forecast = new Forecast(
            $code,
            $date,
            $high,
            $low,
            $text
        );

        $result = $forecast->getLow();

        $this->assertInternalType('float', $result);
        $this->assertEquals($low, $result);
    }

    /**
     * Tests Forecast::setHigh() and Forecast::getHigh().
     *
     * @param int    $code Condition code for this forecast.
     * @param string $date Date and time for which this forecast applies.
     * @param float  $high Forecasted high temperature for this day.
     * @param float  $low  Forecasted low temperature for this day.
     * @param string $text Textual description of conditions.
     *
     * @dataProvider provider
     */
    public function testSetGetHigh($code, $date, $high, $low, $text)
    {
        $forecast = new Forecast(
            $code,
            $date,
            $high,
            $low,
            $text
        );

        $result = $forecast->getHigh();

        $this->assertInternalType('float', $result);
        $this->assertEquals($high, $result);
    }

    /**
     * Tests Forecast::setText() and Forecast::getText().
     *
     * @param int    $code Condition code for this forecast.
     * @param string $date Date and time for which this forecast applies.
     * @param float  $high Forecasted high temperature for this day.
     * @param float  $low  Forecasted low temperature for this day.
     * @param string $text Textual description of conditions.
     *
     * @dataProvider provider
     */
    public function testSetGetText($code, $date, $high, $low, $text)
    {
        $forecast = new Forecast(
            $code,
            $date,
            $high,
            $low,
            $text
        );

        $result = $forecast->getText();

        $this->assertSame($text, $result);
    }

    /**
     * Tests Forecast::setCode() and Forecast::getCode().
     *
     * @param int    $code Condition code for this forecast.
     * @param string $date Date and time for which this forecast applies.
     * @param float  $high Forecasted high temperature for this day.
     * @param float  $low  Forecasted low temperature for this day.
     * @param string $text Textual description of conditions.
     *
     * @dataProvider provider
     */
    public function testSetGetCode($code, $date, $high, $low, $text)
    {
        $forecast = new Forecast(
            $code,
            $date,
            $high,
            $low,
            $text
        );

        $result = $forecast->getCode();

        $this->assertSame($code, $result);
    }
}
