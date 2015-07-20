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
$myquery = "SELECT std.dateutc as `dateutc`, 
     round(`temp_c`,1),round(`wind_chill`,1), round(`dewpt_c`,1),round(`apparent_temp`,1),
    `humidity`, round(`dailyrain_mm`,1),
    c.`text` as winddir,round(`windspeed_ms`,1), round(`windgust_ms`,1),
    `barom_mb`, `pressure_trend`, 
     round(`temp_c`,1),round(`wind_chill`,1), round(`dewpt_c`,1),round(`apparent_temp`,1),
    `humidity`, round(`dailyrain_mm`,1),
    c.`text` as winddir,round(`windspeed_ms`,1), round(`windgust_ms`,1),
    `barom_mb`, `pressure_trend` 

FROM Weather.station_data as std 
inner join `Weather`.compass as c on std.winddir = c.degrees
WHERE std.dateutc >= now() - INTERVAL 12 HOUR  
GROUP BY hour(std.dateutc)
ORDER BY std.dateutc DESC;";

$query = mysql_query($myquery);


while ($r = mysql_fetch_assoc($query)) {
    $trend = (float) $r['pressure_trend'];
    if ($trend > 6.0) {
        $trend_text = ('rising very rapidly');
    } else if ($trend > 3.5) {
        $trend_text = ('rising quickly');
    } else if ($trend > 1.5) {
        $trend_text = ('rising');
    } else if ($trend >= 0.1) {
        $trend_text = ('rising slowly');
    } else if ($trend < -6.0) {
        $trend_text = ('falling very rapidly');
    } else if ($trend < -3.5) {
        $trend_text = ('falling quickly');
    } else if ($trend < -1.5) {
        $trend_text = ('falling');
    } else if ($trend <= -0.1) {
        $trend_text = ('falling slowly');
    } else if ($trend == 'null'){
        $trend_text = ('');
    }
    else{
    $trend_text = ('steady');
    }

    $r['pressure_trend']= $trend_text;
    
    $result[] = $r;
}

$file = json_encode($result);
file_put_contents('data/cache-recent-station-data.json', $file);
mysql_close($link);
