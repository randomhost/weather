<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Units class definition
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
 * Represents units for various aspects of the forecast
 *
 * @category  Weather
 * @package   PHP_Weather
 * @author    Ch'Ih-Yu <chi-yu@web.de>
 * @copyright 2014 random-host.com
 * @license   http://www.debian.org/misc/bsd.license  BSD License (3 Clause)
 * @version   Release: @package_version@
 * @link      https://pear.random-host.com/
 */
class Units
{
    /**
     * Degree units for temperature
     *
     * "F" for Fahrenheit or "C" for Celsius
     *
     * @var string
     */
    protected $temperature = '';

    /**
     * Units for distance
     *
     * "mi" for miles or "km" for kilometers
     *
     * @var string
     */
    protected $distance = '';

    /**
     * Units of barometric pressure
     *
     * "in" for pounds per square inch or "mb" for millibars
     *
     * @var string
     */
    protected $pressure = '';

    /**
     * Units of speed
     *
     * "mph" for miles per hour or "km/h" for kilometers per hour
     *
     * @var string
     */
    protected $speed = '';

    /**
     * Constructor.
     *
     * @param string $temperature Degree units for temperature.
     * @param string $distance    Units for distance.
     * @param string $pressure    Units of barometric pressure.
     * @param string $speed       Units of speed.
     */
    function __construct($temperature, $distance, $pressure, $speed)
    {
        $this->setDistance($distance);
        $this->setPressure($pressure);
        $this->setSpeed($speed);
        $this->setTemperature($temperature);
    }


    /**
     * Returns the degree units for temperature.
     *
     * @return string
     */
    public function getTemperature()
    {
        return $this->temperature;
    }

    /**
     * Returns the units for distance.
     *
     * @return string
     */
    public function getDistance()
    {
        return $this->distance;
    }

    /**
     * Returns the units of barometric pressure.
     *
     * @return string
     */
    public function getPressure()
    {
        return $this->pressure;
    }

    /**
     * Returns the units of speed.
     *
     * @return string
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     * Sets the degree units for temperature.
     *
     * @param string $temperature Degree units for temperature.
     *
     * @return $this
     */
    protected function setTemperature($temperature)
    {
        $this->temperature = strtoupper((string)$temperature);

        return $this;
    }

    /**
     * Sets the units for distance.
     *
     * @param string $distance Units for distance.
     *
     * @return $this
     */
    protected function setDistance($distance)
    {
        $this->distance = $distance;

        return $this;
    }

    /**
     * Sets the units of barometric pressure.
     *
     * @param string $pressure Units of barometric pressure.
     *
     * @return $this
     */
    protected function setPressure($pressure)
    {
        $this->pressure = $pressure;

        return $this;
    }

    /**
     * Sets the units of speed.
     *
     * @param string $speed Units of speed.
     *
     * @return $this
     */
    protected function setSpeed($speed)
    {
        $this->speed = $speed;

        return $this;
    }
} 
