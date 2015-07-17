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


$thisMonthsRangeData = "SELECT date, round(min(grass_temp),2) as min_temp, round(max(grass_temp),2) as max_temp  from observations
WHERE month(date) = month(now()) AND year(date) = year(now())
group by day(date)";

$thisMonthsAverageData = "SELECT date, round(avg(grass_temp),2) as temp  from observations
WHERE month(date) = month(now()) AND year(date) = year(now())
group by day(date)";

$jsonarray = array();
$result = mysql_query($thisMonthsRangeData);

if (!$result) {
    die('Invalid query: ' . mysql_error());
}

$data =  array();
while($r = mysql_fetch_array($result)) {
    $datetime = $r['date'];
    $phpdate = strtotime($datetime);
    $mysqldate = date("U", $phpdate) * 1000;
    
    $data = array($mysqldate,(float)$r['min_temp'],(float)$r['max_temp']);
    $jsonarray['ranges'][] = $data;
}

$jsonarray['updated'] = date("d/m/Y H:i:s");
$jsonarray['title'] = date("F");
$result = mysql_query($thisMonthsAverageData);
if (!$result) {
    die('Invalid query: ' . mysql_error());
}
$data =  array();
while($r = mysql_fetch_array($result)) { 
    $datetime = $r['date'];
    $phpdate = strtotime($datetime);
    $mysqldate = date("U", $phpdate) * 1000;
    
    $data = array($mysqldate,(float)$r['temp']);
    $jsonarray['averages'][] = $data;
}


$file =  json_encode($jsonarray);    
file_put_contents('data/cache-monthly-station-data-average-temp.json', $file);  
mysql_close($link);
//echo $file;
?>
