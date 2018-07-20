<?php

$curlResource = curl_init();
curl_setopt($curlResource, CURLOPT_URL, "http://www.emworkgroup.com/career.html");
curl_exec($curlResource);
curl_close($curlResource);

?>