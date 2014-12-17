<?php

$taskLocation = realpath(dirname(__FILE__));
chdir($taskLocation);
include("../config.php");

$link = mysql_connect(SERVER, USER, PASSWORD);
if (!$link) {
    die('Could not connect: ' . mysql_error());
}

$db_found = mysql_select_db(DATABASE);
$result['updated'] = date("d/m/Y H:i:s");

$myquery = 'SELECT max(barom_mb) as max,min(barom_mb) as min FROM Weather.station_data
WHERE dateutc >= now() - INTERVAL 1 day;';
$query = mysql_query($myquery);
while ($r = mysql_fetch_array($query)) {
    $result['barom']['max'] = array((float) $r['max']);
    $result['barom']['min'] = array((float) $r['min']);
}

$myquery = 'SELECT barom_mb as current FROM Weather.station_data
WHERE dateutc >= now() - INTERVAL 3 HOUR ORDER BY dateutc DESC LIMIT 1;';
$query = mysql_query($myquery);
while ($r = mysql_fetch_array($query)) {
    $result['barom']['current'] = array((float) $r['current']);
}

$myquery = 'SELECT max(temp_c) as max,min(temp_c) as min FROM Weather.station_data
WHERE dateutc >= now() - INTERVAL 1 day;';
$query = mysql_query($myquery);
while ($r = mysql_fetch_array($query)) {
    $result['air_temp']['max'] = array((float) $r['max']);
    $result['air_temp']['min'] = array((float) $r['min']);
}

$myquery = 'SELECT temp_c as current FROM Weather.station_data
WHERE dateutc >= now() - INTERVAL 3 HOUR ORDER BY dateutc DESC LIMIT 1;';
$query = mysql_query($myquery);
while ($r = mysql_fetch_array($query)) {
    $result['air_temp']['current'] = array((float) $r['current']);
}

$myquery = 'SELECT max(windgust_ms) as gustmax, max(windspeed_ms) as windmax FROM Weather.station_data
WHERE dateutc >= now() - INTERVAL 1 day;';
$query = mysql_query($myquery);
while ($r = mysql_fetch_array($query)) {
    $result['wind']['gust_max'] = array((float) $r['gustmax']);
    $result['wind']['speed_max'] = array((float) $r['windmax']);
}

$myquery = 'SELECT windspeed_ms as current, winddir as direction FROM Weather.station_data
WHERE dateutc >= now() - INTERVAL 3 HOUR ORDER BY dateutc DESC LIMIT 1;';
$query = mysql_query($myquery);
while ($r = mysql_fetch_array($query)) {
    $result['wind']['current'] = array((float) $r['current']);
    $result['wind']['direction'] = array((float) $r['direction']);
}

$file = json_encode($result);
file_put_contents('data/cache-live-readings.json', $file);