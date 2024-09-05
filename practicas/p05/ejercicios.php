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

</body>
</html>