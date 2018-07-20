 <script type="text/javascript">
   $(function(){


$("[id=chgmect]").click(function(event) {
        $("#addfrommodal").val("frommodal");

      });

   });
 </script>
 <div class="container">
 <div class="modal fade" id="myModal3" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">เพิ่ม</h4>
        </div>
        <div class="modal-body">
          <div id="me_ct" style="overflow-x:auto; display: <?php echo $displayme_ct; ?>;">
<table width="500" border="1" cellspacing="0" cellpadding="0" style="font-size: 15px; background-color: #ffffff; "  id="me_ct-detail">
   <tr>
    <th colspan="10">
      <font style="color:#ff0000; font-size:20px;"><center>บำรุงรักษาเครื่องจักรโดยหบต-ช.</center></font>
    </th>
  </tr>
</table>


<?php 



  $qaddme_ct = "SELECT * FROM equipment_group a inner join m.equipment b on a.Equipment_type = b.eqtype inner join daily_report c on a.Equipment_id=c.Equipment_id WHERE a.Equipment_group = 'me_ct' and c.TimeDate_record = '$dateshow' GROUP BY a.Equipment_id ORDER BY `a`.`Equipment_id` ASC";

$addme_ct      = mysql_query($qaddme_ct, $DB) or die(mysql_error());
$numaddme_ct = mysql_num_rows($addme_ct);
$row_addme_ct = mysql_fetch_assoc($addme_ct);

do {  


 $eqtype = substr($row_addme_ct['egatno'], 0, 2);
$eqmtype = $row_addme_ct['eqtype'];
$eqmid = $row_addme_ct['Equipment_id'];
if($eqmid==13){
      $fillter="AND b.egatno in ('640143','640144','640146','640147','640148','640149','640153')";
    }else if($eqmid==16){
      $fillter="AND b.egatno in ('340051','340067','340068','340070','340075','340095','340097','340098')";
    }else{
      $fillter="";
    }
$qeqdropdownme_ct = "SELECT * FROM equipment_group a inner join m.equipment b on a.Equipment_type = b.eqtype WHERE a.Equipment_group = 'me_ct' $fillter AND b.eqtype = '$eqmtype' and a.Equipment_id = '$eqmid' GROUP BY b.egatno ORDER BY b.egatno ASC"
  ;

$eqdropdownme_ct     = mysql_query($qeqdropdownme_ct, $DB) or die(mysql_error());
$roweqdropdownme_ct = mysql_num_rows($eqdropdownme_ct);
$row_eqdropdownme_ct = mysql_fetch_assoc($eqdropdownme_ct);



  ?>
  


 <table width="500" border="1" cellspacing="0" cellpadding="0" style="font-size: 15px; background-color: #ffffff; "  id="me_ct-detail">
<tr ><td colspan="10"><?php echo $row_addme_ct['Equipment_name']; ?>(หมายเลข <?php echo $eqtype; ?>)</td></tr>
  <tr class="<?php echo $row_addme_ct['Equipment_group']; ?>" id="<?php echo $eqmid; ?>">
   
  
   <th >หมายเลข</th>
  
   
   <th >เลือก</th>

  </tr>
  <?php 
      
     
   
   do{
    $egatno = $row_eqdropdownme_ct['egatno'];
                $eqid = $row_eqdropdownme_ct['Equipment_id'];
          $qcheckme_ct = "SELECT * FROM daily_detail where Equipment_number = '$egatno' and Record_date ='$dateshow' and detail_type = 'me_ct' and Equipment_id = '$eqid'";
  ;

$checkme_ct     = mysql_query($qcheckme_ct, $DB) or die(mysql_error());
$numcheckme_ct = mysql_num_rows($checkme_ct);
   
    ?>
     <tr style="height: 50px;background-color: <?php if($numcheckme_ct!=0){echo "#b3ecff";}?>">

    
   
   
    <td >No.<?php echo $row_eqdropdownme_ct['egatno']; ?><input type='hidden' value="<?php echo $row_eqdropdownme_ct['egatno']; ?>" name='mac-num<?php echo $row; ?>'  maxlength="100" size="6"></td> 


    <td ><center><input type="checkbox" value="1"  name="add-tag<?php echo $row; ?>" <?php 
                
   if($numcheckme_ct!=0){
    echo "disabled";
   }




     ?>></center></td>
<input type='hidden' name='detail_type<?php echo $row; ?>' value='me_ct'  >
<input type="hidden" name="equipment_id<?php echo $row; ?>"  value="<?php echo $eqmid; ?>">

  </tr>



    <?php
  $row++;
  $me_ct++;
  } while ($row_eqdropdownme_ct = mysql_fetch_assoc($eqdropdownme_ct)); ?>

</table>
<button type="submit" class="btn btn-success" id="chgmect" style="float: right;">บันทึก</button>

<?php
  
} while ($row_addme_ct = mysql_fetch_assoc($addme_ct)); ?>





</div>
        </div>
        <div class="modal-footer">
          
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          
        </div>
      </div>
      
    </div>
  </div>
</div>
