<?php 
$qmacs = "SELECT * FROM equipment_group a INNER JOIN m.equipment c on a.Equipment_type = c.eqtype where a.Equipment_group='sc'  GROUP BY a.Equipment_id";

$macs      = mysql_query($qmacs, $DB) or die(mysql_error());
$nummacs   = mysql_num_rows($macs);
$row_macsc = mysql_fetch_assoc($macs);

$qmactde = "SELECT * FROM equipment_group a  INNER JOIN m.equipment c on a.Equipment_type = c.eqtype where a.Equipment_group='tm'  GROUP BY a.Equipment_id";

$mactde      = mysql_query($qmactde, $DB) or die(mysql_error());
$nummactde   = mysql_num_rows($mactde);
$row_mactm = mysql_fetch_assoc($mactde);

$qmacmde = "SELECT * FROM equipment_group a  INNER JOIN m.equipment c on a.Equipment_type = c.eqtype where a.Equipment_group='me'  GROUP BY a.Equipment_id";

$macmde      = mysql_query($qmacmde, $DB) or die(mysql_error());
$nummacmde   = mysql_num_rows($macmde);
$row_macmede = mysql_fetch_assoc($macmde);

$qmacmct = "SELECT * FROM equipment_group a  INNER JOIN m.equipment c on a.Equipment_type = c.eqtype where a.Equipment_group='me_ct'  GROUP BY a.Equipment_id";

$macmct      = mysql_query($qmacmct, $DB) or die(mysql_error());
$nummacmct   = mysql_num_rows($macmct);
$row_macmct = mysql_fetch_assoc($macmct);
 ?>

<?php 
     switch ($_SESSION['user_type']) {
    case "me_ct":
        ?><table width="1300" border="1" cellspacing="0" cellpadding="0" style="font-size: 15px; background-color: #ffffff; "  id="me-detail">
   
<tr ><th align="center" colspan="10" height="30"><font style="font-size:16px;"><center>บำรุงรักษาเครื่องจักรโดยหบต-ช.</center></font></th></tr>

  
<?php  
if($nummacmct!="0"){
  $count = 1;
do {  

   
$eqmid = $row_macmct['Equipment_id'];
  ?>

<tr ><td colspan="10" bgcolor="#cccccc" height="30" ><h4><?php echo $row_macmct['Equipment_name']; ?></h4></td></tr>
  <tr >
   
  
   <th height="30">ลำดับที่</th>
  <th height="30">หมายเลข</th>
  <th >PM/CM</th>
  <th >เลขชั่วโมง</th>
   
   <th >อาการ</th>
   <th width="100">วันที่ชำรุด</th>
   
   
   

   
   <th >คาดว่าจะแล้วเสร็จ</th>
   
   <th >หมายเหตุ</th>
   <th >ผู้รับผิดชอบ</th>
    <th >แล้วเสร็จ</th>

  </tr>
  <?php 

    $id = $row_macmct['Equipment_id'];
    $eqtype = $row_macmct['eqtype'];
    if($id==13){
      $fillter="AND egatno in ('640143','640144','640146','640147','640148','640149','640153')";
    }else{
      $fillter="";
    }
    $qmect_detail = "SELECT * FROM m.equipment  WHERE eqtype='$eqtype' $fillter order by egatno";

$mectdetail     = mysql_query($qmect_detail, $DB) or die(mysql_error());
$rowmectdetail = mysql_num_rows($mectdetail);
$row_mectdetail = mysql_fetch_assoc($mectdetail);

if($rowmectdetail!="0"){
    
   do{
       $eqnum = $row_mectdetail['egatno'];
$qmct_detailck = "SELECT * FROM daily_detail WHERE Equipment_number = '$eqnum' AND Record_date = '$date' order by Equipment_number";

$mctdetailck     = mysql_query($qmct_detailck, $DB) or die(mysql_error());
$rowmctdetailck = mysql_num_rows($mctdetailck);
$row_mctdetailck = mysql_fetch_assoc($mctdetailck);
if($rowmctdetailck==0){
  ?>
    <tr id="rowat-de<?php echo $row; ?>">

     
   <td align="center" height="27"><?php echo $count; ?></td>
    <td align="center"><?php echo $row_mectdetail['egatno']; ?></td> 
    
    <td align="center"></td>
    <td align="center"></td>
    <td >ปกติ</td>
    <td align="center"></td>
    <td align="center"></td> 
    <td align="center"></td>
    <td align="center"></td>
    <td align="center"></td>
  </tr>
  <?php
}else{
   if($row_mctdetailck['PM_CM']!=""){
?>
<tr id="rowat-de<?php echo $row; ?>">

    
   
   <td align="center" height="27"><?php echo $count; ?></td>
    <td align="center"><?php echo $row_mctdetailck['Equipment_number']; ?></td> 
    <td align="center"><?php echo $row_mctdetailck['PM_CM']; ?></td>
    <td align="center"><?php echo $row_mctdetailck['Mac_hour']; ?></td>
    <td width="500"><?php echo  $row_mctdetailck['Description']; ?></td>
     <td align="center"><?php if($row_mctdetailck['date']=="0000-00-00"){ echo "";}else{ echo thai_date_short(strtotime($row_mctdetailck['date']));} ?></td>


    
    
    <td align="center"><?php if($row_mctdetailck['action_date']=="0000-00-00"){ echo "";}else{ echo thai_date_short(strtotime($row_mctdetailck['action_date']));} ?></td> 
    <td align="center"><?php echo $row_mctdetailck['Remark']; ?></td>
    <td align="center"><?php echo $row_mctdetailck['User_respone']; ?></td>
    <td align="center"><?php echo $row_mctdetailck['finished_date']; ?></td>
   </tr>
  <?php
}else{
  ?>
    <tr id="rowat-de<?php echo $row; ?>">

    
   
   <td align="center" height="27"><?php echo $count; ?></td>
    <td align="center"><?php echo $row_mctdetailck['Equipment_number']; ?></td> 
    <td align="center"><?php echo $row_mctdetailck['PM_CM']; ?></td>
    <td align="center"><?php echo $row_mctdetailck['Mac_hour']; ?></td>
     <td>ปกติ</td>

<td ></td>
    
    
    
    <td></td> 
    <td align="center"><?php echo $row_mctdetailck['Remark']; ?></td>
    <td align="center"><?php echo $row_mctdetailck['User_respone']; ?></td>
    <td ></td>
     </tr>
<?php
  }}
  $row++;
  $count++;
  } while ($row_mectdetail = mysql_fetch_assoc($mectdetail)); $count=1;}
 ?>

  
  
<?php
  
} while ($row_macmct = mysql_fetch_assoc($macmct)); }?>
</table>

<br>

Remark (หบต-ช.): <?php echo($detail_remarkmect['Remark_detail']) ?>
<br>
<br><?php
        break;
    case "sc":
        ?>

<table width="1300" border="1" cellspacing="0" cellpadding="0" style="font-size: 15px; background-color: #ffffff; "  id="sc-detail">
   
<tr ><th align="center" colspan="10" height="30"><font style="color:#ff0000; font-size:16px;"><center>รายละเอียดเครื่องจักรกลุ่ม Service Contract</center></font></th></tr>

  
<?php  
if($nummacs!="0"){
  $count = 1;
do {  

   
$eqmid = $row_macsc['Equipment_id'];
  ?>

<tr ><td colspan="10" bgcolor="#cccccc" height="30"><h4><?php echo $row_macsc['Equipment_name']; ?></h4></td></tr>
  <tr >
   
   <th height="30">ลำดับที่</th>
  <th height="30">หมายเลข</th>
  <th >PM/CM</th>
  <th >เลขชั่วโมง</th>
   
   <th width="450">อาการ</th>
   <th width="100">วันที่ชำรุด</th>
   
   
   

   
   <th >คาดว่าจะแล้วเสร็จ</th>
   
   <th >หมายเหตุ</th>
   <th >ผู้รับผิดชอบ</th>
    <th >แล้วเสร็จ</th>
   

  </tr>
  <?php 

    $id = $row_macsc['Equipment_id'];
    $eqtype = $row_macsc['eqtype'];
    if($id==10){
      $fillter="AND egatno in ('580072','580073','580074','580075')";
    }else if($id==11){
      $fillter="AND egatno in ('640122','640123','640124','640125','640133','640131')";
    }else if($id==12){
      $fillter="AND egatno in ('640128','640129','640134')";
    }else if($id==49){
      $fillter="AND egatno in ('640119','640139','640173','640174','640175')";
    }else if($id==50){
      $fillter="AND egatno in ('640137','640138','640150')";
    }else{
      $fillter="";
    }
    $qsc_detail = "SELECT * FROM m.equipment  WHERE eqtype='$eqtype' $fillter order by egatno";

$scdetail     = mysql_query($qsc_detail, $DB) or die(mysql_error());
$rowscdetail = mysql_num_rows($scdetail);
$row_scdetail = mysql_fetch_assoc($scdetail);

if($rowscdetail!="0"){
    
   do{
       $eqnum = $row_scdetail['egatno'];
$qsc_detailck = "SELECT * FROM daily_detail WHERE Equipment_number = '$eqnum' AND Record_date = '$date' order by Equipment_number";

$scdetailck     = mysql_query($qsc_detailck, $DB) or die(mysql_error());
$rowscdetailck = mysql_num_rows($scdetailck);
$row_scdetailck = mysql_fetch_assoc($scdetailck);
if($rowscdetailck==0){
  ?>
    <tr id="rowat-de<?php echo $row; ?>">

    
   
   <td align="center" height="27"><?php echo $count; ?></td>
    <td align="center"><?php echo $row_scdetail['egatno']; ?></td> 
    
    <td></td>
    <td ></td>
    <td >ปกติ</td>
    <td ></td>
    <td></td> 
    <td></td>
    <td ></td>
    <td ></td>
     </tr>
  <?php
}else{
  if($row_scdetailck['PM_CM']!=""){
  
   
?>
<tr id="rowat-de<?php echo $row; ?>">

    
   
   <td align="center" height="27"><?php echo $count; ?></td>
    <td align="center"><?php echo $row_scdetailck['Equipment_number']; ?></td> 
   <td align="center"><?php echo $row_scdetailck['PM_CM']; ?></td> 
     <td align="center"><?php echo $row_scdetailck['Mac_hour']; ?></td>

<td ><?php echo  $row_scdetailck['Description']; ?></td>
    
    <td align="center"><?php if($row_scdetailck['date']=="0000-00-00"){ echo "";}else{ echo thai_date_short(strtotime($row_scdetailck['date']));} ?></td>
    
    <td align="center"><?php if($row_scdetailck['action_date']=="0000-00-00"){ echo "";}else{ echo thai_date_short(strtotime($row_scdetailck['action_date']));} ?></td> 
    <td align="center"><?php echo $row_scdetailck['Remark']; ?></td>
    <td align="center"><?php echo $row_scdetailck['User_respone']; ?></td>
    <td align="center"><?php echo $row_scdetailck['finished_date']; ?></td>
   </tr>
  <?php
}else{
  ?>
    <tr id="rowat-de<?php echo $row; ?>">

    
   
   <td align="center" height="27"><?php echo $count; ?></td>
    <td align="center"><?php echo $row_scdetailck['Equipment_number']; ?></td> 
    <td align="center"><?php echo $row_scdetailck['PM_CM']; ?></td>
    <td align="center"><?php echo $row_scdetailck['Mac_hour']; ?></td>
     

<td >ปกติ</td>
    <td></td>
    
    
    <td></td> 
    <td align="center"><?php echo $row_scdetailck['Remark']; ?></td>
    <td align="center"><?php echo $row_scdetailck['User_respone']; ?></td>
    <td ></td>
     </tr>
  <?php
}

  }
  $row++;
  $count++;
  } while ($row_scdetail = mysql_fetch_assoc($scdetail)); $count = 1;}
 ?>

  
  
<?php
  
} while ($row_macsc = mysql_fetch_assoc($macs)); }?>
</table>

<br>

Remark: <?php echo($detail_remarksc['Remark_detail']) ?>
<br>
<br><?php
        break;
    case "tm":
        ?>
        <table width="1300" border="1" cellspacing="0" cellpadding="0" style="font-size: 15px; background-color: #ffffff; "  id="me-detail">
   <tr>
    <th colspan="10">
      <font style="color:#ff0000; font-size:16px;"><center>รายละเอียดเครื่องจักรระบบขนส่ง</center></font>
    </th>
  </tr>

  <?php  
  if($nummactde!="0"){
    $count=1;
do {  
    
    
   $eqmid = $row_mactm['Equipment_id'];
  ?>

<tr  ><td colspan="10" bgcolor="#cccccc" height="30"><h4><?php echo $row_mactm['Equipment_name']; ?></h4></td></tr>



  <tr >
   
  <th height="30">ลำดับที่</th>
  <th height="30">หมายเลข</th>
  <th >PM/CM</th>
  <th >เลขชั่วโมง</th>
   
   <th >อาการ</th>
   <th width="100">วันที่ชำรุด</th>
   
   
   

   
   <th >คาดว่าจะแล้วเสร็จ</th>
   
   <th >หมายเหตุ</th>
   <th >ผู้รับผิดชอบ</th>
    <th >แล้วเสร็จ</th>
  </tr>
  <?php 

    $id = $row_mactm['Equipment_id'];
    $eqtype = $row_mactm['eqtype'];
   if($id==1){
      $fillter="AND egatno not in ('240004','240005','240007','240008')";
    }else if($id==3){
      $fillter="AND egatno not in ('260002','260003','260006','260007')";
    }else if($id==4){
      $fillter="AND egatno not in ('270001','270002','270003','270004','270005')";
    }else{
      $fillter="";
    }
    $qtm_detail = "SELECT * FROM m.equipment  WHERE eqtype='$eqtype' $fillter order by egatno";

$tmdetail     = mysql_query($qtm_detail, $DB) or die(mysql_error());
$rowtmdetail = mysql_num_rows($tmdetail);
$row_tmdetail = mysql_fetch_assoc($tmdetail);


    if($rowtmdetail!="0"){
  do{
$eqnum = $row_tmdetail['egatno'];
$qtm_detailck = "SELECT * FROM daily_detail WHERE Equipment_number = '$eqnum' AND Record_date = '$date' order by Equipment_number";

$tmdetailck     = mysql_query($qtm_detailck, $DB) or die(mysql_error());
$rowtmdetailck = mysql_num_rows($tmdetailck);
$row_tmdetailck = mysql_fetch_assoc($tmdetailck);
 
if($rowtmdetailck==0){
    ?>
     <tr id="rowat-de<?php echo $row; ?>">

    
   
   <td align="center" height="27"><?php echo $count; ?></td>
    <td align="center"><?php echo $row_tmdetail['egatno']; ?></td> 
    
    <td></td>
    <td ></td>
    <td >ปกติ</td>
    <td ></td>
    <td></td> 
    <td></td>
    <td ></td>
    <td ></td>
  </tr>
  <?php
}else{
  if($row_tmdetailck['PM_CM']!=""){
?>
<tr id="rowat-de<?php echo $row; ?>">

    
   
   <td align="center" height="27"><?php echo $count; ?></td>
    <td align="center"><?php echo $row_tmdetailck['Equipment_number']; ?></td> 
   <td align="center"><?php echo $row_tmdetailck['PM_CM']; ?></td>
    <td align="center"><?php echo $row_tmdetailck['Mac_hour']; ?></td>
     

<td width="500"><?php echo  $row_tmdetailck['Description']; ?></td>
    <td align="center"><?php if($row_tmdetailck['date']=="0000-00-00"){ echo "";}else{ echo thai_date_short(strtotime($row_tmdetailck['date']));} ?></td>
    
    
    <td align="center"><?php if($row_tmdetailck['action_date']=="0000-00-00"){ echo "";}else{ echo thai_date_short(strtotime($row_tmdetailck['action_date']));} ?></td> 
    <td align="center"><?php echo $row_tmdetailck['Remark']; ?></td>
    <td align="center"><?php echo $row_tmdetailck['User_respone']; ?></td>
    <td align="center"><?php echo $row_tmdetailck['finished_date']; ?></td>
   </tr>
  <?php
}else{
  ?>
    <tr id="rowat-de<?php echo $row; ?>">

    
   
   <td align="center" height="27"><?php echo $count; ?></td>
    <td align="center"><?php echo $row_tmdetailck['Equipment_number']; ?></td> 
     <td align="center"><?php echo $row_tmdetailck['PM_CM']; ?></td>
     <td align="center"><?php echo $row_tmdetailck['Mac_hour']; ?></td>
     

<td >ปกติ</td>
   <td></td>
    
    
    <td></td> 
    <td align="center"><?php echo $row_tmdetailck['Remark']; ?></td>
    <td align="center"><?php echo $row_tmdetailck['User_respone']; ?></td>
    <td ></td>
     </tr>


   <?php
  }

}
  $row++;
  $count++;
  } while ($row_tmdetail = mysql_fetch_assoc($tmdetail)); $count=1; } ?>

  
  
<?php
  
} while ($row_mactm = mysql_fetch_assoc($mactde)); }?>
  
</table>

<br>
Remark: <?php echo($detail_remarktm['Remark_detail']); ?>
<br>
<br>
        
<?php
        break;
    case "me":
        ?>
<table width="1300" border="1" cellspacing="0" cellpadding="0" style="font-size: 15px; background-color: #ffffff; "  id="me-detail">
   
<tr ><th align="center" colspan="10" height="30"><font style=" font-size:16px;"><center>บำรุงรักษาเครื่องจักรโดยหบย-ช.</center></font></th></tr>
<?php  

if($nummacmde!="0"){
  $count = 1;
do {  
    
     
$eqmid = $row_macmede['Equipment_id'];
  ?>

<tr ><td colspan="10" bgcolor="#cccccc" height="30"><h4><?php echo $row_macmede['Equipment_name']; ?></h4></td></tr>
  <tr >
   
  <th height="30">ลำดับที่</th>
  <th height="30">หมายเลข</th>
  <th >PM/CM</th>
  <th >เลขชั่วโมง</th>
   
   <th >อาการ</th>
   <th width="100">วันที่ชำรุด</th>
   
   
   

   
   <th >คาดว่าจะแล้วเสร็จ</th>
   
   <th >หมายเหตุ</th>
   <th >ผู้รับผิดชอบ</th>
    <th >แล้วเสร็จ</th>
   

  </tr>
  <?php 

    $id = $row_macmede['Equipment_id'];
     $eqtype = $row_macmede['eqtype'];
   
    $qme_detail = "SELECT * FROM m.equipment  WHERE eqtype='$eqtype' order by egatno";

$medetail     = mysql_query($qme_detail, $DB) or die(mysql_error());
$rowmedetail = mysql_num_rows($medetail);
$row_medetail = mysql_fetch_assoc($medetail);

if($rowmedetail!="0"){
    
 do {
   $eqnum = $row_medetail['egatno'];
$qme_detailck = "SELECT * FROM daily_detail WHERE Equipment_number = '$eqnum' AND Record_date = '$date' order by Equipment_number";

$medetailck     = mysql_query($qme_detailck, $DB) or die(mysql_error());
$rowmedetailck = mysql_num_rows($medetailck);
$row_medetailck = mysql_fetch_assoc($medetailck);
if($rowmedetailck==0){
    ?>
 <tr id="rowat-de<?php echo $row; ?>">

    
   
   <td align="center" height="27"><?php echo $count; ?></td>
    <td align="center"><?php echo $row_medetail['egatno']; ?></td> 
    <td ></td>
    <td></td>
    <td >ปกติ</td>
    <td ></td>
    <td></td> 
    <td></td>
    <td ></td>
    <td ></td>
  </tr>
  <?php
}else{
  if($row_medetailck['PM_CM']!=""){
?>
<tr id="rowat-de<?php echo $row; ?>">

    
   
   <td align="center" height="27"><?php echo $count; ?></td>
    <td align="center"><?php echo $row_medetailck['Equipment_number']; ?></td> 
    <td align="center"><?php echo $row_medetailck['PM_CM']; ?></td>
    <td align="center"><?php echo $row_medetailck['Mac_hour']; ?></td>
    <td width="500"><?php echo  $row_medetailck['Description']; ?></td>
     <td align="center"><?php if($row_medetailck['date']=="0000-00-00"){ echo "";}else{ echo thai_date_short(strtotime($row_medetailck['date']));} ?></td>
    <td align="center"><?php if($row_medetailck['action_date']=="0000-00-00"){ echo "";}else{ echo thai_date_short(strtotime($row_medetailck['action_date']));} ?></td> 
    <td align="center"><?php echo $row_medetailck['Remark']; ?></td>
    <td align="center"><?php echo $row_medetailck['User_respone']; ?></td>
    <td align="center"><?php echo $row_medetailck['finished_date']; ?></td>
   </tr>
  <?php
}else{
  ?>
    <tr id="rowat-de<?php echo $row; ?>">

    
   
   <td align="center" height="27"><?php echo $count; ?></td>
    <td align="center"><?php echo $row_medetailck['Equipment_number']; ?></td> 
    <td align="center"><?php echo $row_medetailck['PM_CM']; ?></td>
     <td align="center"><?php echo $row_medetailck['Mac_hour']; ?></td>
     <td >ปกติ</td>

    
    <td></td>
    
    <td></td> 
    <td align="center"><?php echo $row_medetailck['Remark']; ?></td>
    <td align="center"><?php echo $row_medetailck['User_respone']; ?></td>
    <td ></td>
     </tr>
    <?php
  }

}
  $row++;
  $count++;
  } while ($row_medetail = mysql_fetch_assoc($medetail)); $count=1; } ?>

  
  
<?php
  
} while ($row_macmede = mysql_fetch_assoc($macmde)); }?>
</table>

<br>
Remark (หบย-ช.): <?php echo($detail_remarkme['Remark_detail']) ?>
<br>
<br>
        <?php
       

}


 ?>











