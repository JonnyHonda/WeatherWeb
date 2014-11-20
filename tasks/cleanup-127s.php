<?php
$taskLocation =  realpath(dirname(__FILE__));
chdir($taskLocation );
include ("../sanitize.inc.php");
include("../config.php");
$link = mysql_connect(SERVER, USER, PASSWORD);

if (!$link) {
    die('Could not connect: ' . mysql_error());
}
$db_found = mysql_select_db(DATABASE);

$myquery = "SELECT * FROM observations WHERE `grass_temp` = -127 "
        . "OR `air_temp` = -127 "
        . "OR `grass_temp` = -127 "
        . "OR `soil_temp_10` = -127 "
        . "OR `soil_temp_30` = -127 "
        . "OR `soil_temp_100` = -127 "
        . "ORDER BY date DESC";

$query = mysql_query($myquery);
$array_keys = array('air_temp','grass_temp','soil_temp_10','soil_temp_30','soil_temp_100');
while($r = mysql_fetch_assoc($query)) { 
//        print_r ($r);
    foreach($array_keys as $elem){
        if($r[$elem] == -127){
 //          print $elem ." = $r[$elem] and id is {$r['id']}\n"; 
           fetch_last_value($r['id'],$elem);
           
        }
      next($r);
      
    }

}

function fetch_last_value($id,$column) {
//SELECT `soil_temp_100` FROM observations WHERE id BETWEEN 7653-10 AND 7653
/// AND `soil_temp_100` != -127 ORDER BY id DESC LIMIT 1;
    $sql = "SELECT `$column` FROM observations WHERE id BETWEEN $id-10 AND $id "
            . "AND `$column` != -127 ORDER BY id DESC  LIMIT 1";
//    print $sql."\n";
    $query = mysql_query($sql);
    $r = mysql_fetch_array($query);
    $sql = "UPDATE observations SET $column = {$r[0]} WHERE id = $id";
     $query = mysql_query($sql);
//    print $sql."\n\n";
    //return $r[0];
}