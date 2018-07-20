<?php
include 'DBConnect.php';
mysql_select_db($databasename, $DB);
$qmact = "SELECT * FROM equipment_group a inner join m.equipment b on a.Equipment_type = b.eqtype inner join daily_report c on a.Equipment_id=c.Equipment_id WHERE a.Equipment_group = 'tm' and c.TimeDate_record = '2018-04-03' GROUP BY a.Equipment_id ORDER BY `a`.`Equipment_id` ASC";

$mact      = mysql_query($qmact, $DB) or die(mysql_error());
$numtm = mysql_num_rows($mact);
$row_mactm = mysql_fetch_assoc($mact);

$qmacm = "SELECT * FROM equipment_group a inner join m.equipment b on a.Equipment_type = b.eqtype inner join daily_report c on a.Equipment_id=c.Equipment_id WHERE a.Equipment_group = 'me' and c.TimeDate_record = '2018-04-03' GROUP BY a.Equipment_id ORDER BY `a`.`Equipment_id` ASC";

$macm      = mysql_query($qmacm, $DB) or die(mysql_error());
$numme = mysql_num_rows($macm);
$row_macme = mysql_fetch_assoc($macm);

$qmacm_ct = "SELECT * FROM equipment_group a inner join m.equipment b on a.Equipment_type = b.eqtype inner join daily_report c on a.Equipment_id=c.Equipment_id WHERE a.Equipment_group = 'me_ct' and c.TimeDate_record = '2018-04-03' GROUP BY a.Equipment_id ORDER BY `a`.`Equipment_id` ASC";

$macm_ct      = mysql_query($qmacm_ct, $DB) or die(mysql_error());
$nummct = mysql_num_rows($macm_ct);
$row_macme_ct = mysql_fetch_assoc($macm_ct);

$qmacs = "SELECT * FROM equipment_group a inner join m.equipment b on a.Equipment_type = b.eqtype inner join daily_report c on a.Equipment_id=c.Equipment_id WHERE a.Equipment_group = 'sc' and c.TimeDate_record = '2018-04-03' GROUP BY a.Equipment_id ORDER BY `a`.`Equipment_id` ASC";

$macs      = mysql_query($qmacs, $DB) or die(mysql_error());
$numsc = mysql_num_rows($macs);
$row_macsc = mysql_fetch_assoc($macs);


?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form method="post" action="teatsql.php">
	<?php 
$qmact = "SELECT * FROM m.equipment ";

$mact      = mysql_query($qmact, $DB) or die(mysql_error());
$numtm = mysql_num_rows($mact);
$row_mactm = mysql_fetch_assoc($mact);

   
 
 $i= 1;
do {
	echo "<input type='text' name='mac-num".$i."' value='".$row_mactm['egatno']."'><br>";
	$i++;
} while ($row_mactm = mysql_fetch_assoc($mact));

 ?>


	 <input type="submit" name="">
</form>
</body>
</html>