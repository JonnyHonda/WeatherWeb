<?php
//date_default_timezone_get ();
$link = mysql_connect('sajb.co.uk', 'Tempestas', 'mRHY9BmlN4CrYUEYNhWV');
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
$interval = 1;
//echo 'Connected successfully';
if(isset($_GET['interval'])){
	$interval = $_GET['interval'];
}
$db_found = mysql_select_db("Weather");
     $myquery = "SELECT * FROM observations WHERE date >= now() - INTERVAL 6 MONTH ORDER BY id";
$query = mysql_query($myquery);

while($r = mysql_fetch_array($query)) {   
 $datetime = $r['date'];
//echo $datetime;
	$phpdate = strtotime( $datetime);
//	$mysqldate = date('d/m/Y H:i', $phpdate );
    	$mysqldate = date("U",$phpdate) * 1000;
//	$mysqldate = date('Y-m-d H:i:s',$phpdate);
/*
	$result['date'][] = $mysqldate;
    $result['data']['air_temp'][] = (float)$r['air_temp'];
    $result['data']['grass_temp'][] = (float)$r['grass_temp'];
    $result['data']['soil_temp_10'][] = (float)$r['soil_temp_10'];
    $result['data']['soil_temp_30'][] = (float)$r['soil_temp_30'];
    $result['data']['soil_temp_100'][] = (float)$r['soil_temp_100'];
*/
	$result['air_temp'][] = array($mysqldate,(float)$r['air_temp']);
	$result['grass_temp'][] = array($mysqldate,(float)$r['grass_temp']);
	$result['soil_temp_10'][] = array($mysqldate,(float)$r['soil_temp_10']);
	$result['soil_temp_30'][] = array($mysqldate,(float)$r['soil_temp_30']);
	$result['soil_temp_100'][] = array($mysqldate,(float)$r['soil_temp_100']);
}

echo json_encode($result);
?>
