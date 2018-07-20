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
$_SESSION['image'] = "image/123338415.jpg";
switch ($_SESSION['user_type']) {
    case "me_ct":
        $who="Mobile Equipment(หบต-ช.)";
         $_SESSION['image'] = "image/5x7ft.jpg_640x640.jpg";
        break;
    case "sc":
        $who="Service Contract";
         $_SESSION['image'] = "image/5x7ft.jpg_640x640.jpg";
        break;
    case "tm":
         $who="ระบบขนส่งวัสดุ";
          $_SESSION['image'] = "image/5x7ft.jpg_640x640.jpg";
        break;
    case "me":
        $who="Mobile Equipment(หบย-ช.)";
        $_SESSION['image'] = "image/5x7ft.jpg_640x640.jpg";
        break;
   case "admin":
       $who="Administrator";
       $_SESSION['image'] = "image/1557cbcdb0ea511.jpg";
             
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>ระบบสรุปสถานการณ์เครื่องจักรหลักประจำวัน</title>
	<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
					
					title: '<?php if($row_date["Log"]=="0"){ echo "ยังไม่ได้เพิ่มรายละเอียด";}else if($row_date["Log"]=="1"){echo "บันทึกแล้ว";}else {echo "มีการแก้ไข";} ?>',
					backgroundColor: '<?php if($row_date["Log"]=="0"){ echo "red";}else if($row_date["Log"]=="1"){echo "blue";}else {echo "green";} ?>',
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
<body style="padding: 20px; background-image:url(<?php echo($_SESSION['image']);?>);" onload="startTime()">
<?php if($_SESSION["user_type"] == "admin" && $_SESSION['id_citizen']=="pass" ){ ?><marquee scrollamount="15"><img src="image/เครื่องจักร-Hitachi-Mining-Machines-EX2600E-6LD.jpg" width="926" height="245" alt="ww" /></marquee></h4><?php  }else if($_SESSION['id_citizen']=="pass"){?>
<marquee scrollamount="10">
          &nbsp;<img src="image/1384416460-T282B2-o.jpg" width="243" height="161" alt="rr" />&nbsp;&nbsp;&nbsp;<img src="image/1384417210-C709575-o.jpg" width="226" height="175" alt="oo" />&nbsp;&nbsp;&nbsp;<img src="image/maxresdefault (1).jpg" width="238" height="176" alt="kk" />&nbsp;&nbsp;&nbsp;<img src="image/maxresdefault.jpg" width="238" height="169" alt="ss" />&nbsp;&nbsp;
          </marquee><?php }else{ ?><marquee direction="right"><img src="image/81812_th.jpg" width="813" height="326" alt="ee" /></marquee><?php }?>
<center><h2><b>ยินดีต้อนรับสู่<?php if($_SESSION['user_type']=="admin"||$_SESSION['user_type']==""){echo "ระบบสรุปสถานการณ์เครื่องจักรหลักประจำวัน";}else{ echo "รายงานสรุปเครื่องจักรกลุ่ม ".$who;}?></b></h2></center> 
<?php if($_SESSION["id_citizen"]!="pass"){ ?>
<a href="login.php" style="font-size: 20px; float: right;"><center>เข้าสู่ระบบ</center></a><?php }else{ 
	?>
<a href="logout.php" style="font-size: 20px; float: right;"><center>ออกจากระบบ</center></a>
<?php } ?>
<br>

<h4><center><?php if($_SESSION["user_type"] == "admin" && $_SESSION['id_citizen']=="pass" ){ ?>
<a href="User_list.php">จัดการผู้ใช้งานระบบ</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="EMDR-equipment_group.php">เพิ่มเครื่องจักรที่ได้รายงานจากแต่ละแผนก</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="EMDR-equipment_group2.php?dateurl=<?php echo $row_last['TimeDate_record']; ?>">เพิ่มความต้องการ,PM,CM</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="Machine_list.php">เพิ่ม-แก้ไข-ลบเครื่องจักร</a>
<?php  }else if($_SESSION['id_citizen']=="pass"){?>
<a href="EMDR-equipment_group2.php?dateurl=<?php echo $row_last['TimeDate_record']; ?>">เพิ่มความต้องการ,PM,CM</a><?php } ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="showhour.php">เลขชั่วโมงเครื่องจักร</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="reportmonthly.php">รายงานประจำเดือน</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="Unenough.php">รายงานสรุปผลเครื่องจักรไม่พอใช้งาน</a>

<p>&nbsp;</p>
ดูรายงานวันที่ <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<input type="date" name="date" value="<?php echo($date) ?>"><input type="submit" value="ดูรายงาน"></form>

</center><b>
	<br>
<center><p><?php 
$eng_date = strtotime($date);
echo thai_date($eng_date);?>  เวลา <a id="txt"></a></h4></p></center></b>
<br>
<br>
<div id='calendar'></div>
</body>
<footer>
  <a href="documentation/index.html">คู่มือ</a>
</footer>
</html>