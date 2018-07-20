

<!DOCTYPE html>
<html lang="en">
<?php
	ini_set('display_errors', '0');
	session_start();
	
	require 'pdfpack/mpdf.php';
ob_start();
		$username = $_SESSION['username'];
		$tfay = iconv('TIS-620', 'UTF-8',$_SESSION['tfay']);
		$year = $_POST['year'];
		$type = $_POST['type'];
		//$hn = "427225000";
		//$password = $_POST['password'];
		//$hn = $empno."000"; 
	
	
	
	
	/*$sql = "SELECT tfay FROM user WHERE username='$username'";
	$result = mysqli_query($conn,$sql );
	$num_rows = mysqli_num_rows($result);
	$query = mysqli_query($conn,$sql) or die("error=$sql");
	$tfay = mysqli_fetch_array($result);*/
	
	 if($year != ""){
        include("lib/nusoap.php");
        $client = new nusoap_client("http://10.20.40.178/srh/WebServiceServer.php?wsdl",true); 
        
        //$data = $client->call('findfay', array('year' => $year, 'type'=> $type, 'tfay'=> $tfay));
		$data_info = $client->call('findfay', array('tfay' => $tfay, 'year' => $year, 'type' => $type));
    }  
	
?>
<head>
  <!-- Theme Made By www.w3schools.com - No Copyright -->
  <title>ระบบรายงานผลตรวจสุขภาพ</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Mitr" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>

</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

  <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container" style="width: auto;height: auto;">
      <div class="navbar-header">
        
        <a class="navbar-brand " href="#myPage">ระบบรายงานผลตรวจสุขภาพและผลประเมินลักษณะงานพิเศษ(ภาพรวม)</a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="../srh/home-3.php">หน้าหลัก</a></li>
<li><a href="../srh/main/logout.php">ออกจากระบบ</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div id="index" class="jumbotron text-center" style="width: auto;height: auto;">
    <div class="row">
     <div class="col-sm-12" style="margin-left: 0px">

<script>
  $(document).ready(function() {
    $('#example').DataTable();
    $('select').addClass('mdb-select');
    $('.mdb-select').material_select();
});
</script>
<style>
  table.dataTable thead .sorting:before, table.dataTable thead .sorting:after, table.dataTable thead .sorting_asc:before, table.dataTable thead .sorting_asc:after, table.dataTable thead .sorting_desc:before, table.dataTable thead .sorting_desc:after {
   padding: 5px;
}
.dataTables_wrapper .mdb-select {
    border: none;
}
.dataTables_wrapper .mdb-select.form-control {
    padding-top: 0;
    margin-top: -1rem;
    margin-left: 0.7rem;
    margin-right: 0.7rem;
    width: 100px;
}
.dataTables_length label {
    display: flex;
    justify-content: left;
}
.dataTables_filter label {
    margin-bottom: 0;
}
.dataTables_filter label input.form-control {
    margin-top: -0.6rem;
    padding-bottom: 0;
}
table.dataTable {
    margin-bottom: 3rem!important;
}
div.dataTables_wrapper div.dataTables_info {
    padding-top: 0;
}
</style>
      <div class="container" style="width: auto;height: auto;">
        <h2>รายงานผลตรวจสุขภาพ</h2>
        <p>ผลประเมินลักษณะงานพิเศษ</p>
		<!--<p><?php echo $year.' '.$type.' '.$tfay; ?></p>-->
        <div style="overflow-x:scroll; width: auto;height: auto; font-size: 20px">            
         <table id="example" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%"><a href="report-F.php><button type="button" class="btn btn-default" style="font-size:15px;color:#000000">ดาวน์โหลด <i class="fa fa-save" style="font-size:20px;color:#000000"></i></a>
    <thead>
        <tr style="background-color: #00ace6; width: auto;height: auto;" >
              <th style="width: auto;height: auto;">ID</th>
              <th style="width: auto;height: auto;">ชื่อ-นามสกุล</th>
              <th style="width: auto;height: auto;">อายุ</th>
              <th style="width: auto;height: auto;">สังกัด</th>
              <th style="width: auto;height: auto;">กลุ่มงานพิเศษ</th>
              <th style="width: auto;height: auto;">วันที่ตรวจ</th>
              <th style="width: auto;height: auto;">วันที่หมดอายุ</th>
              <th style="width: auto;height: auto;">ผลสุขภาพ</th>
              <th style="width: auto;height: auto;">ผลทดสอบ</th>
              <th style="width: auto;height: auto;">% ทดสอบ</th>
              <th style="width: auto;height: auto;">ผลการประเมิน</th>
              <th style="width: auto;height: auto;">หมายเหตุ</th>

        </tr>
    </thead>
    <!--<tfoot>
        <tr style="background-color: #00ace6;">
             <th>ID</th>
              <th style="width: 150%">ชื่อ-นามสกุล</th>
              
              <th >อายุ</th>
              <th style="width: 110%">สังกัด</th>
              
              <th style="width: 150%">กลุ่มงานพิเศษ</th>
              <th style="width: 120%">วันที่ตรวจ</th>
              <th style="width: 120%">วันที่หมดอายุ</th>
              <th>ผลสุขภาพ</th>
              <th>ผลทดสอบ</th>
              <th>% ทดสอบ</th>
              <th>ผลการประเมิน</th>
              <th>หมายเหตุ</th>


        </tr>
    </tfoot>-->
    <tbody style="background-color: #ccebff;">
	<?php
	
	function DateThai($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear";
	}
	
	if (is_array($data_info))
	{
		foreach ($data_info as $result_info) { ?>
        <tr>
            <td><?php echo $result_info["hn"];?></td>
              <td><?php echo $result_info["empn_name"];?></td>
             
              <td><?php echo $result_info["age"];?></td>
              <td><?php echo $result_info["faction"];?></td>
              
              <td><?php echo $result_info["specialist_job"];?></td>
              <td><?php echo DateThai(date('Y-m-d',strtotime($result_info["visit_date"])));?></td>
              <td><?php echo DateThai(date('Y-m-d',strtotime($result_info["visit_date"]. " + 1 year")));?></td>
              <td><?php echo $result_info["job_assess_result"];?></td>
              <td><?php echo $result_info["pass"];?></td>
              <td><?php echo $result_info["percent_score"];?></td>
              <td><?php echo $result_info["job_assess"];?></td>
              <td><?php echo $result_info["job_result"];?></td>
        </tr>
	<?php
	}
	}else{
		echo "data_info has a problem (FindFay)";
	}
		
?>	

    </tbody>
</table> 

      </div>
      </div>

    </div>  
  </div> 

</div>




<footer class="container-fluid text-center">
  <a href="#myPage" title="To Top">
    <span class="glyphicon glyphicon-chevron-up" style="color:#ff9900"></span>
  </a>
  <p>ควบคุมและดูแลโดย <a href="https://www.w3schools.com" title="Visit w3schools">ฝ่ายแพทย์และอนามัย</a></p>
</footer>

<script>
  $(document).ready(function(){
  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {
    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, function(){

        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
  
  $(window).scroll(function() {
    $(".slideanim").each(function(){
      var pos = $(this).offset().top;

      var winTop = $(window).scrollTop();
      if (pos < winTop + 600) {
        $(this).addClass("slide");
      }
    });
  });
})
</script>

</body>
</html>

<?php
 
$html = ob_get_contents();
ob_end_clean();
$pdf = new mPDF('th', 'A4', '0', 'THSaraban');
$pdf->SetAutoFont();
$pdf->SetDisplayMode('fullpage');
$pdf->WriteHTML($html, 2);
$pdf->Output();


?>     