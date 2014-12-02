<?php
$taskLocation =  realpath(dirname(__FILE__));
chdir($taskLocation );
include("../config.php");
$file = '
<table id="freq" class="table table-bordered table-hover table-striped">
    <tr nowrap>
        <th colspan="9" class="hdr">Table of Wind speeds (Frequency)</th>
    </tr>
    <tr nowrap>
        <th>Direction</th>
        <th>&lt; 0.5 m/s</th>
        <th>0.5-2 m/s</th>
        <th>2-4 m/s</th>
        <th>4-6 m/s</th>
        <th>6-8 m/s</th>
        <th>8-10 m/s</th>
        <th>&gt; 10 m/s</th>
    </tr>' . "\n";



$link = mysql_connect(SERVER, USER, PASSWORD);
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
$db_found = mysql_select_db(DATABASE);
$windRose = array(
    0   => 'N',
    22  => 'NNE',
    45  => 'NE',
    68  => 'ENE',
    90  => 'E',
    112 => 'ESE',
    135 => 'SE',
    158 => 'SSE',
    180 => 'S',
    202 => 'SSW',
    225 => 'SW',
    248 => 'WSW',
    270 => 'W',
    292 => 'WNW',
    315 => 'NW',
    338 => 'NNW'
    );

$directions = array(
    '0', '22', '45', '68', '90',
    '112', '135', '158', '180',
    '202', '225', '248', '270',
    '292', '315', '338');

$speeds = array(" < 0.5",
    " BETWEEN 0.5 and 2",
    " BETWEEN 2 and 4",
    " BETWEEN 4 and 6",
    " BETWEEN 6 and 8",
    " BETWEEN 8 and 10",
    " > 10");

foreach ($directions as $direction) {
    $file .= '    <tr nowrap>' ."\n";
    $file .= '<td class="dir">' . $windRose[$direction] . '</td>' ."\n";

    foreach ($speeds as $speed) {
        $sql = "SELECT count(windspeed_ms) as windspeed, winddir FROM station_data "
                . "WHERE dateutc >= now() - INTERVAL 1 DAY and "
                . "winddir = $direction and"
                . "(windspeed_ms) $speed;";
        $query = mysql_query($sql);
        $r = mysql_fetch_array($query);
        $file .= '<td class="data">' . round($r['windspeed'],2) . '</td>' ."\n"; 
    }
    $file .= '   </tr>' ."\n";
}
$file .= '   </table>' ."\n";

file_put_contents('data/cache-freq-windrose-data-table.inc.html', $file);