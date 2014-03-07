<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * ConditionTest unit test definition
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
 * Unit test for Condition
 *
 * @category  Weather
 * @package   PHP_Weather
 * @author    Ch'Ih-Yu <chi-yu@web.de>
 * @copyright 2014 random-host.com
 * @license   http://www.debian.org/misc/bsd.license  BSD License (3 Clause)
 * @version   Release: @package_version@
 * @link      https://pear.random-host.com/
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
            // text, code, temperature, date
            array('Sunny', 32, 3, 'Fri, 07 Mar 2014 7:20 am CET'),
            array('', 0, 3, 'Fri, 07 Mar 2014 7:20 am CET'),
            array('Sunny', 32, 3.5, 'Fri, 07 Mar 2014 7:20 am CET'),
            array('Sunny', 32, 3.5, 'Sat, 08 Mar 2014 12:40 pm CET'),
        );
    }

    /**
     * Tests Condition::setText() and Condition::getText()
     *
     * @param string $text        Textual description of conditions.
     * @param int    $code        Condition code for this forecast.
     * @param float  $temperature Current temperature.
     * @param string $date        Current date and time for which this forecast
     *                            applies.
     *
     * @dataProvider provider
     *
     * @return void
     */
    public function testSetGetText($text, $code, $temperature, $date)
    {
        $condition = new Condition(
            $text,
            $code,
            $temperature,
            $date
        );

        $result = $condition->getText();

        $this->assertInternalType('string', $result);
        $this->assertEquals($text, $result);
    }

    /**
     * Tests Condition::setCode() and Condition::getCode()
     *
     * @param string $text        Textual description of conditions.
     * @param int    $code        Condition code for this forecast.
     * @param float  $temperature Current temperature.
     * @param string $date        Current date and time for which this forecast
     *                            applies.
     *
     * @dataProvider provider
     *
     * @return void
     */
    public function testSetGetCode($text, $code, $temperature, $date)
    {
        $condition = new Condition(
            $text,
            $code,
            $temperature,
            $date
        );

        $result = $condition->getCode();

        $this->assertInternalType('int', $result);
        $this->assertEquals($code, $result);
    }

    /**
     * Tests Condition::setTemperature() and Condition::getTemperature()
     *
     * @param string $text        Textual description of conditions.
     * @param int    $code        Condition code for this forecast.
     * @param float  $temperature Current temperature.
     * @param string $date        Current date and time for which this forecast
     *                            applies.
     *
     * @dataProvider provider
     *
     * @return void
     */
    public function testSetGetTemperature($text, $code, $temperature, $date)
    {
        $condition = new Condition(
            $text,
            $code,
            $temperature,
            $date
        );

        $result = $condition->getTemperature();

        $this->assertInternalType('float', $result);
        $this->assertEquals($temperature, $result);
    }

    /**
     * Tests Condition::setDate() and Condition::getDate()
     *
     * @param string $text        Textual description of conditions.
     * @param int    $code        Condition code for this forecast.
     * @param float  $temperature Current temperature.
     * @param string $date        Current date and time for which this forecast
     *                            applies.
     *
     * @dataProvider provider
     *
     * @return void
     */
    public function testSetGetDate($text, $code, $temperature, $date)
    {
        $condition = new Condition(
            $text,
            $code,
            $temperature,
            $date
        );

        $result = $condition->getDate();

        $this->assertInstanceOf('\DateTime', $result);
        $this->assertEquals($date, $result->format('D, d M Y g:i a T'));
    }
}
