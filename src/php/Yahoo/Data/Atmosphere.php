<?php
namespace randomhost\Weather\Yahoo\Data;

/**
 * Represents forecast information about current atmospheric pressure, humidity,
 * and visibility
 *
 * @author    Ch'Ih-Yu <chi-yu@web.de>
 * @copyright 2016 random-host.com
 * @license   http://www.debian.org/misc/bsd.license  BSD License (3 Clause)
 * @link      http://github.random-host.com/weather/
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
     * @param float $pressure   Barometric pressure.
     * @param int   $rising     State of the barometric pressure.
     * @param float $visibility Visibility.
     */
    public function __construct($humidity, $pressure, $rising, $visibility)
    {
        $this->setHumidity($humidity);
        $this->setPressure($pressure);
        $this->setRising($rising);
        $this->setVisibility($visibility);
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
     * Returns the barometric pressure.
     *
     * @return float
     */
    public function getPressure()
    {
        return $this->pressure;
    }

    /**
     * Returns the state of the barometric pressure.
     *
     * steady (0), rising (1), or falling (2). (integer: 0, 1, 2).
     *
     * @return int
     */
    public function getRising()
    {
        return $this->rising;
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
     * Sets the Humidity in percent.
     *
     * @param float $humidity Humidity in percent.
     *
     * @return $this
     */
    protected function setHumidity($humidity)
    {
        $this->humidity = (float)$humidity;

        return $this;
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

        return $this;
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

        return $this;
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

        return $this;
    }
}
