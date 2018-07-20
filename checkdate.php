
<?php 
include 'DBConnect.php';
$q = $_GET['q'];

mysql_select_db($databasename, $DB);

$qmact = "SELECT * FROM daily_report where TimeDate_record='$q'";

$macta      = mysql_query($qmact, $DB) or die(mysql_error());
$num = intval(mysql_num_rows($macta));

if($num==0){
  echo "";
}else{
	echo "*มีรายการบันทึกวันนี้แล้ว";
}




 ?>