<?php
namespace randomhost\Weather\Yahoo\Data;

use DateTime;

/**
 * Represents forecast information about current astronomical conditions
 *
 * @author    Ch'Ih-Yu <chi-yu@web.de>
 * @copyright 2016 random-host.com
 * @license   http://www.debian.org/misc/bsd.license  BSD License (3 Clause)
 * @link      http://github.random-host.com/weather/
 */
class Astronomy
{
    /**
     * Today's sunrise time.
     *
     * @var DateTime
     */
    protected $sunrise = null;

    /**
     * Today's sunset time.
     *
     * @var DateTime
     */
    protected $sunset = null;

    /**
     * Constructor.
     *
     * @param string $sunrise Today's sunrise time in a format known to \DateTime.
     * @param string $sunset  Today's sunset time in a format known to \DateTime.
     */
    public function __construct($sunrise, $sunset)
    {
        $this->setSunrise($sunrise);
        $this->setSunset($sunset);
    }

    /**
     * Returns today's sunrise time.
     *
     * @return DateTime
     */
    public function getSunrise()
    {
        return $this->sunrise;
    }

    /**
     * Returns today's sunset time.
     *
     * @return DateTime
     */
    public function getSunset()
    {
        return $this->sunset;
    }

    /**
     * Sets today's sunrise time.
     *
     * @param string $sunrise Today's sunrise time in a format known to \DateTime.
     *
     * @return $this
     */
    protected function setSunrise($sunrise)
    {
        $this->sunrise = DateTime::createFromFormat('H:i A', $sunrise);

        return $this;
    }

    /**
     * Sets today's sunset time.
     *
     * @param string $sunset Today's sunset time in a format known to \DateTime.
     *
     * @return $this
     */
    protected function setSunset($sunset)
    {
        $this->sunset = DateTime::createFromFormat('H:i A', $sunset);

        return $this;
    }
}
