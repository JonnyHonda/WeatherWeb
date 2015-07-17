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
// Trend
$myquery = 'SELECT round(sum(trend.diff) ,1) as trend, count(trend.diff) as count
from (
	SELECT x.barom_mb as X, y.barom_mb as Y,
		 x.barom_mb - y.barom_mb diff
	  FROM station_data x 
	  JOIN station_data y 
		ON y.id < x.id
	WHERE y.dateutc >= now() - INTERVAL 3 HOUR 
	GROUP BY y.id) 
as trend;';
$query = mysql_query($myquery);
while ($r = mysql_fetch_array($query)) {
    $trend = (float) $r['trend'];
    $result['barom']['trend'] = array($trend);
    if ($trend > 6.0) {
        $trend_text = ('rising very rapidly');
    } else if ($trend > 3.5) {
        $trend_text = ('rising quickly');
    } else if ($trend > 1.5) {
        $trend_text = ('rising');
    } else if ($trend >= 0.1) {
        $trend_text = ('rising slowly');
    } else if ($trend < -6.0) {
        $trend_text = ('falling very rapidly');
    } else if ($trend < -3.5) {
        $trend_text = ('falling quickly');
    } else if ($trend < -1.5) {
        $trend_text = ('falling');
    } else if ($trend <= -0.1) {
        $trend_text = ('falling slowly');
    }else{
    $trend_text = ('steady');
    }

    $result['barom']['trend_text'] = array($trend_text);
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
mysql_close($link);
