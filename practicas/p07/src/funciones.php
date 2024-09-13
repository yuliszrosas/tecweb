<?php
    //Ejercicio 1
   if(isset($_GET['numero']))
    {
        $numero = $_GET['numero'];
        $resultado = verificarMultiplo($numero);
        echo $resultado;
    }
    function verificarMultiplo($numero) 
    {
        if ($numero % 5 == 0 && $numero % 7 == 0) 
        {
            return '<h3>R= El número ' . $numero . ' SÍ es múltiplo de 5 y 7.</h3>';
        } 
        else 
        {
            return '<h3>R= El número ' . $numero . ' NO es múltiplo de 5 y 7.</h3>';
        }
    }
?>