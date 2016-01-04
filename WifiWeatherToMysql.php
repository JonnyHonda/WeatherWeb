<?php

include ("sanitize.inc.php");
include("config.php");

/*
CREATE TABLE wifiWeather(
   id int NOT NULL PRIMARY KEY AUTO_INCREMENT
  ,dateutc     DATETIME  NOT NULL
  ,temperature DOUBLE NOT NULL
  ,pressure    DOUBLE NOT NULL
  ,wind_dir    INTEGER  NOT NULL
  ,humidity    INTEGER  NOT NULL
  ,wind_speed  DOUBLE NOT NULL
  ,rain_count  INTEGER  NOT NULL
  ,epoc        INTEGER  NOT NULL
);
 */

//date_default_timezone_get ();
$link = mysql_connect(SERVER, USER, PASSWORD);
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
//print_r($_POST);
 $dateutc = sanitize($_POST['dateutc'], SQL);
 $temperature = sanitize($_POST['temperature'], SQL);
 $pressure = sanitize($_POST['pressure'], SQL);
 $wind_dir = sanitize($_POST['wind_dir'], SQL);
 $humidity = sanitize($_POST['humidity'], SQL);
 $wind_speed = sanitize($_POST['wind_speed'], SQL);
 $rain_count = sanitize($_POST['rain_count'], SQL);
 


$db_found = mysql_select_db(DATABASE);
$myquery = "INSERT INTO observations (`dateutc`, `temperature`, `pressure`, "
        . "`wind_dir`, `humidity`, `wind_speed`, `rain_count`)"
        . "values (\"$dateutc\", \"$temperature\", \"$pressure\", \"$wind_dir\", \"$humidity\",
            \"$wind_speed\", \"$rain_count\")";
//echo $myquery;
$query = mysql_query($myquery);
mysql_close($link);