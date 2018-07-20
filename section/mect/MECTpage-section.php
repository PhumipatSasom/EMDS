<?php 
   $qmacm_ct = "SELECT * FROM equipment_group a inner join m.equipment b on a.Equipment_type = b.eqtype WHERE a.Equipment_group = 'me_ct' GROUP BY a.Equipment_id ORDER BY `a`.`Equipment_id` ASC";

$macm_ct      = mysql_query($qmacm_ct, $DB) or die(mysql_error());
$nummct = mysql_num_rows($macm_ct);
$row_macme_ct = mysql_fetch_assoc($macm_ct);
 ?><script type="text/javascript">
  
function radiocheck(val) {
  
     document.getElementById("fix"+val).setAttribute("checked", "checked");
}
</script>
<div id="mect" style="overflow:auto; display: <?php echo $displaymect; ?>;">
<table width="1300" border="1" cellspacing="0" cellpadding="0" style="font-size: 15px; background-color: #ffffff; "  id="me-detail">
   
<tr ><th align="left" colspan="10"><u><li>บำรุงรักษาเครื่องจักรโดยหบต-ช.</u></b></th></tr>

  
<?php  
if($nummct!="0"){
do {  

   
$eqmid = $row_macme_ct['Equipment_id'];
  ?>

<tr ><td colspan="10" bgcolor="#cccccc"><h4><?php echo $row_macme_ct['Equipment_name']; ?></h4></td></tr>
  <tr class="<?php echo $row_macme_ct['Equipment_group']; ?>" id="<?php echo $eqmid; ?>">
   
  
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

    $id = $row_macme_ct['Equipment_id'];
    $eqtype = $row_macme_ct['eqtype'];
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
$qmct_detailck = "SELECT * FROM daily_detail WHERE Equipment_number = '$eqnum' AND Record_date = '$dateshow' order by Equipment_number";

$mctdetailck     = mysql_query($qmct_detailck, $DB) or die(mysql_error());
$rowmctdetailck = mysql_num_rows($mctdetailck);
$row_mctdetailck = mysql_fetch_assoc($mctdetailck);
if($rowmctdetailck==0){
  ?>
    <tr id="rowat-de<?php echo $row; ?>">

     <input type="hidden" name="detail_id<?php echo $row; ?>">
   
   
    <td >No.<?php echo $row_mectdetail['egatno']; ?><input type='hidden' value="<?php echo $row_mectdetail['egatno']; ?>" name='mac-num<?php echo $row; ?>'  maxlength="100" size="6"></td> 
    <td ><input type='radio'  name='Remark<?php echo $row; ?>'  value='PM'> PM<br><input type='radio'  name='Remark<?php echo $row; ?>'  value='CM'> CM</td>
    <td><input type="text" size="8" name="machour<?php echo $row; ?>"></td>
    <td ><textarea type='text' value="" name='mac-problem<?php echo $row; ?>'  rows="3" cols="60"></textarea></td>

    <td ><input type='date'  name='mac-date<?php echo $row; ?>' ><input type='time'  name='mac-time<?php echo $row; ?>' ></td>
    <td ><input type='radio'  name='fix<?php echo $row; ?>' id='fix<?php echo $row; ?>'  value='finish'>มีกำหนดการเสร็จ <input type='date' onchange="radiocheck(<?php echo $row; ?>)"  name='fix-date<?php echo $row; ?>' ><br><input type='radio' name='fix<?php echo $row; ?>' value='unfinish'>ยังไม่มีกำหนดเสร็จ</td>
    
    <td><textarea rows="1" cols="3" name='macald<?php echo $row; ?>'></textarea></td> 
    <td><textarea rows="1" cols="10" name="respone<?php echo $row; ?>"></textarea> </td>
    <td ><center><input type="checkbox" name="fi-tag<?php echo $row; ?>" id ="chfi"></center></td>
    <td ><center><input type="checkbox" name="de-tag<?php echo $row; ?>" id ="chde"></center></td>
<input type='hidden' name='detail_type<?php echo $row; ?>' value='me_ct'  >
<input type="hidden" name="equipment_id<?php echo $row; ?>"  value="<?php echo $id; ?>">
  </tr>
  <?php
}else{
   if($row_mctdetailck['finished_date']==""){
?>
<tr id="rowat-de<?php echo $row; ?>">

    <input type="hidden" value="<?php echo $row_mctdetailck['detail_id']; ?>" name="detail_id<?php echo $row; ?>">
   
   
    <td >No.<?php echo $row_mctdetailck['Equipment_number']; ?><input type='hidden' value="<?php echo $row_mctdetailck['Equipment_number']; ?>" name='mac-num<?php echo $row; ?>'  maxlength="100" size="6"></td> 
    <td ><input type='radio' <?php  if($row_mctdetailck['PM_CM']=="PM") echo"checked" ; ?> name='Remark<?php echo $row; ?>'  value='PM'> PM<br><input type='radio' <?php  if($row_mctdetailck['PM_CM']=="CM") echo"checked" ; ?> name='Remark<?php echo $row; ?>'  value='CM'> CM</td>
     <td><input type="text" size="8" name="machour<?php echo $row; ?>" value="<?php echo $row_mctdetailck['Mac_hour']; ?>"></td>
    <td ><textarea type='text' value="" name='mac-problem<?php echo $row; ?>'  rows="3" cols="60"><?php echo $row_mctdetailck['Description']; ?></textarea></td>

    <td ><input type='date' value="<?php if($row_mctdetailck['date']=="0000-00-00"){echo $date;}else{echo $row_mctdetailck['date'];}  ?>" name='mac-date<?php echo $row; ?>' ><input type='time' value="<?php echo $row_mctdetailck['time']; ?>" name='mac-time<?php echo $row; ?>' ></td>
    <td ><input type='radio' <?php  if($row_mctdetailck['action']=="finish") echo"checked" ; ?> name='fix<?php echo $row; ?>' id='fix<?php echo $row; ?>'  value='finish'>มีกำหนดการเสร็จ <input type='date' onchange="radiocheck(<?php echo $row; ?>)" value="<?php echo $row_mctdetailck['action_date']; ?>" name='fix-date<?php echo $row; ?>' ><br><input type='radio' <?php  if($row_mctdetailck['action']=="unfinish") echo"checked" ; ?> name='fix<?php echo $row; ?>' value='unfinish'>ยังไม่มีกำหนดเสร็จ</td>
    
    <td><textarea rows="1" cols="3" name='macald<?php echo $row; ?>'><?php echo $row_mctdetailck['Remark']; ?></textarea></td> 
    <td><textarea rows="1" cols="10" name="respone<?php echo $row; ?>"><?php echo $row_mctdetailck['User_respone']; ?></textarea></td>
    <td ><center><input type="checkbox" name="fi-tag<?php echo $row; ?>" id ="chfi"></center></td>
    <td ><center><input type="checkbox" name="de-tag<?php echo $row; ?>" id ="chde"></center></td>
<input type='hidden' name='detail_type<?php echo $row; ?>' value='me_ct'  >
<input type="hidden" name="equipment_id<?php echo $row; ?>"  value="<?php echo $id; ?>">
  </tr>
  <?php
}else{
?>
<tr id="rowat-de<?php echo $row; ?>">

     <input type="hidden" name="detail_id<?php echo $row; ?>">
   
   
    <td >No.<?php echo $row_mectdetail['egatno']; ?><input type='hidden' value="<?php echo $row_mectdetail['egatno']; ?>" name='mac-num<?php echo $row; ?>'  maxlength="100" size="6"></td> 
    <td colspan="9" height="60"><center>แล้วเสร็จ</center></td>
    <input type='hidden' name='detail_type<?php echo $row; ?>' value='me_ct'  >
<input type="hidden" name="equipment_id<?php echo $row; ?>"  value="<?php echo $id; ?>">
     </tr>
<?php
  }}
  $row++;
  } while ($row_mectdetail = mysql_fetch_assoc($mectdetail));}
 ?>

  
  
<?php
  
} while ($row_macme_ct = mysql_fetch_assoc($macm_ct)); }?>
</table>

<br>

Remark (หบต-ช.): <input type="text" name="detail_remark-me-2" size="100" value="<?php echo($detail_remarkme_2['Remark_detail']) ?>"><input type="hidden" name="detail_remark-me-id-2" value="<?php echo($detail_remarkme_2['Remark_id']) ?>"><button style="float: right;" >บันทักข้อมูล</button>
<br>
<br></div>