<?php

    $url = 'http://localhost/api_rest_php/public_html/api/user';
    $class = '/user';
    $param = '';

    $response = file_get_contents($url.$class.$param);

   echo $response;

   
   $response = json_decode($response, 1);
   var_dump($response['data'][1]['email']);