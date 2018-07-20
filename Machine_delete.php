<?php 
include 'DBConnect.php';

mysql_select_db($databasename, $DB);

$qmacm_delete ="DELETE from equipment_group where Equipment_id = ".$_GET['macid'];
   $mact_delete = mysql_query($qmacm_delete, $DB) or die(mysql_error());
$insertGoTo = "Machine_list.php";


header(sprintf("Location: %s", $insertGoTo));
 ?>