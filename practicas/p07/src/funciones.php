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

    //Ejercicio 3
    if(isset($_GET['num']))
    {
        $num = $_GET['num'];
        encontrarMultiploWhile($num);
        encontrarMultiploDoWhile($num);
    }
    //Variante con while
    function encontrarMultiploWhile($num) {
        $random = rand(1, 100);

        while ($random % $num !== 0) {
            $random = rand(1, 100);
        }

        echo "<h3>Ejercicio 3 <br> Variante while</h3>";
        echo "<p>El primer múltiplo de {$num} encontrado es: {$random}";
    }

    //Variante con do-while
    function encontrarMultiploDoWhile($num) {
        do {
            $random = rand(1, 100);
        } while ($random % $num !== 0);

        echo "<h3>Variante do-while</h3>";
        echo "<p>El primer múltiplo de {$num} encontrado es: {$random}";
    }

    //Ejercicio 4
    function crearArregloASCII() {
        $arreglo = [];
        for ($i = 97; $i <= 122; $i++) {
            $arreglo[$i] = chr($i);
        }

        echo "<h3>Ejercicio 4</h3>";
        echo "<table border='1'><tr><th>Índice</th><th>Letra</th></tr>";
        foreach ($arreglo as $key => $value) {
            echo "<tr><td>{$key}</td><td>{$value}</td></tr>";
        }
        echo "</table>";
    }

    crearArregloASCII();
    
    //Ejercicio 5
    function identificarPersona() {
        if (isset($_POST['edad']) && isset($_POST['sexo'])) {
            $edad = $_POST['edad'];
            $sexo = $_POST['sexo'];

            // Validar si la persona es de sexo femenino y tiene edad entre 18 y 35 años
            if ($sexo === "femenino" && $edad >= 18 && $edad <= 35) {
                echo '<h3>Ejercicio 5</h3>';
                echo 'Bienvenida, usted está en el rango de edad permitido.';
            } else {
                echo '<h3>Ejercicio 5</h3>';
                echo "Lo sentimos, usted no está en el rango de edad permitido.";
            }
        }
    }

    identificarPersona();

    //Ejercicio 6
    function registrarVehiculos() {
        $vehiculos = [
            "ABC1223" => [
            "Auto" => ["marca" => "Toyota", "modelo" => 2015, "tipo" => "sedan"],
            "Propietario" => ["nombre" => "Carlos López", "ciudad" => "Guadalajara", "direccion" => "Av. Vallarta 123"]
            ],
            "DEF5665" => [
                "Auto" => ["marca" => "Ford", "modelo" => 2023, "tipo" => "hachback"],
                "Propietario" => ["nombre" => "Sofía Gutiérez", "ciudad" => "Puebla", "direccion" => "Calle Hidalgo 56"]
            ],
            "GHI9191" => [
                "Auto" => ["marca" => "Honda", "modelo" => 2015, "tipo" => "hatchback"],
                "Propietario" => ["nombre" => "Ricardo García", "ciudad" => "Puebla", "direccion" => "Blvd. 5 de Mayo 789"]
            ],
            "JKL2567" => [
                "Auto" => ["marca" => "Chevrolet", "modelo" => 2019, "tipo" => "sedan"],
                "Propietario" => ["nombre" => "Emilio Torres", "ciudad" => "Mérida", "direccion" => "Calle Independencia 321"]
            ],
            "MNO9981" => [
                "Auto" => ["marca" => "Nissan", "modelo" => 2024, "tipo" => "camioneta"],
                "Propietario" => ["nombre" => "Sebastián Rosas", "ciudad" => "Ciudad de México", "direccion" => "Paseo de la Reforma 852"]
            ],
            "PQR1611" => [
                "Auto" => ["marca" => "Volkswagen", "modelo" => 2009, "tipo" => "camioneta"],
                "Propietario" => ["nombre" => "Jorge Rojas", "ciudad" => "Querétaro", "direccion" => "Av. Universidad 104"]
            ],
            "STU3009" => [
                "Auto" => ["marca" => "Mazda", "modelo" => 2022, "tipo" => "hatchback"],
                "Propietario" => ["nombre" => "Elena Rodríguez", "ciudad" => "Puebla", "direccion" => "Calle 60 789"]
            ],
            "VWX1516" => [
                "Auto" => ["marca" => "Hyundai", "modelo" => 2020, "tipo" => "camioneta"],
                "Propietario" => ["nombre" => "Pedro Rosas", "ciudad" => "Ciudad de México", "direccion" => "Av. Chapultepec 100"]
            ],
            "YZA1809" => [
                "Auto" => ["marca" => "Kia", "modelo" => 2020, "tipo" => "sedan"],
                "Propietario" => ["nombre" => "Giovanni Fernández", "ciudad" => "Celaya", "direccion" => "Blvd. Adolfo López Mateos 200"]
            ],
            "BYW2125" => [
                "Auto" => ["marca" => "Subaru", "modelo" => 2021, "tipo" => "hatchback"],
                "Propietario" => ["nombre" => "Fernando Tapia", "ciudad" => "Cancún", "direccion" => "Calle Palenque 345"]
            ],
            "SSA2324" => [
                "Auto" => ["marca" => "Jeep", "modelo" => 2017, "tipo" => "camioneta"],
                "Propietario" => ["nombre" => "Andrea Ramírez", "ciudad" => "Veracruz", "direccion" => "Av. 5 de Febrero 678"]
            ],
            "TYL1795" => [
                "Auto" => ["marca" => "Peugeot", "modelo" => 2018, "tipo" => "camioneta"],
                "Propietario" => ["nombre" => "Carlos Morales", "ciudad" => "Oaxaca", "direccion" => "Calle de los Libres 987"]
            ],
            "KIN2425" => [
                "Auto" => ["marca" => "Renault", "modelo" => 2021, "tipo" => "hatchback"],
                "Propietario" => ["nombre" => "Isela Hernández", "ciudad" => "Morelia", "direccion" => "Av. Camelinas 456"]
            ],
            "BBK0704" => [
                "Auto" => ["marca" => "BMW", "modelo" => 2020, "tipo" => "sedan"],
                "Propietario" => ["nombre" => "Luis Álvarez", "ciudad" => "San Luis Potosí", "direccion" => "Calle Uresti 123"]
            ],
            "HLT2013" => [
                "Auto" => ["marca" => "Mercedes-Benz", "modelo" => 2022, "tipo" => "camioneta"],
                "Propietario" => ["nombre" => "Cristina Vargas", "ciudad" => "Tijuana", "direccion" => "Blvd. Agua Caliente 456"]
            ]
        ];

        // Verificar si se ha enviado una matrícula específica
        if (isset($_GET['matricula']) && !empty($_GET['matricula'])) {
            $matricula = $_GET['matricula'];

            // Buscar el vehículo por la matrícula
            if (array_key_exists($matricula, $vehiculos)) {
                // Mostrar los datos del vehículo encontrado
                echo "<h3>Ejercicio 6 <br> Consulta de los datos de un vehículo</h3>";
                echo "Matrícula: " . $matricula . "<br>";
                echo "Marca: " . $vehiculos[$matricula]["Auto"]["marca"] . "<br>";
                echo "Modelo: " . $vehiculos[$matricula]["Auto"]["modelo"] . "<br>";
                echo "Tipo: " . $vehiculos[$matricula]["Auto"]["tipo"] . "<br>";
                echo "Propietario: " . $vehiculos[$matricula]["Propietario"]["nombre"] . "<br>";
                echo "Ciudad: " . $vehiculos[$matricula]["Propietario"]["ciudad"] . "<br>";
                echo "Dirección: " . $vehiculos[$matricula]["Propietario"]["direccion"] . "<br>";
            } else {
                // Si la matrícula no existe, mostrar un mensaje
                echo "<p>El vehículo con matrícula {$matricula} no se encuentra registrado.</p>";
            }
        } 

        echo "<h3>Ejercicio 6 <br> Mostrar la estructura general del arreglo</h3>";
        print_r($vehiculos);
    }

    registrarVehiculos();
?>