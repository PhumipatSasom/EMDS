
<script type="text/javascript">
	$(function(){

 
 $("[id=chfi]").click(function(event) {
 	
 		
 		var monthNames = [ "ม.ค", "ก.พ", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.",
    "ก.ค.", "ส.ค", "ก.ย.", "ต.ค.", "พ.ค.", "ธ.ค." ];

    var today = new Date();
    var h=today.getHours();
    var thaidate = today.getFullYear()+543;
var m=today.getMinutes();
h=checkTime(h);
m=checkTime(m);
    var date = prompt("วันที่แล้วเสร็จ", today.getDate()+" "+monthNames[today.getMonth()]+" "+thaidate+" "+h+":"+m+" น.");

 		
 		$(this).val(date);
 	
 
 });


$("[id=chde]").click(function(event) {
 	
 		alert("มีการลบเกิดขึ้น");
 		$(this).parents("tr").hide();
 		
 	
 
 });



});


function checkTime(i)
{
if (i<10)
  {
  i="0" + i;
  }
return i;
}

function showeq(str,group) {
       if (str == "") {
        document.getElementById("showdetail").innerHTML = "";
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
             
                document.getElementById("de").innerHTML = this.responseText;
               $("#myModal1").modal();



                 
                
            }
        };
        xmlhttp.open("GET","showeqdetail.php?dateshow="+str+"&group="+group,true);
        xmlhttp.send();
    }
    }

</script>


<?php
mysql_select_db($databasename, $DB);
$qmact = "SELECT * FROM equipment_group a inner join m.equipment b on a.Equipment_type = b.eqtype inner join daily_report c on a.Equipment_id=c.Equipment_id WHERE a.Equipment_group = 'tm' and c.TimeDate_record = '$dateshow' GROUP BY a.Equipment_id ORDER BY `a`.`Equipment_id` ASC";

$mact      = mysql_query($qmact, $DB) or die(mysql_error());
$numtm = mysql_num_rows($mact);
$row_mactm = mysql_fetch_assoc($mact);

$qmacm = "SELECT * FROM equipment_group a inner join m.equipment b on a.Equipment_type = b.eqtype inner join daily_report c on a.Equipment_id=c.Equipment_id WHERE a.Equipment_group = 'me' and c.TimeDate_record = '$dateshow' GROUP BY a.Equipment_id ORDER BY `a`.`Equipment_id` ASC";

$macm      = mysql_query($qmacm, $DB) or die(mysql_error());
$numme = mysql_num_rows($macm);
$row_macme = mysql_fetch_assoc($macm);

$qmacm_ct = "SELECT * FROM equipment_group a inner join m.equipment b on a.Equipment_type = b.eqtype inner join daily_report c on a.Equipment_id=c.Equipment_id WHERE a.Equipment_group = 'me_ct' and c.TimeDate_record = '$dateshow' GROUP BY a.Equipment_id ORDER BY `a`.`Equipment_id` ASC";

$macm_ct      = mysql_query($qmacm_ct, $DB) or die(mysql_error());
$nummct = mysql_num_rows($macm_ct);
$row_macme_ct = mysql_fetch_assoc($macm_ct);

$qmacs = "SELECT * FROM equipment_group a inner join m.equipment b on a.Equipment_type = b.eqtype inner join daily_report c on a.Equipment_id=c.Equipment_id WHERE a.Equipment_group = 'sc' and c.TimeDate_record = '$dateshow' GROUP BY a.Equipment_id ORDER BY `a`.`Equipment_id` ASC";

$macs      = mysql_query($qmacs, $DB) or die(mysql_error());
$numsc = mysql_num_rows($macs);
$row_macsc = mysql_fetch_assoc($macs);


$qdetail_remark_tm = "SELECT * FROM detail_remark  where Remark_type = 'tm' and Remark_date = '$dateshow'";

$detail_remark_tm     = mysql_query($qdetail_remark_tm, $DB) or die(mysql_error());

$detail_remarktm = mysql_fetch_assoc($detail_remark_tm);

$qdetail_remark_me = "SELECT * FROM detail_remark  where Remark_type = 'me' and Remark_date = '$dateshow'";

$detail_remark_me     = mysql_query($qdetail_remark_me, $DB) or die(mysql_error());

$detail_remarkme = mysql_fetch_assoc($detail_remark_me);

$qdetail_remark_me_2 = "SELECT * FROM detail_remark  where Remark_type = 'me_ct' and Remark_date = '$dateshow'";

$detail_remark_me_2    = mysql_query($qdetail_remark_me_2, $DB) or die(mysql_error());

$detail_remarkme_2 = mysql_fetch_assoc($detail_remark_me_2);

$qdetail_remark_sc = "SELECT * FROM detail_remark  where Remark_type = 'sc' and Remark_date = '$dateshow'";

$detail_remark_sc     = mysql_query($qdetail_remark_sc, $DB) or die(mysql_error());

$detail_remarksc = mysql_fetch_assoc($detail_remark_sc);

$row = 1;

?>
<input type="hidden" name="addfrommodal" id="addfrommodal"  value="">
<input type="hidden" name="maxrowdetail" id="maxrowdetail" value="">

<?php if ($_SESSION['user_type']=="admin") { ?>

<?php include 'TMpage.php'; ?>
<?php include 'MEpage.php';  ?>
<?php include 'MECTpage.php'; ?>
<?php include 'SCpage.php'; ?>
<?php }else{ 

    switch ($_SESSION['user_type']) {
    case "me_ct":
        include 'MECTpage-section.php';
        break;
    case "sc":
        include 'SCpage-section.php';
        break;
    case "tm":
         include 'TMpage-section.php';
        break;
    case "me":
         include 'MEpage-section.php';
        

}
    
   
    
    
   
?>

<?php } ?>
<?php if($btadd==1){ ?>
<?php include 'TMadd.php'; ?>
<?php include 'MEadd.php'; ?>
<?php include 'MECTadd.php'; ?>
<?php include 'SCadd.php'; ?>
<?php } ?>

<script type='text/javascript'>
$(function(){

 
 $("#maxrowdetail").val(<?=$row - 1;?>);


});
</script>

<div id="de"></div>
