<?php
$taskLocation =  realpath(dirname(__FILE__));
chdir($taskLocation );
include("../config.php");
//date_default_timezone_get ();
$link = mysql_connect(SERVER, USER, PASSWORD);
if (!$link) {
    die('Could not connect: ' . mysql_error());
}

$db_found = mysql_select_db("Weather");

$thisWeeksData = "select DAYNAME(date) as `day`, "
        . "ROUND(AVG(air_temp),2) as `air_temp` from observations WHERE WEEK (date, 1) = "
        . "WEEK(current_date, 1) - 0  "
        . "GROUP BY DAYNAME(date) "
        . "ORDER BY WEEKDAY(date);";

$lastWeeksData = "select DAYNAME(date) as `day`, "
        . "ROUND(AVG(air_temp),2) as `air_temp` from observations WHERE WEEK (date, 1) = "
        . "WEEK(current_date, 1) - 1  "
        . "GROUP BY DAYNAME(date) "
        . "ORDER BY WEEKDAY(date);";  

$daysoftheweek = array("Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday");
$jsonarray = array();
$result = mysql_query($thisWeeksData);

if (!$result) {
    die('Invalid query: ' . mysql_error());
}


while($r = mysql_fetch_array($result)) {
    $jsonarray['this_week'][] = (float)$r['air_temp'];
}


$result = mysql_query($lastWeeksData);
if (!$result) {
    die('Invalid query: ' . mysql_error());
}

while($r = mysql_fetch_array($result)) { 
    $jsonarray['last_week'][] = (float)$r['air_temp'];
}


$file =  json_encode($jsonarray);    
file_put_contents('data/cache-daily-average-temeratures-for-week-as-Json.json', $file);        
//echo $file;
?>
