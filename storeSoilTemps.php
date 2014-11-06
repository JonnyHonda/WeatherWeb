<?php

include ("sanitize.inc.php");
include("config.php");

if (!$link) {
    die('Could not connect: ' . mysql_error());
}

$date = sanitize($_GET['date'], SQL);
$grass_temp = sanitize($_GET['grass_temp'], SQL);
$soil_temp_10 = sanitize($_GET['soil_temp_10'], SQL);
$soil_temp_30 = sanitize($_GET['soil_temp_30'], SQL);
$soil_temp_100 = sanitize($_GET['soil_temp_100'], SQL);

if($grass_temp == -127){
    $grass_temp = fetch_last_value('grass_temp');
}

if($soil_temp_10 == -127){
    $soil_temp_10 = fetch_last_value('grass_temp');
}

if($soil_temp_30 == -127){
    $soil_temp_30 = fetch_last_value('grass_temp');
}

if($soil_temp_100 == -127){
    $soil_temp_100 = fetch_last_value('grass_temp');
}


function fetch_last_value($column){
    $db_found = mysql_select_db("Weather");
    $sql = "SELECT `$column` FROM obsevations ORDER BY date DESC LIMIT 1";
    $query = mysql_query($sql);
    $r = mysql_fetch_array($query);
    return $r[0];
}

