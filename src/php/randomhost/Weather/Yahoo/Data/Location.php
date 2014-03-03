<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Location class definition
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
 * Represents location information of the forecast
 *
 * @category  Weather
 * @package   PHP_Weather
 * @author    Ch'Ih-Yu <chi-yu@web.de>
 * @copyright 2014 random-host.com
 * @license   http://www.debian.org/misc/bsd.license  BSD License (3 Clause)
 * @version   Release: @package_version@
 * @link      https://pear.random-host.com/
 */
class Location
{
    /**
     * City name
     *
     * @var string
     */
    protected $city;

    /**
     * State, territory, or region
     *
     * @var string
     */
    protected $region;

    /**
     * Country name
     *
     * @var string
     */
    protected $country;

    /**
     * Constructor.
     *
     * @param string $city    City name.
     * @param string $region  State, territory, or region.
     * @param string $country Country name.
     */
    public function __construct($city, $region, $country)
    {
        $this->setCity($city);
        $this->setRegion($region);
        $this->setCountry($country);
    }

    /**
     * Returns the city name.
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Returns the state, territory, or region.
     *
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Returns the country name.
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Sets the city name.
     *
     * @param string $city City name.
     *
     * @return $this
     */
    protected function setCity($city)
    {
        $this->city = (string)$city;

        return $this;
    }

    /**
     * Sets the state, territory, or region.
     *
     * This may be set to an empty string.
     *
     * @param string $region State, territory, or region.
     *
     * @return $this
     */
    protected function setRegion($region)
    {
        $this->region = (string)$region;

        return $this;
    }

    /**
     * Sets the country name.
     *
     * @param string $country Country name.
     *
     * @return $this
     */
    protected function setCountry($country)
    {
        $this->country = (string)$country;

        return $this;
    }


}
