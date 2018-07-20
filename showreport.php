<?php include 'DBConnect.php';?>
<?php

require 'pdfpack/mpdf.php';
ob_start();
?>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">

<style type="text/css">
<!--
@page rotated { size: landscape; }
.style1 {
  font-family: "TH SarabunPSK";
  font-size: 24pt;
  font-weight: bold;
}
.style2 {
  font-family: "TH SarabunPSK";
  font-size: 22pt;
  font-weight: bold;
}
.style3 {
  font-family: "TH SarabunPSK";
  font-size: 22pt;

}
.style5 {cursor: hand; font-weight: normal; color: #000000;}
.style9 {font-family: Tahoma; font-size: 12px; }
.style11 {font-size: 20px}
.style13 {font-size: 18}
.style16 {font-size: 18; font-weight: bold; }
.style17 {font-size: 20px; font-weight: bold; }
-->

th{
  text-align: center;
}
  body,td,th {
  font-family: "Arial, Helvetica, sans-serif";
  
</style>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<head>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">

</head>
<body style="padding: 20px; background-color: #F3F781; ">
                  <?php
$thai_day_arr   = array("อาทิตย์", "จันทร์", "อังคาร", "พุธ", "พฤหัสบดี", "ศุกร์", "เสาร์");
$thai_month_arr = array(
    "0"  => "",
    "1"  => "มกราคม",
    "2"  => "กุมภาพันธ์",
    "3"  => "มีนาคม",
    "4"  => "เมษายน",
    "5"  => "พฤษภาคม",
    "6"  => "มิถุนายน",
    "7"  => "กรกฎาคม",
    "8"  => "สิงหาคม",
    "9"  => "กันยายน",
    "10" => "ตุลาคม",
    "11" => "พฤศจิกายน",
    "12" => "ธันวาคม",
);
$thai_month_arr_short = array(
    "0"  => "",
    "1"  => "ม.ค.",
    "2"  => "ก.พ.",
    "3"  => "มี.ค.",
    "4"  => "เม.ย.",
    "5"  => "พ.ค.",
    "6"  => "มิ.ย.",
    "7"  => "ก.ค.",
    "8"  => "ส.ค.",
    "9"  => "ก.ย.",
    "10" => "ต.ค.",
    "11" => "พ.ย.",
    "12" => "ธ.ค.",
);
function thai_date($time)
{
    global $thai_day_arr, $thai_month_arr;

    $thai_date_return .= date("j", $time);
    $thai_date_return .= " " . $thai_month_arr[date("n", $time)];
    $thai_date_return .= " พ.ศ." . (date("Y", $time) + 543);

    return $thai_date_return;
}
function thai_date_short($time)
{
    global $thai_day_arr, $thai_month_arr_short;

    $thai_date_return .= date("j", $time);
    $thai_date_return .= " " . $thai_month_arr_short[date("n", $time)];
    $thai_date_return .= " " . ((date("Y", $time) + 543)-2500);

    return $thai_date_return;
}
?>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
    $date = $_POST['datewant'];
} else {

    $date = $_GET['date'];
}

mysql_select_db($databasename, $DB);
$qmact = "SELECT * FROM daily_report a INNER JOIN equipment_group b on a.Equipment_id = b.Equipment_id where b.Equipment_group='tm' and a.TimeDate_record = '$date' order by a.Record_id";

$mact      = mysql_query($qmact, $DB) or die(mysql_error());
$rowtm     = mysql_num_rows($mact);
$row_mactm = mysql_fetch_assoc($mact);

$qmacm = "SELECT * FROM daily_report a INNER JOIN equipment_group b on a.Equipment_id = b.Equipment_id where b.Equipment_group in ('me','sc','me_ct') and a.TimeDate_record = '$date' order by a.Record_id";

$macm      = mysql_query($qmacm, $DB) or die(mysql_error());
$rowme     = mysql_num_rows($macm);
$row_macme = mysql_fetch_assoc($macm);




$qdetail_remark_table = "SELECT * FROM detail_remark  where Remark_type = 'table' and Remark_date = '$date'";

$detail_remark_table     = mysql_query($qdetail_remark_table, $DB) or die(mysql_error());

$detail_remarktable = mysql_fetch_assoc($detail_remark_table);
$qdetail_remark_tm = "SELECT * FROM detail_remark  where Remark_type = 'tm' and Remark_date = '$date'";

$detail_remark_tm     = mysql_query($qdetail_remark_tm, $DB) or die(mysql_error());

$detail_remarktm = mysql_fetch_assoc($detail_remark_tm);

$qdetail_remark_me = "SELECT * FROM detail_remark  where Remark_type = 'me' and Remark_date = '$date'";

$detail_remark_me     = mysql_query($qdetail_remark_me, $DB) or die(mysql_error());

$detail_remarkme = mysql_fetch_assoc($detail_remark_me);

$qdetail_remark_mect = "SELECT * FROM detail_remark  where Remark_type = 'me_ct' and Remark_date = '$date'";

$detail_remark_mect     = mysql_query($qdetail_remark_mect, $DB) or die(mysql_error());

$detail_remarkmect = mysql_fetch_assoc($detail_remark_mect);

$qdetail_remark_sc = "SELECT * FROM detail_remark  where Remark_type = 'sc' and Remark_date = '$date'";

$detail_remark_sc     = mysql_query($qdetail_remark_sc, $DB) or die(mysql_error());

$detail_remarksc = mysql_fetch_assoc($detail_remark_sc);
?>


<?php if($_SESSION['user_type']=="admin"||$_SESSION['user_type']==""){
include 'preview.php';
}else{
    include 'preview-another.php';
} ?>


<button onclick="window.location.href='index.php'" style="float: left;" >ย้อนกลับ</button>
<button onclick="window.location.href='document.php?date=<?php echo ($date) ?>&exportTo=pdf'" style="float: right;" formtarget="_blank">PDF</button>
<button onclick="window.location.href='document.php?date=<?php echo ($date) ?>&exportTo=excel'" style="float: right;">Excel</button>
</body>
</html>





