
  
<script type="text/javascript">


$(function(){
  
 $("#myBtn4").click(function(){
        $("#myModal4").modal({backdrop: "static"});
    });


}); 
 

   function radiocheck(val) {
  
     document.getElementById("fix"+val).setAttribute("checked", "checked");
}
</script>

<div id="sc" style="overflow-x:auto; display: <?php echo $displaysc; ?>;">
<table width="1300" border="1" cellspacing="0" cellpadding="0" style="font-size: 15px; background-color: #ffffff; "  id="sc-detail">
   <tr>
    <th colspan="10">
      <font style="color:#ff0000; font-size:20px;"><center>รายละเอียดเครื่องจักรกลุ่ม Service Contract</center></font>
    </th>
  </tr>
</table>


<?php  
if($numsc!="0"){
do {  


 $eqtype = substr($row_macsc['egatno'], 0, 2);

$eqmid = $row_macsc['Equipment_id'];



  ?>

 <table width="1300" border="1" cellspacing="0" cellpadding="0" style="font-size: 15px; background-color: #ffffff; "  id="sc-detail">
<tr ><td colspan="10" bgcolor="#cccccc"><h4><?php echo $row_macsc['Equipment_name']; ?>(หมายเลข <?php echo $eqtype; ?>)</h4></td></tr>
  <tr class="<?php echo $row_macsc['Equipment_group']; ?>" id="<?php echo $eqmid; ?>">
   
  
   <th >หมายเลข</th>
   <th >PM/CM</th>
   <th >อาการ</th>

   <th >วันที่จอดเครื่องจักร</th>
   <th >การแก้ไข</th>
   
   <th >Remark</th>
   <th >ผูรับผิดชอบ</th>
   <th >แล้วเสร็จ</th>
   <th >ลบ</th>

  </tr>
  <?php 

    $id = $row_macsc['Equipment_id'];
     
    
    $qsc_detail = "SELECT * FROM daily_detail  WHERE  Equipment_id = '$id' AND Record_date = '$dateshow' ORDER BY Equipment_number";

$scdetail     = mysql_query($qsc_detail, $DB) or die(mysql_error());
$rowscdetail = mysql_num_rows($scdetail);
$row_scdetail = mysql_fetch_assoc($scdetail);

if($rowscdetail!="0"){
   
   do{
    if($row_scdetail['finished_date']==""){
    ?>
     <tr>

    <input type="hidden" value="<?php echo $row_scdetail['detail_id']; ?>" name="detail_id<?php echo $row; ?>">
    <input type="hidden" value="<?php echo $row_scdetail['Mac_hour']; ?>" name="machour<?php echo $row; ?>">
   
   
    <td >No.<?php echo $row_scdetail['Equipment_number']; ?><input type='hidden' value="<?php echo $row_scdetail['Equipment_number']; ?>" name='mac-num<?php echo $row; ?>'  maxlength="100" size="6"></td> 


    <td ><input type='radio' <?php  if($row_scdetail['PM_CM']=="PM") echo"checked" ; ?> name='Remark<?php echo $row; ?>' id="pm-<?php echo $id; ?>"  value='PM'> PM<br><input type='radio' <?php  if($row_scdetail['PM_CM']=="CM") echo"checked" ; ?> name='Remark<?php echo $row; ?>' value='CM' 
      id="cm-<?php echo $id; ?>" > CM</td>


    <td ><textarea type='text' value="" name='mac-problem<?php echo $row; ?>'  rows="3" cols="60"><?php echo $row_scdetail['Description']; ?></textarea></td>

    <td ><input type='date' value="<?php if($row_scdetail['date']=="0000-00-00"){echo $date;}else{echo $row_scdetail['date'];}  ?>" name='mac-date<?php echo $row; ?>' ><input type='hidden' value="<?php echo $row_scdetail['time']; ?>" name='mac-time<?php echo $row; ?>' ></td>
    <td ><input type='radio' <?php  if($row_scdetail['action']=="finish") echo"checked" ; ?> name='fix<?php echo $row; ?>' id='fix<?php echo $row; ?>'  value='finish'>มีกำหนดการเสร็จ <input type='date' onchange="radiocheck(<?php echo $row; ?>)" value="<?php echo $row_scdetail['action_date']; ?>" name='fix-date<?php echo $row; ?>'><br><input type='radio' <?php  if($row_scdetail['action']=="unfinish") echo"checked" ; ?> name='fix<?php echo $row; ?>'  value='unfinish'>ยังไม่มีกำหนดเสร็จ</td>
    
    <td><textarea rows="1" cols="3" name='macald<?php echo $row; ?>'><?php echo $row_scdetail['Remark']; ?></textarea></td> 
    <td><input type="text" name="respone<?php echo $row; ?>"  value="<?php echo $row_scdetail['User_respone']; ?>"></td>
    <td ><center><input type="checkbox"  name="fi-tag<?php echo $row; ?>" id ="chfi"></center></td>
    <td ><center><input type="checkbox"  name="de-tag<?php echo $row; ?>" id ="chde"></center></td>
<input type='hidden' name='detail_type<?php echo $row; ?>' value='sc'  >
<input type="hidden" name="equipment_id<?php echo $row; ?>"  value="<?php echo $id; ?>">
  </tr>



    <?php
  $row++;
  
  }} while ($row_scdetail = mysql_fetch_assoc($scdetail));} ?>
</table>
<?php
  
} while ($row_macsc = mysql_fetch_assoc($macs)); }?>



<br>
Remark: <input type="text" name="detail_remark-sc" size="100" value="<?php echo($detail_remarksc['Remark_detail']) ?>"><input type="hidden" name="detail_remark-sc-id" value="<?php echo($detail_remarksc['Remark_id']) ?>"><?php if ($btadd==1) { ?><button type="button" class="btn btn-info btn-lg" id="myBtn4" >เพิ่มรายการชำรุด</button><?php } ?>
<br>
<br>


</div>
