<?php
    use Product_app\Backend\Myapi\Read\Read; 
    require_once __DIR__ . '/../vendor/autoload.php';

    $productos = new Read('marketzone');
    $productos->single( $_POST['id'] );
    echo $productos->getData();
?>