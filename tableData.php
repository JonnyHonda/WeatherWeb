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
     $myquery = "SELECT * FROM observations WHERE date >= now() - INTERVAL 5 HOUR ORDER BY id DESC";
$query = mysql_query($myquery);

while($r = mysql_fetch_array($query)) {
	$datetime = $r['date'];
	$phpdate = strtotime( $datetime);
	$observationDate = date('d/m/Y', $phpdate );
	$observationTime = date('H:i', $phpdate );   
	echo "<tr>\n";
	echo "\t<td>$observationDate</td>\n";
	echo "\t<td>$observationTime</td>\n";
	echo "\t<td>{$r['air_temp']}</td>\n";
	echo "\t<td>{$r['grass_temp']}</td>\n";
	echo "</tr>\n";
}

?>
