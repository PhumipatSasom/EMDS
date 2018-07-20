 <script type="text/javascript">
   $(function(){


$("[id=chgme]").click(function(event) {
        $("#addfrommodal").val("frommodal");
       
      });


   });
 </script>
 <div class="container">
 <div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">เพิ่ม</h4>
        </div>
        <div class="modal-body">
          <div id="me" style="overflow-x:auto; display: <?php echo $displayme; ?>;">
<table width="500" border="1" cellspacing="0" cellpadding="0" style="font-size: 15px; background-color: #ffffff; "  id="me-detail">
   <tr>
    <th colspan="10">
      <font style="color:#ff0000; font-size:20px;"><center>รายละเอียดเครื่องจักรระบบขนส่งวัสดุ</center></font>
    </th>
  </tr>
</table>


<?php

$qaddme = "SELECT * FROM equipment_group a inner join m.equipment b on a.Equipment_type = b.eqtype inner join daily_report c on a.Equipment_id=c.Equipment_id WHERE a.Equipment_group = 'me' and c.TimeDate_record = '$dateshow' GROUP BY a.Equipment_id ORDER BY `a`.`Equipment_id` ASC";

$addme     = mysql_query($qaddme, $DB) or die(mysql_error());
$numaddme  = mysql_num_rows($addme);
$row_addme = mysql_fetch_assoc($addme);

do {

   
    $eqtype  = substr($row_addme['egatno'], 0, 2);
    $eqmtype = $row_addme['eqtype'];
    $eqmid   = $row_addme['Equipment_id'];

    $qeqdropdownme = "SELECT * FROM equipment_group a inner join m.equipment b on a.Equipment_type = b.eqtype WHERE a.Equipment_group = 'me' AND b.eqtype = '$eqmtype' and a.Equipment_id = '$eqmid' GROUP BY b.egatno ORDER BY b.egatno ASC"
    ;

    $eqdropdownme     = mysql_query($qeqdropdownme, $DB) or die(mysql_error());
    $roweqdropdownme  = mysql_num_rows($eqdropdownme);
    $row_eqdropdownme = mysql_fetch_assoc($eqdropdownme);

    ?>



 <table width="500" border="1" cellspacing="0" cellpadding="0" style="font-size: 15px; background-color: #ffffff; "  id="me-detail">
<tr ><td colspan="10"><?php echo $row_addme['Equipment_name']; ?>(หมายเลข <?php echo $eqtype; ?>)</td></tr>
  <tr class="<?php echo $row_addme['Equipment_group']; ?>" id="<?php echo $eqmid; ?>">


   <th >หมายเลข</th>


   <th >เลือก</th>

  </tr>
  <?php

    do {
      $egatno = $row_eqdropdownme['egatno'];
$eqid = $row_eqdropdownme['Equipment_id'];
        $qcheckme = "SELECT * FROM daily_detail where Equipment_number = '$egatno' and Record_date ='$dateshow' and detail_type = 'me' and Equipment_id = '$eqid'";

        $checkme    = mysql_query($qcheckme, $DB) or die(mysql_error());
        $numcheckme = mysql_num_rows($checkme);

        ?>
     <tr style="height: 50px;background-color: <?php if($numcheckme!=0){echo "#b3ecff";}?>">




    <td >No.<?php echo $row_eqdropdownme['egatno']; ?><input type='hidden' value="<?php echo $row_eqdropdownme['egatno']; ?>" name='mac-num<?php echo $row; ?>'  maxlength="100" size="6"></td>


    <td ><center><input type="checkbox" value="1"  name="add-tag<?php echo $row; ?>" <?php

        if ($numcheckme != 0) {
            echo "disabled";
        }

        ?>></center></td>
<input type='hidden' name='detail_type<?php echo $row; ?>' value='me'  >
<input type="hidden" name="equipment_id<?php echo $row; ?>"  value="<?php echo $eqmid; ?>">

  </tr>



    <?php
$row++;
        $me++;
    } while ($row_eqdropdownme = mysql_fetch_assoc($eqdropdownme));?>

</table>
<button type="submit" class="btn btn-success" id="chgme" style="float: right;">บันทึก</button>

<?php

} while ($row_addme = mysql_fetch_assoc($addme));?>





</div>
        </div>
        <div class="modal-footer">
          
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

        </div>
      </div>

    </div>
  </div>
</div>
