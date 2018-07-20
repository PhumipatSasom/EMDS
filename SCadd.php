 <script type="text/javascript">
   $(function(){


$("[id=chgsc]").click(function(event) {
        $("#addfrommodal").val("frommodal");

      });
    
   });
 </script>
 <div class="container">
 <div class="modal fade" id="myModal4" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">เพิ่ม</h4>
        </div>
        <div class="modal-body">
          <div id="sc" style="overflow-x:auto; display: <?php echo $displaysc; ?>;">
<table width="500" border="1" cellspacing="0" cellpadding="0" style="font-size: 15px; background-color: #ffffff; "  id="sc-detail123">
   <tr>
    <th colspan="10">
      <font style="color:#ff0000; font-size:20px;"><center>รายละเอียดเครื่องจักรกลุ่ม Service Contract</center></font>
    </th>
  </tr>
</table>


<?php 



  $qaddsc = "SELECT * FROM equipment_group a inner join m.equipment b on a.Equipment_type = b.eqtype inner join daily_report c on a.Equipment_id=c.Equipment_id WHERE a.Equipment_group = 'sc' and c.TimeDate_record = '$dateshow' GROUP BY a.Equipment_id ORDER BY `a`.`Equipment_id` ASC";

$addsc      = mysql_query($qaddsc, $DB) or die(mysql_error());
$numaddsc = mysql_num_rows($addsc);
$row_addsc = mysql_fetch_assoc($addsc);

do {  


 $eqtype = substr($row_addsc['egatno'], 0, 2);
$eqmtype = $row_addsc['eqtype'];
$eqmid = $row_addsc['Equipment_id'];
if($eqmid==10){
      $fillter="AND b.egatno in ('580072','580073','580074','580075')";
    }else if($eqmid==11){
      $fillter="AND b.egatno in ('640122','640123','640124','640125','640133','640131')";
    }else if($eqmid==12){
      $fillter="AND b.egatno in ('640128','640129','640134')";
    }else{
      $fillter="";
    }
$qeqdropdown = "SELECT * FROM equipment_group a inner join m.equipment b on a.Equipment_type = b.eqtype WHERE a.Equipment_group = 'sc' $fillter AND b.eqtype = '$eqmtype' and a.Equipment_id = '$eqmid' GROUP BY b.egatno ORDER BY b.egatno ASC"
  ;

$eqdropdown     = mysql_query($qeqdropdown, $DB) or die(mysql_error());
$roweqdropdown = mysql_num_rows($eqdropdown);
$row_eqdropdown = mysql_fetch_assoc($eqdropdown);



  ?>
  


 <table width="500" border="1" cellspacing="0" cellpadding="0" style="font-size: 15px; background-color: #ffffff; "  id="sc-detail">
<tr ><td colspan="10"><?php echo $row_addsc['Equipment_name']; ?>(หมายเลข <?php echo $eqtype; ?>)</td></tr>
  <tr  class="<?php echo $row_addsc['Equipment_group']; ?>" id="<?php echo $eqmid; ?>">
   
  
   <th >หมายเลข</th>
  
   
   <th >เลือก</th>

  </tr>
  
  <?php 
      
     
   
   do{
     
 $egatno = $row_eqdropdown['egatno'];
  $eqid = $row_eqdropdown['Equipment_id'];
          $qcheck = "SELECT * FROM daily_detail where Equipment_number = '$egatno'  and Record_date ='$dateshow' and detail_type = 'sc' and Equipment_id = '$eqid'";
  ;

$check     = mysql_query($qcheck, $DB) or die(mysql_error());
$numcheck = mysql_num_rows($check);
    ?>
     <tr style="height: 50px;background-color: <?php if($numcheck!=0){echo "#b3ecff";}?>" >

    
   
   
    <td >No.<?php echo $row_eqdropdown['egatno']; ?><input type='hidden' value="<?php echo $row_eqdropdown['egatno']; ?>" name='mac-num<?php echo $row; ?>'  maxlength="100" size="6"></td> 


    <td ><center><input type="checkbox" value="1"  name="add-tag<?php echo $row; ?>" <?php
   
   if($numcheck!=0){
    echo "disabled";
   }






     ?>></center></td>
<input type='hidden' name='detail_type<?php echo $row; ?>' value='sc'  >
<input type="hidden" name="equipment_id<?php echo $row; ?>"  value="<?php echo $eqmid; ?>">

  </tr>



    <?php
  $row++;
  $sc++;
  } while ($row_eqdropdown = mysql_fetch_assoc($eqdropdown)); ?>

</table>
<button type="submit" class="btn btn-success" id="chgsc" style="float: right;">บันทึก</button>

<?php
  
} while ($row_addsc = mysql_fetch_assoc($addsc)); ?>





</div>
        </div>
        <div class="modal-footer">
          
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          
        </div>
      </div>
      
    </div>
  </div>
</div>
