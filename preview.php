<?php 
$qmacs = "SELECT * FROM equipment_group a inner join daily_report b on a.Equipment_id = b.Equipment_id where a.Equipment_group='sc' AND b.TimeDate_record = '$date'";

$macs      = mysql_query($qmacs, $DB) or die(mysql_error());
$nummacs   = mysql_num_rows($macs);
$row_macsc = mysql_fetch_assoc($macs);

$qmactde = "SELECT * FROM equipment_group a inner join daily_report b on a.Equipment_id = b.Equipment_id where a.Equipment_group='tm' AND b.TimeDate_record = '$date'";

$mactde      = mysql_query($qmactde, $DB) or die(mysql_error());
$nummactde   = mysql_num_rows($mactde);


$qmacmde = "SELECT * FROM equipment_group a inner join daily_report b on a.Equipment_id = b.Equipment_id where a.Equipment_group='me' AND b.TimeDate_record = '$date'";

$macmde      = mysql_query($qmacmde, $DB) or die(mysql_error());
$nummacmde   = mysql_num_rows($macmde);
$row_macmede = mysql_fetch_assoc($macmde);

$qmacmct = "SELECT * FROM equipment_group a inner join daily_report b on a.Equipment_id = b.Equipment_id where a.Equipment_group='me_ct' AND b.TimeDate_record = '$date' ";

$macmct      = mysql_query($qmacmct, $DB) or die(mysql_error());
$nummacmct   = mysql_num_rows($macmct);
$row_macmct = mysql_fetch_assoc($macmct);
 ?>

<div style="overflow-x:auto;">
<table width="<?php echo($width); ?>" border="1" cellspacing="0" cellpadding="0" style="font-size: 16px; background-color:#ffffff; ">
  
  <tr style="background-color: #cccccc; ">
   <th width="30" height="50"><font style="color:blue;">ลำดับ</th>
   <th width="300"><font style="color:blue;">เครื่องจักรระบบขนส่งวัสดุ</th>
   <th width="100">จำนวนเครื่องจักร</th>
   <th width="120">จำนวนต้องการ<br>(คัน/กะเช้า)</th>
   <th width="100"><font style="color:blue;">จำนวนพร้อมใช้</th>
   <th width="40"><font style="color:blue;">PM.</th>
   <th width="40"><font style="color:blue;">CM.</th>
   <th width="500"><font style="color:blue;">หมายเหตุ</th>
  </tr>
  <?php
$seq1 = 1;

if($rowtm=="0"){
  echo "<tr><td colspan='8'>ไม่มีข้อมูลในวันนี้</td></tr>";

}else{

do {
$eqid = $row_mactm['Equipment_id'];
           $qpm = "SELECT SUM(CASE WHEN PM_CM='PM' THEN 1 ELSE 0 END) as PM FROM daily_detail WHERE Equipment_id = '$eqid' AND Record_date = '$date' AND finished_date = '' ";

$pm      = mysql_query($qpm, $DB) or die(mysql_error());

$row_pm = mysql_fetch_assoc($pm);

$pmvalue = $row_pm['PM'];

 
           $qcm = "SELECT SUM(CASE WHEN PM_CM='CM' THEN 1 ELSE 0 END) as CM FROM daily_detail WHERE Equipment_id = '$eqid' AND Record_date = '$date' AND finished_date = '' ";

$cm      = mysql_query($qcm, $DB) or die(mysql_error());

$row_cm = mysql_fetch_assoc($cm);
$cmvalue = $row_cm['CM'];
    ?>
<tr>
  <td><center><?php echo $seq1; ?></center></td>
  <td><?php echo $row_mactm['Equipment_name']; ?></td>
  <td><center><?php echo $row_mactm['Equipment_amount']; ?></center></td>
  <td><center><?php echo $row_mactm['Equipment_require']; ?></center></td>
  <td><center><?php

    $ald = $row_mactm['Equipment_amount'] - $pmvalue - $cmvalue;
    if ($ald < $row_mactm['Equipment_require']) {
        echo "<font color='#FF0000'>" . $ald . "</font>";

    } else {
        echo $ald;
    }

    ?></center></td>
  <td><center><?php 
 
if($pmvalue==""){
  $pmvalue = 0;
}
       
   echo $pmvalue; ?></center></td>
  <td><center><?php 


if($cmvalue==""){
  $cmvalue = 0;
}
       
   echo $cmvalue; ?></center></td>
  <td><?php 
         $eqid = $row_mactm['Equipment_id'];
         $total = $cmvalue+$pmvalue;
      $qnotepm = "SELECT * FROM daily_detail WHERE Equipment_id = '$eqid' AND Record_date = '$date' AND PM_CM = 'PM' AND finished_date = '' order by Equipment_number";

$notepm      = mysql_query($qnotepm, $DB) or die(mysql_error());

$row_notepm = mysql_fetch_assoc($notepm);

 $qnotecm = "SELECT * FROM daily_detail WHERE Equipment_id = '$eqid' AND Record_date = '$date' AND PM_CM = 'CM' AND finished_date = '' order by Equipment_number";

$notecm      = mysql_query($qnotecm, $DB) or die(mysql_error());

$row_notecm = mysql_fetch_assoc($notecm);

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


   ?></td>
</tr>
  <?php
$seq1++;

} while ($row_mactm = mysql_fetch_assoc($mact)); }
?>
  <tr style="background-color: #cccccc; height: 10px;">
  <th width="15" height="50"><font style="color:blue;">ลำดับ</th>
   <th width="150"><font style="color:blue;">เครื่องจักรกลุ่ม Mobile equipment</th>
   <th width="100">จำนวนเครื่องจักร</th>
   <th width="120">จำนวนต้องการ<br>(คัน/กะเช้า)</th>
   <th width="100"><font style="color:blue;">จำนวนพร้อมใช้</th>
   <th width="40"><font style="color:blue;">PM.</th>
   <th width="40"><font style="color:blue;">CM.</th>
   <th width="250"><font style="color:blue;">หมายเหตุ</th>
  </tr>
  <?php
$seq2 = 1;
if($rowme=="0"){
  echo "<tr><td colspan='8'>ไม่มีข้อมูลในวันนี้</td></tr>";

}else{

do {
 $eqid = $row_macme['Equipment_id'];
           $qpm = "SELECT SUM(CASE WHEN PM_CM='PM' THEN 1 ELSE 0 END) as PM FROM daily_detail WHERE Equipment_id = '$eqid' AND Record_date = '$date' AND finished_date = '' ";

$pm      = mysql_query($qpm, $DB) or die(mysql_error());

$row_pm = mysql_fetch_assoc($pm);
$pmvalue = $row_pm['PM'];
 
           $qcm = "SELECT SUM(CASE WHEN PM_CM='CM' THEN 1 ELSE 0 END) as CM FROM daily_detail WHERE Equipment_id = '$eqid' AND Record_date = '$date' AND finished_date = '' ";

$cm      = mysql_query($qcm, $DB) or die(mysql_error());

$row_cm = mysql_fetch_assoc($cm);
$cmvalue = $row_cm['CM'];
     
    ?>
<tr>
  <td><center><?php echo $seq2; ?></center></td>
  <td><?php echo $row_macme['Equipment_name']; ?></td>
  <td><center><?php echo $row_macme['Equipment_amount']; ?></center></td>
  <td><center><?php echo $row_macme['Equipment_require']; ?></center></td>
  <td><center><?php

    $ald = $row_macme['Equipment_amount'] - $pmvalue - $cmvalue;
    if ($ald < $row_macme['Equipment_require']) {
        echo "<font color='#FF0000'>" . $ald . "</font>";

    } else {
        echo $ald;
    }

    ?></center></td>
  <td><center><?php 

if($pmvalue==""){
  $pmvalue = 0;
}
       
   echo $pmvalue; ?></center></td>
  <td><center><?php 

if($cmvalue==""){
  $cmvalue = 0;
}
       
   echo $cmvalue; ?></center></td>
  <td><?php 
         $eqid = $row_macme['Equipment_id'];
         $total = $cmvalue+$pmvalue;
      $qnotepm = "SELECT * FROM daily_detail WHERE Equipment_id = '$eqid' AND Record_date = '$date' AND PM_CM = 'PM' AND finished_date = '' order by Equipment_number";

$notepm      = mysql_query($qnotepm, $DB) or die(mysql_error());

$row_notepm = mysql_fetch_assoc($notepm);

 $qnotecm = "SELECT * FROM daily_detail WHERE Equipment_id = '$eqid' AND Record_date = '$date' AND PM_CM = 'CM' AND finished_date = '' order by Equipment_number";

$notecm      = mysql_query($qnotecm, $DB) or die(mysql_error());

$row_notecm = mysql_fetch_assoc($notecm);

$qegatno = "SELECT egatno FROM m.equipment WHERE eqtype =".$row_macme['Equipment_type'];

$egatno      = mysql_query($qegatno, $DB) or die(mysql_error());

$row_egatno = mysql_fetch_assoc($egatno);
$numegatno = mysql_num_rows($egatno);
    $prefix = substr($row_egatno['egatno'], 0, 2);
    $first = 0;
      if($total!=0){
      echo "No.".$prefix."-";
      if($pmvalue!=0){
    do {
      if($first==0){
        $suffix = substr($row_notepm['Equipment_number'], 2);
      }else{
        $suffix = substr($row_notepm['Equipment_number'], 3);
      }

      echo $suffix.",";

          $first++;
          
      }
     while ($row_notepm = mysql_fetch_assoc($notepm));
     echo "(PM.)";
    } if($cmvalue!=0){
      do {
         if($first==0){
        $suffixcm = substr($row_notecm['Equipment_number'], 2);
       }else{
        $suffixcm = substr($row_notecm['Equipment_number'], 3);
      }
          $first++;
      echo $suffixcm.",";}
     while ($row_notecm = mysql_fetch_assoc($notecm));
echo "(CM.)";
}


   }


   ?></td>
</tr>
  <?php
$seq2++;

} while ($row_macme = mysql_fetch_assoc($macm)); }
?>
</table></div>
<table width="<?php echo($width); ?>" border="0"><tr ><td colspan = '8'><font style="color:#ff0000; font-size: <?php echo $fontsize; ?>;"><center><?php echo($detail_remarktable['Remark_detail']) ?></center></font></td></tr></table>

<table style="background-color: white; font-size: <?php echo $fontsize; ?>; " >
  <tr ><th align="left" style="font-size: 12px;" colspan="8"><h4><u>รายละเอียดเครื่องจักรระบบขนส่งวัสดุ</u></h4></th></tr>
  


  <?php 
  
    $qtm_detail = "SELECT * FROM daily_detail  WHERE  detail_type = 'tm' AND Record_date = '$date' AND finished_date = '' order by Equipment_number";

$tmdetail     = mysql_query($qtm_detail, $DB) or die(mysql_error());
$rowtmdetail = mysql_num_rows($tmdetail);
$row_tmdetail = mysql_fetch_assoc($tmdetail);
if($nummactde!=0){
if($rowtmdetail==0){
  echo "<tr><td colspan = '8' align = 'left'>เครื่องจักรพร้อมใช้งาน</td></tr>";
}
else{


 do{ 

  if($row_tmdetail['PM_CM']!=""){
  
 if($row_tmdetail['time']=="00:00:00"){
    $time = "";
  }else{
    $secondcut = explode(':',$row_tmdetail['time']);
   $time =  "เวลา ".$secondcut[0].":".$secondcut[1]." น.";
  }
  if($row_tmdetail['date']=="0000-00-00"){
    $datetoshow = "ไม่ทราบวัน";
  }else{
   $datetoshow =  thai_date_short(strtotime($row_tmdetail['date']));
  }
  if($row_tmdetail['action']=="finish" ){
    $action = "มีกำหนดเสร็จ ".thai_date_short(strtotime($row_tmdetail['action_date']));
  }else{
    $action = "ยังไม่มีกำหนดเสร็จ";
  }


  

  


echo "<tr ><td colspan = '8' align = 'left'>".$row_tmdetail['Equipment_number']." ".$row_tmdetail['PM_CM'].".".$row_tmdetail['Description']." (<font style='color:red;'>".$datetoshow." ".$time." อยู่ระหว่างดำเนินการ / ".$action."</font>)".$row_tmdetail['Remark']."</td></tr>";}
}while($row_tmdetail = mysql_fetch_assoc($tmdetail)); }
  }else{

    echo "<tr><td colspan = '8' align = 'left'><h5>ไม่มีข้อมูลในวันนี้</h5></td></tr>";
  } ?>
  
</table>

<tr ><td colspan="8"><font style="  color: red;"><u><?php echo($detail_remarktm['Remark_detail']) ?></u></font></td></tr>
<tr ><td colspan="8"><font style="  color: blue;"><u>บันทึกวันที่ <?php echo thai_date_short(strtotime($detail_remarktm['Log_date'])); ?> เวลา <?php $secondcut = explode(':',$detail_remarktm['Log_time']);
   $time =  "เวลา ".$secondcut[0].":".$secondcut[1]." น."; echo($time) ?></u></font></td></tr>
<table style="background-color: white; font-size: <?php echo $fontsize; ?>; " >
<tr ><th align="left" style="font-size: 12px; color: #008B8B;" colspan="2"><h4><u>รายละเอียดเครื่องจักรกลุ่ม Mobile Equipment</u></h4></th></tr>
<tr><td style="vertical-align: top;" >
  <table style="background-color: white; font-size: <?php echo $fontsize; ?>; " width="<?php echo($width/2) ?>" >
  <tr ><th align="left" colspan = '4'><h4><u><li>บำรุงรักษาเครื่องจักรโดยหบย-ช.</li></u></h4></th></tr>

<?php  
do {  ?>

<tr ><td colspan="4" align="left" style="color: blue; text-decoration: underline;">>><?php echo $row_macmede['Equipment_name']; ?></td></tr>
  <?php 
  $id = $row_macmede['Equipment_id'];

 $qpm = "SELECT SUM(CASE WHEN PM_CM='PM' THEN 1 ELSE 0 END) as PM FROM daily_detail WHERE Equipment_id = '$id' AND Record_date = '$date' AND finished_date = '' ";

$pm      = mysql_query($qpm, $DB) or die(mysql_error());

$row_pm = mysql_fetch_assoc($pm);
$pmvalue = $row_pm['PM'];
 
           $qcm = "SELECT SUM(CASE WHEN PM_CM='CM' THEN 1 ELSE 0 END) as CM FROM daily_detail WHERE Equipment_id = '$id' AND Record_date = '$date' AND finished_date = '' ";

$cm      = mysql_query($qcm, $DB) or die(mysql_error());

$row_cm = mysql_fetch_assoc($cm);
$cmvalue = $row_cm['CM'];


  $total = $pmvalue+$cmvalue;
    $qme_detail = "SELECT * FROM daily_detail  WHERE  Equipment_id = '$id' AND Record_date = '$date' AND finished_date = '' order by Equipment_number";

$medetail     = mysql_query($qme_detail, $DB) or die(mysql_error());
$rowmedetail = mysql_num_rows($medetail);
$row_medetail = mysql_fetch_assoc($medetail);
if($nummacmde!=0){
if($total!=0){
if($rowmedetail==0){
  echo "<tr><td colspan = '4' align = 'left'><h5>ไม่ได้ส่งรายงาน</h5></td></tr>";
}
else{


 do{ 
  if($row_medetail['PM_CM']!=""){
  
 if($row_medetail['time']=="00:00:00"){
    $time = "";
  }else{
   $secondcut = explode(':',$row_medetail['time']);
   $time =  "เวลา ".$secondcut[0].":".$secondcut[1]." น.";
  }
  if($row_medetail['date']=="0000-00-00"){
    $datetoshow = "ไม่ทราบวัน";
  }else{
   $datetoshow =  thai_date_short(strtotime($row_medetail['date']));
  }
  if($row_medetail['action']=="finish" && $row_medetail['action_date']!="0000-00-00"){
    $action = "มีกำหนดเสร็จ ".thai_date_short(strtotime($row_medetail['action_date']));
  }else{
    $action = "ยังไม่มีกำหนดเสร็จ";
  }
   $prefix = substr($row_medetail['Equipment_number'], 0, 2);
      
          $suffix = substr($row_medetail['Equipment_number'], 2);
     

  

  


echo "<tr ><td colspan = '4' align = 'left'>No.$prefix-$suffix ".$row_medetail['PM_CM'].".".$row_medetail['Description']." (<font style='color:red;'>".$datetoshow." ".$time."อยู่ระหว่างดำเนินการ / ".$action."</font>)".$row_medetail['Remark']."</td></tr>";}
}while($row_medetail = mysql_fetch_assoc($medetail)); }}else{
   echo "<tr><td colspan = '4' align = 'left'><h5>เครื่องจักรพร้อมใช้งาน</h5></td></tr>";
}
  }else{
    echo "<tr><td colspan = '4' align = 'left'><h5>ไม่มีข้อมูลในวันนี้</h5></td></tr>";
  } ?>
  
<?php
  
} while ($row_macmede= mysql_fetch_assoc($macmde)); ?>

<tr ><td colspan="4"><font style="  color: #DB19A8;"><u><?php echo($detail_remarkme['Remark_detail']) ?></u></font></td></tr>
<tr ><td colspan="4"><font style="  color: blue;"><u>บันทึกวันที่ <?php echo thai_date_short(strtotime($detail_remarkme['Log_date'])); ?> เวลา <?php $secondcut = explode(':',$detail_remarkme['Log_time']);
   $time =  "เวลา ".$secondcut[0].":".$secondcut[1]." น."; echo($time) ?></u></font></td></tr>
</table>
</td>
<td style="vertical-align: top;" >
 <table style="background-color: white; font-size: <?php echo $fontsize; ?>;  " width="<?php echo($width/2) ?>">
  
<tr><th align="left" colspan="4"><h4><u><li>บำรุงรักษาเครื่องจักรโดยหบต-ช.</li></u></h4></th></tr>
<?php  
do {  ?>

<tr style="position: relative;"><td colspan="4" align="left" style="color: blue; text-decoration: underline;">>><?php echo $row_macmct['Equipment_name']; ?></td></tr>
  <?php 
  $id = $row_macmct['Equipment_id'];
 
 $qpm = "SELECT SUM(CASE WHEN PM_CM='PM' THEN 1 ELSE 0 END) as PM FROM daily_detail WHERE Equipment_id = '$id' AND Record_date = '$date' AND finished_date = '' ";

$pm      = mysql_query($qpm, $DB) or die(mysql_error());

$row_pm = mysql_fetch_assoc($pm);
$pmvalue = $row_pm['PM'];
 
           $qcm = "SELECT SUM(CASE WHEN PM_CM='CM' THEN 1 ELSE 0 END) as CM FROM daily_detail WHERE Equipment_id = '$id' AND Record_date = '$date' AND finished_date = '' ";

$cm      = mysql_query($qcm, $DB) or die(mysql_error());

$row_cm = mysql_fetch_assoc($cm);
$cmvalue = $row_cm['CM'];


  $total = $pmvalue+$cmvalue;
    $qmct_detail = "SELECT * FROM daily_detail  WHERE  Equipment_id = '$id' AND Record_date = '$date' AND finished_date = ''  order by Equipment_number";

$mctdetail     = mysql_query($qmct_detail, $DB) or die(mysql_error());
$rowmctdetail = mysql_num_rows($mctdetail);
$row_mctdetail = mysql_fetch_assoc($mctdetail);
if($nummacmct!=0){
if($total!=0){
if($rowmctdetail==0){
  echo "<tr ><td colspan = '4' align = 'left'><h5>ไม่ได้ส่งรายงาน</h5></td></tr>";
}
else{


 do{ 

  if($row_mctdetail['PM_CM']!=""){
  
 if($row_mctdetail['time']=="00:00:00"){
    $time = "";
  }else{
    $secondcut = explode(':',$row_mctdetail['time']);
   $time =  "เวลา ".$secondcut[0].":".$secondcut[1]." น.";
  }
  if($row_mctdetail['date']=="0000-00-00"){
    $datetoshow = "ไม่ทราบวัน";
  }else{
   $datetoshow =  thai_date_short(strtotime($row_mctdetail['date']));
  }
  if($row_mctdetail['action']=="finish" && $row_mctdetail['action_date']!="0000-00-00"){
    $action = "มีกำหนดเสร็จ ".thai_date_short(strtotime($row_mctdetail['action_date']));
  }else{
    $action = "ยังไม่มีกำหนดเสร็จ";
  }

$prefix = substr($row_mctdetail['Equipment_number'], 0, 2);
      
          $suffix = substr($row_mctdetail['Equipment_number'], 2);
  

  


echo "<tr><td colspan = '4' align = 'left'>No.$prefix-$suffix ".$row_mctdetail['PM_CM'].".".$row_mctdetail['Description']." (<font style='color:red;'>".$datetoshow." ".$time." อยู่ระหว่างดำเนินการ / ".$action."</font>)".$row_mctdetail['Remark']."</td></tr>";}
}while($row_mctdetail = mysql_fetch_assoc($mctdetail)); }}else{
   echo "<tr ><td colspan = '4' align = 'left'><h5>เครื่องจักรพร้อมใช้งาน</h5></td></tr>";
}
  }else{
    echo "<tr ><td colspan = '4' align = 'left'><h5>ไม่มีข้อมูลในวันนี้</h5></td></tr>";
  } ?>
  
<?php
  
} while ($row_macmct = mysql_fetch_assoc($macmct)); ?>

<tr ><td colspan="4"><font style="  color: black;"><u><?php echo($detail_remarkmect['Remark_detail']) ?></u></font></td></tr>
<tr ><td colspan="4"><font style="  color: blue;"><u>บันทึกวันที่ <?php echo thai_date_short(strtotime($detail_remarkmect['Log_date'])); ?> เวลา <?php $secondcut = explode(':',$detail_remarkmect['Log_time']);
   $time =  "เวลา ".$secondcut[0].":".$secondcut[1]." น."; echo($time) ?></u></font></td></tr>
</table></td>
</tr>
</table>

<table style="background-color: #ccffe6; font-size: <?php echo $fontsize; ?>; " >
<tr ><th align="left" style="font-size: 12px; color: #008B8B;" colspan="8"><h4><u>รายละเอียดเครื่องจักรกลุ่ม SERVICE CONTRACT</u></h4></th></tr>



<?php  
do {  ?>

<tr ><td colspan="8" align="left" style="color: blue; text-decoration: underline;">>><?php echo $row_macsc['Equipment_name']; ?></td></tr>
  <?php 
  $id = $row_macsc['Equipment_id'];
 
 $qpm = "SELECT SUM(CASE WHEN PM_CM='PM' THEN 1 ELSE 0 END) as PM FROM daily_detail WHERE Equipment_id = '$id' AND Record_date = '$date' AND finished_date = '' ";

$pm      = mysql_query($qpm, $DB) or die(mysql_error());

$row_pm = mysql_fetch_assoc($pm);
$pmvalue = $row_pm['PM'];
 
           $qcm = "SELECT SUM(CASE WHEN PM_CM='CM' THEN 1 ELSE 0 END) as CM FROM daily_detail WHERE Equipment_id = '$id' AND Record_date = '$date' AND finished_date = '' ";

$cm      = mysql_query($qcm, $DB) or die(mysql_error());

$row_cm = mysql_fetch_assoc($cm);
$cmvalue = $row_cm['CM'];


  $total = $pmvalue+$cmvalue;
    $qsc_detail = "SELECT * FROM daily_detail  WHERE  Equipment_id = '$id' AND Record_date = '$date' AND finished_date = '' order by Equipment_number";

$scdetail     = mysql_query($qsc_detail, $DB) or die(mysql_error());
$rowscdetail = mysql_num_rows($scdetail);
$row_scdetail = mysql_fetch_assoc($scdetail);
if($nummacs!=0){
if($total!=0){
if($rowscdetail==0){
  echo "<tr><td><h5>ไม่ได้ส่งรายงาน</h5></td></tr>";
}
else{


 do{ 

  if($row_scdetail['PM_CM']!=""){
  
 if($row_scdetail['time']=="00:00:00"){
    $time = "";
  }else{
   $secondcut = explode(':',$row_scdetail['time']);
   $time =  "เวลา ".$secondcut[0].":".$secondcut[1]." น.";
  }
  if($row_scdetail['date']=="0000-00-00"){
    $datetoshow = "ไม่ทราบวัน";
  }else{
   $datetoshow =  thai_date_short(strtotime($row_scdetail['date']));
  }
  if($row_scdetail['action']=="finish" && $row_scdetail['action_date']!="0000-00-00"){
    $action = "มีกำหนดเสร็จ ".thai_date_short(strtotime($row_scdetail['action_date']));
  }else{
    $action = "ยังไม่มีกำหนดเสร็จ";
  }
$prefix = substr($row_scdetail['Equipment_number'], 0, 2);
      
          $suffix = substr($row_scdetail['Equipment_number'], 2);
  
echo "<tr ><td colspan = '8' align = 'left'>No.$prefix-$suffix ".$row_scdetail['PM_CM'].".".$row_scdetail['Description']." (<font style='color:red;'>".$datetoshow." ".$time." อยู่ระหว่างดำเนินการ / ".$action."</font>)".$row_scdetail['Remark']."</td></tr>";}
}while($row_scdetail = mysql_fetch_assoc($scdetail)); }
}else{
   echo "<tr><td colspan = '8' align = 'left'><h5>เครื่องจักรพร้อมใช้งาน</h5></td></tr>";
}
  }else{
    echo "<tr><td colspan = '8' align = 'left'><h5>ไม่มีข้อมูลในวันนี้</h5></td></tr>";
  } ?>
  
<?php
  
} while ($row_macsc = mysql_fetch_assoc($macs)); ?>

<tr ><td colspan="8"><font style="  color: blue;"><u><?php echo($detail_remarksc['Remark_detail']) ?></u></font></td></tr>
<tr ><td colspan="8"><font style="  color: blue;"><u>บันทึกวันที่ <?php echo thai_date_short(strtotime($detail_remarksc['Log_date'])); ?> เวลา <?php $secondcut = explode(':',$detail_remarksc['Log_time']);
   $time =  "เวลา ".$secondcut[0].":".$secondcut[1]." น."; echo($time) ?></u></font></td></tr>

</table>



