<?php

$taskLocation = realpath(dirname(__FILE__));
chdir($taskLocation);
include("../config.php");

$link = mysql_connect(SERVER, USER, PASSWORD);
if (!$link) {
    die('Could not connect: ' . mysql_error());
}

$db_found = mysql_select_db(DATABASE);
$myquery = 'SELECT dateutc, rain_mm, dailyrain_mm FROM Weather.station_data '
        . 'WHERE dateutc >= now() - INTERVAL 1 YEAR '
        . 'order by dateutc';
$query = mysql_query($myquery);
$result['updated'] = date("d/m/Y h:j:s");
while ($r = mysql_fetch_array($query)) {
    $datetime = $r['dateutc'];
    $phpdate = strtotime($datetime);
    $mysqldate = date("U", $phpdate) * 1000;
    $result['rain_mm'][] = array($mysqldate, (float) $r['rain_mm']);
    $result['dailyrain_mm'][] = array($mysqldate, (float) $r['dailyrain_mm']);
}
$file = json_encode($result);
file_put_contents('data/cache-rainfall-data.json', $file);