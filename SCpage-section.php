<?php 
   $qmacs = "SELECT * FROM equipment_group a inner join m.equipment b on a.Equipment_type = b.eqtype WHERE a.Equipment_group = 'sc'  GROUP BY a.Equipment_id ORDER BY `a`.`Equipment_id` ASC";

$macs      = mysql_query($qmacs, $DB) or die(mysql_error());
$numsc = mysql_num_rows($macs);
$row_macsc = mysql_fetch_assoc($macs);
 ?><script type="text/javascript">
  
function radiocheck(val) {
  
     document.getElementById("fix"+val).setAttribute("checked", "checked");
}
</script>
<div id="sc" style="overflow:auto; display: <?php echo $displaysc; ?>;">
<table width="1300" border="1" cellspacing="0" cellpadding="0" style="font-size: 15px; background-color: #ffffff; "  id="sc-detail">
   
<tr ><th align="center" colspan="10"><font style="color:#ff0000; font-size:20px;"><center>รายละเอียดเครื่องจักรกลุ่ม Service Contract</center></font></th></tr>

  
<?php  
if($numsc!="0"){
do {  

   
$eqmid = $row_macsc['Equipment_id'];
  ?>

<tr ><td colspan="10" bgcolor="#cccccc"><h4><?php echo $row_macsc['Equipment_name']; ?></h4></td></tr>
  <tr class="<?php echo $row_macsc['Equipment_group']; ?>" id="<?php echo $eqmid; ?>">
   
  
   <th >หมายเลข</th>
   <th >PM/CM</th>
   <th >ชั่วโมงเครื่องจักร</th>
   <th >อาการ</th>

   <th >วันที่จอดเครื่องจักร</th>
   <th >การแก้ไข</th>
   
   <th >Remark</th>
   <th >ผู้รับผิดชอบ</th>
    <th >แล้วเสร็จ</th>
   <th >ลบ</th>

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
$qsc_detailck = "SELECT * FROM daily_detail WHERE Equipment_number = '$eqnum' AND Record_date = '$dateshow' order by Equipment_number";

$scdetailck     = mysql_query($qsc_detailck, $DB) or die(mysql_error());
$rowscdetailck = mysql_num_rows($scdetailck);
$row_scdetailck = mysql_fetch_assoc($scdetailck);
if($rowscdetailck==0){
  ?>
    <tr id="rowat-de<?php echo $row; ?>">

     <input type="hidden" name="detail_id<?php echo $row; ?>">
   
   
    <td >No.<?php echo $row_scdetail['egatno']; ?><input type='hidden' value="<?php echo $row_scdetail['egatno']; ?>" name='mac-num<?php echo $row; ?>'  maxlength="100" size="6"></td> 
    <td ><input type='radio'  name='Remark<?php echo $row; ?>'  value='PM'> PM<br><input type='radio'  name='Remark<?php echo $row; ?>'  value='CM'> CM<br><input type='radio'  name='Remark<?php echo $row; ?>'  value=''> ปกติ</td>
    <td><input type="text" size="8" name="machour<?php echo $row; ?>"></td>
    <td ><textarea type='text' value="" name='mac-problem<?php echo $row; ?>'  rows="3" cols="40"></textarea></td>

    <td ><input type='date'  name='mac-date<?php echo $row; ?>' ><input type='time'  name='mac-time<?php echo $row; ?>' ></td>
    <td ><input type='radio'  name='fix<?php echo $row; ?>' id='fix<?php echo $row; ?>'  value='finish'>มีกำหนดการเสร็จ <input type='date' onchange="radiocheck(<?php echo $row; ?>)"  name='fix-date<?php echo $row; ?>' ><br><input type='radio' name='fix<?php echo $row; ?>' value='unfinish'>ยังไม่มีกำหนดเสร็จ</td>
    
    <td><textarea rows="3" cols="17" name='macald<?php echo $row; ?>'></textarea></td> 
    <td><textarea rows="1" cols="10" name="respone<?php echo $row; ?>"></textarea> </td>
    <td ><center><input type="checkbox" name="fi-tag<?php echo $row; ?>" id ="chfi"></center></td>
    <td ><center><input type="checkbox" name="de-tag<?php echo $row; ?>" id ="chde"></center></td>
<input type='hidden' name='detail_type<?php echo $row; ?>' value='sc'  >
<input type="hidden" name="equipment_id<?php echo $row; ?>"  value="<?php echo $id; ?>">
  </tr>
  <?php
}else{
   if($row_scdetailck['finished_date']==""){
?>
<tr id="rowat-de<?php echo $row; ?>">

    <input type="hidden" value="<?php echo $row_scdetailck['detail_id']; ?>" name="detail_id<?php echo $row; ?>">
   
   
    <td >No.<?php echo $row_scdetailck['Equipment_number']; ?><input type='hidden' value="<?php echo $row_scdetailck['Equipment_number']; ?>" name='mac-num<?php echo $row; ?>'  maxlength="100" size="6"></td> 
    <td ><input type='radio' <?php  if($row_scdetailck['PM_CM']=="PM") echo"checked" ; ?> name='Remark<?php echo $row; ?>'  value='PM'> PM<br><input type='radio' <?php  if($row_scdetailck['PM_CM']=="CM") echo"checked" ; ?> name='Remark<?php echo $row; ?>'  value='CM'> CM<br><input type='radio' <?php  if($row_scdetailck['PM_CM']=="") echo"checked" ; ?> name='Remark<?php echo $row; ?>'  value=''> ปกติ</td>
     <td><input type="text" size="8" name="machour<?php echo $row; ?>" value="<?php echo $row_scdetailck['Mac_hour']; ?>"></td>
    <td ><textarea type='text' value="" name='mac-problem<?php echo $row; ?>'  rows="3" cols="40"><?php echo $row_scdetailck['Description']; ?></textarea></td>

    <td ><input type='date' value="<?php if($row_scdetailck['date']=="0000-00-00"){echo $date;}else{echo $row_scdetailck['date'];}  ?>" name='mac-date<?php echo $row; ?>' ><input type='time' value="<?php echo $row_scdetailck['time']; ?>" name='mac-time<?php echo $row; ?>' ></td>
    <td ><input type='radio' <?php  if($row_scdetailck['action']=="finish") echo"checked" ; ?> name='fix<?php echo $row; ?>' id='fix<?php echo $row; ?>'  value='finish'>มีกำหนดการเสร็จ <input type='date' onchange="radiocheck(<?php echo $row; ?>)" value="<?php echo $row_scdetailck['action_date']; ?>" name='fix-date<?php echo $row; ?>' ><br><input type='radio' <?php  if($row_scdetailck['action']=="unfinish") echo"checked" ; ?> name='fix<?php echo $row; ?>' value='unfinish'>ยังไม่มีกำหนดเสร็จ</td>
    
    <td><textarea rows="3" cols="17" name='macald<?php echo $row; ?>'><?php echo $row_scdetailck['Remark']; ?></textarea></td> 
    <td><textarea rows="1" cols="10" name="respone<?php echo $row; ?>"><?php echo $row_scdetailck['User_respone']; ?></textarea></td>
    <td ><center><input type="checkbox" name="fi-tag<?php echo $row; ?>" id ="chfi"></center></td>
    <td ><center><input type="checkbox" name="de-tag<?php echo $row; ?>" id ="chde"></center></td>
<input type='hidden' name='detail_type<?php echo $row; ?>' value='sc'  >
<input type="hidden" name="equipment_id<?php echo $row; ?>"  value="<?php echo $id; ?>">
  </tr>
  <?php
}else{
?>
<tr id="rowat-de<?php echo $row; ?>">

     <input type="hidden" value="<?php echo $row_scdetailck['detail_id']; ?>" name="detail_id<?php echo $row; ?>">
   
   
    <td >No.<?php echo $row_scdetail['egatno']; ?><input type='hidden' value="<?php echo $row_scdetail['egatno']; ?>" name='mac-num<?php echo $row; ?>'  maxlength="100" size="6"></td> 
    <td colspan="9" height="60"><center>แล้วเสร็จ <input type="checkbox" name="cancel<?php echo $row; ?>" value="cancel"><font color="red"> *ยกเลิกการแล้วเสร็จ</font></center></td>
     <input type='hidden' name='detail_type<?php echo $row; ?>' value='sc'  >
<input type="hidden" name="equipment_id<?php echo $row; ?>"  value="<?php echo $id; ?>">
     </tr>
<?php
  }}
  $row++;
  } while ($row_scdetail = mysql_fetch_assoc($scdetail));}
 ?>

  
  
<?php
  
} while ($row_macsc = mysql_fetch_assoc($macs)); }?>
</table>

<br>

Remark: <input type="text" name="detail_remark-sc" size="100" value="<?php echo($detail_remarksc['Remark_detail']) ?>"><input type="hidden" name="detail_remark-sc-id" value="<?php echo($detail_remarksc['Remark_id']) ?>">
<br>
<br></div>