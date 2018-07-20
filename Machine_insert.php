<?php include 'DBConnect.php';

mysql_select_db($databasename, $DB);
$num ="";
$empty = intval($num);
$qdropdown = "SELECT * FROM m.equipment_type";
$dropdown      = mysql_query($qdropdown, $DB) or die(mysql_error());
$row_dropdown = mysql_fetch_assoc($dropdown);
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $Equipment_name = htmlspecialchars($_REQUEST['Equipment_name']);
    $NumberOfEquipment = htmlspecialchars($_REQUEST['NumberOfEquipment']);
    $Equipment_type = htmlspecialchars($_REQUEST['Equipment_type']);
    $Equipment_group = htmlspecialchars($_REQUEST['Equipment_group']);

    $qmac_insert = "INSERT INTO equipment_group values($empty,'".$Equipment_name."',".$NumberOfEquipment.",'".$Equipment_type."','".$Equipment_group."')";

$mact = mysql_query($qmac_insert, $DB) or die(mysql_error());

$insertGoTo = "Machine_list.php";


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
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script><title>เพิ่มเครื่องจักร</title>
    <script type="text/javascript">
    	function showamount(str) {
    if (str == "") {
        document.getElementById("amount").innerHTML = "";
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("amount").innerHTML = this.responseText;
                document.getElementById("NumberOfEquipment").value = this.responseText;
                
                 
                
            }
        };
        xmlhttp.open("GET","EquipmentCount.php?q="+str,true);
        xmlhttp.send();
    }
}
    </script>
</head>
<body style="padding: 20px; background-image: url(<?php echo $_SESSION['image']; ?>); ">
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<table style="font-size: 20px;  background-color:#ffffff;" align="center" border="1"  >
		<tr>
			<th colspan="2"> เพิ่มเครื่องจักร</th>
		</tr>
		<tr>
			<td>ชื่อ: </td>
			<td><input type="text" name="Equipment_name" size="100" required="required"></td>
		</tr>
		<tr>
			<td>จำนวน: </td>
			<td><p id="amount"></p><input type="hidden" name="NumberOfEquipment" id="NumberOfEquipment"></td>
		</tr>
		<tr>
			<td>Equipment Type: </td>
			<td><select name="Equipment_type"  required="required" onchange="showamount(this.value)"><?php do {
				
			 ?><option value="<?php echo($row_dropdown['equipment_type']) ?>"><?php echo($row_dropdown['equipment_type']) ?>:<?php echo($row_dropdown['description']) ?></option><?php } while ($row_dropdown = mysql_fetch_assoc($dropdown)); ?></select></td>
		</tr>
		<tr>
			<td>ชนิด: </td>
			<td><input type="radio" name="Equipment_group" value="tm" required="required"> ระบบขนส่งวัสดุ <br>Moblie Equipment<br><dd><input type="radio" name="Equipment_group" value="me" required="required">ล้อยาง<dd><input type="radio" name="Equipment_group" value="me_ct" required="required">ตีนตะขาบ</li></dd><input type="radio" name="Equipment_group" value="sc" required="required">Service Contract</td>
		</tr>
		<br>
		<tr>
			<td colspan="2"><input type="submit" name="" value="บันทึก"><input type=button onclick=window.history.back() value=ยกเลิก></td>
		</tr>
		
	</table>
</form>
</body>
</html>