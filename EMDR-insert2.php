<?php include 'DBConnect.php';
mysql_select_db($databasename, $DB);
session_start();

$qlast = "SELECT * FROM daily_report WHERE TimeDate_record = '".$_POST['datereport']."'";

$last = mysql_query($qlast, $DB) or die(mysql_error());

$num = intval(mysql_num_rows($last));
date_default_timezone_set("Asia/Bangkok");
$date = $_POST['datereport'];
$numemp ="";
$empty = intval($numemp);
if ($num == 0) {
 
  $maxrowtm= $_POST['maxrowtm'];  

      //insert new row
 
//update existing row
for ($x = 1; $x <= $maxrowtm; $x++) {
  


$macid= $_POST['Equipment_id'.$x];
$mac_want= $_POST['Equipment_require'.$x];


$recid= $_POST['recid'.$x];
$delete= $_POST['delete'.$x];
$date= $_POST['datereport'];
$amount =  $_POST['amount'.$x];
 if($mac_want==""){
 	$mac_want = 0;
 }

if($delete==""){

	switch ($_SESSION['user_type']) {
    case "me_ct":
        $log=4;
        break;
    case "sc":
        $log=5;
        break;
    case "tm":
         $log=2;
        break;
    case "me":
        $log=3;
        break;
   case "admin":
       
            $log=1;

}
		mysql_select_db($databasename, $DB);
		$qmact_update = "INSERT into  daily_report values($empty,$macid,$amount,$mac_want,'$date',$log)";

		$mact = mysql_query($qmact_update, $DB) or die(mysql_error(). "<br />" . $qmact_update. "<br /> row =" .$x);
	}


	
}






      
  $maxrowme= $_POST['maxrowme'];  

   

//update existing row
for ($x = 1; $x <= $maxrowme; $x++) {
  


$macid= $_POST['Equipment_id-m'.$x];
$mac_want= $_POST['Equipment_require-m'.$x];


$recid= $_POST['recid-m'.$x];
$delete= $_POST['delete-m'.$x];
$amount =  $_POST['amount-m'.$x];
if($mac_want==""){
 	$mac_want = 0;
 }

 $total = $pm+$cm ;

if($delete==""){
            
		mysql_select_db($databasename, $DB);
		$qmact_update = "INSERT into  daily_report values($empty,$macid,$amount,$mac_want,'$date',1)";

		$mact = mysql_query($qmact_update, $DB) or die(mysql_error(). "<br />" . $qmact_update. "<br /> row =" .$x);
	}

	
	
	
}

 

     $maxrowdetail= intval($_POST['maxrowdetail']);



for ($x = 1; $x <= $maxrowdetail; $x++) {
  


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
$finishdate = $_POST['fi-tag'.$x];
$respone = $_POST['respone'.$x];
$add = $_POST['add-tag'.$x];

if($problem_time==""){
						$problem_time = ("00:00");
					}
					
if($problem_date==""){
						$problem_date = ("0000-00-00");
					}
if($fix_date==""){
						$fix_date = ("0000-00-00");
					}


	if($delete==""){

	mysql_select_db($databasename, $DB);


				
				$qmacdetail_insert = "INSERT INTO daily_detail values($empty,'$type',$equipment_id,'$mac_num','$Remark','$hour','$problem','$problem_date','$problem_time','$fix_status','$finishdate','$fix_date','$Remark_d','$date','$respone')";



$macm = mysql_query($qmacdetail_insert, $DB) or die(mysql_error(). "<br />" . $qmacdetail_insert. "<br /> row =" .$x);
}

	


}



      $detail_remarktable_insert = "INSERT INTO detail_remark values($empty,'".$_POST['detail_remark-table']."','table','".$_POST['datereport']."',CURDATE(),CURTIME())";

$detail_remarktable = mysql_query($detail_remarktable_insert, $DB) or die(mysql_error());

$detail_remarktm_insert = "INSERT INTO detail_remark values($empty,'".$_POST['detail_remark-tm']."','tm','".$_POST['datereport']."',CURDATE(),CURTIME())";

$detail_remarktm = mysql_query($detail_remarktm_insert, $DB) or die(mysql_error());

$detail_remarkme_insert = "INSERT INTO detail_remark values($empty,'".$_POST['detail_remark-me']."','me','".$_POST['datereport']."',CURDATE(),CURTIME())";

$detail_remarkme = mysql_query($detail_remarkme_insert, $DB) or die(mysql_error());

$detail_remarkmect_insert = "INSERT INTO detail_remark values($empty,'".$_POST['detail_remark-me-2']."','me_ct','".$_POST['datereport']."',CURDATE(),CURTIME())";

$detail_remarkmect = mysql_query($detail_remarkmect_insert, $DB) or die(mysql_error());

$detail_remarksc_insert = "INSERT INTO detail_remark values($empty,'".$_POST['detail_remark-sc']."','sc','".$_POST['datereport']."',CURDATE(),CURTIME())";

$detail_remarksc = mysql_query($detail_remarksc_insert, $DB) or die(mysql_error());

    } else{


    	$maxrowtm= $_POST['maxrowtm'];  
  		switch ($_SESSION['user_type']) {
    case "me_ct":
        $log=4;
        break;
    case "sc":
        $log=5;
        break;
    case "tm":
         $log=2;
        break;
    case "me":
        $log=3;
        break;
   case "admin":
       
            $log=1;

}

//update existing row
			for ($x = 1; $x <= $maxrowtm; $x++) {
			  


			$macid= $_POST['Equipment_id'.$x];
			$mac_want= $_POST['Equipment_require'.$x];
			
			
			$recid= $_POST['recid'.$x];
			$delete= $_POST['delete'.$x];
if($mac_want==""){
 	$mac_want = 0;
 }



			if($delete==""){

				
					mysql_select_db($databasename, $DB);
					$qmact_update = "UPDATE daily_report
					SET Equipment_require = ".$mac_want.",
					
					Equipment_id = ".$macid.",
					
					Log = $log

					 WHERE Record_id= ".$recid.";";

					$mact = mysql_query($qmact_update, $DB) or die(mysql_error());
				}else{
					mysql_select_db($databasename, $DB);
					$qmact_update = "DELETE 
									FROM  daily_report 
									WHERE Record_id = $recid";
						$dedes = mysql_query($qmact_update, $DB) or die(mysql_error(). "<br />" . $qmact_update. "<br /> row =" .$x);

						
				
				}


				
			}

			$maxrowme= $_POST['maxrowme'];  

   

//update existing row
					for ($x = 1; $x <= $maxrowme; $x++) {
					  


					$macid= $_POST['Equipment_id-m'.$x];
					$mac_want= $_POST['Equipment_require-m'.$x];
					
					
					$recid= $_POST['recid-m'.$x];
					$delete= $_POST['delete-m'.$x];
						if($mac_want==""){
						 	$mac_want = 0;
						 }

					if($delete==""){

							mysql_select_db($databasename, $DB);
							$qmact_update = "UPDATE daily_report
							SET Equipment_require = ".$mac_want.",
							
							Equipment_id = ".$macid.",
							
							Log = $log 
							WHERE Record_id= ".$recid.";";

							$mact = mysql_query($qmact_update, $DB) or die(mysql_error(). "<br />" . $qmact_update);
						}else{
							mysql_select_db($databasename, $DB);
							$qmact_update = "DELETE 
									FROM  daily_report 
									WHERE Record_id = $recid";
							
							$mactdes = mysql_query($qmact_update, $DB) or die(mysql_error(). "<br />" . $qmact_update);

							



						}

						
						
						
					}
				$qde = "SELECT * FROM daily_detail a  where a.Record_date = '".$_POST['datereport']."'    GROUP by a.detail_id ";

				$de = mysql_query($qde, $DB) or die(mysql_error());

				$num = intval(mysql_num_rows($de));

				$maxrowdetail= $_POST['maxrowdetail'];



				for ($x = $num+1; $x <= $maxrowdetail; $x++) {
				  

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
				$finishdate = $_POST['fi-tag'.$x];
				$respone = $_POST['respone'.$x];
				$type= $_POST['detail_type'.$x];
				$add = $_POST['add-tag'.$x];
                     
                     $qmacnum = "SELECT * FROM daily_detail a  where Equipment_number = '$mac_num' and detail_type = '$type' and Record_date = '$date' ";

				$macnum = mysql_query($qmacnum, $DB) or die(mysql_error(). "<br />" . $qmacnum);

				$nummac = intval(mysql_num_rows($macnum));

                     if($add=="1"){
                     	if($nummac==0){
					if($problem_time==""){
						$problem_time = ("00:00");
					}
					if($problem_date==""){
						$problem_date = ("0000-00-00");
					}
					if($fix_date==""){
						$fix_date = ("0000-00-00");
					}
				

					if($equipment_id!=""){

					mysql_select_db($databasename, $DB);

					
				$qmacdetail_insert = "INSERT INTO daily_detail values($empty,'$type',$equipment_id,'$mac_num','$Remark','$hour','$problem','$problem_date','$problem_time','$fix_status','$finishdate','$fix_date','$Remark_d','$date','$respone')";

				$macm = mysql_query($qmacdetail_insert, $DB) or die(mysql_error(). "<br />" . $qmacdetail_insert. "<br />" .$x);

       
}
		}	}	
				}




			for ($x = 1; $x <= $num; $x++) {
			  
			$detail_id= $_POST['detail_id'.$x];
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
			$finishdate = $_POST['fi-tag'.$x];
			$respone = $_POST['respone'.$x];
			$add = $_POST['add-tag'.$x];

if($problem_time==""){
						$problem_time = ("00:00");
					}
					if($problem_date==""){
						$problem_date = ("0000-00-00");
					}
					if($fix_date==""){
						$fix_date = ("0000-00-00");
					}
				mysql_select_db($databasename, $DB);
			if($delete==""){
				
						$qmactmdetail_update = "UPDATE daily_detail set 
						detail_type='$type',
						Equipment_number='$mac_num',
						PM_CM='$Remark',
						Description = '$problem',
						Equipment_id = $equipment_id,
						Remark='$Remark_d',
						
						date='$problem_date',
						time='$problem_time',
						action='$fix_status',
						action_date='$fix_date'
						
						 
						WHERE detail_id = '$detail_id' ;";
				
			

			$macm = mysql_query($qmactmdetail_update, $DB) or die(mysql_error(). "<br />" . $qmactmdetail_update. "<br />" .$x);

			}else{
			 $qmactmdetail_delete = "DELETE FROM daily_detail WHERE detail_id = '$detail_id' ;";

			$macm = mysql_query($qmactmdetail_delete, $DB) or die(mysql_error(). "<br />" . $qmactmdetail_delete);

			}


}
}

$detail_remarktable_edit = "UPDATE detail_remark set Remark_detail = '".$_POST['detail_remark-table']."'  WHERE Remark_id = ". $_POST['detail_remark-table-id'];

$detail_remarktable = mysql_query($detail_remarktable_edit, $DB) or die(mysql_error());

$detail_remarktm_edit = "UPDATE detail_remark set Remark_detail = '".$_POST['detail_remark-tm']."'   WHERE Remark_id = ". $_POST['detail_remark-tm-id'];

$detail_remarktm = mysql_query($detail_remarktm_edit, $DB) or die(mysql_error());
$detail_remarkme_edit = "UPDATE detail_remark set Remark_detail = '".$_POST['detail_remark-me']."'  WHERE Remark_id = ". $_POST['detail_remark-me-id'];

$detail_remarkme = mysql_query($detail_remarkme_edit, $DB) or die(mysql_error());


$detail_remarkmect_edit = "UPDATE detail_remark set Remark_detail = '".$_POST['detail_remark-me-2']."' WHERE Remark_id = ". $_POST['detail_remark-me-id-2'];

$detail_remarkmect = mysql_query($detail_remarkmect_edit, $DB) or die(mysql_error());

$detail_remarksc_edit = "UPDATE detail_remark set Remark_detail = '".$_POST['detail_remark-sc']."' WHERE Remark_id = ". $_POST['detail_remark-sc-id'];

$detail_remarksc = mysql_query($detail_remarksc_edit, $DB) or die(mysql_error());




$frommodal= $_POST['addfrommodal'];



if($frommodal=="frommodal"){

$insertGoTo = "EditMachineRecorded.php?dateurl=".$date;


header(sprintf("Location: %s", $insertGoTo));
}else{
$insertGoTo = "EMDR-equipment_group2.php?dateurl=".$date;


header(sprintf("Location: %s", $insertGoTo));

}
?>




