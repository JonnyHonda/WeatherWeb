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
$myquery = "SELECT dateutc, round((baromin * 33.8637526) ,2) as pressure, "
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
    $result['pressure'][] = array($mysqldate, (float) $r['pressure']);
    $mslp = (float)round(calculateMSLP(ALTITUDE, $r['pressure'] ),2);
    $result['mslp'][] = array($mysqldate,  $mslp);
}
$file = json_encode($result);
file_put_contents('data/cache-station-mslp-airtemp.json', $file);
  function calculateMSLP($altitude_in_meters,$pressure_in_millibars){

        $F1 = (pow(1013.25, 0.190284) * 0.0065)/288;
        $F2 = $altitude_in_meters/pow(($pressure_in_millibars - 0.3), 0.190284);
        $F3 = 1/0.190284;
        $F =  pow((1 + ($F1 * $F2)), $F3);
        return  ($pressure_in_millibars - 0.3) * $F;

    }
?>
