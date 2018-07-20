<?php 
include 'DBConnect.php';
mysql_select_db($databasename, $DB);
      date_default_timezone_set("Asia/Bangkok");
      $dateurl = $_GET['date'];
      $eqmid = $_GET['eqmid'];
      $group = $_GET['group'];

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


<div class="container">
 
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">รายละเอียด</h4>
        </div>
        <div class="modal-body">
            

           <?php 
  
   

 $qbdatede = "SELECT * FROM daily_detail  WHERE   Record_date = '$dateurl' and  Equipment_id = '$eqmid' order by Equipment_number ";
$bdatede = mysql_query($qbdatede, $DB) or die(mysql_error());
$rowdatede = mysql_fetch_assoc($bdatede);
$numdatede = mysql_num_rows($bdatede);
if($group=="tm"){
  do{ 
 if($rowdatede['time']=="00:00:00"){
    $time = "";
  }else{
   $time =  "เวลา ".$rowdatede['time']." น.";
  }
  if($rowdatede['date']=="0000-00-00"){
    $datetoshow = "ไม่ทราบวัน";
  }else{
   $datetoshow =  thai_date_short(strtotime($rowdatede['date']));
  }
  if($rowdatede['action']=="finish" ){
    $action = "มีกำหนดเสร็จ ".thai_date_short(strtotime($rowdatede['action_date']));
  }else{
    $action = "ยังไม่มีกำหนดเสร็จ";
  }


  

  


echo "<p align='left'>".$rowdatede['Equipment_number']." ".$rowdatede['PM_CM'].".".$rowdatede['Description']." (<font style='color:red;'>".$datetoshow." ".$time." อยู่ระหว่างดำเนินการ / ".$action."</font>)".$rowdatede['Remark']."</p><br>";

}while($rowdatede = mysql_fetch_assoc($bdatede)); 
}else{

 do{ 


   if($rowdatede['time']=="00:00:00"){
    $time = "";
  }else{
   $time =  "เวลา ".$row_mctdetail['time']." น.";
  }
  if($rowdatede['date']=="0000-00-00"){
    $datetoshow = "ไม่ทราบวัน";
  }else{
   $datetoshow =  thai_date_short(strtotime($rowdatede['date']));
  }
  if($rowdatede['action']=="finish" && $rowdatede['action_date']!="0000-00-00"){
    $action = "มีกำหนดเสร็จ ".thai_date_short(strtotime($rowdatede['action_date']));
  }else{
    $action = "ยังไม่มีกำหนดเสร็จ";
  }
$prefix = substr($rowdatede['Equipment_number'], 0, 2);
      
          $suffix = substr($rowdatede['Equipment_number'], 2);
  
echo "<p align='left'>No.$prefix-$suffix ".$rowdatede['PM_CM'].".".$rowdatede['Description']." (<font style='color:red;'>".$datetoshow." ".$time." อยู่ระหว่างดำเนินการ / ".$action."</font>)".$rowdatede['Remark']."</p><br>";
        
       

}while($rowdatede = mysql_fetch_assoc($bdatede)); 
      }
   ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>