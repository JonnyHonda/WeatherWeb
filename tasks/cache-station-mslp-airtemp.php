<?php

$taskLocation = realpath(dirname(__FILE__));
chdir($taskLocation);
include("../config.php");

$link = mysql_connect(SERVER, USER, PASSWORD);
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
// 
$db_found = mysql_select_db(DATABASE);
$myquery = "SELECT dateutc, round((baromin * 33.8637526) ,2) as mslp, "
        . "round((tempf-32)/1.8,2) as air_temp, "
        . "round((dewptf-32)/1.8,2) as dew_temp "
        . "FROM Weather.station_data "
        . "WHERE dateutc >= now() - INTERVAL 1 YEAR ORDER BY dateutc";
$query = mysql_query($myquery);

while ($r = mysql_fetch_array($query)) {
    $datetime = $r['dateutc'];

    $phpdate = strtotime($datetime);

    $mysqldate = date("U", $phpdate) * 1000;

    $result['air_temp'][] = array($mysqldate, (float) $r['air_temp']);
    $result['dew_temp'][] = array($mysqldate, (float) $r['dew_temp']);
    $result['mslp'][] = array($mysqldate, (float) $r['mslp']);
}
$file = json_encode($result);
file_put_contents('data/cache-station-mslp-airtemp.json', $file);
?>
