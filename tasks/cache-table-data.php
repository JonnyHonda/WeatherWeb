<?php

$taskLocation = realpath(dirname(__FILE__));
chdir($taskLocation);
include("../config.php");
//date_default_timezone_get ();
$link = mysql_connect(SERVER, USER, PASSWORD);
if (!$link) {
    die('Could not connect: ' . mysql_error());
}

$db_found = mysql_select_db("Weather");
$myquery = "SELECT * FROM observations WHERE date >= now() - INTERVAL 5 HOUR ORDER BY id DESC";
$query = mysql_query($myquery);
$file = '<table class="table table-bordered table-hover table-striped">'
        . '<thead>'
        . '<tr>'
        . '<th colspan="6">Today\'s Temperatures</th>'
        . '</tr>'
        . '<tr>'
        . '<th>Time</th>'
        . '<th>Grass</th>'
        . '<th>Air</th>'
        . '<th>10cm Soil</th>'
        . '<th>30cm Soil</th>'
        . '<th>100cm Soil</th>'
        . '</tr>'
        . '</thead>'
        . '<tbody>';
while ($r = mysql_fetch_array($query)) {
    $datetime = $r['date'];
    $phpdate = strtotime($datetime);
    $observationDate = date('d/m/Y', $phpdate);
    $observationTime = date('H:i', $phpdate);
    $file .= "<tr>\n";
    $file .= "\t<td>$observationTime</td>\n";
    $file .= "\t<td>{$r['air_temp']}</td>\n";
    $file .= "\t<td>{$r['grass_temp']}</td>\n";
    $file .= "\t<td>{$r['soil_temp_10']}</td>\n";
    $file .= "\t<td>{$r['soil_temp_30']}</td>\n";
    $file .= "\t<td>{$r['soil_temp_100']}</td>\n";
    $file .= "</tr>\n";
}
$file .= "</tbody></table>";
file_put_contents('data/cache-table-data.inc.html', $file);
?>

