<?php 
require 'pdfpack/mpdf.php';
ob_start();
 ?>
<!DOCTYPE html>
<html lang="en">

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
  <style>
  #customers {
    font-family: 'Mitr', sans-serif;
    border-collapse: collapse;
    width: 100%;
  }

  #customers td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
  }

  #customers tr:nth-child(even){background-color: #f2f2f2;}

  #customers tr:hover {background-color: #d9d9d9;}

  #customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: center;
    background-color: #00b3b3;
    color: #000000;
  }
</style>
<div id="index" class="jumbotron text-center" style="width: auto;height: auto;">
  <div class="row">
   <div class="col-sm-12" style="margin-left: 0px; ">
    <h2>2.3.3.4 Biomarker</h2>
    <p>สรุปผลการตรวจหา Biomarker นร่างกาย ในกลุ่มที่ปฏิบัติงานกับสารเคมีอันตราย </p>
    <a href="../srh/reportbio.php" target="_blank"><button type="button" class="btn btn-success">ดาวน์โหลดรายงาน<i class="fa fa-file-pdf-o" style="font-size:25px;color:#000000
    ;margin-left: 10px;"></i></button></a>
    <table id="customers" style="font-size: 20px; background-color: #c6ecd9;margin-top: 20px" >

      <tr >
        <th  rowspan="2">รายการตรวจ</th>
        <th  rowspan="2">หน่วย</th>
        <th  rowspan="2">สิ่งส่งตรวจวิเคราะห์</th>
        <th  rowspan="2">ค่ามตราฐาน(ไม่เกิน)</th>
        <th  rowspan="2">ข้อมูลอ้างอิงมีค่ามตราฐาน</th>
        <th  rowspan="2">จำนวนผู้เข้ารับการตรวจ(ราย)</th>
        <th colspan="2">ผลปกติ</th>
        <th colspan="2">ผลผิดปกติ</th>
      </tr>
      <tr >
        
        <th>จำนวน(ราย)</th>
        <th>ร้อยละ</th>
        <th>จำนวน(ราย)</th>
        <th>ร้อยละ</th>
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

    <u><p style="margin-top: 100px">กราฟแสดงร้อยละผลตรวจหา Biomarker ในร่างกาย ในพนักงานปฏิบัติงานกับสารเคมีอันตรายหน่วยงาน</p></u>
    <table id="tablechart">
      
      <tr >
        <td style="text-align: right;">Toluene(Hippuric)*</td>
        <td>5</td>
        
      </tr>
      <tr>
        <td style="text-align: right;">Benzene(Phenol)*</td>
        <td>3</td>
        
      </tr>
      <tr>
        <td style="text-align: right;">Mwthyl isobutyl ketone</td>
        <td>7</td>
        
      </tr>
      <tr>
        <td style="text-align: right;">Nickel</td>
        <td>10</td>
        
      </tr>
      <tr>
        <td style="text-align: right;">Lead in Blood</td>
        <td>9</td>
        
      </tr>
      <tr>
        <td style="text-align: right;">Toluene</td>
        <td>11</td>
        
      </tr>

      <tr>
        <td style="text-align: right;">Methanol</td>
        <td>11</td>
        
      </tr>

      <tr>
        <td style="text-align: right;">Acetone</td>
        <td>11</td>
        
      </tr>

      <tr>
        <td style="text-align: right;">Xylene(Methythippuric acid)</td>
        <td>11</td>
        
      </tr>

      <tr>
        <td style="text-align: right;">Benzene(t,t-Muconic acid)</td>
        <td>11</td>
        
      </tr>

      <tr>
        <td style="text-align: right;">Chromium(Total chromium)</td>
        <td>11</td>
        
      </tr>
      <tr>
        <td style="text-align: right;">Candmium</td>
        <td>11</td>
        
      </tr>
      <tr>
        <td style="text-align: right;">Mercury</td>
        <td>11</td>
        
      </tr>
      <tr>
        <td style="text-align: right;">Inorgenic arsenic(แม่เมาะ)</td>
        <td>11</td>
        
      </tr>
      <tr>
        <td style="text-align: right;">Arsenic(แม่เมาะ)</td>
        <td>11</td>
        
      </tr>
      <tr>
        <td style="text-align: right;">Trichloroacetic acid(แม่เมาะ)</td>
        <td>11</td>
        
      </tr>
      <tr>
        <td style="text-align: right;">nHexane(2,5Hexsnedione)(แม่เมาะ)</td>
        <td>11</td>
        
      </tr>
      <tr>
        <td style="text-align: right;">Cadmium in Blood</td>
        <td>11</td>
        
      </tr>
      <tr>
        <td style="text-align: right;">Ethybenzene (Mandelic acid)</td>
        <td>11</td>
        
      </tr>
      <tr>
        <td style="text-align: right;">CR IN BLOOD</td>
        <td>11</td>
        
      </tr>
      <tr>
        <td style="text-align: right;">NI IN BLOOD</td>
        <td>11</td>
        
      </tr>
      <tr>
        <td style="text-align: right;">HG IN BLOOD</td>
        <td>11</td>
        
      </tr>
      <tr>
        <td style="text-align: right;">MIN IN BLOOD</td>
        <td>11</td>
        
      </tr>
      
      
    </table>
    <style type="text/css">
    #tablechart {
      width: 100%;

      background: #eee;
      padding: 1em;
      margin: 1em auto;
      box-sizing: border-box;
      border: 1px solid #ccc;
    }

    #tablechart th { font-size: 20px }

    #tablechart td {
      font-size: 15px;
      font-weight: bold;
      border-bottom: 1px solid #fbfbfb;
      
      width: 20%;
      padding: .5em .25em;
      background-size: 0% 100%;
      background-repeat: no-repeat;
      -webkit-transition: all .75s ease-out;
      -moz-transition: all .75s ease-out;
      transition: all .75s ease-out;
    }

    #tablechart td:nth-child(2) {
      width: 40%;
      color: #000000;
      
      text-align: left;
      background-image: -webkit-linear-gradient(to right, #79d2a6, #79d2a6);
      background-image: -moz-linear-gradient(to right, #79d2a6, #79d2a6);
      background-image: linear-gradient(to right, #79d2a6, #79d2a6);
      background-position: left  top;
    }

    
  </style>

  <script type="text/javascript">
    var twoColComp = {
      init: function (){
        var tables = document.getElementsByTagName('table');

        for(var i = 0; i < tables.length; i++) {
          if (new RegExp('(^| )two-column-comp( |$)', 'gi').test(tables[i].className)){
           return;
         }

         var h = tables[i].clientHeight, 
         t = tables[i].getBoundingClientRect().top,
         wT = window.pageYOffset || document.documentElement.scrollTop,
         wH = window.innerHeight;

         if(wT + wH > t + h/2){
           this.make(tables[i]);
         }
       }
     },
     
     make : function(el){
      var rows = el.getElementsByTagName('tr'),
      vals = [],
      max,
      percent;

      for(var x = 0; x < rows.length; x++) {
        var cells = rows[x].getElementsByTagName('td');
        for(var y = 1; y < cells.length; y++){
          vals.push(parseInt(cells[y].innerHTML, 10));
        }
      }

      max = Math.max.apply( Math, vals );
      percent = 100/max;

      for(x = 0; x < rows.length; x++) {
        var cells = rows[x].getElementsByTagName('td');
        for(var y = 1; y < cells.length; y++){
          var currNum = parseInt(cells[y].innerHTML, 10);
          cells[y].style.backgroundSize = percent * currNum + "% 100%";
          cells[y].style.transitionDelay = x/20 + "s";
        } 
      }

      el.className =+ " two-column-comp"
    }
  }

  window.onload = function(){
    twoColComp.init();
  }

  window.onscroll = function(){
    twoColComp.init();
  }
</script>



</div>  
</div> 

</div>




<footer class="container-fluid text-center">
  <a href="#myPage" title="To Top">
    <span class="glyphicon glyphicon-chevron-up" style="color:#ff9900"></span>
  </a>
  <p>ควบคุมและดูแลโดย <a href="https://www.w3schools.com" title="Visit w3schools">ฝ่ายแพทย์และอนามัย</a></p>
</footer>



</body>
</html>


