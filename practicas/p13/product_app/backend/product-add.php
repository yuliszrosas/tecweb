<?php
   use Product_app\Backend\Myapi\Create\Create; 
   require_once __DIR__ . '/../vendor/autoload.php';

    $productos = new Create('marketzone');
    $productos->add( json_decode( json_encode($_POST) ) );
    echo $productos->getData();
?>