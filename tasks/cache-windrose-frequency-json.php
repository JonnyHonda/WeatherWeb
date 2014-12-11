<?php

$taskLocation = realpath(dirname(__FILE__));
chdir($taskLocation);
include("../config.php");
$link = mysql_connect(SERVER, USER, PASSWORD);
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
$db_found = mysql_select_db(DATABASE);
$windRose = array(
    0 => 'N',
    22 => 'NNE',
    45 => 'NE',
    68 => 'ENE',
    90 => 'E',
    112 => 'ESE',
    135 => 'SE',
    158 => 'SSE',
    180 => 'S',
    202 => 'SSW',
    225 => 'SW',
    248 => 'WSW',
    270 => 'W',
    292 => 'WNW',
    315 => 'NW',
    338 => 'NNW'
);

$directions = array(
    '0', '22', '45', '68', '90',
    '112', '135', '158', '180',
    '202', '225', '248', '270',
    '292', '315', '338');

$speeds = array(
    array(" < 0.5"," < 0.5m/s" ),
    array(" BETWEEN 0.5 and 2","0.5-2m/s "),
    array(" BETWEEN 2 and 4","2-4m/s"),
    array(" BETWEEN 4 and 6","4-6m/s"),
    array(" BETWEEN 6 and 8","6-8m/s"),
    array(" BETWEEN 8 and 10","8-10m/s"),
    array(" > 10", "> 10m/s")
        );
$tc = 0;
$sql = "SELECT 100 / sum(
(SELECT count(windspeed_ms) FROM Weather.station_data
WHERE dateutc >= now() - INTERVAL 1 DAY AND 
windspeed_ms < .5) + 
(SELECT count(windspeed_ms) FROM Weather.station_data
WHERE dateutc >= now() - INTERVAL 1 DAY AND 
windspeed_ms BETWEEN 0.5 AND 2) +
(SELECT count(windspeed_ms) FROM Weather.station_data
WHERE dateutc >= now() - INTERVAL 1 DAY AND 
windspeed_ms BETWEEN 2 AND 4) +
(SELECT count(windspeed_ms) FROM Weather.station_data
WHERE dateutc >= now() - INTERVAL 1 DAY AND 
windspeed_ms BETWEEN 4 AND 6) +
(SELECT count(windspeed_ms) FROM Weather.station_data
WHERE dateutc >= now() - INTERVAL 1 DAY AND 
windspeed_ms BETWEEN 6 AND 8) +
(SELECT count(windspeed_ms) FROM Weather.station_data
WHERE dateutc >= now() - INTERVAL 1 DAY AND 
windspeed_ms BETWEEN 8 AND 10) +
(SELECT count(windspeed_ms) FROM Weather.station_data
WHERE dateutc >= now() - INTERVAL 1 DAY AND 
windspeed_ms > 10)
) as tc;";
$query = mysql_query($sql);
$r = mysql_fetch_array($query);
$tc = $r['tc'];
$jsonArray = array();
foreach ($speeds as $speed) {
    $elem = array();
    foreach ($directions as $direction) {
        $elem['name'] = $speed[1];
        $sql = "SELECT count(windspeed_ms) as windspeed, winddir FROM station_data "
                . "WHERE dateutc >= now() - INTERVAL 1 DAY and "
                . "winddir = $direction and"
                . "(windspeed_ms) {$speed[0]};";
        $query = mysql_query($sql);
        $r = mysql_fetch_array($query);
        $elem['data'][] = round($r['windspeed'] * $tc, 2);
    }
    $jsonArray['frequency'][] = $elem;
}
file_put_contents("data/cache-freq-windrose-data.json", json_encode($jsonArray));