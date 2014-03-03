<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Yahoo Weather API test script
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
namespace randomhost\Weather;

/**
 * Dependencies:
 */
require 'psr0.autoloader.php';

// get Yahoo Weather API Feed instance
$feed = new Yahoo\Feed(667931, Yahoo\Feed::UNITS_INTL);

var_dump($feed->getLocation());
var_dump($feed->getUnits());
var_dump($feed->getWind());
var_dump($feed->getAtmosphere());
var_dump($feed->getAstronomy()->getSunrise());
var_dump($feed->getCondition());
