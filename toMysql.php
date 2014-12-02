<?php

include ("sanitize.inc.php");
include("config.php");


/*
  `dateutc`,
  `windgustmph`,
  `tempf`,
  windspeedmph`,
  `baromin`,
  `rainin`,
  `dailyrainin`,
  `winddir`,
  `softwaretype`,
  `key`,
  `dewptf`,
  `humidity`,
 */

//date_default_timezone_get ();
$link = mysql_connect(SERVER, USER, PASSWORD);
if (!$link) {
    die('Could not connect: ' . mysql_error());
}

 $dateutc = sanitize($_GET['dateutc'], SQL);
 $windgust_ms = sanitize($_GET['windgust_ms'], SQL);
 $temp_c = sanitize($_GET['temp_c'], SQL);
 $windspeed_ms = sanitize($_GET['windspeed_ms'], SQL);
 $barom_mb = sanitize($_GET['barom_mb'], SQL);
 $rain_mm = sanitize($_GET['rain_mm'], SQL);
 $dailyrain_mm = sanitize($_GET['dailyrain_mm'], SQL);
 $winddir = sanitize($_GET['winddir'], SQL);
 $softwaretype = sanitize($_GET['softwaretype'], SQL);
 $key = sanitize($_GET['key'], SQL);
 $dewpt_c = sanitize($_GET['dewpt_c'], SQL);
 $humidity = sanitize($_GET['humidity'], SQL);



$db_found = mysql_select_db(DATABASE);
$myquery = "INSERT INTO station_data (`dateutc`, `windgust_mm`, `temp_c`, "
        . "`windspeed_ms`, `barom_mb`, `rain_mm`, `dailyrain_mm`, `winddir`, "
        . "`softwaretype`, `key`, `dewpt_c`, `humidity`)"
        . "values (\"$dateutc\", \"$windgust_ms\", \"$temp_c\", \"$windspeed_ms\", \"$barom_mb\",
            \"$rain_mm\", \"$dailyrain_mm\", \"$winddir\", \"$softwaretype\", \"$key\", \"$dewpt_c\",\"$humidity\")";
// echo $myquery;
$query = mysql_query($myquery);
