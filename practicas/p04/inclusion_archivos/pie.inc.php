<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <hr/>
    <?php
        echo "<div><h1 style=\"border-width:3;border-style:groove; background-color:
        #ffcc99;\"> Final de la página PHP Vínculos útiles : <a href=\"php.net\">php.net</a>
        &nbsp; <a href=\"mysql.org\">mysql.org</a></h1>";
        echo "Nombre del archivo ejecutado: ", $_SERVER['PHP_SELF'],"&nbsp;&nbsp; &nbsp;";
        echo "Nombre del archivo incluido: ", __FILE__ ,"</div>";
    ?>
</body>
</html>