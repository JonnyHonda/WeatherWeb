<?php
/**
 * Not in use
 */
include ("sanitize.inc.php");
include("config.php");
$link = mysql_connect(SERVER, USER, PASSWORD);
$db_found = mysql_select_db(DATABASE);
if (!$link) {
    die('Could not connect: ' . mysql_error());
}

$date = sanitize($_GET['date'], SQL);
$grass_temp = sanitize($_GET['grass_temp'], SQL);
$soil_temp_10 = sanitize($_GET['soil_temp_10'], SQL);
$soil_temp_30 = sanitize($_GET['soil_temp_30'], SQL);
$soil_temp_100 = sanitize($_GET['soil_temp_100'], SQL);

if ($grass_temp == -127) {
    $grass_temp = fetch_last_value('grass_temp');
}

if ($soil_temp_10 == -127) {
    $soil_temp_10 = fetch_last_value('grass_temp');
}

if ($soil_temp_30 == -127) {
    $soil_temp_30 = fetch_last_value('grass_temp');
}

if ($soil_temp_100 == -127) {
    $soil_temp_100 = fetch_last_value('grass_temp');
}

$sql = "INSERT INTO observations "
        . "(date,air_temp,soil_temp_100,soil_temp_30,soil_temp_10,grass_temp) "
        . "values(\"$date\", \"$air_temp\", \"$grass_temp\", \"$soil_temp_10\", "
        . "\"$soil_temp_30\", \"$soil_temp_100\")";
$query = mysql_query($sql);

function fetch_last_value($column) {
    $db_found = mysql_select_db(DATABASE);
    $sql = "SELECT `$column` FROM observations ORDER BY date DESC LIMIT 1";
    $query = mysql_query($sql);
    $r = mysql_fetch_array($query);
    return $r[0];
}
