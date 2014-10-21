<?php
$taskLocation =  realpath(dirname(__FILE__));
chdir($taskLocation );
include("../config.php");

$link = mysql_connect(SERVER, USER, PASSWORD);
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
$windRose = array(
    0   => array('text'=> 'N',    'speed'=> array(0,0,0,0,0,0,0)),
    22  => array('text'=> 'NNE',  'speed'=> array(0,0,0,0,0,0,0)),
    45  => array('text'=> 'NE',   'speed'=> array(0,0,0,0,0,0,0)), 
    68  => array('text'=> 'ENE',  'speed'=> array(0,0,0,0,0,0,0)),
    90  => array('text'=> 'E',    'speed'=> array(0,0,0,0,0,0,0)),
    112 => array('text'=> 'ESE',  'speed'=> array(0,0,0,0,0,0,0)),
    135 => array('text'=> 'SE',   'speed'=> array(0,0,0,0,0,0,0)),
    158 => array('text'=> 'SSE',  'speed'=> array(0,0,0,0,0,0,0)),
    180 => array('text'=> 'S',    'speed'=> array(0,0,0,0,0,0,0)),
    202 => array('text'=> 'SSW',  'speed'=> array(0,0,0,0,0,0,0)),
    225 => array('text'=> 'SW',   'speed'=> array(0,0,0,0,0,0,0)),
    248 => array('text'=> 'WSW',  'speed'=> array(0,0,0,0,0,0,0)),
    270 => array('text'=> 'W',    'speed'=> array(0,0,0,0,0,0,0)),
    292 => array('text'=> 'WNW',  'speed'=> array(0,0,0,0,0,0,0)),
    315 => array('text'=> 'NW',   'speed'=> array(0,0,0,0,0,0,0)),
    338 => array('text'=> 'NNW',  'speed'=> array(0,0,0,0,0,0,0))
    );

$interval = 30;
$db_found = mysql_select_db("Weather");
$myquery = "SELECT count(windspeedmph) as countofrows, SUM(windspeedmph) as sumofwindspeed FROM Weather.station_data WHERE dateutc >= now() - INTERVAL $interval DAY";
$query = mysql_query($myquery);
$r = mysql_fetch_assoc($query);
$countofrows = $r['countofrows'];
echo $r['sumofwindspeed'];
$myquery = "SELECT winddir, (windspeedmph * 0.44704) as windspeedmps FROM Weather.station_data group by windspeedmph WHERE dateutc >= now() - INTERVAL $interval DAY ";

$query = mysql_query($myquery);
while($r = mysql_fetch_array($query)) {   
    switch($r['winddir']){
        case 0 : $windRose[0]['speed'][];
    }
}

print_r($windRose);
?>
