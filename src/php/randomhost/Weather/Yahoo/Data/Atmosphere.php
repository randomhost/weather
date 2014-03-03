<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Atmosphere class definition
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
 * Represents forecast information about current atmospheric pressure, humidity,
 * and visibility
 *
 * @category  Weather
 * @package   PHP_Weather
 * @author    Ch'Ih-Yu <chi-yu@web.de>
 * @copyright 2014 random-host.com
 * @license   http://www.debian.org/misc/bsd.license  BSD License (3 Clause)
 * @version   Release: @package_version@
 * @link      https://pear.random-host.com/
 */
class Atmosphere
{
    /**
     * Humidity in percent
     *
     * @var float
     */
    protected $humidity = 0.0;

    /**
     * Visibility
     *
     * @var float
     */
    protected $visibility = 0.0;

    /**
     * Barometric pressure
     *
     * @var float
     */
    protected $pressure = 0.0;

    /**
     * State of the barometric pressure
     *
     * steady (0), rising (1), or falling (2). (integer: 0, 1, 2)
     *
     * @var int
     */
    protected $rising = 0;

    /**
     * Constructor.
     *
     * @param float $humidity   Humidity in percent.
     * @param float $visibility Visibility.
     * @param float $pressure   Barometric pressure.
     * @param int   $rising     State of the barometric pressure.
     */
    function __construct($humidity, $visibility, $pressure, $rising)
    {
        $this->setHumidity($humidity);
        $this->setVisibility($visibility);
        $this->setPressure($pressure);
        $this->setRising($rising);
    }


    /**
     * Returns the humidity in percent.
     *
     * @return float
     */
    public function getHumidity()
    {
        return $this->humidity;
    }

    /**
     * Returns the visibility.
     *
     * @return float
     */
    public function getVisibility()
    {
        return $this->visibility;
    }

    /**
     * Returns the state of the barometric pressure.
     *
     * steady (0), rising (1), or falling (2). (integer: 0, 1, 2)
     *
     * @return float
     */
    public function getPressure()
    {
        return $this->pressure;
    }

    /**
     * Returns the rising.
     *
     * @return int
     */
    public function getRising()
    {
        return $this->rising;
    }


    /**
     * Sets the Humidity in percent.
     *
     * @param float $humidity Humidity in percent.
     *
     * @return $this
     */
    protected function setHumidity($humidity)
    {
        $this->humidity = (float)$humidity;
    }

    /**
     * Sets the visibility.
     *
     * @param float $visibility Visibility.
     *
     * @return $this
     */
    protected function setVisibility($visibility)
    {
        $this->visibility = (float)$visibility;
    }

    /**
     * Sets the barometric pressure.
     *
     * @param float $pressure Barometric pressure
     *
     * @return $this
     */
    protected function setPressure($pressure)
    {
        $this->pressure = (float)$pressure;
    }

    /**
     * Sets the state of the barometric pressure.
     *
     * @param int $rising State of the barometric pressure.
     *
     * @return $this
     */
    protected function setRising($rising)
    {
        $this->rising = (int)$rising;
    }
} 
