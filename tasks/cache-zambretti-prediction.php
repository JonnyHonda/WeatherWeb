<?php
$taskLocation =  realpath(dirname(__FILE__));
chdir($taskLocation );
include("../config.php");
include '../zambretti.inc.php';

$link = mysql_connect(SERVER, USER, PASSWORD);
if (!$link) {
    die('Could not connect: ' . mysql_error());
}

$in2mb = 33.8637526;
$db_found = mysql_select_db(DATABASE);

$wind_rose = array("N", "NNE", "NE", 
    "ENE", "E", "ESE", 
    "SE", "SSE", "S", 
    "SSW", "SW", "WSW", 
    "W", "WNW", "NW", "NNW");

$mysql = "SELECT * FROM station_data ORDER BY dateutc desc limit 2;";
$query = mysql_query($mysql);
if (!$query) die ("Problem running query");
// if (!$query) die("Query issue\n");

$r = mysql_fetch_array($query);
$millibars = $r['baromin'] * $in2mb;
$winddir = $r['winddir'] % 22;
$month = date("j");
$date =date("h:i:s A");
$r = mysql_fetch_array($query);
$trend = 0;

if ($millibars - $r['baromin'] < 0){
    $trend = 2;
}
if ($millibars - $r['baromin'] > 0){
    $trend = 1;
}

$output =  betel_cast($millibars, $month, $winddir, $trend , 1, 1050, 950);
$file = file_get_contents("templates/cache-zambretti-prediction.template.html");
$file = str_replace("[--image--]","{$output[1]}", $file);
$file = str_replace("[--description--]","{$output[0]}", $file);
$file = str_replace("[--date--]","$date", $file);
file_put_contents("data/cache-zambretti-prediction.inc.html",$file);

