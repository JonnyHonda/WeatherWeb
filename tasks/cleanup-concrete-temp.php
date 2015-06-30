<?php
$taskLocation = realpath(dirname(__FILE__));
chdir($taskLocation);
include ("../sanitize.inc.php");
include("../config.php");
$link = mysql_connect(SERVER, USER, PASSWORD);

if (!$link) {
    die('Could not connect: ' . mysql_error());
}
$db_found = mysql_select_db(DATABASE);

$array_keys = array('air_temp', 'grass_temp', 'soil_temp_10', 'soil_temp_30', 'soil_temp_100', 'concrete_temp');

foreach ($array_keys as $elem) {
 $myquery = "SELECT * FROM observations WHERE `$elem` in (-127,85,127.94) "
        . "ORDER BY date DESC";
//print "$myquery\n";
$query = mysql_query($myquery);   
    while ($r = mysql_fetch_assoc($query)) {

        if ($r[$elem] == -127 || $r[$elem] == 127.94 || $r[$elem] == 85) {
            fetch_last_value($r['id'], $elem);
        }
        next($r);
    }
}
mysql_close($link);

function fetch_last_value($id, $column) {
    $sql = "SELECT `$column` FROM observations WHERE id BETWEEN $id-10 AND $id "
            . "AND `$column` NOT IN (-127,85,127.94) ORDER by id DESC"
            . "  LIMIT 1";
//print "$sql\n";
    $query = mysql_query($sql);
    $r = mysql_fetch_array($query);
    $sql = "UPDATE observations SET $column = {$r[0]} WHERE id = $id";
//	print("$sql\n");
   $query = mysql_query($sql);
}
