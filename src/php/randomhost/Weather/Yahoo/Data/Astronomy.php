<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Astronomy class definition
 *
 * PHP version 5
 *
 * @category  Weather
 * @package   PHP_Weather
 * @author    Ch'Ih-Yu <chi-yu@web.de>
 * @copyright 2014 random-host.com
 * @license   http://www.debian.org/misc/bsd.license  BSD License (3 Clause)
 * @link      https://pear.random-host.com/
 */
namespace randomhost\Weather\Yahoo\Data;

/**
 * Represents forecast information about current astronomical conditions
 *
 * @category  Weather
 * @package   PHP_Weather
 * @author    Ch'Ih-Yu <chi-yu@web.de>
 * @copyright 2014 random-host.com
 * @license   http://www.debian.org/misc/bsd.license  BSD License (3 Clause)
 * @version   Release: @package_version@
 * @link      https://pear.random-host.com/
 */
class Astronomy
{
    /**
     * Today's sunrise time.
     *
     * @var \DateTime
     */
    protected $sunrise = null;

    /**
     * Today's sunset time.
     *
     * @var \DateTime
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
     * @return \DateTime
     */
    public function getSunrise()
    {
        return $this->sunrise;
    }

    /**
     * Returns today's sunset time.
     *
     * @return \DateTime
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
        $this->sunrise = new \DateTime($sunrise);

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
        $this->sunset = new \DateTime($sunset);

        return $this;
    }
} 
