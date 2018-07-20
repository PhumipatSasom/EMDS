<script type="text/javascript">
  $(function(){
   
 
      

 $("#myBtn1").click(function(){
        $("#myModal1").modal({backdrop: "static"});
    });



  });

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
    
   
    $qtm_detail = "SELECT * FROM daily_detail  WHERE  Equipment_id = '$id' AND Record_date = '$dateshow' ORDER BY Equipment_number";

$tmdetail     = mysql_query($qtm_detail, $DB) or die(mysql_error());
$rowtmdetail = mysql_num_rows($tmdetail);
$row_tmdetail = mysql_fetch_assoc($tmdetail);


    if($rowtmdetail!="0"){
  do{

    if($row_tmdetail['finished_date']==""){
    ?>
     <tr >

    <input type="hidden" value="<?php echo $row_tmdetail['detail_id']; ?>" name="detail_id<?php echo $row; ?>">
     <input type="hidden" value="<?php echo $row_tmdetail['Mac_hour']; ?>" name="machour<?php echo $row; ?>">
   
   
    <td ><?php echo $row_tmdetail['Equipment_number']; ?><input type='hidden' value="<?php echo $row_tmdetail['Equipment_number']; ?>" name='mac-num<?php echo $row; ?>'  maxlength="100" size="6"></td> 
    <td ><input type='radio' <?php  if($row_tmdetail['PM_CM']=="PM") echo"checked" ; ?> name='Remark<?php echo $row; ?>'  value='PM'> PM<br><input type='radio' <?php  if($row_tmdetail['PM_CM']=="CM") echo"checked" ; ?> name='Remark<?php echo $row; ?>'  value='CM'> CM</td>
    <td ><textarea type='text' value="" name='mac-problem<?php echo $row; ?>'  rows="3" cols="60"><?php echo $row_tmdetail['Description']; ?></textarea></td>

    <td ><input type='date' value="<?php if($row_tmdetail['date']=="0000-00-00"){echo $date;}else{echo $row_tmdetail['date'];}  ?>" name='mac-date<?php echo $row; ?>' ><input type='hidden' value="<?php echo $row_tmdetail['time']; ?>" name='mac-time<?php echo $row; ?>'></td>
    <td ><input type='radio' <?php  if($row_tmdetail['action']=="finish") echo"checked" ; ?> name='fix<?php echo $row; ?>' id='fix<?php echo $row; ?>'  value='finish'>มีกำหนดการเสร็จ <input type='date' onchange="radiocheck(<?php echo $row; ?>)" value="<?php echo $row_tmdetail['action_date']; ?>" name='fix-date<?php echo $row; ?>'  ><br><input type='radio' <?php  if($row_tmdetail['action']=="unfinish") echo"checked" ; ?> name='fix<?php echo $row; ?>' value='unfinish'>ยังไม่มีกำหนดเสร็จ</td>
    
    <td><textarea rows="1" cols="3" name='macald<?php echo $row; ?>'><?php echo $row_tmdetail['Remark']; ?></textarea></td> 
    <td><input type="text" name="respone<?php echo $row; ?>" value="<?php echo $row_tmdetail['User_respone']; ?>"></td>
    <td ><center><input type="checkbox" name="fi-tag<?php echo $row; ?>" id ="chfi"></center></td>
    <td ><center><input type="checkbox" name="de-tag<?php echo $row; ?>" id ="chde"></center></td>
<input type='hidden' name='detail_type<?php echo $row; ?>' value='tm'  >
<input type="hidden" name="equipment_id<?php echo $row; ?>"  value="<?php echo $id; ?>">
  </tr>



    <?php
  $row++;
  
 } } while ($row_tmdetail = mysql_fetch_assoc($tmdetail));}  ?>
<?php
  
} while ($row_mactm = mysql_fetch_assoc($mact));} ?>
  
</table>

<br>
Remark: <input type="text" name="detail_remark-tm" size="100" value="<?php echo($detail_remarktm['Remark_detail']) ?>"><input type="hidden" name="detail_remark-tm-id" value="<?php echo($detail_remarktm['Remark_id']) ?>"><button style="float: right;" >บันทักข้อมูล</button><?php if ($btadd==1) { ?><button type="button" class="btn btn-info btn-lg" id="myBtn1" >เพิ่มรายการชำรุด</button><?php } ?>
<br>
<br></div>