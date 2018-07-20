<?php 
include 'DBConnect.php';

mysql_select_db($databasename, $DB);

$qmacm_delete ="DELETE from users where user_id = ".$_GET['userid'];
   $mact_delete = mysql_query($qmacm_delete, $DB) or die(mysql_error());
$insertGoTo = "User_list.php";


header(sprintf("Location: %s", $insertGoTo));
 ?>