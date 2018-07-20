<script type="text/javascript">
  $(function(){
   
 
      

 $("#myBtn3").click(function(){
        $("#myModal3").modal({backdrop: "static"});
    });



  });
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

   $eqtype = substr($row_macme_ct['egatno'], 0, 2);
$eqmid = $row_macme_ct['Equipment_id'];
  ?>

<tr ><td colspan="10" bgcolor="#cccccc"><h4><?php echo $row_macme_ct['Equipment_name']; ?>(หมายเลข <?php echo $eqtype; ?>)</h4></td></tr>
  <tr class="<?php echo $row_macme_ct['Equipment_group']; ?>" id="<?php echo $eqmid; ?>">
   
  
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

    $id = $row_macme_ct['Equipment_id'];
    
    
    $qmect_detail = "SELECT * FROM daily_detail  WHERE  Equipment_id = '$id' AND Record_date = '$dateshow' ORDER BY Equipment_number";

$mectdetail     = mysql_query($qmect_detail, $DB) or die(mysql_error());
$rowmectdetail = mysql_num_rows($mectdetail);
$row_mectdetail = mysql_fetch_assoc($mectdetail);

if($rowmectdetail!="0"){
    
   do{
      if($row_mectdetail['finished_date']==""){

    ?>
     <tr id="rowat-de<?php echo $row; ?>">

    <input type="hidden" value="<?php echo $row_mectdetail['detail_id']; ?>" name="detail_id<?php echo $row; ?>">
     <input type="hidden" value="<?php echo $row_mectdetail['Mac_hour']; ?>" name="machour<?php echo $row; ?>">
   
   
    <td >No.<?php echo $row_mectdetail['Equipment_number']; ?><input type='hidden' value="<?php echo $row_mectdetail['Equipment_number']; ?>" name='mac-num<?php echo $row; ?>'  maxlength="100" size="6"></td> 
    <td ><input type='radio' <?php  if($row_mectdetail['PM_CM']=="PM") echo"checked" ; ?> name='Remark<?php echo $row; ?>'  value='PM'> PM<br><input type='radio' <?php  if($row_mectdetail['PM_CM']=="CM") echo"checked" ; ?> name='Remark<?php echo $row; ?>'  value='CM'> CM</td>
    <td ><textarea type='text' value="" name='mac-problem<?php echo $row; ?>'  rows="3" cols="60"><?php echo $row_mectdetail['Description']; ?></textarea></td>

    <td ><input type='date' value="<?php if($row_mectdetail['date']=="0000-00-00"){echo $date;}else{echo $row_mectdetail['date'];}  ?>" name='mac-date<?php echo $row; ?>' ><input type='time' value="<?php echo $row_mectdetail['time']; ?>" name='mac-time<?php echo $row; ?>' ></td>
    <td ><input type='radio' <?php  if($row_mectdetail['action']=="finish") echo"checked" ; ?> name='fix<?php echo $row; ?>' id='fix<?php echo $row; ?>'  value='finish'>มีกำหนดการเสร็จ <input type='date' onchange="radiocheck(<?php echo $row; ?>)" value="<?php echo $row_mectdetail['action_date']; ?>" name='fix-date<?php echo $row; ?>' ><br><input type='radio' <?php  if($row_mectdetail['action']=="unfinish") echo"checked" ; ?> name='fix<?php echo $row; ?>' value='unfinish'>ยังไม่มีกำหนดเสร็จ</td>
    
    <td><textarea rows="1" cols="3" name='macald<?php echo $row; ?>'><?php echo $row_mectdetail['Remark']; ?></textarea></td> 
    <td><input type="text" name="respone<?php echo $row; ?>" value="<?php echo $row_mectdetail['User_respone']; ?>"></td>
    <td ><center><input type="checkbox" name="fi-tag<?php echo $row; ?>" id ="chfi"></center></td>
    <td ><center><input type="checkbox" name="de-tag<?php echo $row; ?>" id ="chde"></center></td>
<input type='hidden' name='detail_type<?php echo $row; ?>' value='me_ct'  >
<input type="hidden" name="equipment_id<?php echo $row; ?>"  value="<?php echo $id; ?>">
  </tr>



    <?php
  $row++;
  
 } } while ($row_mectdetail = mysql_fetch_assoc($mectdetail));}?>

  
  
<?php
  
} while ($row_macme_ct = mysql_fetch_assoc($macm_ct)); }?>
</table>

<br>

Remark (หบต-ช.): <input type="text" name="detail_remark-me-2" size="100" value="<?php echo($detail_remarkme_2['Remark_detail']) ?>"><input type="hidden" name="detail_remark-me-id-2" value="<?php echo($detail_remarkme_2['Remark_id']) ?>"><button style="float: right;" >บันทักข้อมูล</button><?php if ($btadd==1) { ?><button type="button" class="btn btn-info btn-lg" id="myBtn3" >เพิ่มรายการชำรุด</button><?php } ?>
<br>
<br></div>