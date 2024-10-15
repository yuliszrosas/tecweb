<?php
include_once __DIR__.'/database.php';

// SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
$producto = file_get_contents('php://input');
if (!empty($producto)) {
    // SE TRANSFORMA EL STRING DEL JSON A OBJETO
    $jsonOBJ = json_decode($producto);

    // Validar que el objeto JSON contenga las propiedades necesarias
    if (isset($jsonOBJ->nombre, $jsonOBJ->marca, $jsonOBJ->modelo, $jsonOBJ->precio, $jsonOBJ->detalles, $jsonOBJ->unidades, $jsonOBJ->imagen)) {
        // Preparar la consulta de inserción

        // Asignar los valores del JSON a variables
        $nombre = $jsonOBJ->nombre;
        
        // Validar si el producto ya existe en la BD (nombre, marca y modelo)
        $sql = "SELECT * FROM productos WHERE nombre = ? AND eliminado = 0";
        $stmt = $conexion->prepare($sql); // Cambié $conn por $conexion
        $stmt->bind_param("s", $nombre);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Si el producto ya existe, se envía este mensaje y se termina el script
            echo json_encode(['status' => 'error', 'message' => 'El producto ya existe en la base de datos.']);
            exit();
        }

        $sql = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen, eliminado) VALUES (?, ?, ?, ?, ?, ?, ?, 0)";
        $stmt = $conexion->prepare($sql);
        // Vincular parámetros
        $stmt->bind_param(
            "sssdsis",
            $jsonOBJ->nombre, 
            $jsonOBJ->marca, 
            $jsonOBJ->modelo, 
            $jsonOBJ->precio, 
            $jsonOBJ->detalles, 
            $jsonOBJ->unidades, 
            $jsonOBJ->imagen
        );

        // Intentar ejecutar la consulta
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Producto agregado exitosamente.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al agregar el producto: ' . $stmt->error]);
        }

        // Cerrar la declaración
        $stmt->close();
    } 
} 

// Cerrar la conexión a la base de datos
$conexion->close();
?>