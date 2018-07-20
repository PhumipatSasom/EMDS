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

  
  
   
   

$qrow = "SELECT * FROM equipment_group where Equipment_group = '$section'";
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
   
<tr ><th align="center" colspan="10" height="30"><font style="font-size:16px;"><center>รายงานสรุปสถานการณ์เครื่องจักรประจำเดือน <?php echo($thai_month_arr[$month]); ?> ปี <?php echo($year+543); ?> ของแผนก <?php switch ($section) {
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

  
<?php  

  $count = 1;

do {  

   
$eqmid = $rowname['Equipment_id'];
  ?>

<tr ><td colspan="10" bgcolor="#cccccc" height="30" ><h4><?php echo $rowname['Equipment_name']; ?></h4></td></tr>

 
  <tr >
   
  
   <th height="30">ลำดับที่</th>
  <th height="30">หมายเลข</th>
  <th >PM/CM</th>
  <th >เลขชั่วโมง</th>
   
   <th >อาการ</th>
   <th width="100">วันที่ชำรุด</th>
   
   
   

   
   <th >คาดว่าจะแล้วเสร็จ</th>
   
   <th >หมายเหตุ</th>
   <th >ผู้รับผิดชอบ</th>
    <th >แล้วเสร็จ</th>

  </tr>
  <?php 

    $id = $rowname['Equipment_id'];
   $sd   = $rowshowdate['Record_date'];
    $qmonth = "SELECT * FROM daily_detail where month(Record_date) = '$month' AND year(Record_date) = '$year' AND detail_type = '$section' AND Equipment_id = '$eqmid' order by Equipment_number ";
$monthly = mysql_query($qmonth, $DB) or die(mysql_error());
$rowmonthly = mysql_fetch_assoc($monthly);
$nummonthly = mysql_num_rows($monthly);

if($nummonthly!=0){
    
   do{
      
  ?>
   
<tr id="rowat-de<?php echo $row; ?>">

    
   
   <td align="center" height="27"><?php echo $count; ?></td>
    <td align="center"><?php echo $rowmonthly['Equipment_number']; ?></td> 
    <td align="center"><?php echo $rowmonthly['PM_CM']; ?></td>
    <td align="center"><?php echo $rowmonthly['Mac_hour']; ?></td>
    <td width="500"><?php echo  $rowmonthly['Description']; ?></td>
     <td align="center"><?php if($rowmonthly['date']=="0000-00-00"){ echo "";}else{ echo thai_date_short(strtotime($rowmonthly['date']));} ?></td>


    
    
    <td align="center"><?php if($rowmonthly['action_date']=="0000-00-00"){ echo "";}else{ echo thai_date_short(strtotime($rowmonthly['action_date']));} ?></td> 
    <td align="center"><?php echo $rowmonthly['Remark']; ?></td>
    <td align="center"><?php echo $rowmonthly['User_respone']; ?></td>
    <td align="center"><?php echo $rowmonthly['finished_date']; ?></td>
   </tr>
  



  <?php
 $count++;
 }while ($rowmonthly = mysql_fetch_assoc($monthly));}
  $count = 1;

 

?>

<?php
 
} while ($rowname = mysql_fetch_assoc($row)); ?>
</table>

 <?php }else{ echo "<br>ยังไม่ได้เลือกวันที่หรือไม่มีข้อมูล";} ?>


</body>
</html>