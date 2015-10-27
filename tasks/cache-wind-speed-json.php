<?php

$taskLocation = realpath(dirname(__FILE__));
chdir($taskLocation);
include("../config.php");

$link = mysql_connect(SERVER, USER, PASSWORD);
if (!$link) {
    die('Could not connect: ' . mysql_error());
}

$db_found = mysql_select_db(DATABASE);
$myquery = 'SELECT dateutc, winddir, winddir %16 as idx, windspeed_ms, windgust_ms FROM Weather.station_data '
        . 'WHERE dateutc >= now() - INTERVAL 1 YEAR '
        . 'order by dateutc';
$query = mysql_query($myquery);
$result['updated'] = date("d/m/Y H:i:s");
while ($r = mysql_fetch_array($query)) {
    $datetime = $r['dateutc'];
    $phpdate = strtotime($datetime);
    $mysqldate = date("U", $phpdate) * 1000;
    $result['winddir'][] = array($mysqldate, (float) $r['winddir']);
    $result['idx'][] = array($mysqldate, (float) $r['idx']);
    $result['windspeed_ms'][] = array($mysqldate, (float) $r['windspeed_ms']);
    $result['windgust_ms'][] = array($mysqldate, (float) $r['windgust_ms']);
}
$file = json_encode($result);
file_put_contents('data/cache-wind-speed-data.json', $file);
mysql_close($link);