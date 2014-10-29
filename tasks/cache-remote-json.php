<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$taskLocation = realpath(dirname(__FILE__));
chdir($taskLocation);
include("../config.php");

$filename = "data/cr-soiltemps_all.json";
$file = NULL;
if (file_exists($filename)) {
    $last_modified = date_create(date("F d Y H:i:s", filemtime($filename)));
    $now = date_create(date("F d Y H:i:s"));
    $diff = date_diff($last_modified, $now);
    $cache_time = $diff->format("%d");
    //echo $cache_time;
    if ($cache_time > 1) {
        //echo "getting new file 1 ";
        $file = file_get_contents("http://www.chrisramsay.co.uk/weather-report/data/soiltemps_all.json");
    }
} else {
    //echo "getting new file 2";
    $file = file_get_contents("http://www.chrisramsay.co.uk/weather-report/data/soiltemps_all.json");
}

if($file){
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
