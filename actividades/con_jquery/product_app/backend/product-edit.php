<?php
include_once __DIR__ . '/database.php';

// SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
$producto = file_get_contents('php://input');
$data = array(
    'status' => 'error',
    'message' => 'El producto no se pudo actualizar.'
);

if (!empty($producto)) {
    // SE TRANSFORMA EL STRING DEL JSON A OBJETO
    $jsonOBJ = json_decode($producto);

    // Asegúrate de que el ID del producto esté presente
    if (isset($jsonOBJ->id)) {
        $id = $jsonOBJ->id;

        // Se asume que los datos ya fueron validados antes de enviarse
        $sql = "UPDATE productos SET 
                    nombre = '{$jsonOBJ->nombre}', 
                    marca = '{$jsonOBJ->marca}', 
                    modelo = '{$jsonOBJ->modelo}', 
                    precio = {$jsonOBJ->precio}, 
                    detalles = '{$jsonOBJ->detalles}', 
                    unidades = {$jsonOBJ->unidades}, 
                    imagen = '{$jsonOBJ->imagen}' 
                WHERE id = $id AND eliminado = 0";

        // Ejecuta la consulta
        if ($conexion->query($sql) === TRUE) {
            $data['status'] = "success";
            $data['message'] = "Producto actualizado correctamente";
        } else {
            $data['message'] = "ERROR: No se ejecutó $sql. " . mysqli_error($conexion);
        }
    } else {
        $data['message'] = "ERROR: ID de producto no proporcionado.";
    }
    // Cierra la conexión
    $conexion->close();
}

// SE HACE LA CONVERSIÓN DE ARRAY A JSON
echo json_encode($data, JSON_PRETTY_PRINT);
?>
