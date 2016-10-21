<?php
/**
 * Yahoo Weather API test script
 *
 * @author    Ch'Ih-Yu <chi-yu@web.de>
 * @copyright 2016 random-host.com
 * @license   http://www.debian.org/misc/bsd.license  BSD License (3 Clause)
 * @link      http://github.random-host.com/weather/
 */
namespace randomhost\Weather;

/**
 * Dependencies:
 */
require_once realpath(__DIR__ . '/../../vendor') . '/autoload.php';

// get Yahoo Weather API Feed instance
$feed = new Yahoo\Feed('Cologne', Yahoo\Feed::UNITS_INTL);

var_dump($feed->getLocation());
var_dump($feed->getUnits());
var_dump($feed->getWind());
var_dump($feed->getAtmosphere());
var_dump($feed->getAstronomy());
var_dump($feed->getCondition());
var_dump($feed->getForecast());
