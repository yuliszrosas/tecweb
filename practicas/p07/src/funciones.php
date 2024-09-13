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

    //Ejercicio 2
    function generarSecuenciaAleatoria() {
        $matriz = []; 
        $contador = 0;

        while (true) {
            $contador++;

            $num1 = rand(0, 1000);
            $num2 = rand(0, 1000);
            $num3 = rand(0, 1000);

            // Verificar si la secuencia cumple con el patrón impar, par, impar
            if ($num1 % 2 !== 0 && $num2 % 2 === 0 && $num3 % 2 !== 0) {
                // Agregar la secuencia válida a la matriz
                $matriz[] = [$num1, $num2, $num3];
                break; // Si se cumple el patrón, salir del bucle
            }
            // Agregar todas las secuencias generadas a la matriz
            $matriz[] = [$num1, $num2, $num3];
        }

        echo "<h3>Ejercicio 2: Secuencia Aleatoria</h3>";
        echo "<table border='1'>";
        echo "<tr><th>Iteración</th><th>Número 1</th><th>Número 2</th><th>Número 3</th></tr>";
        foreach ($matriz as $index => $secuencia) {
            echo "<tr><td>" . ($index + 1) . "</td><td>{$secuencia[0]}</td><td>{$secuencia[1]}</td><td>{$secuencia[2]}</td></tr>";
        }
        echo "</table>";

        $totalNumeros = count($matriz) * 3; 
        echo "<p>Total de iteraciones: {$contador}</p>";
        echo "<p>Cantidad de números generados: {$totalNumeros}</p>";
    }

    generarSecuenciaAleatoria();

?>