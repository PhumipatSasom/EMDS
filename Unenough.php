<?php 
include 'DBConnect.php';
mysql_select_db($databasename, $DB);
date_default_timezone_set("Asia/Bangkok");
$day   = date("d");
$month = date("m");
$year  = date("Y");
$date  = $year . "-" . $month . "-" . $day;
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fdate = htmlspecialchars($_REQUEST['fdate']);
    $ldate = htmlspecialchars($_REQUEST['ldate']);
   
    }

  
   
   $qbdate = "SELECT * FROM equipment_group a inner join daily_report b on a.Equipment_id = b.Equipment_id where b.TimeDate_record between '$fdate' and '$ldate' order by b.Record_id";
$bdate = mysql_query($qbdate, $DB) or die(mysql_error());
$rowdate = mysql_fetch_assoc($bdate);
$numdate = mysql_num_rows($bdate);



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

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>รายงานสรุปผลเครื่องจักรไม่พอใช้งาน</title>
     <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript">
    function showdetail(str,date,group) {
       if (str == "") {
        document.getElementById("showdetail").innerHTML = "";
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
             
                document.getElementById("showdetail").innerHTML = this.responseText;
               $("#myModal").modal();



                 
                
            }
        };
        xmlhttp.open("GET","detailshow.php?eqmid="+str+"&date="+date+"&group="+group,true);
        xmlhttp.send();
    }
    }


  </script>
  <style type="text/css">
    th{
      text-align: center;
    }
  </style>
</head>
<body style="text-align: center; padding: 20px; background-image: url(<?php echo $_SESSION['image']; ?>);">
 <button onclick="window.location.href='index.php'" style="float: right;" >ย้อนกลับ</button>
 <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	วันที่ <input type="date" required="required" name="fdate" value="<?php echo($fdate) ?>"> ถึงวันที่ <input type="date" required="required" name="ldate" value="<?php echo($ldate) ?>"><input type="submit" value="ดูรายงาน"></form>

    <?php if($numdate!=0){ ?>  
    <br>
    <center>
<table width="<?php echo($width); ?>" border="1"  style="font-size: 16px; background-color:#ffffff;  ">
  
  <tr style="background-color: #cccccc; height: 10px;">
  
<th >วันที่</th>
<th>เครื่องจักรไม่พร้อมใช้</th>
<th>ต้องการ</th>
<th >มีใช้</th>
<th>PM</th>
<th >CM</th>
<th >หมายเหตุ</th>
<th></th>
  </tr>

    	<?php do {

    			$eqid = $rowdate['Equipment_id'];
    			$date = $rowdate['TimeDate_record'];

    					$qpm = "SELECT SUM(CASE WHEN PM_CM='PM' THEN 1 ELSE 0 END) as PM FROM daily_detail WHERE Equipment_id = $eqid AND Record_date = '$date' ";

$pm      = mysql_query($qpm, $DB) or die(mysql_error());

$row_pm = mysql_fetch_assoc($pm);

$pmvalue = $row_pm['PM'];

 
           $qcm = "SELECT SUM(CASE WHEN PM_CM='CM' THEN 1 ELSE 0 END) as CM FROM daily_detail WHERE Equipment_id = $eqid AND Record_date = '$date' ";

$cm      = mysql_query($qcm, $DB) or die(mysql_error());

$row_cm = mysql_fetch_assoc($cm);
$cmvalue = $row_cm['CM'];
if($pmvalue==""){
  $pmvalue = 0;
}
if($cmvalue==""){
  $cmvalue = 0;
}

 $ald = $rowdate['Equipment_amount'] - $pmvalue - $cmvalue;

    if ($ald < $rowdate['Equipment_require']) {
       

     
    	?>
    	<tr>
    	<td ><?php $eng_date = strtotime($rowdate['TimeDate_record']);
echo thai_date_short($eng_date); ?></td>
    	<td><?php echo $rowdate['Equipment_name']; ?></td>
    	<td><center><?php echo $rowdate['Equipment_require']; ?></center></td>
    	<td><center><?php echo $ald; ?></center></td>
    	<td><center><?php echo $pmvalue; ?></center></td>
    	<td><center><?php echo $cmvalue; ?></center></td>
        <td><?php 
         $eqid = $rowdate['Equipment_id'];
         $total = $cmvalue+$pmvalue;
      $qnotepm = "SELECT * FROM daily_detail WHERE Equipment_id = $eqid AND Record_date = '$date' AND PM_CM = 'PM' order by Equipment_number";

$notepm      = mysql_query($qnotepm, $DB) or die(mysql_error());

$row_notepm = mysql_fetch_assoc($notepm);

 $qnotecm = "SELECT * FROM daily_detail WHERE Equipment_id = $eqid AND Record_date = '$date' AND PM_CM = 'CM' order by Equipment_number";

$notecm      = mysql_query($qnotecm, $DB) or die(mysql_error());

$row_notecm = mysql_fetch_assoc($notecm);
if($rowdate['Equipment_group']=="tm"){
     if($total!=0){
     
      if($pmvalue!=0){
    do {
          $suffix = $row_notepm['Equipment_number'];
      echo $suffix.",";}
     while ($row_notepm = mysql_fetch_assoc($notepm));
     echo "(PM.)";
    } if($cmvalue!=0){
      do {
          $suffixcm = $row_notecm['Equipment_number'];
      echo $suffixcm.",";}
     while ($row_notecm = mysql_fetch_assoc($notecm));
echo "(CM.)";
}


   }
}else{
$qegatno = "SELECT egatno FROM m.equipment WHERE eqtype =".$rowdate['Equipment_type'];

$egatno      = mysql_query($qegatno, $DB) or die(mysql_error());

$row_egatno = mysql_fetch_assoc($egatno);
    $prefix = substr($row_egatno['egatno'], 0, 2);
      if($total!=0){
      echo "No.".$prefix."-";
      if($pmvalue!=0){
    do {
          $suffix = substr($row_notepm['Equipment_number'], 3);
      echo $suffix.",";}
     while ($row_notepm = mysql_fetch_assoc($notepm));
     echo "(PM.)";
    } if($cmvalue!=0){
      do {
          $suffixcm = substr($row_notecm['Equipment_number'], 3);
      echo $suffixcm.",";}
     while ($row_notecm = mysql_fetch_assoc($notecm));
echo "(CM.)";
}


   }
}

   ?></td>
   <td ><label><a onclick="showdetail(<?php echo $rowdate['Equipment_id']; ?>,'<?php echo $rowdate['TimeDate_record']; ?>','<?php echo $rowdate['Equipment_group']; ?>')" >ดูรายละเอียด</a></label></td>
    </tr>
    	<?php }} while ($rowdate = mysql_fetch_assoc($bdate)); ?>
    
</table></center>
 


    <?php }else{ echo "<br>ยังไม่ได้เลือกวันที่หรือไม่มีข้อมูล";} ?>
    <div id="showdetail"></div>
</body>
</html>