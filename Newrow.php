<?php include 'DBConnect.php';

$q = $_GET['q'];

mysql_select_db($databasename, $DB);

$qmact = "SELECT * FROM equipment_group where Equipment_group='tm'";

$macta      = mysql_query($qmact, $DB) or die(mysql_error());
$row_mactm = mysql_fetch_assoc($macta);

$qmacm = "SELECT * FROM equipment_group where Equipment_group in ('me','sc','me_ct')";

$macma      = mysql_query($qmacm, $DB) or die(mysql_error());
$row_macme = mysql_fetch_assoc($macma);




$qmact = "SELECT * FROM daily_report a INNER JOIN equipment_group b on a.Equipment_id = b.Equipment_id where b.Equipment_group='tm' and a.TimeDate_record = '" . $q . "' order by a.Record_id";

$mact      = mysql_query($qmact, $DB) or die(mysql_error());
$rowtm      = mysql_num_rows($mact);
$row_mactma = mysql_fetch_assoc($mact);

$qmacm = "SELECT * FROM daily_report a INNER JOIN equipment_group b on a.Equipment_id = b.Equipment_id where b.Equipment_group in ('me','sc','me_ct') and a.TimeDate_record = '" . $q . "' order by a.Record_id";

$macm      = mysql_query($qmacm, $DB) or die(mysql_error());
$rowme      = mysql_num_rows($macm);
$row_macmea = mysql_fetch_assoc($macm);

?>

  
<input type="hidden" name="maxrowtm" id="maxrowtm" value="<?php echo($rowtm) ?>">
<input type="hidden" name="maxrowme" id="maxrowme" value="<?php echo($rowme) ?>">

 

<table width="500" border="1" cellspacing="0" cellpadding="0" align="center" style="font-size: 15px; background-color: #ffffff"  id="tm_show">
   <tr >
    <th colspan="9">
      <font style="color:#ff0000; font-size:18px;"><center>เครื่องจักรระบบขนส่งวัสดุ</center></font>
    </th>
  </tr>

  <tr >
   <th>ลำดับ</th>
   <th width="300px" >เครื่องจักรระบบขนส่งวัสดุ</th>
   <th >จำนวนเครื่องจักร</th>
   
   <th ><center><button type="button" class="btn btn-default btn-sm" id="addrow_t" onclick="add_t()">
          <span class="glyphicon glyphicon-plus-sign" ></span>
        </button></center></th>

  </tr>
   <?php
$row = 1;

if ($rowtm == "0") {
    echo "<tr><td colspan='9'>ไม่มีข้อมูลในวันนี้</td></tr>";

} else {

    do {
        ?>
    <tr  id="rowat<?php echo $row; ?>">
      <td align="center"><?php echo $row; ?><input type="hidden"  name="recid<?php echo $row; ?>" value="
        <?php echo ($row_mactma['Record_id']) ?>"></td>

   <td id="row<?php echo $row; ?>" width="300px">
     <input type="hidden" value="<?php echo ($row_mactma['Equipment_id']) ?>" name="Equipment_id<?php echo $row; ?>" id="Equipment_id<?php echo $row; ?>"> <?php echo $row_mactma['Equipment_name']; ?>
   </td>
   <td align="center"><?php echo $row_mactma['NumberOfEquipment']; ?><input type="hidden" name="amount<?php echo $row; ?>" value="<?php echo $row_mactma['NumberOfEquipment']; ?>"></td>
  
   <td><center><button type="button" class="btn btn-default btn-sm" id="bt_t<?php echo $row; ?>" onclick="deleterow(<?php echo $row; ?>)">
          <span class="glyphicon glyphicon-minus-sign"></span>
        </button></center></td>


    </tr>

    <?php
$row++;
    } while ($row_mactma = mysql_fetch_assoc($mact));
}?>

</table>


<table width="500" border="1" cellspacing="0" align="center" cellpadding="0" style="font-size: 15px; background-color: #ffffff; border-top:0px;"  id="me_show">
   <tr >
    <th colspan="9">
      <font style="color:#ff0000; font-size:18px;"><center>เครื่องจักรกลุ่ม Mobile equipment</center></font>
    </th>
  </tr>

  <tr>
  <th >ลำดับ</th>
   <th width="300px" >เครื่องจักรกลุ่ม Mobile equipment</th>
   <th >จำนวนเครื่องจักร</th>
   
   <th ><center><button type="button" class="btn btn-default btn-sm" id="addrow_m" onclick="add_m()">
          <span class="glyphicon glyphicon-plus-sign" ></span>
        </button></center></th>

  </tr>
  
<?php
$row = 1;
if ($rowme == "0") {
    echo "<tr><td colspan='9'>ไม่มีข้อมูลในวันนี้</td></tr>";

} else {

    do {
        ?>
    <tr id="rowat-m<?php echo $row; ?>">
      <td align="center"><p><?php echo $row; ?><input type="hidden"  name="recid-m<?php echo $row; ?>" value="
        <?php echo ($row_macmea['Record_id']) ?>"></p></td>

   <td id="row-m<?php echo $row; ?>" width="300px">
     <input type="hidden" value="<?php echo ($row_macmea['Equipment_id']) ?>" name="Equipment_id-m<?php echo $row; ?>" id="Equipment_id-m<?php echo $row; ?>"> <?php echo $row_macmea['Equipment_name']; ?>
   </td>
   <td align="center"><?php echo $row_macmea['NumberOfEquipment']; ?><input type="hidden" name="amount-m<?php echo $row; ?>" value="<?php echo $row_macmea['NumberOfEquipment']; ?>"></td>
   
   <td><center><button type="button" class="btn btn-default btn-sm" id="bt_m<?php echo $row; ?>" onclick="deleterow_m(<?php echo $row; ?>)">
          <span class="glyphicon glyphicon-minus-sign"></span>
        </button></center></td>


    </tr>

    <?php
$row++;
    } while ($row_macmea = mysql_fetch_assoc($macm));
}?>
</table>

<table style="font-size: 15px; width: 500px; background-color:#ffffff; display:none; " border="1" id="myTbl_t" >
  <tr>
    <th colspan="9">
      <font style="color:#ff0000; font-size:20px;"><center>เพิ่มข้อมูลเครื่องจักรระบบขนส่งวัสดุ</center></font>
    </th>
  </tr>
  <tr>
   <th >ลำดับ</th>
   <th >เครื่องจักระบบขนส่งวัสดุ</th>
   <th >จำนวนเครื่องจักร</th>

   <th ></th>

  </tr>

  <tr id="firstTr_t" >

   <td><p id="rowadd_t">0</p></td>

   <td>
     <select  onchange="showAmount(this.value,0)" id="Equipment_id" name="Equipment_id" >
       <option value="">เลือกเครื่องจักร</option>
      <?php do {?>
  <option value="<?php echo $row_mactm['Equipment_id'] ?>" ><?php echo $row_mactm['Equipment_name'] ?></option>
  <?php } while ($row_mactm = mysql_fetch_assoc($macta));?>
</select>
   </td>
   <td><p id="txtHint0"></p><input type="hidden"  id="amount" value=""></td>
  
   <td><p id="ald"></p></td>

  <td><center><button type="button" class="btn btn-default btn-sm" id="bt_t0" onclick="deleterow(0)">
          <span class="glyphicon glyphicon-minus-sign"></span>
        </button></center></td>
  </tr>


</table>




<table style="font-size: 15px; width: 1300px; background-color:#ffffff; display:none; " border="1" id="myTbl_m" >
  <tr>
    <th colspan="9">
      <font style="color:#ff0000; font-size:20px;"><center>เพิ่มข้อมูลเครื่องจักรกลุ่ม Mobile equipment</center></font>
    </th>
  </tr>
  <tr>
   <th >ลำดับ</th>
   <th >เครื่องจักกลุ่ม Mobile equipment</th>
   <th >จำนวนเครื่องจักร</th>

   <th ></th>

  </tr>

  <tr id="firstTr_m" >

   <td><p id="rowadd_m">0</p></td>

   <td>
     <select  onchange="showAmount_m(this.value,0)" id="Equipment_id-m" name="Equipment_id-m" style="width: 230px;" >
       <option value="">เลือกเครื่องจักร</option>
      <?php do {?>
  <option value="<?php echo $row_macme['Equipment_id'] ?>"><?php echo $row_macme['Equipment_name'] ?></option>
  <?php } while ($row_macme = mysql_fetch_assoc($macma));?>
</select>
   </td>
   <td><p id="txtHint-m0"></p><input type="hidden"  id="amount-m" value=""></td>

  <td><center><button type="button" class="btn btn-default btn-sm" id="bt_m0" onclick="deleterow_m(0)">
          <span class="glyphicon glyphicon-minus-sign"></span>
        </button></center></td>
  </tr>


</table>






