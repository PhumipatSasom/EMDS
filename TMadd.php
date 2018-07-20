 <script type="text/javascript">
   $(function(){

$("[id=chgtm]").click(function(event) {
        $("#addfrommodal").val("frommodal");

      });

    
   });
 </script>
 <div class="container">
 <div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">เพิ่ม</h4>
        </div>
        <div class="modal-body">
          <div id="tm" style="overflow-x:auto; display: <?php echo $displaytm; ?>;">
<table width="500" border="1" cellspacing="0" cellpadding="0" style="font-size: 15px; background-color: #ffffff; "  id="tm-detail">
   <tr>
    <th colspan="10">
      <font style="color:#ff0000; font-size:20px;"><center>รายละเอียดเครื่องจักรระบบขนส่งวัสดุ</center></font>
    </th>
  </tr>
</table>


<?php 



  $qaddtm = "SELECT * FROM equipment_group a inner join m.equipment b on a.Equipment_type = b.eqtype inner join daily_report c on a.Equipment_id=c.Equipment_id WHERE a.Equipment_group = 'tm' and c.TimeDate_record = '$dateshow' GROUP BY a.Equipment_id ORDER BY `a`.`Equipment_id` ASC";

$addtm      = mysql_query($qaddtm, $DB) or die(mysql_error());
$numaddtm = mysql_num_rows($addtm);
$row_addtm = mysql_fetch_assoc($addtm);

do {  



$eqmtype = $row_addtm['eqtype'];
$eqmid = $row_addtm['Equipment_id'];

$qeqdropdowntm = "SELECT * FROM equipment_group a inner join m.equipment b on a.Equipment_type = b.eqtype WHERE a.Equipment_group = 'tm' AND b.eqtype = '$eqmtype' and a.Equipment_id = '$eqmid' GROUP BY b.egatno ORDER BY b.egatno ASC"
  ;

$eqdropdowntm     = mysql_query($qeqdropdowntm, $DB) or die(mysql_error());
$roweqdropdowntm = mysql_num_rows($eqdropdowntm);
$row_eqdropdowntm = mysql_fetch_assoc($eqdropdowntm);



  ?>
  


 <table width="500" border="1" cellspacing="0" cellpadding="0" style="font-size: 15px; background-color: #ffffff; "  id="tm-detail">
<tr ><td colspan="10"><?php echo $row_addtm['Equipment_name']; ?></td></tr>
  <tr class="<?php echo $row_addtm['Equipment_group']; ?>" id="<?php echo $eqmid; ?>">
   
  
   <th >หมายเลข</th>
  
   
   <th >เลือก</th>

  </tr>
  <?php 
      
     
   
   do{
     $egatno = $row_eqdropdowntm['egatno'];
              $eqid = $row_eqdropdowntm['Equipment_id'];
          $qchecktm = "SELECT * FROM daily_detail where Equipment_number = '$egatno' and Record_date ='$dateshow' and detail_type = 'tm' and Equipment_id = '$eqid'";
  ;

$checktm     = mysql_query($qchecktm, $DB) or die(mysql_error());
$numchecktm = mysql_num_rows($checktm);
    ?>
     <tr style="height: 50px; background-color: <?php if($numchecktm!=0){echo "#b3ecff";}?>">

    
   
   
    <td ><?php echo $row_eqdropdowntm['egatno']; ?><input type='hidden' value="<?php echo $row_eqdropdowntm['egatno']; ?>" name='mac-num<?php echo $row; ?>'  maxlength="100" size="6"></td> 


    <td ><center><input type="checkbox" value="1"  name="add-tag<?php echo $row; ?>" <?php 
             
   
   if($numchecktm!=0){
    echo "disabled";
   }




     ?>></center></td>
<input type='hidden' name='detail_type<?php echo $row; ?>' value='tm'  >
<input type="hidden" name="equipment_id<?php echo $row; ?>"  value="<?php echo $eqmid; ?>">

  </tr>



    <?php
  $row++;
  $tm++;
  } while ($row_eqdropdowntm = mysql_fetch_assoc($eqdropdowntm)); ?>

</table>
<button type="submit" class="btn btn-success" id="chgtm" style="float: right;">บันทึก</button>

<?php
  
} while ($row_addtm = mysql_fetch_assoc($addtm)); ?>





</div>

        </div>
        <div class="modal-footer">
          
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          
        </div>
      </div>
      
    </div>
  </div>
</div>
