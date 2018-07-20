 
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
          <div id="" style="overflow-x:auto; ">



<?php 
    include 'DBConnect.php';
mysql_select_db($databasename, $DB);
      date_default_timezone_set("Asia/Bangkok");
    $dateshowde = $_GET['dateshow'];
    $eqgroup = $_GET['group'];


  $qadd = "SELECT * FROM equipment_group a inner join m.equipment b on a.Equipment_type = b.eqtype inner join daily_report c on a.Equipment_id=c.Equipment_id WHERE a.Equipment_group = '$eqgroup' and c.TimeDate_record = '$dateshowde' GROUP BY a.Equipment_id ORDER BY `a`.`Equipment_id` ASC";

$add      = mysql_query($qadd, $DB) or die(mysql_error());
$numadd = mysql_num_rows($add);
$row_add = mysql_fetch_assoc($add);

do {  



$eqmtype = $row_add['eqtype'];
$eqmid = $row_add['Equipment_id'];

$qeqdropdown = "SELECT * FROM equipment_group a inner join m.equipment b on a.Equipment_type = b.eqtype WHERE a.Equipment_group = '$eqgroup' AND b.eqtype = '$eqmtype' and a.Equipment_id = '$eqmid' GROUP BY b.egatno ORDER BY b.egatno ASC"
  ;

$eqdropdown     = mysql_query($qeqdropdown, $DB) or die(mysql_error());
$roweqdropdown = mysql_num_rows($eqdropdown);
$row_eqdropdown = mysql_fetch_assoc($eqdropdown);



  ?>
  


 <table width="500" border="1" cellspacing="0" cellpadding="0" style="font-size: 15px; background-color: #ffffff; "  id="-detail">
<tr ><td colspan="10"><?php echo $row_add['Equipment_name']; ?></td></tr>
  <tr class="<?php echo $row_add['Equipment_group']; ?>" id="<?php echo $eqmid; ?>">
   
  
   <th >หมายเลข</th>
  
   
   <th >เลือก</th>

  </tr>
  <?php 
      
     
   
   do{
     $egatno = $row_eqdropdown['egatno'];
              $eqid = $row_eqdropdown['Equipment_id'];
          $qcheck = "SELECT * FROM daily_detail where Equipment_number = '$egatno' and Record_date ='$dateshowde' and detail_type = '$eqgroup' and Equipment_id = '$eqid'";
  ;

$check     = mysql_query($qcheck, $DB) or die(mysql_error());
$numcheck = mysql_num_rows($check);
    ?>
     <tr style="height: 50px; background-color: <?php 
             
   
   if($numcheck!=0){
    echo "#ffffcc";
   }




     ?>">

    
   
   
    <td ><?php echo $row_eqdropdown['egatno']; ?><input type='hidden' value="<?php echo $row_eqdropdown['egatno']; ?>" name='mac-num<?php echo $row; ?>'  maxlength="100" size="6"></td> 


    <td ><center><input type="checkbox" value="1" id="test" name="add-tag<?php echo $row; ?>" <?php 
             
   
   if($numcheck!=0){
    echo "disabled";
   }




     ?>></center></td>


  </tr>



    <?php
  
  
  } while ($row_eqdropdown = mysql_fetch_assoc($eqdropdown)); ?>

</table>


<?php
  
} while ($row_add = mysql_fetch_assoc($add)); ?>





</div>

        </div>
        <div class="modal-footer">
          
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          
        </div>
      </div>
      
    </div>
  </div>
</div>
