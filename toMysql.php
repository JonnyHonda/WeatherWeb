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
 $windgustmph = sanitize($_GET['windgustmph'], SQL);
 $tempf = sanitize($_GET['tempf'], SQL);
 $windspeedmph = sanitize($_GET['windspeedmph'], SQL);
 $baromin = sanitize($_GET['baromin'], SQL);
 $rainin = sanitize($_GET['rainin'], SQL);
 $dailyrainin = sanitize($_GET['dailyrainin'], SQL);
 $winddir = sanitize($_GET['winddir'], SQL);
 $softwaretype = sanitize($_GET['softwaretype'], SQL);
 $key = sanitize($_GET['key'], SQL);
 $dewptf = sanitize($_GET['dewptf'], SQL);
 $humidity = sanitize($_GET['humidity'], SQL);



$db_found = mysql_select_db(DATABASE);
$myquery = "INSERT INTO station_data (`dateutc`, `windgustmph`, `tempf`, "
        . "`windspeedmph`, `baromin`, `rainin`, `dailyrainin`, `winddir`, "
        . "`softwaretype`, `key`, `dewptf`, `humidity`)"
        . "values (\"$dateutc\", \"$windgustmph\", \"$tempf\", \"$windspeedmph\", \"$baromin\",
            \"$rainin\", \"$dailyrainin\", \"$winddir\", \"$softwaretype\", \"$key\", \"$dewptf\",\"$humidity\")";
// echo $myquery;
$query = mysql_query($myquery);
