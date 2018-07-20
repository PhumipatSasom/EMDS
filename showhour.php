<?php 
include 'DBConnect.php';
mysql_select_db($databasename, $DB);
date_default_timezone_set("Asia/Bangkok");
$day   = date("d");
$month = date("m");
$year  = date("Y");
$date  = $year . "-" . $month . "-" . $day;
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $month = htmlspecialchars($_REQUEST['month']);
    $year = htmlspecialchars($_REQUEST['year']);
   $section = htmlspecialchars($_REQUEST['section']);

    }

  
  
   
   

$qrow = "SELECT * FROM equipment_group a inner join daily_detail b on a.Equipment_id = b.Equipment_id where month(b.Record_date) = '$month' and year(b.Record_date) = '$year' and detail_type = '$section' GROUP BY a.Equipment_id";
$row = mysql_query($qrow, $DB) or die(mysql_error());
$rowname = mysql_fetch_assoc($row);
$numname = mysql_num_rows($row);



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

$thai_month_arr_day = array(
    "0"  => "",
    "1"  => 31,
    "2"  => 29,
    "3"  => 31,
    "4"  => 30,
    "5"  => 31,
    "6"  => 30,
    "7"  => 31,
    "8"  => 31,
    "9"  => 30,
    "10" => 31,
    "11" => 30,
    "12" => 31,
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

function onlydate($time)
{
    global $thai_month_arr;

   
    $thai_date_return .= $thai_month_arr[date("n", $time)];
    

    return $thai_date_return;
}

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>รายงานประจำเดือน</title>
     <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
    th{
      text-align: center;
    }
  </style>
</head>
<body style="text-align: center; padding: 20px; background-image: url(<?php echo $_SESSION['image']; ?>);">
 <button onclick="window.location.href='index.php'" style="float: right;" >ย้อนกลับ</button>
 <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	เดือน   
  <select name="month"> <?php $i=1;
     do {
         ?>
<option value="<?php echo($i) ?>" <?php if($i==$month) echo "selected"; ?>><?php echo($thai_month_arr[$i]) ?></option>
         <?php
         $i++;
      } while ( $i<= 12); ?>   </select>
    
   ปี 
<select name="year"> <?php $i=2560; $c= 1;
     do {
         ?>
<option value="<?php echo($i-543) ?>" <?php $y = $i-543; if($y==$year) echo "selected"; ?>><?php echo($i) ?></option>
         <?php
         $c++;
         $i++;
      } while ( $c<= 35); ?>   </select>
   แผนก
   <select name="section"> 
<option value="tm" <?php if($section=="tm") echo "selected"; ?>>ขนส่งวัสดุ</option>
<option value="me" <?php if($section=="me") echo "selected"; ?>>หบย-ช.</option>
<option value="me_ct" <?php if($section=="me_ct") echo "selected"; ?>>หบต-ช.</option>
<option value="sc" <?php if($section=="sc") echo "selected"; ?>>Service Contract</option>
        </select>
  <input type="submit" value="ดูรายงาน"></form>
<?php if($numname!=0){ ?>
<table width="1300" border="1" cellspacing="0" cellpadding="0" style="font-size: 15px; background-color: #ffffff; "  id="me-detail">
   
<tr ><th align="center" colspan="32" height="30"><font style="font-size:16px;"><center>เลขชั่วโมงเครื่องจักรประจำเดือน <?php echo($thai_month_arr[$month]); ?> ปี <?php echo($year+543); ?> ของแผนก <?php switch ($section) {
    case "me_ct":
        echo "หบต-ช.";
         
        break;
    case "sc":
        echo "Service Contract";
         
        break;
    case "tm":
        echo "ระบบขนส่งวัสดุ";
          
        break;
    case "me":
       echo "หบย-ช.";
       
} ?></center></font></th></tr>
<tr>
  <td width='200'>เครื่องจักร No./วันที่</td>
  <?php 
  $col = 1;

  do {
    echo "<td width='50'>$col</td>";
    $col++;
  } while ($col <= $thai_month_arr_day[$month]); ?>
</tr>
<?php do {
  ?>
  <tr>
    <td style="text-decoration: underline; background-color: #b3ffb3"><?php echo $rowname['Equipment_name']; ?></td>
  </tr>
  <?php 
      $id = $rowname['Equipment_id'];
      $eqtype = $rowname['Equipment_type'];
      if($id==13){
      $fillter="AND egatno in ('640143','640144','640146','640147','640148','640149','640153')";
    }else if($id==10){
      $fillter="AND egatno in ('580072','580073','580074','580075')";
    }else if($id==11){
      $fillter="AND egatno in ('640122','640123','640124','640125','640133','640131')";
    }else if($id==12){
      $fillter="AND egatno in ('640128','640129','640134')";
    }else if($id==49){
      $fillter="AND egatno in ('640119','640139','640173','640174','640175')";
    }else if($id==50){
      $fillter="AND egatno in ('640137','640138','640150')";
    }else if($id==1){
      $fillter="AND egatno not in ('240004','240005','240007','240008')";
    }else if($id==3){
      $fillter="AND egatno not in ('260002','260003','260006','260007')";
    }else if($id==4){
      $fillter="AND egatno not in ('270001','270002','270003','270004','270005')";
    }else{
      $fillter="";
    }
$qmac = "SELECT * FROM m.equipment  WHERE eqtype='$eqtype' $fillter order by egatno";
$mac = mysql_query($qmac, $DB) or die(mysql_error());
$rowmac = mysql_fetch_assoc($mac);
  do {
    ?>
<tr>
  <td ><?php echo $rowmac['egatno']; ?></td>
<?php 
  $col = 1;

  do {
    $macnum = $rowmac['egatno'];
$qmachour = "SELECT Mac_hour FROM daily_detail where month(Record_date) = '$month' and year(Record_date) = '$year' and day(Record_date) = '$col' and Equipment_number='$macnum' ";
$machour = mysql_query($qmachour, $DB) or die(mysql_error());
$rowmachour = mysql_fetch_assoc($machour);

    echo "<td width='50'>".$rowmachour['Mac_hour']."</td>";
    $col++;
  } while ($col <= $thai_month_arr_day[$month]); ?>
</tr>
    <?php
  } while ($rowmac = mysql_fetch_assoc($mac)); ?>
  <?php
} while ($rowname = mysql_fetch_assoc($row)); ?>

</table>

 <?php }else{ echo "<br>ยังไม่ได้เลือกวันที่หรือไม่มีข้อมูล";} ?>


</body>
</html>