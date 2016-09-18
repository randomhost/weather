<?php
namespace randomhost\Weather\Yahoo\Data;

/**
 * Represents location information of the forecast
 *
 * @author    Ch'Ih-Yu <chi-yu@web.de>
 * @copyright 2016 random-host.com
 * @license   http://www.debian.org/misc/bsd.license  BSD License (3 Clause)
 * @link      http://github.random-host.com/weather/
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
     * Country name
     *
     * @var string
     */
    protected $country;

    /**
     * State, territory, or region
     *
     * @var string
     */
    protected $region;

    /**
     * Constructor.
     *
     * @param string $city    City name.
     * @param string $country Country name.
     * @param string $region  State, territory, or region.
     */
    public function __construct($city, $country, $region)
    {
        $this->setCity($city);
        $this->setCountry($country);
        $this->setRegion($region);
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
     * Returns the country name.
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
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
}
