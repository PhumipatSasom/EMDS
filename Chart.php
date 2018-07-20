

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
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,600|Raleway:600,300|Josefin+Slab:400,700,600italic,600,400italic' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" type="text/css" href="css/slick-team-slider.css" />
  <link rel="stylesheet" type="text/css" href="css/style.css">
		
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
		<script src="js/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-xlarge.css" />
            

		</noscript>
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
