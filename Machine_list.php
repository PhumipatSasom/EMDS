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
?>
<!DOCTYPE html>
<html>
<head>
	
	<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script><title>เครื่องจักร</title>
<style type="text/css">
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

</head>
<body style="padding: 20px; background-image: url(<?php echo $_SESSION['image']; ?>);">
	<a href="index.php" style="float: right;">กลับสู่หน้าหลัก</a>
<table style="font-size: 20px; width: 1300px; background-color:#ffffff; " border="1"  >
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
		<td><a href="Machine_insert.php"><span class="glyphicon glyphicon-plus-sign" title="เพิ่มข้อมูล"></span></a><a href="Machine_edit.php?macid=<?php echo($row_mac['Equipment_id']);  ?>&eqtype=<?php echo($row_mac['Equipment_type']);  ?>"><span class="glyphicon glyphicon-edit" title="แก้ไขข้อมูล" ></span></a><a href="Machine_delete.php?macid=<?php echo($row_mac['Equipment_id']);  ?>"><span class="glyphicon glyphicon-minus-sign" title="ลบข้อมูล" onClick="return confirm('ยืนยันที่จะลบ?')"></span></a></td>
		<td><?php echo $row_mac['Equipment_name'] ?></td>
		<td><?php echo $row_mac['NumberOfEquipment'] ?></td>
		<td><?php if($row_mac['Equipment_group']== "tm") {echo "ระบบขนส่งวัสดุ"; } else if($row_mac['Equipment_group']== "me") {echo "Mobile equipment";} else if($row_mac['Equipment_group']== "me_ct") {echo "Mobile equipment";} else if($row_mac['Equipment_group']== "sc") {echo "Service Contract";} else{echo "ไม่ได้กำหนดชนิดเครื่องจักร";}?></td>
	</tr>
	<?php  $row++; 
}while($row_mac = mysql_fetch_assoc($mac)); ?>
</table>
</body>
</html>