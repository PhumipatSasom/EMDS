<?php 
$qmact = "SELECT * FROM equipment_group a inner join m.equipment b on a.Equipment_type = b.eqtype  WHERE a.Equipment_group = 'tm'  GROUP BY a.Equipment_id ORDER BY `a`.`Equipment_id` ASC";

$mact      = mysql_query($qmact, $DB) or die(mysql_error());
$numtm = mysql_num_rows($mact);
$row_mactm = mysql_fetch_assoc($mact);
 ?>
<script type="text/javascript">
  

function radiocheck(val) {
  
     document.getElementById("fix"+val).setAttribute("checked", "checked");
}
</script>
<div id="tm" style="overflow:auto; display: <?php echo $displaytm; ?>;">

<table width="1300" border="1" cellspacing="0" cellpadding="0" style="font-size: 15px; background-color: #ffffff; "  id="me-detail">
   <tr>
    <th colspan="10">
      <font style="color:#ff0000; font-size:20px;"><center>รายละเอียดเครื่องจักรระบบขนส่ง</center></font>
    </th>
  </tr>

  <?php  
  if($numtm!="0"){
do {  
    
    
   $eqmid = $row_mactm['Equipment_id'];
  ?>

<tr  ><td colspan="10" bgcolor="#cccccc"><h4><?php echo $row_mactm['Equipment_name']; ?></h4></td></tr>



  <tr class="<?php echo $row_mactm['Equipment_group']; ?>" id="<?php echo $eqmid; ?>">
   
  
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
$qtm_detailck = "SELECT * FROM daily_detail WHERE Equipment_number = '$eqnum' AND Record_date = '$dateshow' order by Equipment_number";

$tmdetailck     = mysql_query($qtm_detailck, $DB) or die(mysql_error());
$rowtmdetailck = mysql_num_rows($tmdetailck);
$row_tmdetailck = mysql_fetch_assoc($tmdetailck);
if($rowtmdetailck==0){
    ?>
     <tr id="rowat-de<?php echo $row; ?>">

     <input type="hidden" name="detail_id<?php echo $row; ?>">
   
   
    <td >No.<?php echo $row_tmdetail['egatno']; ?><input type='hidden' value="<?php echo $row_tmdetail['egatno']; ?>" name='mac-num<?php echo $row; ?>'  maxlength="100" size="6"></td> 
    <td ><input type='radio'  name='Remark<?php echo $row; ?>'  value='PM'> PM<br><input type='radio'  name='Remark<?php echo $row; ?>'  value='CM'> CM</td>
    <td><input type="text" size="8" name="machour<?php echo $row; ?>"></td>
    <td ><textarea type='text' value="" name='mac-problem<?php echo $row; ?>'  rows="3" cols="60"></textarea></td>

    <td ><input type='date'  name='mac-date<?php echo $row; ?>' ><input type='time'  name='mac-time<?php echo $row; ?>' ></td>
    <td ><input type='radio'  name='fix<?php echo $row; ?>' id='fix<?php echo $row; ?>'  value='finish'>มีกำหนดการเสร็จ <input type='date' onchange="radiocheck(<?php echo $row; ?>)"  name='fix-date<?php echo $row; ?>' ><br><input type='radio' name='fix<?php echo $row; ?>' value='unfinish'>ยังไม่มีกำหนดเสร็จ</td>
    
    <td><textarea rows="1" cols="3" name='macald<?php echo $row; ?>'></textarea></td> 
    <td><textarea rows="1" cols="10" name="respone<?php echo $row; ?>"></textarea> </td>
    <td ><center><input type="checkbox" name="fi-tag<?php echo $row; ?>" id ="chfi"></center></td>
    <td ><center><input type="checkbox" name="de-tag<?php echo $row; ?>" id ="chde"></center></td>
<input type='hidden' name='detail_type<?php echo $row; ?>' value='tm'  >
<input type="hidden" name="equipment_id<?php echo $row; ?>"  value="<?php echo $id; ?>">
  </tr>
  <?php
}else{
?>
<tr id="rowat-de<?php echo $row; ?>">

    <input type="hidden" value="<?php echo $row_tmdetailck['detail_id']; ?>" name="detail_id<?php echo $row; ?>">
   
   
    <td >No.<?php echo $row_tmdetailck['Equipment_number']; ?><input type='hidden' value="<?php echo $row_tmdetailck['Equipment_number']; ?>" name='mac-num<?php echo $row; ?>'  maxlength="100" size="6"></td> 
    <td ><input type='radio' <?php  if($row_tmdetailck['PM_CM']=="PM") echo"checked" ; ?> name='Remark<?php echo $row; ?>'  value='PM'> PM<br><input type='radio' <?php  if($row_tmdetailck['PM_CM']=="CM") echo"checked" ; ?> name='Remark<?php echo $row; ?>'  value='CM'> CM</td>
     <td><input type="text" size="8" name="machour<?php echo $row; ?>" value="<?php echo $row_tmdetailck['Mac_hour']; ?>"></td>
    <td ><textarea type='text' value="" name='mac-problem<?php echo $row; ?>'  rows="3" cols="60"><?php echo $row_tmdetailck['Description']; ?></textarea></td>

    <td ><input type='date' value="<?php if($row_tmdetailck['date']=="0000-00-00"){echo $date;}else{echo $row_tmdetailck['date'];}  ?>" name='mac-date<?php echo $row; ?>' ><input type='time' value="<?php echo $row_tmdetailck['time']; ?>" name='mac-time<?php echo $row; ?>' ></td>
    <td ><input type='radio' <?php  if($row_tmdetailck['action']=="finish") echo"checked" ; ?> name='fix<?php echo $row; ?>' id='fix<?php echo $row; ?>'  value='finish'>มีกำหนดการเสร็จ <input type='date' onchange="radiocheck(<?php echo $row; ?>)" value="<?php echo $row_tmdetailck['action_date']; ?>" name='fix-date<?php echo $row; ?>' ><br><input type='radio' <?php  if($row_tmdetailck['action']=="unfinish") echo"checked" ; ?> name='fix<?php echo $row; ?>' value='unfinish'>ยังไม่มีกำหนดเสร็จ</td>
    
    <td><textarea rows="1" cols="3" name='macald<?php echo $row; ?>'><?php echo $row_tmdetailck['Remark']; ?></textarea></td> 
    <td><textarea rows="1" cols="10" name="respone<?php echo $row; ?>"><?php echo $row_tmdetailck['User_respone']; ?></textarea></td>
    <td ><center><input type="checkbox" name="fi-tag<?php echo $row; ?>" id ="chfi"></center></td>
    <td ><center><input type="checkbox" name="de-tag<?php echo $row; ?>" id ="chde"></center></td>
<input type='hidden' name='detail_type<?php echo $row; ?>' value='tm'  >
<input type="hidden" name="equipment_id<?php echo $row; ?>"  value="<?php echo $id; ?>">
  </tr>


    <?php
  }$row++;
  
  } while ($row_tmdetail = mysql_fetch_assoc($tmdetail));}  ?>
<?php
  
} while ($row_mactm = mysql_fetch_assoc($mact));} ?>
  
</table>

<br>
Remark: <input type="text" name="detail_remark-tm" size="100" value="<?php echo($detail_remarktm['Remark_detail']) ?>"><input type="hidden" name="detail_remark-tm-id" value="<?php echo($detail_remarktm['Remark_id']) ?>"><button style="float: right;" >บันทักข้อมูล</button>
<br>
<br></div>