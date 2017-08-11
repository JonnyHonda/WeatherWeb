<?php

include ("sanitize.inc.php");
include("config.php");

/*
 * date=2014-12-27 14:19:48
 * air_temp=3.88
 * soil_temp_100=8.25
 * soil_temp_30=5.94
 * concrete_temp=0.12
 * soil_temp_10=4.69
 * grass_temp=-0.31
 */

//date_default_timezone_get ();
$link = mysql_connect(SERVER, USER, PASSWORD);
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
//print_r($_POST);
 $date = sanitize($_POST['date'], SQL);
 $air_temp = sanitize($_POST['air_temp'], SQL);
 $soil_temp_100 = sanitize($_POST['soil_temp_100'], SQL);
 $soil_temp_30 = sanitize($_POST['soil_temp_30'], SQL);
 $concrete_temp = sanitize($_POST['concrete_temp'], SQL);
 $soil_temp_10 = sanitize($_POST['soil_temp_10'], SQL);
 $grass_temp = sanitize($_POST['grass_temp'], SQL);




$db_found = mysql_select_db(DATABASE);
$myquery = "INSERT INTO observations (`date`, `air_temp`, `soil_temp_100`, "
        . "`soil_temp_30`, `concrete_temp`, `soil_temp_10`, `grass_temp`)"
        . "values (\"$date\", \"$air_temp\", \"$soil_temp_100\", \"$soil_temp_30\", \"$concrete_temp\",
            \"$soil_temp_10\", \"$grass_temp\")";
//echo $myquery;
$query = mysql_query($myquery);
mysql_close($link);
// Push to ElasticSearch

$date= str_replace(" ","T",$date);
$date = $date."Z";
echo $date;
$data = array(
"observation_time" => "$date",
 "temperatures" => array(
        "grass" => (double)$grass_temp,
        "concrete" => (double)$concrete_temp,
        "soil_10cm" => (double)$soil_temp_10,
        "soil_30cm" => (double)$soil_temp_30,
        "soil_75cm" => (double)$soil_temp_100
           )
);
/*
$json_data = json_encode($data);

exec("curl -sS -XPOST \"https://search-egxp-weather-data-bqyr4n75d7j66mp32q63i2mbq4.eu-west-1.es.amazonaws.com/observations/observation/\" -d'$json_data'");

*/
