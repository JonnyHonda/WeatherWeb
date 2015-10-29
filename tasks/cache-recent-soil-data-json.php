<?php

$taskLocation = realpath(dirname(__FILE__));
chdir($taskLocation);
include("../config.php");
//date_default_timezone_get ();
$link = mysql_connect(SERVER, USER, PASSWORD);
if (!$link) {
    die('Could not connect: ' . mysql_error());
}

$db_found = mysql_select_db(DATABASE);
$myquery = "SELECT `date`, grass_temp, concrete_temp, soil_temp_10, soil_temp_30, soil_temp_100  FROM Weather.observations
WHERE `date` >= now() - INTERVAL 12 HOUR GROUP BY hour(`date`) ORDER BY `date` DESC;";

$query = mysql_query($myquery);

$result = array();
while ($r = mysql_fetch_assoc($query)) {
    
    $result[] = $r;
}
$file = json_encode($result);
file_put_contents('data/cache-recent-soil-data.json', $file);
mysql_close($link);
