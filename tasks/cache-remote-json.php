<?php
/**
 * This task downloads a remote json file of soils temps and saves it.
 * it then load the local soild temp json file and combines them into a new json
 * file and saves it for the remote comparison graph to use
 */
$taskLocation = realpath(dirname(__FILE__));
chdir($taskLocation);
include("../config.php");
$filename = "data/cr-soiltemps_all.json";

$file = file_get_contents("http://www.chrisramsay.co.uk/weather-report/data/soiltemps.json");
if(strlen($file) > 0){
    file_put_contents("data/cr-soiltemps_all.json",$file);
}

$json = file_get_contents($filename);

$decoded_remote_data = json_decode($json);
$combined_array['remote'] = $decoded_remote_data;

$json = file_get_contents("data/cache-multi-line-graph.json");
$decoded_local_data = json_decode($json);
$combined_array['local'] = $decoded_local_data;

$file = json_encode($combined_array);
file_put_contents("data/combined-soiltemps.json", $file);
