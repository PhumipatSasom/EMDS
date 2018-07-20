	  
			  
			  <?php
require('pdfpack/mpdf.php');
require_once 	"../include/Configutf8.inc.php";
db_connect();
$html .= '<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
			    <td align="center"><img src="logo.jpg" width="108" height="170" border="0" /></td>
			  </tr></table>
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
			    <td align="center">แบบประเมินผลการปฏิบัติงาน<br />
			      สำหรับพนักงานสายวิชาการ</td>
			  </tr>	</table>';
$html .= '<table width="100%" border="0" cellpadding="2" cellspacing="3">
				<tr class="fontwhite bgblack">
			    <td width="15%">Name</td>
                <td width="15%">กลุ่มที่</td>
                <td width="15%">ระดับปริญญา</td>
                <td width="15%">Start-End</td>
                 <td width="6%">จำนวนนักศึกษา</td>
                <td width="6%">หน่วยกิต</td>
                <td width="15%" >ชั่วโมง การสอน lecturer</td>
                <td width="15%" >ชั่วโมง การสอน Lab</td>
                <td width="15%" >สอน lecturer ทุกๆวัน<br />
                  เริ่มเวลา</td>
                <td width="15%" >สอน lab ทุกๆวัน<br />
เริ่มเวลา</td>
			  </tr>';

				$sql="SELECT * FROM qasystem_teaching";
				$query=mysql_query($sql);
				$querynum=mysql_num_rows($query);
				$countn=0;
				$countnloop=0;
				if($querynum>=1){
					while($row=mysql_fetch_object($query)){
					$html .= '<tr>';
						$html .= '<td>'.$row->subjectcode.'<br />'.$row->tsubjectname.'</td>';
                        $html .= '<td>'.$row->tgroup.'</td>';
                        $html .= '<td>';
							if($row->tteachtype=="1"){
								$html .= "ระดับปริญญาตรี";
							}else{
								$html .= "ระดับบัณฑิตศึกษา";
							}
                        $html .= '</td>';
                        $html .= '<td>'.$row->tstartdate.'<br />'.$row->tenddate.'</td>';
                         $html .= '<td>'.$row->tstudentnumber.'</td>';
						$html .= '<td>'.$row->tpoint.'</td>';
                        $html .= '<td>'.$row->tleceverytimes.'</td>';
                        $html .= '<td>'.$row->tlabeverytimes.'</td>';
                        $html .= '<td>'.$row->tlecevery.'<br />'.$row->tleceverytime.'</td>';
                        $html .= '<td>'.$row->tlabevery.'<br />'.$row->tlabeverytime.'</td>';
                        $html .= '</tr>';
					}
				}else{
					$html .= '<tr><td colspan="9">No data</td></tr>';
				}
                
                
$html .= '</table>';

$mpdf = new mPDF("UTF-8");
$mpdf->SetAutoFont();
$mpdf->WriteHTML($html);
$mpdf->Output();
?>