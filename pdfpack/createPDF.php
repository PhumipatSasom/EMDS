<?php
require('pdfpack/mpdf.php');
require_once 	"../include/Configutf8.inc.php";
db_connect();
$html .= '<div align="center" style="width:800px;">
<img src="logo.jpg" width="85" height="133" border="0" />
</div>
<div align="center" style="width:800px; font-size:16px;">
<strong>แบบประเมินผลการปฏิบัติงาน</strong><br />
<strong>สำหรับพนักงานสายวิชาการ</strong>
</div>
<div align="center" style="width:800px; font-size:14px; margin-top:35px;">
<div align="right" style="width:270px; font-size:14px; float:left; padding-right:20px;">
สำหรับการประเมิน
</div>
<div align="left" style="width:200px; font-size:14px; float:left;">
ตามรอบปีประเมิน ครั้งที่ …………/…………<br />
ระยะเวลาการประเมิน………………………………<br />
ต่อสัญญาจ้าง<br />
ระยะเวลาการประเมิน………………………………
</div>
<div style="clear:both; line-height:0px; height:0px; width:0px;"></div>
</div>
<div align="left" style="width:700px; font-size:20px; margin-top:35px;">
ส่วนที่ 1 ประวัติส่วนตัว
</div>
<div align="left" style="width:700px; font-size:17px; margin-top:10px; margin-left:25px;">
1.    ชื่อ-สกุล  ...นนทวรรษ  ธงสิบสอง... อายุ ....30.... ปี วุฒิ การศึกษา ...ปริญญาโท (คอมพิวเตอร์อาร์ต).
</div>
<div align="left" style="width:700px; font-size:17px; margin-top:5px;">
ตำแหน่ง  ........อาจารย์.............      สังกัดสำนักวิชา ...เทคโนโลยีสารสนเทศ..................... 
</div>
<div align="left" style="width:700px; font-size:17px; margin-top:5px;">
2.  เริ่มเป็นพนักงานเมื่อวันที่ .......1.............. เดือน .......กุมภาพันธ์...... พ.ศ. .....2556.……..….......
</div>
<div align="left" style="width:700px; font-size:17px; margin-top:5px;">
รวมระยะเวลาการปฏิบัติงาน .....1...... ปี.....8..... เดือน ....0.... วัน (นับถึง......1 ตุลาคม 2557.……........) 
</div>';

$mpdf = new mPDF("UTF-8");
$mpdf->SetAutoFont();
$mpdf->WriteHTML($html);
$mpdf->Output();
?>

