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
namespace randomhost\Weather\Yahoo;

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
     * Two-character country code
     *
     * @var string
     */
    protected $country;

    /**
     * Constructor.
     *
     * @param string $city    City name.
     * @param string $region  State, territory, or region.
     * @param string $country Two-character country code.
     */
    public function __construct($city, $region, $country)
    {
        $this->city = $city;
        $this->region = $region;
        $this->country = $country;
    }

    /**
     * Sets the city name.
     *
     * @param string $city City name.
     *
     * @return $this
     */
    public function setCity($city)
    {
        $this->city = (string)$city;

        return $this;
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
     * Sets the state, territory, or region.
     *
     * This may be set to an empty string.
     *
     * @param string $region State, territory, or region.
     *
     * @return $this
     */
    public function setRegion($region)
    {
        $this->region = (string)$region;

        return $this;
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
     * Sets the two-character country code.
     *
     * @param string $country Two-character country code.
     *
     * @return $this
     * @throws \UnexpectedValueException Thrown in case $country is not a
     *                                   two-character string.
     */
    public function setCountry($country)
    {
        if (is_string($country) || 2 !== strlen($country)) {
            throw new \UnexpectedValueException(
                sprintf(
                    'Parameter 1 to __FUNCTION__() expected to be a ' .
                    'two-character string, %s given',
                    var_export($country, true)
                )
            );
        }
        $this->country = $country;

        return $this;
    }

    /**
     * Returns the two-character country code.
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }


}
