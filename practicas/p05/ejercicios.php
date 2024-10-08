<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Ejercicios en PHP</title>
</head>
<body>
    <h2>Ejercicio 1</h2>
    <p>
    <?php
        // Ejercicio 1: Muestra qué variables son válidas y por qué
        $variables = array(
            '$_myvar' => 'Válida: Comienza con $ seguido de un guion bajo y luego caracteres válidos.',
            '$_7var' => 'Válida: Comienza con $ seguido de un guion bajo y luego caracteres válidos (número después de un guion bajo es permitido).',
            'myvar' => 'Inválida: No comienza con el signo $.',
            '$myvar' => 'Válida: Comienza con $ seguido de letras.',
            '$var7' => 'Válida: Comienza con $ seguido de letras y termina con un número.',
            '$_element1' => 'Válida: Comienza con $ seguido de un guion bajo y luego caracteres válidos.',
            '$house*5' => 'Inválida: Contiene un carácter especial (*) no permitido.'
        );

        echo '<pre>';
        print_r($variables);
        echo '</pre>';
    ?>
    </p>

    <h2>Ejercicio 2</h2>
    <p>
    <?php
        // Ejercicio 2: Mostrar contenido de variables
        $a = "ManejadorSQL";
        $b = 'MySQL';
        $c = &$a;
        echo "a: $a".'<br>';
        echo "b: $b".'<br>';
        echo "c: $c".'<br>';
        
        $a = "PHP server";
        $b = &$a;
        echo '<br> Después de cambiar';
        echo '<br>'."a: $a"; 
        echo '<br>'."b: $b";
        echo '<br>'."c: $c";

        echo '<br><br>En el segundo bloque de asignaciones, se realiza lo siguiente: 
            <br>$a se le asigna el valor "PHP server". Ahora $a contiene "PHP server".
            <br>$b se asigna como una referencia a $a. Esto significa que $b ahora apunta a la misma ubicación en la memoria que $a. Cualquier cambio en $a también se reflejará en $b.
            <br>Debido a esto, tanto $a como $b tienen el valor "PHP server" después de la asignación.
            <br>La variable $c sigue siendo una referencia a $a. Como $a ha cambiado su valor a "PHP server", $c también refleja este cambio.';
    ?>
    </p>
    <h2>Ejercicio 3</h2>
    <p>
        <?php
            $a = "PHP5";
            echo '$a = ' . $a . '<br>';

            $z[] = &$a; 
            echo '$z[0] = ' . $z[0] . '<br>';

            $b = "5a version de PHP";
            echo '$b = ' . $b . '<br>';

            $c = $b * 10;
            echo '$c = ' . $c . '<br>';

            $a .= $b; 
            echo '$a = ' . $a . '<br>';

            $b *= $c; 
            echo '$b = ' . $b . '<br>';

            $z[0] = "MySQL"; 
            echo '$z[0] = ' . $z[0] . '<br>';
        ?>
    </p>
    <h2>Ejercicio 4</h2>
    <p>
    <?php
        $a = "PHP5";
        $z[] = &$a; 
        $b = "5a version de PHP";
        $c = $b * 10; 
        $a .= $b; 
        $b *= $c; 
        $z[0] = "MySQL"; 

        // Mostrar valores usando $GLOBALS
        echo '$GLOBALS["a"] = ' . $GLOBALS['a'] . '<br>'; 
        echo '$GLOBALS["b"] = ' . $GLOBALS['b'] . '<br>'; 
        echo '$GLOBALS["c"] = ' . $GLOBALS['c'] . '<br>'; 
        echo '$GLOBALS["z"][0] = ' . $GLOBALS['z'][0] . '<br>'; 
        ?>
    </p>
    <h2>Ejercicio 5</h2>
    <p>
        <?php
            $a1 = "7 personas"; 
            $b1 = (integer) $a1; 
            $a1 = "9E3"; 
            $c1 = (double) $a1; 

            echo '$a = ' . $a1 . '<br>'; 
            echo '$b = ' . $b1 . '<br>';
            echo '$c = ' . $c1 . '<br>';
        ?>
    </p>
    <h2>Ejericio 6</h2>
    <p>
        <?php
        // Inicialización de variables
        $a2 = "0";         
        $b2 = "TRUE";      
        $c2 = FALSE;       
        $d2 = ($a2 OR $b2);  
        $e2 = ($a2 AND $c2); 
        $f2 = ($a2 XOR $b2);
    
        // Mostrar los valores usando var_dump
        echo "\$a: ";
        var_dump($a2); 
        echo '<br>';
        echo "\$b: ";
        var_dump($b2); 
        echo '<br>';
        echo "\$c: ";
        var_dump($c2); 
        echo '<br>';
        echo "\$d: ";
        var_dump($d2); 
        echo '<br>';
        echo "\$e: ";
        var_dump($e2); 
        echo '<br>';
        echo "\$f: ";
        var_dump($f2);
        echo '<br>';
        echo '<br>';
        ?>
    </p>
    <h2>Ejercicio 7</h2>
    <p>
    <?php
        // a. Obtener la versión de Apache y PHP
        echo 'Versión de Apache: ' . (isset($_SERVER['SERVER_SOFTWARE']) ? $_SERVER['SERVER_SOFTWARE'] : 'No disponible') . '<br>';
        echo 'Versión de PHP: ' . phpversion() . '<br>';

        // b. Obtener el nombre del sistema operativo del servidor
        echo 'Sistema Operativo del Servidor: ' . (PHP_OS_FAMILY ? PHP_OS_FAMILY : 'No disponible') . '<br>';

        // c. Obtener el idioma del navegador del cliente
        echo 'Idioma del Navegador del Cliente: ' . (isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? $_SERVER['HTTP_ACCEPT_LANGUAGE'] : 'No disponible') . '<br>';
        ?>

    </p>

</body>
</html>