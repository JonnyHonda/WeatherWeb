<?php
include("config.php");
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
$file = "";
while($r = mysql_fetch_array($query)) {
	$datetime = $r['date'];
	$phpdate = strtotime( $datetime);
	$observationDate = date('d/m/Y', $phpdate );
	$observationTime = date('H:i', $phpdate );   
	$file .= "<tr>\n";
	$file .= "\t<td>$observationDate</td>\n";
	$file .=  "\t<td>$observationTime</td>\n";
	$file .=  "\t<td>{$r['air_temp']}</td>\n";
	$file .=  "\t<td>{$r['grass_temp']}</td>\n";
	$file .=  "</tr>\n";
}
file_put_contents('tableData.inc.html', $file);
?>
