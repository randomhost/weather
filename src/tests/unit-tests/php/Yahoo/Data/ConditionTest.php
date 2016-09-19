<?php
namespace randomhost\Weather\Yahoo\Data;

/**
 * Unit test for Condition
 *
 * @author    Ch'Ih-Yu <chi-yu@web.de>
 * @copyright 2016 random-host.com
 * @license   http://www.debian.org/misc/bsd.license  BSD License (3 Clause)
 * @link      http://github.random-host.com/weather/
 */
class ConditionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Data provider for most test cases.
     *
     * @return array
     */
    public function provider()
    {
        return array(
            // code, date, temperature, text
            array(32, 'Fri, 07 Mar 2014 7:20 am CET', 3, 'Sunny',),
            array(0, 'Fri, 07 Mar 2014 7:20 am CET', 3, '',),
            array(32, 'Fri, 07 Mar 2014 7:20 am CET', 3.5, 'Sunny',),
            array(32, 'Sat, 08 Mar 2014 12:40 pm CET', 3.5, 'Sunny',),
        );
    }

    /**
     * Tests Condition::setText() and Condition::getText().
     *
     * @param int    $code        Condition code for this forecast.
     * @param string $date        Current date and time for which this forecast
     *                            applies.
     * @param float  $temperature Current temperature.
     * @param string $text        Textual description of conditions.
     *
     * @dataProvider provider
     */
    public function testSetGetText($code, $date, $temperature, $text)
    {
        $condition = new Condition(
            $code,
            $date,
            $temperature,
            $text
        );

        $result = $condition->getText();

        $this->assertSame($text, $result);
    }

    /**
     * Tests Condition::setCode() and Condition::getCode().
     *
     * @param int    $code        Condition code for this forecast.
     * @param string $date        Current date and time for which this forecast
     *                            applies.
     * @param float  $temperature Current temperature.
     * @param string $text        Textual description of conditions.
     *
     * @dataProvider provider
     */
    public function testSetGetCode($code, $date, $temperature, $text)
    {
        $condition = new Condition(
            $code,
            $date,
            $temperature,
            $text
        );

        $result = $condition->getCode();

        $this->assertSame($code, $result);
    }

    /**
     * Tests Condition::setTemperature() and Condition::getTemperature().
     *
     * @param int    $code        Condition code for this forecast.
     * @param string $date        Current date and time for which this forecast
     *                            applies.
     * @param float  $temperature Current temperature.
     * @param string $text        Textual description of conditions.
     *
     * @dataProvider provider
     */
    public function testSetGetTemperature($code, $date, $temperature, $text)
    {
        $condition = new Condition(
            $code,
            $date,
            $temperature,
            $text
        );

        $result = $condition->getTemperature();

        $this->assertInternalType('float', $result);
        $this->assertEquals($temperature, $result);
    }

    /**
     * Tests Condition::setDate() and Condition::getDate().
     *
     * @param int    $code        Condition code for this forecast.
     * @param string $date        Current date and time for which this forecast
     *                            applies.
     * @param float  $temperature Current temperature.
     * @param string $text        Textual description of conditions.
     *
     * @dataProvider provider
     */
    public function testSetGetDate($code, $date, $temperature, $text)
    {
        $condition = new Condition(
            $code,
            $date,
            $temperature,
            $text
        );

        $result = $condition->getDate();

        $this->assertInstanceOf('\DateTime', $result);
        $this->assertSame($date, $result->format('D, d M Y g:i a T'));
    }
}
