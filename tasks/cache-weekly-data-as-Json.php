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
$result = mysql_query($thisWeeksData);
if (!$result) {
    die('Invalid query: ' . mysql_error());
}
$daysoftheweek = array("Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday");

$file = file_get_contents("templates/barGraphData.template.json");
while($r = mysql_fetch_array($result)) {
    switch($r['day']){
        case  'Monday' :
               $file = str_replace("%MONDAYA%",$r['air_temp'],$file); break;
        case  'Tuesday' :
            $file = str_replace("%TUESDAYA%",$r['air_temp'],$file);break;
        case  'Wednesday' :
            $file = str_replace("%WEDNESDAYA%",$r['air_temp'],$file);break;
        case  'Thursday' : 
            $file = str_replace("%THURSDAYA%",$r['air_temp'],$file);break;
        case  'Friday' : 
            $file = str_replace("%FRIDAYA%",$r['air_temp'],$file);break;
        case  'Saturday' : 
            $file = str_replace("%SATURDAYA%",$r['air_temp'],$file);break;
        case  'Sunday' : 
            $file = str_replace("%SUNDAYA%",$r['air_temp'],$file);break;
        
    }	
     
 }


$result = mysql_query($lastWeeksData);
while($r = mysql_fetch_array($result)) { 
        switch($r['day']){
        case  'Monday' :
               $file = str_replace("%MONDAYB%",$r['air_temp'],$file); break;
        case  'Tuesday' :
            $file = str_replace("%TUESDAYB%",$r['air_temp'],$file);break;
        case  'Wednesday' :
            $file = str_replace("%WEDNESDAYB%",$r['air_temp'],$file);break;
        case  'Thursday' : 
            $file = str_replace("%THURSDAYB%",$r['air_temp'],$file);break;
        case  'Friday' : 
            $file = str_replace("%FRIDAYB%",$r['air_temp'],$file);break;
        case  'Saturday' : 
            $file = str_replace("%SATURDAYB%",$r['air_temp'],$file);break;
        case  'Sunday' : 
            $file = str_replace("%SUNDAYB%",$r['air_temp'],$file);break;
        
    }   
}
        $file = preg_replace('/%[A-Z]*%/', '0', $file);
        
        
        file_put_contents('data/barGraphData.json', $file);        
//echo $file;
?>
