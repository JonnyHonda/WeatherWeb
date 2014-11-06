<?php
$taskLocation =  realpath(dirname(__FILE__));
chdir($taskLocation );
include("../config.php");
//date_default_timezone_get ();
$link = mysql_connect(SERVER, USER, PASSWORD);
if (!$link) {
    die('Could not connect: ' . mysql_error());
}

$db_found = mysql_select_db(DATABASE);

/*
 * These sqls only fetch data for a this and last week and not the past 7 days
 */


$thisWeeksData = "SELECT DAYNAME(start_date) as `day`,"
        . "avg_grass_temp as temp, min_grass_temp as min_temp, "
        . "max_grass_temp as max_temp FROM daily_averages"
        . " WHERE WEEK (start_date, 1) = WEEK(current_date, 1) - 0 "
        . "GROUP BY DAYNAME(start_date) "
        . "ORDER BY WEEKDAY(start_date)";

$lastWeeksData = "SELECT DAYNAME(start_date) as `day`,"
        . "avg_grass_temp as temp, min_grass_temp as min_temp, "
        . "max_grass_temp as max_temp FROM daily_averages"
        . " WHERE WEEK (start_date, 1) = WEEK(current_date, 1) - 1 "
        . "GROUP BY DAYNAME(start_date) "
        . "ORDER BY WEEKDAY(start_date)";

$jsonarray = array();
$result = mysql_query($thisWeeksData);

if (!$result) {
    die('Invalid query: ' . mysql_error());
}


while($r = mysql_fetch_array($result)) {
    $jsonarray['this_week']['day'][] = $r['day'];
    $jsonarray['this_week']['average'][] = (float)$r['temp'];
    $jsonarray['this_week']['min_temp'][] = (float)$r['min_temp'];
    $jsonarray['this_week']['max_temp'][] = (float)$r['max_temp'];
}


$result = mysql_query($lastWeeksData);
if (!$result) {
    die('Invalid query: ' . mysql_error());
}

while($r = mysql_fetch_array($result)) { 
    $jsonarray['last_week']['day'][] = $r['day'];
    $jsonarray['last_week']['average'][] = (float)$r['temp'];
    $jsonarray['last_week']['min_temp'][] = (float)$r['min_temp'];
    $jsonarray['last_week']['max_temp'][] = (float)$r['max_temp'];

}


$file =  json_encode($jsonarray);    
file_put_contents('data/cache-daily-average-temeratures-for-week-as-Json.json', $file);        
//echo $file;
?>
