<?php 
   $qmacm = "SELECT * FROM equipment_group a inner join m.equipment b on a.Equipment_type = b.eqtype  WHERE a.Equipment_group = 'me'  GROUP BY a.Equipment_id ORDER BY `a`.`Equipment_id` ASC";

$macm      = mysql_query($qmacm, $DB) or die(mysql_error());
$numme = mysql_num_rows($macm);
$row_macme = mysql_fetch_assoc($macm);
 ?>
<script type="text/javascript">
 
function radiocheck(val) {
  
     document.getElementById("fix"+val).setAttribute("checked", "checked");
}
</script>
<div id="me" style="overflow:auto; display: <?php echo $displayme; ?>;">
<table width="1300" border="1" cellspacing="0" cellpadding="0" style="font-size: 15px; background-color: #ffffff; "  id="me-detail">
   <tr>
    <th colspan="10">
      <font style="color:#ff0000; font-size:20px;"><center>รายละเอียดเครื่องจักรกลุ่ม Mobile equipment</center></font>
    </th>
  </tr>
<tr ><th align="left" colspan = '10'><u><li>บำรุงรักษาเครื่องจักรโดยหบย-ช.</u></b></th></tr>
  
<?php  

if($numme!="0"){
do {  
    
     
$eqmid = $row_macme['Equipment_id'];
  ?>

<tr ><td colspan="10" bgcolor="#cccccc"><h4><?php echo $row_macme['Equipment_name']; ?></h4></td></tr>
  <tr class="<?php echo $row_macme['Equipment_group']; ?>" id="<?php echo $eqmid; ?>">
   
  
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

    $id = $row_macme['Equipment_id'];
     $eqtype = $row_macme['eqtype'];
   
    $qme_detail = "SELECT * FROM m.equipment  WHERE eqtype='$eqtype' order by egatno";

$medetail     = mysql_query($qme_detail, $DB) or die(mysql_error());
$rowmedetail = mysql_num_rows($medetail);
$row_medetail = mysql_fetch_assoc($medetail);

if($rowmedetail!="0"){
    
 do {
   $eqnum = $row_medetail['egatno'];
$qme_detailck = "SELECT * FROM daily_detail WHERE Equipment_number = '$eqnum' AND Record_date = '$dateshow' order by Equipment_number";

$medetailck     = mysql_query($qme_detailck, $DB) or die(mysql_error());
$rowmedetailck = mysql_num_rows($medetailck);
$row_medetailck = mysql_fetch_assoc($medetailck);
if($rowmedetailck==0){
    ?>
 <tr id="rowat-de<?php echo $row; ?>">

     <input type="hidden" name="detail_id<?php echo $row; ?>">
   
   
    <td >No.<?php echo $row_medetail['egatno']; ?><input type='hidden' value="<?php echo $row_medetail['egatno']; ?>" name='mac-num<?php echo $row; ?>'  maxlength="100" size="6"></td> 
    <td ><input type='radio'  name='Remark<?php echo $row; ?>'  value='PM'> PM<br><input type='radio'  name='Remark<?php echo $row; ?>'  value='CM'> CM<br><input type='radio'  name='Remark<?php echo $row; ?>'  value=''> ปกติ</td>
    <td><input type="text" size="8" name="machour<?php echo $row; ?>"></td>
    <td ><textarea type='text' value="" name='mac-problem<?php echo $row; ?>'  rows="3" cols="40"></textarea></td>

    <td ><input type='date'  name='mac-date<?php echo $row; ?>' ><input type='time'  name='mac-time<?php echo $row; ?>' ></td>
    <td ><input type='radio'  name='fix<?php echo $row; ?>' id='fix<?php echo $row; ?>'  value='finish'>มีกำหนดการเสร็จ <input type='date' onchange="radiocheck(<?php echo $row; ?>)"  name='fix-date<?php echo $row; ?>' ><br><input type='radio' name='fix<?php echo $row; ?>' value='unfinish'>ยังไม่มีกำหนดเสร็จ</td>
    
    <td><textarea rows="3" cols="17" name='macald<?php echo $row; ?>'></textarea></td> 
    <td><textarea rows="1" cols="10" name="respone<?php echo $row; ?>"></textarea> </td>
    <td ><center><input type="checkbox" name="fi-tag<?php echo $row; ?>" id ="chfi"></center></td>
    <td ><center><input type="checkbox" name="de-tag<?php echo $row; ?>" id ="chde"></center></td>
<input type='hidden' name='detail_type<?php echo $row; ?>' value='me'  >
<input type="hidden" name="equipment_id<?php echo $row; ?>"  value="<?php echo $id; ?>">
  </tr>
  <?php
}else{
  if($row_medetailck['finished_date']==""){
?>
<tr id="rowat-de<?php echo $row; ?>">

    <input type="hidden" value="<?php echo $row_medetailck['detail_id']; ?>" name="detail_id<?php echo $row; ?>">
   
   
    <td >No.<?php echo $row_medetailck['Equipment_number']; ?><input type='hidden' value="<?php echo $row_medetailck['Equipment_number']; ?>" name='mac-num<?php echo $row; ?>'  maxlength="100" size="6"></td> 
    <td ><input type='radio' <?php  if($row_medetailck['PM_CM']=="PM") echo"checked" ; ?> name='Remark<?php echo $row; ?>'  value='PM'> PM<br><input type='radio' <?php  if($row_medetailck['PM_CM']=="CM") echo"checked" ; ?> name='Remark<?php echo $row; ?>'  value='CM'> CM<br><input type='radio' <?php  if($row_medetailck['PM_CM']=="") echo"checked" ; ?> name='Remark<?php echo $row; ?>'  value=''> ปกติ</td>
     <td><input type="text" size="8" name="machour<?php echo $row; ?>" value="<?php echo $row_medetailck['Mac_hour']; ?>"></td>
    <td ><textarea type='text' value="" name='mac-problem<?php echo $row; ?>'  rows="3" cols="40"><?php echo $row_medetailck['Description']; ?></textarea></td>

    <td ><input type='date' value="<?php if($row_medetailck['date']=="0000-00-00"){echo $date;}else{echo $row_medetailck['date'];}  ?>" name='mac-date<?php echo $row; ?>' ><input type='time' value="<?php echo $row_medetailck['time']; ?>" name='mac-time<?php echo $row; ?>' ></td>
    <td ><input type='radio' <?php  if($row_medetailck['action']=="finish") echo"checked" ; ?> name='fix<?php echo $row; ?>' id='fix<?php echo $row; ?>'  value='finish'>มีกำหนดการเสร็จ <input type='date' onchange="radiocheck(<?php echo $row; ?>)" value="<?php echo $row_medetailck['action_date']; ?>" name='fix-date<?php echo $row; ?>' ><br><input type='radio' <?php  if($row_medetailck['action']=="unfinish") echo"checked" ; ?> name='fix<?php echo $row; ?>' value='unfinish'>ยังไม่มีกำหนดเสร็จ</td>
    
    <td><textarea rows="3" cols="17" name='macald<?php echo $row; ?>'><?php echo $row_medetailck['Remark']; ?></textarea></td> 
    <td><textarea rows="1" cols="10" name="respone<?php echo $row; ?>"><?php echo $row_medetailck['User_respone']; ?></textarea></td>
    <td ><center><input type="checkbox" name="fi-tag<?php echo $row; ?>" id ="chfi"></center></td>
    <td ><center><input type="checkbox" name="de-tag<?php echo $row; ?>" id ="chde"></center></td>
<input type='hidden' name='detail_type<?php echo $row; ?>' value='me'  >
<input type="hidden" name="equipment_id<?php echo $row; ?>"  value="<?php echo $id; ?>">
  </tr>
    <?php
  }else{
    ?>
<tr id="rowat-de<?php echo $row; ?>">

     <input type="hidden" value="<?php echo $row_medetailck['detail_id']; ?>" name="detail_id<?php echo $row; ?>">
   
   
    <td >No.<?php echo $row_medetail['egatno']; ?><input type='hidden' value="<?php echo $row_medetail['egatno']; ?>" name='mac-num<?php echo $row; ?>'  maxlength="100" size="6"></td> 
    <td colspan="9" height="60"><center>แล้วเสร็จ <input type="checkbox" name="cancel<?php echo $row; ?>" value="cancel"><font color="red"> *ยกเลิกการแล้วเสร็จ</font></center></td>
     <input type='hidden' name='detail_type<?php echo $row; ?>' value='me'  >
<input type="hidden" name="equipment_id<?php echo $row; ?>"  value="<?php echo $id; ?>">
     </tr>
    <?php
  }

}
  $row++;
  
  } while ($row_medetail = mysql_fetch_assoc($medetail));} ?>

  
  
<?php
  
} while ($row_macme = mysql_fetch_assoc($macm)); }?>
</table>

<br>
Remark (หบย-ช.): <input type="text" name="detail_remark-me" size="100" value="<?php echo($detail_remarkme['Remark_detail']) ?>"><input type="hidden" name="detail_remark-me-id" value="<?php echo($detail_remarkme['Remark_id']) ?>"><button style="float: right;" >บันทักข้อมูล</button>
<br>
<br></div>