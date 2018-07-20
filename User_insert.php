<?php include 'DBConnect.php';

mysql_select_db($databasename, $DB);
$num ="";
$empty = intval($num);
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = htmlspecialchars($_REQUEST['username']);
    $password = htmlspecialchars($_REQUEST['password']);
    $type = htmlspecialchars($_REQUEST['user_type']);
    

    $quser_insert = "INSERT INTO users values($empty,'$username','$password','$type')";

$mact = mysql_query($quser_insert, $DB) or die(mysql_error());

$insertGoTo = "User_list.php";


header(sprintf("Location: %s", $insertGoTo));
}
 
?>
<!DOCTYPE html>
<html>
<head>
	
	<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script><title>เพิ่มู้ใช้งานระบบ</title>
</head>
<body style="padding: 20px; background-image: url(<?php echo $_SESSION['image']; ?>); ">
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<table style="font-size: 20px; width: 500px; background-color:#ffffff;" align="center" border="1"  >
		<tr>
			<th colspan="2"> เพิ่มู้ใช้งานระบบ</th>
		</tr>
		<tr>
			<td>Username: </td>
			<td><input type="text" name="username" size="100" required="required"></td>
		</tr>
		<tr>
			<td>Password: </td>
			<td><input type="text" size="100" name="password" required="required"></td>
		</tr>
		
		<tr>
			<td>Type: </td>
			<td><input type="radio" name="user_type" value="tm" required="required"> ระบบขนส่งวัสดุ <br>Moblie Equipment<br><dd><input type="radio" name="user_type" value="me" required="required">ล้อยาง<dd><input type="radio" name="user_type" value="me_ct" required="required">ตีนตะขาบ</li></dd><input type="radio" name="user_type" value="sc" required="required">Service Contract<br><input type="radio" name="user_type" value="admin" required="required">Administrator</td>
		</tr>
		<br>
		<tr>
			<td colspan="2"><input type="submit" name="" value="บันทึก"><input type=button onclick=window.history.back() value=ยกเลิก></td>
		</tr>
		
	</table>
</form>
</body>
</html>