<?php

include ("sanitize.inc.php");
include("config.php");

/*
 * date=2014-12-27 14:19:48
 * air_temp=3.88
 * soil_temp_100=8.25
 * soil_temp_30=5.94
 * concrete_temp=0.12
 * soil_temp_10=4.69
 * grass_temp=-0.31
 */

//date_default_timezone_get ();
$link = mysql_connect(SERVER, USER, PASSWORD);
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
//print_r($_POST);
 $date = sanitize($_POST['date'], SQL);
 $air_temp = sanitize($_POST['air_temp'], SQL);
 $soil_temp_100 = sanitize($_POST['soil_temp_100'], SQL);
 $soil_temp_30 = sanitize($_POST['soil_temp_30'], SQL);
 $concrete_temp = sanitize($_POST['concrete_temp'], SQL);
 $soil_temp_10 = sanitize($_POST['soil_temp_10'], SQL);
 $grass_temp = sanitize($_POST['grass_temp'], SQL);




$db_found = mysql_select_db("Weather_Test");
$myquery = "INSERT INTO station_data (`date`, `air_temp`, `soil_temp_100`, "
        . "`soil_temp_30`, `concrete_temp`, `soil_temp_10`, `grass_temp`)"
        . "values (\"$date\", \"$air_temp\", \"$soil_temp_100\", \"$soil_temp_30\", \"$concrete_temp\",
            \"$soil_temp_10\", \"$grass_temp\")";
//echo $myquery;
$query = mysql_query($myquery);
