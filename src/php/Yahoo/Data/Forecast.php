<?php
namespace randomhost\Weather\Yahoo\Data;

/**
 * Represents the weather forecast for a specific day
 *
 * @author    Ch'Ih-Yu <chi-yu@web.de>
 * @copyright 2016 random-host.com
 * @license   http://www.debian.org/misc/bsd.license  BSD License (3 Clause)
 * @link      http://github.random-host.com/weather/
 */
class Forecast
{
    /**
     * Date to which this forecast applies
     *
     * @var \DateTime|null
     */
    protected $date = null;

    /**
     * Forecasted low temperature for this day
     *
     * @var float
     */
    protected $low = 0.0;

    /**
     * Forecasted high temperature for this day
     *
     * @var float
     */
    protected $high = 0.0;

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
     * Constructor.
     *
     * @param int    $code Condition code for this forecast.
     * @param string $date Date and time for which this forecast applies.
     * @param float  $high Forecasted high temperature for this day.
     * @param float  $low  Forecasted low temperature for this day.
     * @param string $text Textual description of conditions.
     */
    public function __construct($code, $date, $high, $low, $text)
    {
        $this->setCode($code);
        $this->setDate($date);
        $this->setHigh($high);
        $this->setLow($low);
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
     * Returns the date to which this forecast applies.
     *
     * @return \DateTime|null
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Returns the forecasted high temperature for this day.
     *
     * @return float
     */
    public function getHigh()
    {
        return $this->high;
    }

    /**
     * Returns the forecasted low temperature for this day.
     *
     * @return float
     */
    public function getLow()
    {
        return $this->low;
    }

    /**
     * Returns the textual description of conditions.
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
     * Sets the date to which this forecast applies.
     *
     * @param string $date Date to which this forecast applies.
     *
     * @return $this
     */
    protected function setDate($date)
    {
        $this->date = new \DateTime($date);

        return $this;
    }

    /**
     * Sets the forecasted high temperature for this day.
     *
     * @param float $high Forecasted high temperature for this day.
     *
     * @return $this
     */
    protected function setHigh($high)
    {
        $this->high = (float)$high;

        return $this;
    }

    /**
     * Sets the forecasted low temperature for this day.
     *
     * @param float $low Forecasted low temperature for this day.
     *
     * @return $this
     */
    protected function setLow($low)
    {
        $this->low = (float)$low;

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
