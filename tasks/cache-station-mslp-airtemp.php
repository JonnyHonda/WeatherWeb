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
$myquery = "SELECT dateutc, barom_mb as pressure, "
        . "temp_c as air_temp, "
        . "dewpt_c as dew_temp, "
        . "humidity "
        . "FROM Weather.station_data "
        . "WHERE dateutc >= now() - INTERVAL 1 YEAR ORDER BY dateutc";
$query = mysql_query($myquery);
$result['updated'] = date("d/m/Y H:i:s");
while ($r = mysql_fetch_array($query)) {
    $datetime = $r['dateutc'];
    $phpdate = strtotime($datetime);
    $mysqldate = date("U", $phpdate) * 1000;

    $result['air_temp'][] = array($mysqldate, (float) $r['air_temp']);
    $result['dew_temp'][] = array($mysqldate, (float) $r['dew_temp']);
    $result['pressure'][] = array($mysqldate, (float) $r['pressure']);   
    $mslp = (float)round(calculateMSLP(ALTITUDE, $r['pressure'], $r['air_temp']),2);
    $result['mslp'][] = array($mysqldate,  $mslp);
}
$file = json_encode($result);
file_put_contents('data/cache-station-mslp-airtemp.json', $file);

  
 function calculateMSLP($local_height,$abs_press,$air_temp){
   $mslp = (1-($local_height*0.0065)/($air_temp+(0.0065*$local_height)+273.15));
   $mslp = pow($mslp,-5.275);
   return $abs_press*$mslp;
     
 }
