<?php include 'DBConnect.php';

$q = $_GET['datefromrecorded'];

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






<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<head>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



<script type="text/javascript">
  function add_t(argument) {

 addt();
}
function add_m(argument) {

 addm();
}
$(function(){

  $("#addrow_t").click(function(){
     

   var  rowCount  = parseInt($("#rowadd_t").html());

            rowCount++;

       $("#maxrowtm").val(rowCount);
       $("#rowadd_t").text(rowCount);


      $("#tm_show").append("<tr id= 'rowat"+rowCount+"'><td  style='display: none;'></td ><td></td><td align='center'></td><td align='center'></td></tr>");

  $("#tm_show tr:last td:nth-child(1)").append($("#rowadd_t").clone(true).text(rowCount).attr('id','row'+rowCount));



       $("#tm_show tr:last td:nth-child(2)").append($("#Equipment_id").clone(true).attr('name','Equipment_id'+rowCount).attr('id','Equipment_id'+rowCount).attr('onchange','showAmount(this.value,'+rowCount+')'));
         $("#tm_show tr:last td:nth-child(3)").append("<p id='txtHint"+rowCount+"'></p>");
         $("#tm_show tr:last td:nth-child(3) ").append($("#amount").clone(true).attr('name','amount'+rowCount).attr('id','amount'+rowCount));


       $("#tm_show tr:last td:nth-child(4)").append($("#bt_t0").clone(true).html('<span class="glyphicon glyphicon-minus-sign"></span>').attr('id','bt_t'+rowCount).attr('onclick','deleterow('+rowCount+')'));
         $("#tm_show tr:last td:last").append("<input type='hidden' name='none"+rowCount+"' id='none"+rowCount+"' value='notnone'>");



    });

    


$("#addrow_m").click(function(){
 
   var  rowCount  = parseInt($("#rowadd_m").html());
            rowCount++;

       $("#maxrowme").val(rowCount);
       $("#rowadd_m").text(rowCount);


      $("#me_show").append("<tr id= 'rowat-m"+rowCount+"'><td style='display: none;'></td><td></td><td align='center'><td align='center'></td></tr>");

  $("#me_show tr:last td:nth-child(1)").append($("#rowadd_m").clone(true).text(rowCount).attr('id','row-m'+rowCount));



       $("#me_show tr:last td:nth-child(2)").append($("#Equipment_id-m").clone(true).attr('name','Equipment_id-m'+rowCount).attr('id','Equipment_id-m'+rowCount).attr('onchange','showAmount_m(this.value,'+rowCount+')'));
         $("#me_show tr:last td:nth-child(3)").append("<p id='txtHint-m"+rowCount+"'></p>");
       $("#me_show tr:last td:nth-child(3) ").append($("#amount-m").clone(true).attr('id','amount-m'+rowCount).attr('name','amount-m'+rowCount));

       $("#me_show tr:last td:nth-child(4)").append($("#bt_m0").clone(true).html('<span class="glyphicon glyphicon-minus-sign"></span>').attr('id','bt_m'+rowCount).attr('onclick','deleterow_m('+rowCount+')'));




    });




    
});




function deleterow(val){

        var x = document.getElementById("bt_t"+val).getAttribute("id");
            if(x=="bt_t1"){
              alert("ไม่สามารถลบแถวแรกได้");
            }else{

              document.getElementById("rowat"+val).remove();
              //document.getElementById("rowat"+val).remove();
               var row = parseInt(document.getElementById("rowadd_t").innerHTML);
                var netrow = row-1;
                document.getElementById("maxrowtm").value = netrow;
                document.getElementById("rowadd_t").innerHTML = netrow;
              



            }
}
function deleterow_m(val){

        var x = document.getElementById("bt_m"+val).getAttribute("id");
            if(x=="bt_m1"){
              alert("ไม่สามารถลบแถวแรกได้");
            }else{

               document.getElementById("rowat-m"+val).remove();
               var row = parseInt(document.getElementById("rowadd_m").innerHTML);
                var netrow = row-1;
                document.getElementById("maxrowme").value = netrow;
                document.getElementById("rowadd_m").innerHTML = netrow;
              
              


            }
}

    function showAmount(str,row) {
    if (str == "") {
        document.getElementById("txtHint"+row).innerHTML = "";
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint"+row).innerHTML = this.responseText;
                 document.getElementById("amount"+row).value = this.responseText;
                
            }
        };
        xmlhttp.open("GET","Machine-amount.php?q="+str,true);
        xmlhttp.send();
    }
}

function showAmount_m(str,row) {
    if (str == "") {
        document.getElementById("txtHint-m"+row).innerHTML = "";
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              document.getElementById("txtHint-m"+row).innerHTML = this.responseText;
document.getElementById("amount-m"+row).value = this.responseText;
            }
        };
        xmlhttp.open("GET","Machine-amount.php?q="+str,true);
        xmlhttp.send();
    }
}








</script>




</head>

<body style="padding: 20px; background-image: url(<?php echo $_SESSION['image']; ?>);" >
  <input type=button onclick=window.history.back() value=ยกเลิก>
  

  <form method="GET" action="EMDR-equipment_group-insert.php"  >
    
 <font style="color:#ff0000; font-size:24px;"><center><p id="datechg"><b>เครื่องจักรหลัก </b></p></center></font>
 


<br>
  
<input type="hidden" name="maxrowtm" id="maxrowtm" value="">
<input type="hidden" name="maxrowme" id="maxrowme" value="">
<input type="hidden" name="datereport" id="datereport" value="<?php echo($_GET['datefromrecorded']); ?>">
<input type="hidden" name="datestatus" id="datestatus" value="<?php echo($_GET['datestatus']); ?>">

<table width="500" border="1" cellspacing="0" cellpadding="0" align="center" style="font-size: 15px; background-color: #ffffff"  id="tm_show">
   <tr >
    <th colspan="9">
      <font style="color:#ff0000; font-size:18px;"><center>เครื่องจักรระบบขนส่งวัสดุ</center></font>
    </th>
  </tr>

  <tr >
   <th style="display: none;">ลำดับ</th>
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
    <tr  >
      <td style="display: none;"></td>
   <td  width="300px">
     <?php echo $row_mactma['Equipment_name']; ?>
   </td>
   <td align="center"><p ><?php echo $row_mactma['Equipment_amount']; ?></p></td>
  
   <td></td>


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
  <th style="display: none;"></th>
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
    <tr >
      
<td style="display: none;"></td>
   <td  width="300px">
     <?php echo $row_macmea['Equipment_name']; ?>
   </td>
   <td align="center"><p ><?php echo $row_macmea['Equipment_amount']; ?></p></td>
   
   <td></td>


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
   <th style="display: none;">ลำดับ</th>
   <th >เครื่องจักระบบขนส่งวัสดุ</th>
   <th >จำนวนเครื่องจักร</th>

   <th ></th>

  </tr>

  <tr id="firstTr_t" >

   <td style="display: none;"><p id="rowadd_t">0</p></td>

   <td>
     <select  onchange="showAmount(this.value,0)" id="Equipment_id" name="Equipment_id" >
       <option value="">เลือกเครื่องจักร</option>
      <?php do {?>
  <option value="<?php echo $row_mactm['Equipment_id'] ?>" ><?php echo $row_mactm['Equipment_name'] ?></option>
  <?php } while ($row_mactm = mysql_fetch_assoc($macta));?>
</select>
   </td>
   <td><p id="txtHint0"></p><input type="hidden" name="amount" id="amount" value=""></td>
  
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
   <th style="display: none;">ลำดับ</th>
   <th >เครื่องจักกลุ่ม Mobile equipment</th>
   <th >จำนวนเครื่องจักร</th>

   <th ></th>

  </tr>

  <tr id="firstTr_m" >

   <td style="display: none;"><p id="rowadd_m">0</p></td>

   <td>
     <select  onchange="showAmount_m(this.value,0)" id="Equipment_id-m" name="Equipment_id-m" style="width: 230px;" >
       <option value="">เลือกเครื่องจักร</option>
      <?php do {?>
  <option value="<?php echo $row_macme['Equipment_id'] ?>"><?php echo $row_macme['Equipment_name'] ?></option>
  <?php } while ($row_macme = mysql_fetch_assoc($macma));?>
</select>
   </td>
   <td><p id="txtHint-m0"></p><input type="hidden" id="amount-m" value=""></td>

  <td><center><button type="button" class="btn btn-default btn-sm" id="bt_m0" onclick="deleterow_m(0)">
          <span class="glyphicon glyphicon-minus-sign"></span>
        </button></center></td>
  </tr>


</table>
<br>
<center>
  <button >บันทักข้อมูลเครื่องจักร</button>
</center>
</form>

</body>

</html>





