<?php
$taskLocation =  realpath(dirname(__FILE__));
chdir($taskLocation );
include("../config.php");
//date_default_timezone_get ();
$link = mysql_connect(SERVER, USER, PASSWORD);
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
$interval = 1;
//echo 'Connected successfully';
if(isset($_GET['interval'])){
	$interval = $_GET['interval'];
}
$db_found = mysql_select_db("Weather");
     $myquery = "SELECT * FROM observations WHERE date >= now() - INTERVAL 5 HOUR ORDER BY id DESC";
$query = mysql_query($myquery);

while($r = mysql_fetch_array($query)) {   
 $datetime = $r['date'];
	$phpdate = strtotime( $datetime);
    	$mysqldate = date("U",$phpdate) * 1000;
	$result['air_temp'][] = array($mysqldate,(float)$r['air_temp']);
	$result['grass_temp'][] = array($mysqldate,(float)$r['grass_temp']);
//	$result['soil_temp_10'][] = array($mysqldate,(float)$r['soil_temp_10']);
//	$result['soil_temp_30'][] = array($mysqldate,(float)$r['soil_temp_30']);
//	$result['soil_temp_100'][] = array($mysqldate,(float)$r['soil_temp_100']);
}

echo json_encode($result);
?>
