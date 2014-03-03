<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Wind class definition
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
 * Represents forecast information about wind
 *
 * @category  Weather
 * @package   PHP_Weather
 * @author    Ch'Ih-Yu <chi-yu@web.de>
 * @copyright 2014 random-host.com
 * @license   http://www.debian.org/misc/bsd.license  BSD License (3 Clause)
 * @version   Release: @package_version@
 * @link      https://pear.random-host.com/
 */
class Wind
{
    /**
     * Wind chill in degrees
     *
     * @var float
     */
    protected $chill = 0.0;

    /**
     * Wind direction, in degrees
     *
     * @var float
     */
    protected $direction = 0.0;

    /**
     * Wind speed
     *
     * @var float
     */
    protected $speed = 0.0;

    /**
     * Constructor.
     *
     * @param float $chill     Wind chill in degrees.
     * @param float $direction Wind direction, in degrees.
     * @param float $speed     Wind speed.
     */
    function __construct($chill, $direction, $speed)
    {
        $this->setChill($chill);
        $this->setDirection($direction);
        $this->setSpeed($speed);
    }


    /**
     * Returns the wind chill in degrees.
     *
     * @return float
     */
    public function getChill()
    {
        return $this->chill;
    }

    /**
     * Returns the wind direction, in degrees.
     *
     * @return float
     */
    public function getDirection()
    {
        return $this->direction;
    }

    /**
     * Returns the wind speed.
     *
     * @return float
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     * Sets the wind chill in degrees.
     *
     * @param float $chill Wind chill in degrees.
     *
     * @return $this
     */
    protected function setChill($chill)
    {
        $this->chill = (float)$chill;

        return $this;
    }

    /**
     * Sets the wind direction, in degrees.
     *
     * @param float $direction Wind direction, in degrees.
     *
     * @return $this
     */
    protected function setDirection($direction)
    {
        $this->direction = (float)$direction;

        return $this;
    }

    /**
     * Sets the wind speed.
     *
     * @param float $speed Wind speed.
     *
     * @return $this
     */
    protected function setSpeed($speed)
    {
        $this->speed = (float)$speed;

        return $this;
    }
} 
