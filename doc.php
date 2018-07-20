<?php

require 'pdfpack/mpdf.php';
ob_start();
?>

<?php



//connect ฐานข้อมูล


 $Server = array(); 
 $PC = array();
 $Camera = array();
 // ตัวแปรแกน x

 
 
//sql สำหรับดึงข้อมูล จาก ฐานข้อมูล


	array_push($Server,8);
 array_push($PC,8);
 array_push($Camera,8);
 


//array_push คือการนำค่าที่ได้จาก sql ใส่เข้าไปตัวแปร array
 
 
  

?>
<!DOCTYPE HTML>

<!--
	Ion by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html  lang="en" class=" js no-touch">
<head><title>Chart</title>
  
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>     
        
        
    
</head>
<body>
<table width="1024" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><img src="img/HHnew.png" width="1350" height="160"  alt=""/></td>
  </tr>
</table>
  <!--HEADER START-->
 
   
   <script>
 $(function () {
        $('#container').highcharts({
            chart: {
                type: 'bar' //รูปแบบของ แผนภูมิ ในที่นี้ให้เป็น line
            },
            title: {
                text: 'Summary of Failur devices' //
            },
            
            xAxis: {
                categories: ['Device'],
				
				
				
            },
            yAxis: {
                title: {
                    text: 'Amount'
                }
            },
            tooltip: {
                enabled: true,
                formatter: function() {
                    return '<b>'+ this.series.name +'</b><br/>'+
                        this.x +': '+ this.y +' device';
                }
            },
   legend: {
                            layout: 'vertical',
                            align: 'right',
                            verticalAlign: 'top',
                            x: -10,
                            y: 100,
                            borderWidth: 2
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: false
                }
            },
            series: [{
                                name: '1: Server',
                                data: [<?= implode(',', $Server) // ข้อมูล array แกน y ?>]
								},{
                                name: '2: PC',
                                data: [<?= implode(',', $PC) // ข้อมูล array แกน y ?>]
								},{
                                name: '3: Camera',
                                data: [<?= implode(',', $Camera) // ข้อมูล array แกน y ?>]
								}
								
								]
        });
    });
        </script>
  <!--HEADER END-->

  <!--BANNER START-->
  
	<section id="main" >
	  
   		<div id="container"></div>
   		<p>&nbsp;</p>
            
	  
</section>
</fieldset>
   
</div>   

         
        </div>
      </div>
    </div>
  </div>
  <!--BANNER END-->
  
   
     
 
</body>

</html>
<?php $html = ob_get_contents();
ob_end_clean();
$pdf = new mPDF('th', 'A4', '0', 'THSaraban');
$pdf->SetAutoFont();
$pdf->SetDisplayMode('fullpage');
$pdf->SetTopMargin(8);
$pdf->WriteHTML($html,2);
$pdf->Output('สรุปสถานการณ์เครื่องจักรประจำวันที่ .pdf','I');
 ?>