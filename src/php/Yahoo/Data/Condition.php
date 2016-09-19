<?php
namespace randomhost\Weather\Yahoo\Data;

/**
 * Represents the current weather conditions
 *
 * @author    Ch'Ih-Yu <chi-yu@web.de>
 * @copyright 2016 random-host.com
 * @license   http://www.debian.org/misc/bsd.license  BSD License (3 Clause)
 * @link      http://github.random-host.com/weather/
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
     * @param int    $code        Condition code for this forecast.
     * @param string $date        Current date and time for which this forecast
     *                            applies.
     * @param float  $temperature Current temperature.
     * @param string $text        Textual description of conditions.
     */
    public function __construct($code, $date, $temperature, $text)
    {
        $this->setCode($code);
        $this->setDate($date);
        $this->setTemperature($temperature);
        $this->setText($text);
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
     * Returns the current date and time for which this forecast applies.
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
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
}
