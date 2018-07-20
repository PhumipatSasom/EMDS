<?php 
session_start();
include 'DBConnect.php';

mysql_select_db($databasename, $DB);


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = htmlspecialchars($_REQUEST['username']);
    $password = htmlspecialchars($_REQUEST['password']);
   $login = "SELECT * FROM users  where username = '$username' and password = '$password'";

$loginstatus     = mysql_query($login, $DB) or die(mysql_error());
$numlog = mysql_num_rows($loginstatus);
$rowlog = mysql_fetch_assoc($loginstatus);
    if($numlog!=0){
$_SESSION["id_citizen"] = "pass";
$_SESSION['user_type'] = $rowlog['usertype'];
    	
    	$insertGoTo = "index.php";


header(sprintf("Location: %s", $insertGoTo));
    }else{
    	echo '<script type="text/javascript">alert("Username หรือ Password ผิดพลาด!!!");</script>';
    }


}


?>
<!DOCTYPE html>
<html>
<head>
	<title>เข้าสู่ระบบ</title>
	<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body style="padding: 20px; background-image: url(<?php echo $_SESSION['image']; ?>); ">
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<table style="font-size: 20px; width: 500px; background-color:#ffffff;  " align="center" border="1"  >
		<tr>
			<th colspan="2"> เข้าสู่ระบบ</th>
		</tr>
		<tr>
			<td>Username: </td>
			<td><input type="text" name="username" ></td>
		</tr>
		<tr>
			<td>Password: </td>
			<td><input type="password"  name="password" ></td>
		</tr>
		
		<br>
		<tr>
			<td colspan="2"><input type="submit" name="" value="เข้าสู่ระบบ"><input type=button onclick=window.history.back() value=ยกเลิก></td>
		</tr>
		
	</table>
</form>
</body>
</html>