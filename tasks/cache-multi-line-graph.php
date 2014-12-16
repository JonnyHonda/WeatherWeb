<?php

$taskLocation = realpath(dirname(__FILE__));
chdir($taskLocation);
include("../config.php");

$link = mysql_connect(SERVER, USER, PASSWORD);
if (!$link) {
    die('Could not connect: ' . mysql_error());
}

$db_found = mysql_select_db(DATABASE);
$myquery = 'SELECT date_format(date,"%Y-%m-%d %H:%i:00") as `date`, 
    air_temp,soil_temp_100,soil_temp_30,soil_temp_10, grass_temp  
    FROM observations WHERE date >= now() - INTERVAL 1 YEAR ORDER BY id;';
$query = mysql_query($myquery);
$result['updated'] = date("d/m/Y H:i:s");
while ($r = mysql_fetch_array($query)) {
    $datetime = $r['date'];

    $phpdate = strtotime($datetime);

    $mysqldate = date("U", $phpdate) * 1000;

    $result['air_temp'][] = array($mysqldate, (float) $r['air_temp']);
    $result['grass_temp'][] = array($mysqldate, (float) $r['grass_temp']);
    $result['soil_temp_10'][] = array($mysqldate, (float) $r['soil_temp_10']);
    $result['soil_temp_30'][] = array($mysqldate, (float) $r['soil_temp_30']);
    $result['soil_temp_100'][] = array($mysqldate, (float) $r['soil_temp_100']);
}
$file = json_encode($result);
file_put_contents('data/cache-multi-line-graph.json', $file);
