<?php include 'DBConnect.php';

mysql_select_db($databasename, $DB);
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = htmlspecialchars($_REQUEST['username']);
    $password = htmlspecialchars($_REQUEST['password']);
    $usertype = htmlspecialchars($_REQUEST['usertype']);
    $user_id = htmlspecialchars($_REQUEST['user_id']);
    

    $qmact_update = "UPDATE users
		SET username = '$username',
		password = '$password',
		usertype = '$usertype'
		 WHERE user_id= $user_id";

$mact = mysql_query($qmact_update, $DB) or die(mysql_error());

$insertGoTo = "User_list.php";


header(sprintf("Location: %s", $insertGoTo));
}

$qmac = "SELECT * FROM users where user_id =".$_GET['userid'];

    $mac     = mysql_query($qmac, $DB) or die(mysql_error());
     $row_mac = mysql_fetch_assoc($mac);
 
?>
<!DOCTYPE html>
<html>
<head>
	
	<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>แก้ไขผู้ใช้งานระบบ</title>
</head>
<body style="padding: 20px; background-image: url(<?php echo $_SESSION['image']; ?>); ">
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<table style="font-size: 20px; width: 500px; background-color:#ffffff;  " align="center" border="1"  >
		<tr>
			<th colspan="2"> แก้ไขผู้ใช้งานระบบ</th>
		</tr>
		<tr>
			<td>Usename: </td>
			<td><input type="text" name="username" size="100" value="<?php echo($row_mac['username']) ?>" required="required"></td>
		</tr>
		<tr>
			<td>Password: </td>
			<td><input type="text"  value="<?php echo($row_mac['password']) ?>" size="100"  name="password" required="required"></td>
		</tr>
		
		<tr>
			<td>ชนิด: </td>
			<td><input type="radio" name="usertype" value="tm" <?php 
			if($row_mac['usertype']=="tm") echo "checked"; ?> required="required"> ระบบขนส่งวัสดุ <br>Moblie Equipment<dd><input type="radio" name="usertype" value="me" <?php 
			if($row_mac['usertype']=="me") echo "checked"; ?> required="required">ล้อยาง<br><input type="radio" name="usertype" value="me_ct" <?php 
			if($row_mac['usertype']=="me_ct") echo "checked"; ?> required="required">ตีนตะขาบ</dd><input type="radio" name="usertype" value="sc" <?php 
			if($row_mac['usertype']=="sc") echo "checked"; ?> required="required">Service Contract<br><input type="radio" name="usertype" value="admin" <?php 
			if($row_mac['usertype']=="admin") echo "checked"; ?> required="required">Administrator</td>
		</tr>
		<br>
		<tr>
			<td colspan="2"><input type="submit" name="" value="แก้ไข"><input type=button onclick=window.history.back() value=ยกเลิก></td>
		</tr>
		<input type="hidden" name="user_id" value="<?php echo($_GET['userid']) ?>">
	</table>
</form>
</body>
</html>