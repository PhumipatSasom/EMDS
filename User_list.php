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

 $quser = "SELECT * FROM users ";

    $user      = mysql_query($quser, $DB) or die(mysql_error());
    $row_user = mysql_fetch_assoc($user);
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
<script type="text/javascript">
	$(function(){

	});
</script>
</head>
<body style="padding: 20px; background-image: url(<?php echo $_SESSION['image']; ?>);">
	<a href="index.php" style="float: right;">กลับสู่หน้าหลัก</a>
<table style="font-size: 20px; width: 1300px; background-color:#ffffff; " border="1"  >
	<tr>
		<th style="font-size: 30px; text-align: center;" colspan="5"> ผู้ใช้งานระบบ</th>
	</tr>
	<tr >
		<th >ลำดับ</th>
		<th >คำสั่ง</th>
		<th>Username</th>
		<th>Password</th>
		<th>ตำแหน่ง</th>
		
	</tr>
	<?php $row = 1 ;

	do{ ?>
	<tr>
		<td><?php echo $row; ?></td>
		<td><a href="User_insert.php"><span class="glyphicon glyphicon-plus-sign" title="เพิ่มข้อมูล"></span></a><a href="User_edit.php?userid=<?php echo($row_user['user_id']);  ?>"><span class="glyphicon glyphicon-edit" title="แก้ไขข้อมูล" ></span></a><a href="User_delete.php?userid=<?php echo($row_user['user_id']);  ?>"><span class="glyphicon glyphicon-minus-sign" title="ลบข้อมูล" onClick="return confirm('ยืนยันที่จะลบ?')"></span></a>
		<td><?php echo $row_user['username'] ?></td>
		<td><?php echo $row_user['password'] ?></td>
		<td><?php if($row_user['usertype']== "tm") {echo "ระบบขนส่งวัสดุ"; } else if($row_user['usertype']== "me") {echo "Mobile equipment";} else if($row_user['usertype']== "me_ct") {echo "Mobile equipment";} else if($row_user['usertype']== "sc") {echo "Service Contract";}else if($row_user['usertype']== "admin") {echo "Administrator";} else{echo "ไม่ได้กำหนดตำแหน่ง";}?></td>
	</td>
		
		
	</tr>
	<?php  $row++; 
}while($row_user = mysql_fetch_assoc($user)); ?>
</table>
</body>
</html>