<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica 7</title>
</head>
<body>
    <h2>Ejemplo de POST</h2>
    <form action="http://localhost/tecweb/practicas/p04/index.php" method="post">
        Name: <input type="text" name="name"><br>
        E-mail: <input type="text" name="email"><br>
        <input type="submit">
    </form>
    <br>
    <?php
        if(isset($_POST["name"]) && isset($_POST["email"]))
        {
            echo $_POST["name"];
            echo '<br>';
            echo $_POST["email"];
        }
    ?>

    <h2>Ejercicio 1</h2>
    <p>Escribir programa para comprobar si un número es un múltiplo de 5 y 7</p>
    <form action="src/funciones.php" method="get">
        <label for="numero">Introduce un número:</label>
        <input type="text" id="numero" name="numero" required>
        <input type="submit" value="Enviar">
    </form>

    <h2>Ejercicio 2</h2>
    <p>Crear un programa para la generación repetitiva de 3 números aleatorios
        hasta obtener una secuencia compuesta por: impar, par, impar
    </p>
    <form action="src/funciones.php" method="get">
        <input type="submit" value="Generar secuencia">
    </form>

    <h2>Ejercicio 3</h2>
    <p>Utiliza un ciclo while para encontrar el primer número entero obtenido aleatoriamente,
        pero que además sea múltiplo de un número dado.

        <ul>
            <li>Crear una variante de este script utilizando el diclo do-while</li>
            <li>El número dado se debe obtener vía GET</li>   
        </ul>
    </p>
    <form action="src/funciones.php" method="get">
        <label for="num">Introduce un número:</label>
        <input type="text" id="num" name="num" required>
        <input type="submit" value="Enviar">
    </form> 

    <h2>Ejercicio 4</h2>
    <p>Crear un arreglo cuyos índices van de 97 a 122 y cuyos valores son las letras de la a
       a la z. Usa la función chr(n) que devuelve el caracter cuyo código ASCII es n para poner
       el valor en cada índice.
    </p>
    <form action="src/funciones.php" method="get">
        <input type="submit" value="Generar arreglo">
    </form>

    <h2>Ejercicio 5</h2>
    <p>Usar las variables $edad y $sexo en una instrucción if para identificar una persona de
        sexo “femenino”, cuya edad oscile entre los 18 y 35 años y mostrar un mensaje de
        bienvenida apropiado.
    </p>
    <form action="src/funciones.php" method="post">
        <label for="edad">Edad:</label>
        <input type="number" id="edad" name="edad" required>
        <br>
        <label for="sexo">Sexo:</label>
        <select id="sexo" name="sexo" required>
            <option value="femenino">Femenino</option>
            <option value="masculino">Masculino</option>
        </select>
        <br>
        <input type="submit" value="Enviar">
    </form>

    <h2>Ejercicio 6</h2>
    <p>
    Crea en código duro un arreglo asociativo que sirva para registrar el parque vehicular de
    una ciudad.
    </p>
    <p>Consultar información del parque vehicular.</p>
    <form action="src/funciones.php" method="get">
        <label for="matricula">Buscar por matrícula:</label>
        <input type="text" id="matricula" name="matricula">
        <input type="hidden" name="ejercicio" value="6">
        <input type="submit" value="Consultar">
    </form>
    <form action="src/funciones.php" method="get">
        <input type="hidden" name="ejercicio" value="6">
        <input type="hidden" name="mostrar_todos" value="1">
        <input type="submit" value="Mostrar Todos">
    </form>
</body>
</html>