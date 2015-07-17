<?php
include("config.php");

$link = mysql_connect(SERVER, USER, PASSWORD);
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
$interval = 1;
//echo 'Connected successfully';
if(isset($_GET['interval'])){
	$interval = $_GET['interval'];
}
$db_found = mysql_select_db(DATABASE);
     $myquery = "SELECT * 
         FROM observations order by date DESC Limit 1";
$query = mysql_query($myquery);

while($r = mysql_fetch_row($query)) {  
    $csvdata = implode(",", $r);
}

echo $csvdata;
mysql_close($link);