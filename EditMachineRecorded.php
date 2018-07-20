<?php 
session_start();
if($_SESSION["id_citizen"] == "")
{
  echo "Please Login!";
  header("index.php");
  exit();
}

 ?>
<?php include 'DBConnect.php';

mysql_select_db($databasename, $DB);
ob_start();
?>
<?php

date_default_timezone_set("Asia/Bangkok");
$day   = date("d");
$month = date("m");
$year  = date("Y");
$date  = $year . "-" . $month . "-" . $day;

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
function thai_date($time)
{
    global $thai_day_arr, $thai_month_arr;

    $thai_date_return .= date("j", $time);
    $thai_date_return .= " " . $thai_month_arr[date("n", $time)];
    $thai_date_return .= " พ.ศ." . (date("Y", $time) + 543);

    return $thai_date_return;
}
?>
<?php
$dateshow = $_GET['dateurl'];
$netdate = $_GET['dateurl'];
$qlast = "SELECT TimeDate_record FROM daily_report a INNER JOIN equipment_group b on a.Equipment_id = b.Equipment_id WHERE a.TimeDate_record = ( SELECT MAX(TimeDate_record) from daily_report )";

$last = mysql_query($qlast, $DB) or die(mysql_error());

$row_last = mysql_fetch_assoc($last);


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $dateshow = htmlspecialchars($_REQUEST['datenow']);

   
$netdate = $_SESSION['fixdate'];
        
        $message = "*ข้อมูลเก่าจากวันที่ ".thai_date(strtotime($dateshow))." <br>*ถ้าต้องการข้อมูลวันอื่นกรุณาเลือก ";
        $btadd = 0;
        $showdate= 1;
      

 

}
else{


     if ($dateshow > $row_last['TimeDate_record']) {

        $dateshow = $row_last['TimeDate_record'];
        $message = "*ข้อมูลเก่าจากวันที่ ".thai_date(strtotime($row_last['TimeDate_record']))."<br>*ถ้าต้องการข้อมูลวันอื่นกรุณาเลือก ";
        $btadd = 0;
        $showdate= 1;
      

    } else {

      $dateshow = $_GET['dateurl'];
        $link = "<a style='float: right;' href='InsertMachineRecorded.php?datefromrecorded=".$dateshow."&datestatus=edit'>เพิ่มเครื่องจักร</a>";
        if($_SESSION['user_type']=="admin"){
          $btadd = 1;
        }else{
          $btadd = 0;
        }
    }

       
       }

$qmacta = "SELECT * FROM daily_report a INNER JOIN equipment_group b on a.Equipment_id = b.Equipment_id where b.Equipment_group='tm' and a.TimeDate_record = '" . $dateshow . "' order by a.Record_id";

$macta      = mysql_query($qmacta, $DB) or die(mysql_error());
$rowtm      = mysql_num_rows($macta);
$row_mactma = mysql_fetch_assoc($macta);

$qmacma = "SELECT * FROM daily_report a INNER JOIN equipment_group b on a.Equipment_id = b.Equipment_id where b.Equipment_group in ('me','sc','me_ct') and a.TimeDate_record = '" . $dateshow . "' order by a.Record_id";

$macma      = mysql_query($qmacma, $DB) or die(mysql_error());
$rowme      = mysql_num_rows($macma);
$row_macmea = mysql_fetch_assoc($macma);

$qlog = "SELECT Log FROM `daily_report` where TimeDate_record = '$dateshow'  GROUP BY Log ";

$logq      = mysql_query($qlog, $DB) or die(mysql_error());

$row_log = mysql_fetch_assoc($logq);

$qdetail_remark_table = "SELECT * FROM detail_remark  where Remark_type = 'table' and Remark_date = '$dateshow'";

$detail_remark_table     = mysql_query($qdetail_remark_table, $DB) or die(mysql_error());

$detail_remarktable = mysql_fetch_assoc($detail_remark_table);

$display="none";
$displaytm="none";
$displayme="none";
$displaymect="none";
$displaysc="none";

switch ($_SESSION['user_type']) {
    case "me_ct":
        $displaymect="";
        break;
    case "sc":
        $displaysc="";
        break;
    case "tm":
         $displaytm="";
        break;
    case "me":
        $displayme="";
        break;
   case "admin":
       
             $display="";
             $displaytm="";
              $displayme="";
            $displaymect="";
            $displaysc="";

}


$color = "#F3F781";
switch ($_SESSION['user_type']) {
    case "me_ct":
        $who="Mobile Equipment";
        $color = "#b3ffd9";
        break;
    case "sc":
        $who="Service Contract";
        $color = "#b3ffd9";
        break;
    case "tm":
         $who="ระบบขนส่งวัสดุ";
         $color = "#b3ffd9";
        break;
    case "me":
        $who="Mobile Equipment";
        $color = "#b3ffd9";
        break;
   case "admin":
       $who="Administrator";
       $color = "#f5ccff";
             
}

if($_SESSION['user_type']=="admin"){
  $goto = "EMDR-insert2.php";
}else{
  $goto = "EMDR-insert-another.php";
}

?>


<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<head>
  <title>แก้ไข Daily Report</title>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script type="text/javascript">


function popup(val){

        var want = parseInt(document.getElementById("Equipment_require"+val).value);
        var amount = parseInt(document.getElementById("amount"+val).value);


                if(amount<want){


                   alert("เกินจำนวนเครื่องจักรแล้ว");
                }


}
function popup_m(val){

        var want = parseInt(document.getElementById("Equipment_require-m"+val).value);
        var amount = parseInt(document.getElementById("amount-m"+val).value);


                if(amount<want){


                   alert("เกินจำนวนเครื่องจักรแล้ว");
                }


}

function showResult(result){

if(result==1)

{

document.getElementById("divResult").innerHTML = "<font color=green><a href='EditMachineRecorded.php?dateurl=<?php echo $netdate; ?>'>แก้ไขข้อมูลที่บันทึก</a> </font>  <br>";

if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("report").innerHTML = this.responseText;
                 
                
            }
        };
        xmlhttp.open("GET","showreport.php?date=<?php echo $netdate; ?>",true);
        xmlhttp.send();

document.getElementById("form2").style.display = "none";
document.getElementById("hide").innerHTML = "";
alert('Save successfully!');

 //setTimeout(function(){ window.location.href='index.php' }, 3000);




}
else

{

alert('ไม่สามารถทำงานได้');

}

}



function deleteable(val) {
  document.getElementById("Equipment_require"+val).removeAttribute('required');
}
function deleteable_m(val) {
  document.getElementById("Equipment_require-m"+val).removeAttribute('required');
}





</script>

<style type="text/css">
  
  th{
    text-align: center;
  }

  




</style>


</head>

<body style="padding: 20px; background-image: url(<?php echo $_SESSION['image']; ?>); " onload="
<?php $val=1; 
do{ ?>
  check(<?php echo $val; ?>) 
 <?php $val++; 
}while($val<=$rowtm); ?>,<?php $val=1; 
do{ ?>
  check_m(<?php echo $val; ?>) 
 <?php $val++; 
}while($val<=$rowme); ?>" >
  <a href="index.php" style="float: right;">กลับสู่หน้าหลัก</a>
  <a onclick="window.history.back()" style="float: left;">ย้อนกลับ</a>
   
  
   <font style="color:#ff0000; font-size:24px;"><center><p id="datechg"><b><?php if($_SESSION['user_type']=="admin"){echo "สรุปสถานการณ์เครื่องจักรหลัก ประจำวันที่";}else{ echo "รายงานสรุปเครื่องจักรกลุ่ม ".$who." ประจำวันที่ ";} $eng_date = strtotime($netdate);echo thai_date($eng_date);?></b><p id="hide"><font style="color:#3333cc; font-size:24px;"><?php echo $message; ?><?php if($showdate==1){ ?><form method="POST" id="form1" action="<?php echo $_SERVER['PHP_SELF']; ?>"><input type='date' style="font-size:18px;" id='datenow' name="datenow" ><input type='submit' style="font-size:18px;" id="view" value='บันทึกวันที่'></form><?php } ?></font></p></p></center></font>
   <center><h1><div id="divResult"></div></h1></center>
   <p id="report"></p>

  
  <form method="post" action="<?php echo($goto); ?>"  id="form2" >




<input type="hidden" name="maxrowtm" id="maxrowtm" value="">
<input type="hidden" name="maxrowme" id="maxrowme" value="">
<input type="hidden" name="datereport" id="datereport" value="<?php echo ($netdate) ?>">
<input type="hidden" name="Log" value="2">


  <div style="overflow-x:auto; display: <?php echo $display; ?>;">
<table width="1300" border="1" cellspacing="0" cellpadding="0" style="font-size: 15px; background-color: #ffffff"  id="tm_show">
   <tr >
    <th colspan="9">
      <font style="color:#ff0000; font-size:18px;"><center>เครื่องจักรระบบขนส่งวัสดุ</center></font>
    </th>
  </tr>

  <tr>
  <th >ลำดับ</th>
   <th >เครื่องจักรระบบขนส่งวัสดุ</th>
   <th >จำนวนเครื่องจักร</th>
   <th >จำนวนต้องการ<br>(คัน/กะเช้า)</th>
   
  
   <th >ลบ</th>


  </tr>
    <?php
$row = 1;

if ($rowtm == "0") {
    echo "<tr><td colspan='9'>ไม่มีข้อมูลในวันนี้</td></tr>";

} else {

    do {
        ?>
    <tr id="rowat<?php echo $row; ?>">
      <td align="center"><p><?php echo $row; ?><input type="hidden"  name="recid<?php echo $row; ?>" value="
        <?php echo ($row_mactma['Record_id']) ?>"></p></td>

   <td id="row<?php echo $row; ?>">
     <input type="hidden" value="<?php echo ($row_mactma['Equipment_id']) ?>" name="Equipment_id<?php echo $row; ?>" id="Equipment_id<?php echo $row; ?>"> <?php echo $row_mactma['Equipment_name']; ?>
   </td>
   <td align="center"><input type="hidden" name="amount<?php echo $row; ?>" id="amount<?php echo $row; ?>" value="<?php echo $row_mactma['Equipment_amount']; ?>"><?php echo $row_mactma['Equipment_amount']; ?></td>
   <td align="center"><input type="number" value="<?php echo ($row_mactma['Equipment_require']) ?>"  name="Equipment_require<?php echo $row; ?>"   min="0" oninput="validity.valid||(value='');" id="Equipment_require<?php echo $row; ?>" style="width: 50px;" required="required" onclick="popup(<?php echo $row; ?>)" onkeyup="popup(<?php echo $row; ?>)" /></td>
  
   
    <td><input type="checkbox"  name="delete<?php echo $row; ?>" id="delete<?php echo $row; ?>" value="<?php echo ($row_mactma['Equipment_id']) ?>" onclick="deleteable(<?php echo $row; ?>)" ></td>


    </tr>

    <?php
$row++;
    } while ($row_mactma = mysql_fetch_assoc($macta));
}?>
<script type='text/javascript'>
$(function(){

 $("#maxrowtm").val(<?=$row-1;?>);


});
</script>
</table>
<br>
<br>
<table width="1300" border="1" cellspacing="0" cellpadding="0" style="font-size: 15px; background-color: #ffffff; "  id="me_show">
   <tr >
    <th colspan="9">
      <font style="color:#ff0000; font-size:18px;"><center>เครื่องจักรกลุ่ม Mobile equipment</center></font>
    </th>
  </tr>

  <tr>
  <th >ลำดับ</th>
   <th >เครื่องจักรกลุ่ม Mobile equipment</th>
   <th >จำนวนเครื่องจักร</th>
   <th >จำนวนต้องการ<br>(คัน/กะเช้า)</th>
   
   <th >ลบ</th>


  </tr>
    <?php
$row = 1;
if ($rowme == "0") {
    echo "<tr><td colspan='9'>ไม่มีข้อมูลในวันนี้</td></tr>";

} else {

    do {
        ?>
    <tr id="rowat-m<?php echo $row; ?>">
      <td align="center"><p><?php echo $row; ?><input type="hidden"  name="recid-m<?php echo $row; ?>" value="
        <?php echo ($row_macmea['Record_id']) ?>"></p></td>

   <td id="row-m<?php echo $row; ?>">
     <input type="hidden" value="<?php echo ($row_macmea['Equipment_id']) ?>" name="Equipment_id-m<?php echo $row; ?>" id="Equipment_id-m<?php echo $row; ?>"> <?php echo $row_macmea['Equipment_name']; ?>
   </td>
   <td align="center"><input type="hidden" name="amount-m<?php echo $row; ?>" id="amount-m<?php echo $row; ?>" value="<?php echo $row_macmea['Equipment_amount']; ?>"><?php echo $row_macmea['Equipment_amount']; ?></td>
   <td align="center"><input type="number" value="<?php echo ($row_macmea['Equipment_require']) ?>" name="Equipment_require-m<?php echo $row; ?>"   min="0" oninput="validity.valid||(value='');" id="Equipment_require-m<?php echo $row; ?>" style="width: 50px;" required="required" onclick="popup_m(<?php echo $row; ?>)" onkeyup="popup_m(<?php echo $row; ?>)" /></td>
   
  
    <td><input type="checkbox" name="delete-m<?php echo $row; ?>" id="delete-m<?php echo $row; ?>" onclick="deleteable_m(<?php echo $row; ?>)" ></td>


    </tr>

    <?php
$row++;
    } while ($row_macmea = mysql_fetch_assoc($macma));
}?>
<script type='text/javascript'>
$(function(){

 $("#maxrowme").val(<?=$row - 1;?>);


});
</script>
</table>

<br>
Remark: <input type="text" name="detail_remark-table" size="100" value="<?php echo($detail_remarktable['Remark_detail']) ?>"><input type="hidden" name="detail_remark-table-id" value="<?php echo($detail_remarktable['Remark_id']) ?>">
<?php echo $link; ?>
<br>
<br>
</div>
<?php include 'detail-test.php';?>


<br>
<br>
<center>
  <button >บันทึกข้อมูล</button>
</center>


</form>

</body>
<footer>
  <a href="documentation/index.html">คู่มือ</a>
</footer>
</html>





