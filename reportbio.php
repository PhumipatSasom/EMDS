<!DOCTYPE html>
<html lang="en">
<?php
ini_set('display_errors', '0');
session_start();



  $username = $_SESSION['username'];
  $tlong = iconv('TIS-620', 'UTF-8',$_SESSION['tlong']);
  $tfay = iconv('TIS-620', 'UTF-8',$_SESSION['tfay']);
  $year = $_POST['year'];
  $type = $_POST['type'];
    //$hn = "427225000";
    //$password = $_POST['password'];
    //$hn = $empno."000"; 


require "connect.php";
require_once ('mpdf/mpdf.php');
ob_start();

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
    $data_info_all = $client->call('findfay_all', array('tfay' => $tfay, 'year' => $year));   
  }  
  
  ?>

  <?php
  $thai_day_arr=array("อาทิตย์","จันทร์","อังคาร","พุธ","พฤหัสบดี","ศุกร์","เสาร์");
  $thai_month_arr=array(
    "0"=>"",
    "1"=>"มกราคม",
    "2"=>"กุมภาพันธ์",
    "3"=>"มีนาคม",
    "4"=>"เมษายน",
    "5"=>"พฤษภาคม",
    "6"=>"มิถุนายน", 
    "7"=>"กรกฎาคม",
    "8"=>"สิงหาคม",
    "9"=>"กันยายน",
    "10"=>"ตุลาคม",
    "11"=>"พฤศจิกายน",
    "12"=>"ธันวาคม"                 
  );
  function thai_date($time){
    global $thai_day_arr,$thai_month_arr;
    $thai_date_return="วัน".$thai_day_arr[date("w",$time)];
    $thai_date_return.= "ที่ ".date("j",$time);
    $thai_date_return.=" เดือน".$thai_month_arr[date("n",$time)];
    $thai_date_return.= " พ.ศ.".(date("Yํ",$time)+543);
    
    return $thai_date_return;
  }
  ?>
  <head>
    <!-- Theme Made By www.w3schools.com - No Copyright -->
    <title>วันที่พิมพ์ <?php $eng_date=time(); echo thai_date($eng_date);?></title>
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
  </head>

  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>

</head>
<style type="text/css">
<!--
@page rotated { size: landscape; }
.style1 {
  font-family: "TH SarabunPSK";
  font-size: 18pt;
  font-weight: bold;
}
.style2 {
  font-family: "TH SarabunPSK";
  font-size: 16pt;
  font-weight: bold;
}
.style3 {
  font-family: "TH SarabunPSK";
  font-size: 20pt;
  font-weight: bold;
  background-image: bla1.jpg ;
  
}
.style5 {cursor: hand; font-weight: normal; color: #000000;}
.style9 {font-family: Tahoma; font-size: 12px; }
.style11 {font-size: 12px}
.style13 {font-size: 9}
.style16 {font-size: 9; font-weight: bold; }
.style17 {font-size: 12px; font-weight: bold; }
-->
</style>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<head>
  <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
</head>
<body >
  <div class=Section2>

    <table bordercolor="#424242" width="1500" height="78" border="1"  align="center" cellpadding="0" cellspacing="0" class="style3" >
      <tr align="center">
        <th width="200" align="center" bgcolor="#D5D5D5" rowspan="2"><strong>รายการตรวจ</strong></th>
        <th width="60" align="center" bgcolor="#D5D5D5" rowspan="2"><strong>หน่วย</strong></th>
        <th width="130" align="center" bgcolor="#D5D5D5" rowspan="2"><strong>สิ่งส่งตรวจวิเคราะห์</strong></th>
        <th width="139" align="center" bgcolor="#D5D5D5" rowspan="2"><strong>ค่ามาตราฐาน(ไม่เกิน)</strong></th>
        <th width="110" align="center" bgcolor="#D5D5D5" rowspan="2"><strong>ข้อมูลอ้างอิงมีค่ามาตราฐาน</strong></th>
        <th width="110" align="center" bgcolor="#D5D5D5" rowspan="2"><strong>จำนวนผู้เข้ารับการตรวจ(ราย)</strong></th>
        <th width="80" align="center" bgcolor="#D5D5D5" colspan="2"><strong>ผลปกติ</strong></th>
        <th width="80" align="center" bgcolor="#D5D5D5" colspan="2"><strong>ผลผิดปกติ</strong></th>
      </tr>



      <tr>
        <th width="80" align="center" bgcolor="#D5D5D5" ><strong>จำนวน(ราย) </strong></th>
        <th width="80" align="center" bgcolor="#D5D5D5"><strong>ร้อยละ</strong></th>
        <th width="80" align="center" bgcolor="#D5D5D5" ><strong>จำนวน(ราย) </strong></th>
        <th width="80" align="center" bgcolor="#D5D5D5"><strong>ร้อยละ</strong></th>
      </tr>
       <tr>
        <td style="text-align: left;">Min in Blood</td>
        <td>ug/dL</td>
        <td>เลือด</td>
        <td>10.00</td>
        <td>N-Health / Prolab(ในคนสัมผัส)</td>
        <td></td>
        <td>5</td>
        <td></td>
        <td>5</td>
        <td></td>
      </tr>
      
      <tr>
        <td style="text-align: left;">Hig in Blood</td>
        <td>ug/dL</td>
        <td>เลือด</td>
        <td>10.00</td>
        <td>N-Health / Prolab(ในคนสัมผัส)</td>
        <td></td>
        <td>5</td>
        <td></td>
        <td>5</td>
        <td></td>
      </tr>

      <tr>
        <td style="text-align: left;">Ni in Blood</td>
        <td>ug/dL</td>
        <td>เลือด</td>
        <td>10.00</td>
        <td>N-Health / Prolab(ในคนสัมผัส)</td>
        <td></td>
        <td>5</td>
        <td></td>
        <td>5</td>
        <td></td>
      </tr>
      
      <tr>
        <td style="text-align: left;">Ethybenzene (Mandelic acid)</td>
        <td>ug/dL</td>
        <td>เลือด</td>
        <td>10.00</td>
        <td>N-Health / Prolab(ในคนสัมผัส)</td>
        <td></td>
        <td>5</td>
        <td></td>
        <td>5</td>
        <td></td>
      </tr>
      
      <tr>
        <td style="text-align: left;">Cadmium in Blood</td>
        <td>ug/dL</td>
        <td>เลือด</td>
        <td>10.00</td>
        <td>N-Health / Prolab(ในคนสัมผัส)</td>
        <td></td>
        <td>5</td>
        <td></td>
        <td>5</td>
        <td></td>
      </tr>

      <tr>
        <td style="text-align: left;">nHexane(2,5Hexsnedione)(แม่เมาะ)</td>
        <td>ug/dL</td>
        <td>เลือด</td>
        <td>10.00</td>
        <td>N-Health / Prolab(ในคนสัมผัส)</td>
        <td></td>
        <td>5</td>
        <td></td>
        <td>5</td>
        <td></td>
      </tr>

      <tr>
        <td style="text-align: left;">Trichloroacetic acid(แม่เมาะ)</td>
        <td>ug/dL</td>
        <td>เลือด</td>
        <td>10.00</td>
        <td>N-Health / Prolab(ในคนสัมผัส)</td>
        <td></td>
        <td>5</td>
        <td></td>
        <td>5</td>
        <td></td>
      </tr>

      <tr>
        <td style="text-align: left;">Arsenic(แม่เมาะ)</td>
        <td>ug/dL</td>
        <td>เลือด</td>
        <td>10.00</td>
        <td>N-Health / Prolab(ในคนสัมผัส)</td>
        <td></td>
        <td>5</td>
        <td></td>
        <td>5</td>
        <td></td>
      </tr>

      <tr>
        <td style="text-align: left;">Inorgenic arsenic(แม่เมาะ)</td>
        <td>ug/dL</td>
        <td>เลือด</td>
        <td>10.00</td>
        <td>N-Health / Prolab(ในคนสัมผัส)</td>
        <td></td>
        <td>5</td>
        <td></td>
        <td>5</td>
        <td></td>
      </tr>

      <tr>
        <td style="text-align: left;">Mercury</td>
        <td>ug/dL</td>
        <td>เลือด</td>
        <td>10.00</td>
        <td>N-Health / Prolab(ในคนสัมผัส)</td>
        <td></td>
        <td>5</td>
        <td></td>
        <td>5</td>
        <td></td>
      </tr>

      <tr>
        <td style="text-align: left;">Candmium</td>
        <td>ug/dL</td>
        <td>เลือด</td>
        <td>10.00</td>
        <td>N-Health / Prolab(ในคนสัมผัส)</td>
        <td></td>
        <td>5</td>
        <td></td>
        <td>5</td>
        <td></td>
      </tr>

      <tr>
        <td style="text-align: left;">Chromium(Total chromium)</td>
        <td>ug/dL</td>
        <td>เลือด</td>
        <td>10.00</td>
        <td>N-Health / Prolab(ในคนสัมผัส)</td>
        <td></td>
        <td>5</td>
        <td></td>
        <td>5</td>
        <td></td>
      </tr>

      <tr>
        <td style="text-align: left;">Benzene(t,t-Muconic acid)</td>
        <td>ug/dL</td>
        <td>เลือด</td>
        <td>10.00</td>
        <td>N-Health / Prolab(ในคนสัมผัส)</td>
        <td></td>
        <td>5</td>
        <td></td>
        <td>5</td>
        <td></td>
      </tr>

      <tr>
        <td style="text-align: left;">Xylene(Methythippuric acid)</td>
        <td>ug/dL</td>
        <td>เลือด</td>
        <td>10.00</td>
        <td>N-Health / Prolab(ในคนสัมผัส)</td>
        <td></td>
        <td>5</td>
        <td></td>
        <td>5</td>
        <td></td>
      </tr>

      <tr>
        <td style="text-align: left;">Acetone</td>
        <td>ug/dL</td>
        <td>เลือด</td>
        <td>10.00</td>
        <td>N-Health / Prolab(ในคนสัมผัส)</td>
        <td></td>
        <td>5</td>
        <td></td>
        <td>5</td>
        <td></td>
      </tr>

      <tr>
        <td style="text-align: left;">Methanol</td>
        <td>ug/dL</td>
        <td>เลือด</td>
        <td>10.00</td>
        <td>N-Health / Prolab(ในคนสัมผัส)</td>
        <td></td>
        <td>5</td>
        <td></td>
        <td>5</td>
        <td></td>
      </tr>

      <tr>
        <td style="text-align: left;">Toluene</td>
        <td>ug/dL</td>
        <td>เลือด</td>
        <td>10.00</td>
        <td>N-Health / Prolab(ในคนสัมผัส)</td>
        <td></td>
        <td>5</td>
        <td></td>
        <td>5</td>
        <td></td>
      </tr>

      <tr>
        <td style="text-align: left;">Lead in Blood</td>
        <td>ug/dL</td>
        <td>เลือด</td>
        <td>10.00</td>
        <td>N-Health / Prolab(ในคนสัมผัส)</td>
        <td></td>
        <td>5</td>
        <td></td>
        <td>5</td>
        <td></td>
      </tr>

      <tr>
        <td style="text-align: left;">Nickel</td>
        <td>ug/dL</td>
        <td>เลือด</td>
        <td>10.00</td>
        <td>N-Health / Prolab(ในคนสัมผัส)</td>
        <td></td>
        <td>5</td>
        <td></td>
        <td>5</td>
        <td></td>
      </tr>

      <tr>
        <td style="text-align: left;">Mwthyl isobutyl ketone</td>
        <td>ug/dL</td>
        <td>เลือด</td>
        <td>10.00</td>
        <td>N-Health / Prolab(ในคนสัมผัส)</td>
        <td></td>
        <td>5</td>
        <td></td>
        <td>5</td>
        <td></td>
      </tr>

      <tr>
        <td style="text-align: left;">Benzene(Phenol)*</td>
        <td>ug/dL</td>
        <td>เลือด</td>
        <td>10.00</td>
        <td>N-Health / Prolab(ในคนสัมผัส)</td>
        <td></td>
        <td>5</td>
        <td></td>
        <td>5</td>
        <td></td>
      </tr>

      <tr>
        <td style="text-align: left;">Toluene(Hippuric)*</td>
        <td>ug/dL</td>
        <td>เลือด</td>
        <td>10.00</td>
        <td>N-Health / Prolab(ในคนสัมผัส)</td>
        <td></td>
        <td>5</td>
        <td></td>
        <td>5</td>
        <td></td>
      </tr>

    </table>


  </div>
  
</body>
</html>



<?php


$html = ob_get_contents();
ob_end_clean();

/**
* 
*/
class PDF extends mPDF
{

  function Header()
  {   
    $this->SetY(5);
    $this->SetFont('Arial','8',12);
    $this->Image('images/bla2.jpg',135,10,30);
    $this->Cell(0,10,'รายงานผลตรวจสุขภาพ',0,1,'C');
    $this->Cell(0,3,'ผลประเมินลักษณะงานพิเศษ',0,1,'C');
    $this->Ln(5);
  }
  function Footer()
  {   
    $this->SetY(-15);
    $this->SetFont('THSaraban','8',0);

    $this->Cell(0,10,'หน้า ' .$this->PAGENO(),0,0,'C');
    $this->Cell(0,10,'ฝ่ายแพทย์และอนามัย                          ',0,0,'C');

  }
}
$pdf = new PDF('th', 'A4-L', '0', 'THSaraban');
$pdf->SetAutoFont();
$pdf->SetDisplayMode('fullpage');

$pdf->SetY(0);
$pdf->WriteHTML($html, 2);

$pdf->Output();


?>     


