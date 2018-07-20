<?php 
 



for ($x = 1; $x <= 210; $x++) {
  


					$mac_num= $_POST['mac-num'.$x];
					$hour= $_POST['machour'.$x];
					$Remark= $_POST['Remark'.$x];
					$problem= $_POST['mac-problem'.$x];
					$problem_date= $_POST['mac-date'.$x];
					$problem_time= $_POST['mac-time'.$x];
					$fix_status= $_POST['fix'.$x];
					$fix_date= $_POST['fix-date'.$x];
					$equipment_id = $_POST['equipment_id'.$x];
					$Remark_d= $_POST['macald'.$x];
					$date= $_POST['datereport'];
					$type= $_POST['detail_type'.$x];
					$delete = $_POST['de-tag'.$x];
					
					$respone = $_POST['respone'.$x];
				

if($problem_time==""){
						$problem_time = ("00:00");
					}
					
if($problem_date==""){
						$problem_date = ("0000-00-00");
					}
if($fix_date==""){
						$fix_date = ("0000-00-00");
					}

echo "eqid= ".$equipment_id." row = ".$x." eqnum = ".$mac_num." type = ".$type."<br>";
}
?>