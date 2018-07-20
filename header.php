<?php 
session_start();

 ?>
<?php
include 'DBConnect.php';
mysql_select_db($databasename, $DB);
$qdate = "SELECT DISTINCT(m.TimeDate_record), (SELECT Log FROM daily_report m2 WHERE m2.Record_id = (SELECT MAX(m3.Record_id) FROM daily_report m3 WHERE m3.TimeDate_record = m.TimeDate_record)) AS Log
FROM daily_report m 
ORDER BY m.TimeDate_record";

$dateq      = mysql_query($qdate, $DB) or die(mysql_error());

$row_date = mysql_fetch_assoc($dateq);

$qlast = "SELECT TimeDate_record FROM daily_report a INNER JOIN equipment_group b on a.Equipment_id = b.Equipment_id WHERE a.TimeDate_record = ( SELECT MAX(TimeDate_record) from daily_report )";

    $last = mysql_query($qlast, $DB) or die(mysql_error());

    $row_last = mysql_fetch_assoc($last);

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
    $thai_date_return .= " พ.ศ." . (date("Yํ", $time) + 543);

    return $thai_date_return;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $d = htmlspecialchars($_REQUEST['date']);
    $insertGoTo = "EMDR-show.php?date=".$d;


header(sprintf("Location: %s", $insertGoTo));

    }

switch ($_SESSION['user_type']) {
    case "me_ct":
        $who="Mobile Equipment";
        break;
    case "sc":
        $who="Service Contract";
        break;
    case "tm":
         $who="ระบบขนส่งวัสดุ";
        break;
    case "me":
        $who="Mobile Equipment";
        break;
   case "admin":
       $who="Administrator";
             
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>ระบบจัดการเครื่องจักรรายวัน</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
<link href='fullcalendar-3.6.2/fullcalendar.min.css' rel='stylesheet' />
<link href='fullcalendar-3.6.2/fullcalendar.print.min.css' rel='stylesheet' media='print' />
<script src='fullcalendar-3.6.2/lib/moment.min.js'></script>
<script src='fullcalendar-3.6.2/lib/jquery.min.js'></script>
<script src='fullcalendar-3.6.2/fullcalendar.min.js'></script>
<script type="text/javascript">


function startTime()
{
var today=new Date();
var h=today.getHours();
var m=today.getMinutes();
var s=today.getSeconds();
// add a zero in front of numbers<10
h=checkTime(h);
m=checkTime(m);
s=checkTime(s);
document.getElementById('txt').innerHTML=h+":"+m+":"+s;
t=setTimeout(function(){startTime()},500);
}

function checkTime(i)
{
if (i<10)
  {
  i="0" + i;
  }
return i;
}


	$(document).ready(function() {
		
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next',
				center: 'title',
				right: 'month'
			},
			
			 // can click day/week names to navigate views
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			events: [<?php 
      			do{?>
			
				{
					
					title: '<?php if($row_date["Log"]=="0"){ echo "ยังไม่ได้เพิ่มรายละเอียด";}else{echo "บันทึกแล้ว";} ?>',
					backgroundColor: '<?php if($row_date["Log"]=="0"){ echo "red";}else{echo "blue";} ?>',
					start: '<?php echo $row_date["TimeDate_record"]; ?>',
					url: 'EMDR-equipment_group2.php?dateurl=<?php echo $row_date["TimeDate_record"]; ?>'
				},<?php }while($row_date = mysql_fetch_assoc($dateq)); ?>
				
				
			]

		});

		
	});

 
 


 
</script>
<style>
     

	#calendar {
		max-width: 900px;
		margin: 0 auto;
		background-color: #ffffff;
	}

</style>
</head>
<body>

<div class="container">
  <?php if($_SESSION["id_citizen"]=="pass"){ 
    echo("<h4><b>ยินดีต้อนรับ ".$who."</h4> ");
 } ?>
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
    <li><a data-toggle="tab" href="#menu1">เพิ่มความต้องการลPM,CM</a></li>
    <li><a data-toggle="tab" href="#menu2">เพิ่มเครื่องจักรที่ได้รายงานจากแต่ละแผนก</a></li>
    <li><a data-toggle="tab" href="#menu3">เพิ่ม-แก้ไข-ลบเครื่องจักร </a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      
      <div id='calendar'></div>
    </div>
    <div id="menu1" class="tab-pane fade">
      <h3>Menu 1</h3>
      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    </div>
    <div id="menu2" class="tab-pane fade">
      <h3>Menu 2</h3>
      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
    </div>
    <div id="menu3" class="tab-pane fade">
      <?php 
session_start();
if($_SESSION["id_citizen"] == "")
{
	echo "Please Login!";
	header("index.php");
	exit();
}

if($_SESSION['user_type'] != "admin")
{
	echo "This page for admin only!";
	exit();

} ?>
<?php include 'DBConnect.php';

mysql_select_db($databasename, $DB);

 $qmac = "SELECT * FROM equipment_group ";

    $mac      = mysql_query($qmac, $DB) or die(mysql_error());
    $row_mac = mysql_fetch_assoc($mac);
?><style type="text/css">
	td {
		text-align: center;
	}
	th {
		text-align: center;
	}
	span {
		padding: 5px;

	}
</style>
<div class="container">
<table style="font-size: 16px; width: 1300; background-color:#ffffff; " class="table" border="1"  >
	<tr>
		<th style="font-size: 30px; text-align: center;" colspan="5"> เครื่องจักร</th>
	</tr>
	<tr >
		<th >ลำดับ</th>
		<th>คำสั่ง</th>
		<th>ชื่อเครื่องจักร</th>
		<th>จำนวน</th>
		<th>ชนิด</th>
	</tr>
	<?php $row = 1 ;

	do{ ?>
	<tr>
		<td><?php echo $row; ?></td>
		<td><a href="Machine_insert.php"><span class="glyphicon glyphicon-plus-sign" title="เพิ่มข้อมูล"></span></a><a href="Machine_edit.php?macid=<?php echo($row_mac['Equipment_id']);  ?>"><span class="glyphicon glyphicon-edit" title="แก้ไขข้อมูล" ></span></a><a href="Machine_delete.php?macid=<?php echo($row_mac['Equipment_id']);  ?>"><span class="glyphicon glyphicon-minus-sign" title="ลบข้อมูล" onClick="return confirm('ยืนยันที่จะลบ?')"></span></a></td>
		<td><?php echo $row_mac['Equipment_name'] ?></td>
		<td><?php echo $row_mac['NumberOfEquipment'] ?></td>
		<td><?php if($row_mac['Equipment_group']== "tm") {echo "ระบบขนส่งวัสดุ"; } else if($row_mac['Equipment_group']== "me") {echo "Mobile equipment";} else if($row_mac['Equipment_group']== "me_ct") {echo "Mobile equipment";} else if($row_mac['Equipment_group']== "sc") {echo "Service Contract";} else{echo "ไม่ได้กำหนดชนิดเครื่องจักร";}?></td>
	</tr>
	<?php  $row++; 
}while($row_mac = mysql_fetch_assoc($mac)); ?>
</table></div>
    </div>
  </div>
</div>

</body>
</html>
