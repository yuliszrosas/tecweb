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

</body>
</html>