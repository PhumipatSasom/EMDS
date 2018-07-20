<?php include 'DBConnect.php';
mysql_select_db($databasename, $DB);


$datereport= $_GET['datereport'];
date_default_timezone_set("Asia/Bangkok");
		$day=date("d");
		$month=date("m");
		$year=date("Y");
		$date=$year."-".$month."-".$day;

if($datereport==""){
         $netdate = $date;
}else{
	$netdate = $datereport;
}

    $qremark = "SELECT * FROM detail_remark where Remark_date = '$netdate'";

$remark= mysql_query($qremark, $DB) or die(mysql_error());
$numremark=mysql_num_rows($remark);
      
  $maxrowtm= $_GET['maxrowtm'];  

      //insert new row
    for ($x = 1; $x <= $maxrowtm; $x++) {
  


$macid= $_GET['Equipment_id'.$x];
$amount = $_GET['amount'.$x];


$num ="";
$empty = intval($num);

if($macid!=""){

	mysql_select_db($databasename, $DB);


$qmact_insert = "INSERT INTO daily_report  values($empty,$macid,$amount,0,'$netdate',0)";

$mact = mysql_query($qmact_insert, $DB) or die(mysql_error());
}

}


    
      
  $maxrowme= $_GET['maxrowme'];  

      //insert new row
    for ($x = 1; $x <= $maxrowme; $x++) {
  


$macid= $_GET['Equipment_id-m'.$x];
$amount = $_GET['amount-m'.$x];
$num ="";
$empty = intval($num);

if($macid!=""){

	mysql_select_db($databasename, $DB);


$qmact_insert = "INSERT INTO daily_report  values($empty,$macid,$amount,0,'$netdate',0)";

$mact = mysql_query($qmact_insert, $DB) or die(mysql_error());
}

	
	

	
	
}

$datestatus = $_GET['datestatus'];
if($datestatus=="edit"){
$insertGoTo = "EditMachineRecorded.php?dateurl=".$datereport;


header(sprintf("Location: %s", $insertGoTo));

}else if($datestatus=="insert"){

	if($numremark==0){
		$detail_remarktable_insert = "INSERT INTO detail_remark values($empty,'".$_POST['detail_remark-table']."','table','".$netdate."')";

$detail_remarktable = mysql_query($detail_remarktable_insert, $DB) or die(mysql_error());

$detail_remarktm_insert = "INSERT INTO detail_remark values($empty,'".$_POST['detail_remark-tm']."','tm','".$netdate."')";

$detail_remarktm = mysql_query($detail_remarktm_insert, $DB) or die(mysql_error());

$detail_remarkme_insert = "INSERT INTO detail_remark values($empty,'".$_POST['detail_remark-me']."','me','".$netdate."')";

$detail_remarkme = mysql_query($detail_remarkme_insert, $DB) or die(mysql_error());

$detail_remarkmect_insert = "INSERT INTO detail_remark values($empty,'".$_POST['detail_remark-me-2']."','me_ct','".$netdate."')";

$detail_remarkmect = mysql_query($detail_remarkmect_insert, $DB) or die(mysql_error());

$detail_remarksc_insert = "INSERT INTO detail_remark values($empty,'".$_POST['detail_remark-sc']."','sc','".$netdate."')";

$detail_remarksc = mysql_query($detail_remarksc_insert, $DB) or die(mysql_error());
	}
$insertGoTo = "EMDR-equipment_group2.php?dateurl=".$datereport;


header(sprintf("Location: %s", $insertGoTo));

}

else{
$detail_remarktable_insert = "INSERT INTO detail_remark values($empty,'".$_POST['detail_remark-table']."','table','".$netdate."')";

$detail_remarktable = mysql_query($detail_remarktable_insert, $DB) or die(mysql_error());

$detail_remarktm_insert = "INSERT INTO detail_remark values($empty,'".$_POST['detail_remark-tm']."','tm','".$netdate."')";

$detail_remarktm = mysql_query($detail_remarktm_insert, $DB) or die(mysql_error());

$detail_remarkme_insert = "INSERT INTO detail_remark values($empty,'".$_POST['detail_remark-me']."','me','".$netdate."')";

$detail_remarkme = mysql_query($detail_remarkme_insert, $DB) or die(mysql_error());

$detail_remarkmect_insert = "INSERT INTO detail_remark values($empty,'".$_POST['detail_remark-me-2']."','me_ct','".$netdate."')";

$detail_remarkmect = mysql_query($detail_remarkmect_insert, $DB) or die(mysql_error());

$detail_remarksc_insert = "INSERT INTO detail_remark values($empty,'".$_POST['detail_remark-sc']."','sc','".$netdate."')";

$detail_remarksc = mysql_query($detail_remarksc_insert, $DB) or die(mysql_error());
//update existing row


$insertGoTo = "index.php";


header(sprintf("Location: %s", $insertGoTo));




}










?>