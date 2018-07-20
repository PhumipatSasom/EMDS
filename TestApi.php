<?php
  $url = 'http://localhost:81/Api/RestfulApi.php'; 
  
  $data = "fn=login&test=1";
  
  /*$data = array(
        'fn' => "login" 
    );*/
  
  
  try{
    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_URL, $url );
    curl_setopt( $ch, CURLOPT_POSTFIELDS, $data );
    curl_setopt( $ch, CURLOPT_POST, true );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
    $content = curl_exec( $ch );
    curl_close($ch);
    
    print_r($content);
    
  }catch(Exception $ex){
  
    echo $ex;
  }
    
?>