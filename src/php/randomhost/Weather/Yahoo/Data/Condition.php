<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Condition class definition
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
 * Represents the current weather conditions
 *
 * @category  Weather
 * @package   PHP_Weather
 * @author    Ch'Ih-Yu <chi-yu@web.de>
 * @copyright 2014 random-host.com
 * @license   http://www.debian.org/misc/bsd.license  BSD License (3 Clause)
 * @version   Release: @package_version@
 * @link      https://pear.random-host.com/
 */
class Condition
{
    /**
     * Textual description of conditions
     *
     * Example: "Partly Cloudy"
     *
     * @var string
     */
    protected $text = '';

    /**
     * Condition code for this forecast
     *
     * You could use this code to choose a text description or image for the
     * forecast. The possible values for this element are described in
     * <a href="http://developer.yahoo.com/weather/#codes">Condition Codes</a>.
     *
     * @var int
     */
    protected $code = 0;

    /**
     * Current temperature
     *
     * @var float
     */
    protected $temperature = 0.0;

    /**
     * Current date and time for which this forecast applies
     *
     * @var \DateTime|null
     */
    protected $date = null;

    /**
     * Constructor.
     *
     * @param string $text        Textual description of conditions.
     * @param int    $code        Condition code for this forecast.
     * @param float  $temperature Current temperature.
     * @param string $date        Current date and time for which this forecast
     *                            applies.
     */
    function __construct($text, $code, $temperature, $date)
    {
        $this->setText($text);
        $this->setCode($code);
        $this->setTemperature($temperature);
        $this->setDate($date);
    }


    /**
     * Returns the textual description of conditions.
     *
     * Example: "Partly Cloudy"
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Returns the condition code for this forecast.
     *
     * You could use this code to choose a text description or image for the
     * forecast. The possible values for this element are described in
     * <a href="http://developer.yahoo.com/weather/#codes">Condition Codes</a>.
     *
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Returns the current temperature.
     *
     * @return float
     */
    public function getTemperature()
    {
        return $this->temperature;
    }

    /**
     * Returns the current date and time for which this forecast applies.
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Sets the textual description of conditions.
     *
     * @param string $text Textual description of conditions.
     *
     * @return $this
     */
    protected function setText($text)
    {
        $this->text = (string)$text;

        return $this;
    }

    /**
     * Sets the condition code for this forecast.
     *
     * @param int $code Condition code for this forecast.
     *
     * @return $this
     */
    protected function setCode($code)
    {
        $this->code = (int)$code;

        return $this;
    }

    /**
     * Sets the current temperature.
     *
     * @param float $temperature Current temperature.
     *
     * @return $this
     */
    protected function setTemperature($temperature)
    {
        $this->temperature = (float)$temperature;

        return $this;
    }

    /**
     * Sets the current date and time for which this forecast applies.
     *
     * @param string $date Current date and time for which this forecast applies.
     *
     * @return $this
     */
    protected function setDate($date)
    {
        $this->date = new \DateTime($date);

        return $this;
    }
} 
