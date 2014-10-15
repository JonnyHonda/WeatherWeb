<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include("config.php");
//date_default_timezone_get ();
$link = mysql_connect(SERVER, USER, PASSWORD);
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
$interval = 1;
//echo 'Connected successfully';
if (isset($_GET['interval'])) {
    $interval = $_GET['interval'];
}
$db_found = mysql_select_db("Weather");
$myquery = 'SELECT DATE_FORMAT(date,"%Y-%m-%d %H:00:00") as `date`, 
round(avg(air_temp),2) as air_temp, 
round(avg(grass_temp),2) as grass_temp,
round(avg(soil_temp_10),2) as soil_temp_10,
round(avg(soil_temp_30),2) as soil_temp_30 ,
round(avg(soil_temp_100),2) as soil_temp_100 FROM Weather.observations 
WHERE date >= now() - INTERVAL 7 DAY GROUP BY DATE_FORMAT(date, "%d-%m-%y %H") ORDER BY date DESC;';
$query = mysql_query($myquery);

while ($r = mysql_fetch_array($query)) {
    $datetime = $r['date'];
    $phpdate = strtotime($datetime);
    $mysqldate = date("U", $phpdate) * 1000;
    for ($l = 1; $l <= 5; $l++) {
        $subarray = array();
        $subarray[0] = $mysqldate;
        $subarray[1] = (float) $r[$l];
        //  $subarray['grass_temp'] = (float)$r['grass_temp'];
        //  $subarray['soil_temp_10'] = (float)$r['soil_temp_10'];
        //  $subarray['soil_temp_30'] = (float)$r['soil_temp_30'];
        //  $subarray['soil_temp_100'] = (float)$r['soil_temp_100'];
        $result[$l][] = $subarray;
//	$result['grass_temp'][] = array($mysqldate,(float)$r['grass_temp']);
//	$result['soil_temp_10'][] = array($mysqldate,(float)$r['soil_temp_10']);
//	$result['soil_temp_30'][] = array($mysqldate,(float)$r['soil_temp_30']);
//	$result['soil_temp_100'][] = array($mysqldate,(float)$r['soil_temp_100']);
    }
}

$file = json_encode($result);
file_put_contents("cache-line-graph.json", $file);
