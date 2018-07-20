<?php 
session_start();
if($_SESSION["id_citizen"] == "")
{
    echo "Please Login!";
    header("index.php");
    exit();
}

if($_SESSION['user_type'] != "admin")
{
    echo "This page for admin only!";
    exit();

} ?><?php  
  
date_default_timezone_set("Asia/Bangkok");
$q = $_GET['q'];
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
   
    $thai_date_return.= date("j",$time);
    $thai_date_return.=" ".$thai_month_arr[date("n",$time)];
    $thai_date_return.= " พ.ศ.".(date("Y",$time)+543);
    
    return $thai_date_return;
}

$datecon = strtotime($q);
echo thai_date($datecon);

  
?>