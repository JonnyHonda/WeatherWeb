<?php

$taskLocation = realpath(dirname(__FILE__));
chdir($taskLocation);
include("../config.php");

$link = mysql_connect(SERVER, USER, PASSWORD);
if (!$link) {
    die('Could not connect: ' . mysql_error());
}

$db_found = mysql_select_db(DATABASE);
$myquery = 'select `dateutc`, `temp_c`, `humidity`, `rain_mm`, `dailyrain_mm`, `barom_mb`
from station_data
WHERE dateutc > now() - INTERVAL 1 DAY
order by dateutc ASC;';
$query = mysql_query($myquery);
$result['updated'] = date("d/m/Y H:i:s");
$xdata = array();
$temp_data = array();
$rain_data = array();
$pressure_data = array();
$humidity_data = array();


while ($r = mysql_fetch_array($query)) {
    $datetime = $r['dateutc'];
    $phpdate = strtotime($datetime);
    $xdata[] = date("U", $phpdate) * 1000;
    $temp_data[] = (double) $r['temp_c'];
    $rain_data[] = (double) $r['rain_mm'];
    $dailyrain_data[] = (double) $r['dailyrain_mm'];
    $pressure_data[] = (double) $r['barom_mb'];
    $humidity_data[] = (int) $r['humidity'];
}

$result['xData'] = $xdata;
$result['datasets'][0]['name'] = "Temperature";
$result['datasets'][0]['data'] = $temp_data;
$result['datasets'][0]['unit'] = "Deg C";
$result['datasets'][0]['type'] = "line";
$result['datasets'][0]['valueDecimals'] = 1;

$result['datasets'][1]['name'] = "Rain";
$result['datasets'][1]['data'] = $rain_data;
$result['datasets'][1]['unit'] = "mm";
$result['datasets'][1]['type'] = "column";
$result['datasets'][1]['valueDecimals'] = 1;

$result['datasets'][2]['name'] = "Rain Accumulation";
$result['datasets'][2]['data'] = $dailyrain_data;
$result['datasets'][2]['unit'] = "mm";
$result['datasets'][2]['type'] = "column";
$result['datasets'][2]['valueDecimals'] = 1;

$result['datasets'][3]['name'] = "Pressure";
$result['datasets'][3]['data'] = $pressure_data;
$result['datasets'][3]['unit'] = "mb";
$result['datasets'][3]['type'] = "area";
$result['datasets'][3]['min'] = 940;
$result['datasets'][3]['max'] = 1040;
$result['datasets'][3]['valueDecimals'] = 1;

$result['datasets'][4]['name'] = "Humidity";
$result['datasets'][4]['data'] = $humidity_data;
$result['datasets'][4]['unit'] = "%";
$result['datasets'][4]['type'] = "area";
$result['datasets'][4]['min'] = 40;
$result['datasets'][4]['max'] = 100;
$result['datasets'][4]['valueDecimals'] = 0;

$file = json_encode($result);
file_put_contents('data/cache-linked-graph-data.json', $file);
mysql_close($link);
