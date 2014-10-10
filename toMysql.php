<?php

include ("sanitize.inc.php");
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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
$link = mysql_connect('sajb.co.uk', 'Tempestas', 'mRHY9BmlN4CrYUEYNhWV');
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



$db_found = mysql_select_db("Weather");
$myquery = "INSERT INTO station_data (`dateutc`, `windgustmph`, `tempf`, "
        . "`windspeedmph`, `baromin`, `rainin`, `dailyrainin`, `winddir`, "
        . "`softwaretype`, `key`, `dewptf`, `humidity`)"
        . "values (\"$dateutc\", \"$windgustmph\", \"$tempf\", \"$windspeedmph\", \"$baromin\",
            \"$rainin\", \"$dailyrainin\", \"$winddir\", \"$softwaretype\", \"$key\", \"$dewptf\",\"$humidity\")";
// echo $myquery;
$query = mysql_query($myquery);
