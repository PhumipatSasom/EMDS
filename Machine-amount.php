
<?php include 'DBConnect.php';?>


<?php
$q = intval($_GET['q']);



mysql_select_db($databasename, $DB);
$qmact = "SELECT * FROM equipment_group where Equipment_id=".$q;

$mact = mysql_query($qmact, $DB) or die(mysql_error());
$row_mactm = mysql_fetch_assoc($mact);




echo $row_mactm['NumberOfEquipment'] ;

mysql_close($DB);
?>











