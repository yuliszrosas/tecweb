<?php
    use Product_app\Backend\Myapi\Products;
    require_once __DIR__.'/myapi/Products.php';

    $productos = new Products('marketzone');
    $productos->edit( json_decode( json_encode($_POST) ) );
    echo $productos->getData();
?>
