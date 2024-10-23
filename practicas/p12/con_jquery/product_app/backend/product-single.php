<?php

include_once __DIR__ . '/database.php';

if (isset($_POST['id'])) {
    $id = mysqli_real_escape_string($conexion, $_POST['id']); // Escapa el ID para evitar inyecciones SQL

    // Prepara la consulta para obtener el producto por su ID
    $query = "SELECT * FROM productos WHERE id = {$id}";
    $result = mysqli_query($conexion, $query);
    
    // Verifica si la consulta se ejecutó correctamente
    if (!$result) {
        die('Query Failed: ' . mysqli_error($conexion));
    }

    // Inicializa un array para almacenar el producto
    $json = array();
    if ($row = mysqli_fetch_assoc($result)) { // Cambia a fetch_assoc para obtener un solo producto
        $json = array(
            'nombre' => $row['nombre'], // Asegúrate de que los nombres de los campos sean correctos
            'precio' => $row['precio'],
            'unidades' => $row['unidades'],
            'modelo' => $row['modelo'],
            'marca' => $row['marca'],
            'detalles' => $row['detalles'],
            'imagen' => $row['imagen'],
            'id' => $row['id']
        );
    }

    // Convierte el array a JSON y lo imprime
    echo json_encode($json);
} else {
    echo json_encode(['error' => 'ID no proporcionado']);
}
?>
