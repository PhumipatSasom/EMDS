<?php 
session_start();
if($_SESSION["id_citizen"] == "")
{
  echo "Please Login!";
  header("index.php");
  exit();
}

if($_SESSION['user_type'] != "admin")
{
  echo "This page for admin only!";
  exit();

} ?>
<?php include 'DBConnect.php';

mysql_select_db($databasename, $DB);
ob_start();
?>
<?php
date_default_timezone_set("Asia/Bangkok");
$day   = date("d");
$month = date("m");
$year  = date("Y");
$date  = $year . "-" . $month . "-" . $day;

$thai_day_arr   = array("อาทิตย์", "จันทร์", "อังคาร", "พุธ", "พฤหัสบดี", "ศุกร์", "เสาร์");
$thai_month_arr = array(
    "0"  => "",
    "1"  => "มกราคม",
    "2"  => "กุมภาพันธ์",
    "3"  => "มีนาคม",
    "4"  => "เมษายน",
    "5"  => "พฤษภาคม",
    "6"  => "มิถุนายน",
    "7"  => "กรกฎาคม",
    "8"  => "สิงหาคม",
    "9"  => "กันยายน",
    "10" => "ตุลาคม",
    "11" => "พฤศจิกายน",
    "12" => "ธันวาคม",
);
function thai_date($time)
{
    global $thai_day_arr, $thai_month_arr;

    $thai_date_return .= date("j", $time);
    $thai_date_return .= " " . $thai_month_arr[date("n", $time)];
    $thai_date_return .= " พ.ศ." . (date("Y", $time) + 543);

    return $thai_date_return;
}


$eng_month_arr = array(
     "" => "0",
     "มกราคม" => "1",
     "กุมภาพันธ์" => "2",
     "มีนาคม" => "3",
     "เมษายน" => "4",
     "พฤษภาคม" => "5",
      "มิถุนายน"=> "6",
     "กรกฎาคม" => "7",
      "สิงหาคม"=> "8",
    "กันยายน" =>  "9",
     "ตุลาคม"=> "10",
     "พฤศจิกายน"=> "11",
    "ธันวาคม" => "12",
);
function eng_date($time)
{
    global $thai_eng_arr;

    $eng_date_return .= date("j", $time);
    $eng_date_return .=  $thai_month_arr[date("n", $time)];
    $eng_date_return .= "-" . (date("Y", $time));

    return $eng_date_return;
}
$qlast = "SELECT TimeDate_record FROM daily_report a INNER JOIN equipment_group b on a.Equipment_id = b.Equipment_id WHERE a.TimeDate_record = ( SELECT MAX(TimeDate_record) from daily_report )";

    $last = mysql_query($qlast, $DB) or die(mysql_error());

    $row_last = mysql_fetch_assoc($last);

$qdate = "SELECT DISTINCT(m.TimeDate_record), (SELECT Log FROM daily_report m2 WHERE m2.Record_id = (SELECT MAX(m3.Record_id) FROM daily_report m3 WHERE m3.TimeDate_record = m.TimeDate_record)) AS Log
FROM daily_report m 
ORDER BY m.TimeDate_record";

$dateq      = mysql_query($qdate, $DB) or die(mysql_error());

$row_date = mysql_fetch_assoc($dateq);




?>






<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<head>
  <title>สถานการณ์เครื่องจักร</title>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<link href='fullcalendar-3.6.2/fullcalendar.min.css' rel='stylesheet' />
<link href='fullcalendar-3.6.2/fullcalendar.print.min.css' rel='stylesheet' media='print' />
<script src='fullcalendar-3.6.2/lib/moment.min.js'></script>
<script src='fullcalendar-3.6.2/lib/jquery.min.js'></script>
<script src='fullcalendar-3.6.2/fullcalendar.min.js'></script>

<script type="text/javascript">
  function add_t(argument) {

 addt();
}
function add_m(argument) {

 addm();
}
$(function(){

  window.addt = function(){
     

   var  rowCount  = parseInt($("#maxrowtm").val());

            rowCount++;

       $("#maxrowtm").val(rowCount);
       $("#rowadd_t").text(rowCount);


      $("#tm_show").append("<tr id= 'rowat"+rowCount+"'><td align='center'></td ><td></td><td align='center'></td><td align='center'></td></tr>");

  $("#tm_show tr:last td:nth-child(1)").append($("#rowadd_t").clone(true).text(rowCount).attr('id','row'+rowCount));



       $("#tm_show tr:last td:nth-child(2)").append($("#Equipment_id").clone(true).attr('name','Equipment_id'+rowCount).attr('id','Equipment_id'+rowCount).attr('onchange','showAmount(this.value,'+rowCount+')'));
         $("#tm_show tr:last td:nth-child(3)").append("<p id='txtHint"+rowCount+"'></p>");
         $("#tm_show tr:last td:nth-child(3) ").append($("#amount").clone(true).attr('name','amount'+rowCount).attr('id','amount'+rowCount));


       $("#tm_show tr:last td:nth-child(4)").append($("#bt_t0").clone(true).html('<span class="glyphicon glyphicon-minus-sign"></span>').attr('id','bt_t'+rowCount).attr('onclick','deleterow('+rowCount+')'));
         $("#tm_show tr:last td:last").append("<input type='hidden' name='none"+rowCount+"' id='none"+rowCount+"' value='notnone'>");



    }

    


window.addm = function(){
 
   var  rowCount  = parseInt($("#maxrowme").val());
            rowCount++;

       $("#maxrowme").val(rowCount);
       $("#rowadd_m").text(rowCount);


      $("#me_show").append("<tr id= 'rowat-m"+rowCount+"'><td align='center'></td><td></td><td align='center'><td align='center'></td></tr>");

  $("#me_show tr:last td:nth-child(1)").append($("#rowadd_m").clone(true).text(rowCount).attr('id','row-m'+rowCount));



       $("#me_show tr:last td:nth-child(2)").append($("#Equipment_id-m").clone(true).attr('name','Equipment_id-m'+rowCount).attr('id','Equipment_id-m'+rowCount).attr('onchange','showAmount_m(this.value,'+rowCount+')'));
         $("#me_show tr:last td:nth-child(3)").append("<p id='txtHint-m"+rowCount+"'></p>");
       $("#me_show tr:last td:nth-child(3) ").append($("#amount-m").clone(true).attr('name','amount-m'+rowCount).attr('id','amount-m'+rowCount));

       $("#me_show tr:last td:nth-child(4)").append($("#bt_m0").clone(true).html('<span class="glyphicon glyphicon-minus-sign"></span>').attr('id','bt_m'+rowCount).attr('onclick','deleterow_m('+rowCount+')'));




    }




$("#enable").change(function(event) {
    if($(":checked")){
  $("#datereport").removeAttr('disabled');
  }

});
    
});




function deleterow(val){

        var x = document.getElementById("bt_t"+val).getAttribute("id");
            if(x=="bt_t0"){
              alert("ไม่สามารถลบแถวแรกได้");
            }else{

              document.getElementById("rowat"+val).remove();
              //document.getElementById("rowat"+val).remove();

              



            }
}
function deleterow_m(val){

        var x = document.getElementById("bt_m"+val).getAttribute("id");
            if(x=="bt_m0"){
              alert("ไม่สามารถลบแถวแรกได้");
            }else{

               document.getElementById("rowat-m"+val).remove();

              


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

function shownewrow(str) {
    if (str == "") {
        document.getElementById("newtable").innerHTML = "";
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
                
                document.getElementById("newtable").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","Newrow.php?q="+str,true);
        xmlhttp.send();
    }
}

function checkdate(str) {
    if (str == "") {
        document.getElementById("message").innerHTML = "";
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
                
                document.getElementById("message").innerHTML = "<h2>"+this.responseText+"</h2>";
            }
        };
        xmlhttp.open("GET","checkdate.php?q="+str,true);
        xmlhttp.send();
    }
}

function showResult(result){

if(result==1)

{
alert('Save successfully!');
document.getElementById("divResult").innerHTML = "<center><h4><font color=green> Save successfully! </font> </h4> </center>";
 setTimeout(function(){ window.location.href='index.php' }, 1000);
}
else

{

document.getElementById("divResult").innerHTML = "<font color=red> Error!! Cannot save data </font> <br>";

}

}

function enable(){

        var checker = document.getElementById('enable');

 // when unchecked or checked, run the function
 checker.onclick = function(){
if(this.checked){
    document.getElementById('datereport').disabled = true;
} else {
    document.getElementById('datereport').disabled = true;
}

}


}





</script>
<style>
     

  #calendar {
    max-width: 900px;
    margin: 0 auto;
    background-color: #ffffff;
  }

</style>



</head>

<body style="padding: 20px; background-color: #F3F781" onload="shownewrow('<?php echo($row_last['TimeDate_record']) ?>')">
  <a href="index.php" style="float: right;">กลับสู่หน้าหลัก</a>
  

  <form method="GET" action="EMDR-equipment_group-insert.php"  id="form2"  >
  

   
 <font style="color:#ff0000; font-size:24px;"><center><p id="datechg"><b>เครื่องจักรหลัก </b></p></center></font>

 <center>วันที่ต้องการบันทึก: <input type="date" name="datereport" required="required" onchange="checkdate(this.value)"><font style="color:#ff0000; "><p id="message"></p></font></center>
 <br>
<center><input type="checkbox" id="enable" >คัดลอกข้อมูลวันที่: <input type="date" disabled="disabled" name="" id="datereport" value="<?php echo($row_last['TimeDate_record']) ?>" onchange="shownewrow(this.value)" onkeyup="shownewrow(this.value)"></center>

<br><div id="divResult"></div>



<p id="newtable"></p>

<br>

<center>
  <button >บันทักข้อมูลเครื่องจักร</button>
</center>
</form>

</body>

</html>





