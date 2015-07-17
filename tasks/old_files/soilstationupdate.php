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



 $myquery = "SELECT * FROM observations WHERE `$elem` = -127 "
        . "ORDER BY date DESC";

$query = mysql_query($myquery);   
    while ($r = mysql_fetch_assoc($query)) {

    }

mysql_close($link);
