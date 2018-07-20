
<?php include 'DBConnect.php';?>


<?php
$q = intval($_GET['q']);



mysql_select_db($databasename, $DB);
$qmact = "SELECT * FROM m.equipment where eqtype=".$q;

$mact = mysql_query($qmact, $DB) or die(mysql_error());
$num = mysql_num_rows($mact);




echo $num ;

mysql_close($DB);
?>











