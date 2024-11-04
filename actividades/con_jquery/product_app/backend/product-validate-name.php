<?php
 include_once __DIR__.'/database.php';

// Obtener la entrada JSON de la solicitud
$input = json_decode(file_get_contents('php://input'), true);

// Verificar si se ha enviado el nombre del producto
if (isset($input['nombre'])) {
    $nombre = $input['nombre'];

    // Preparar la consulta para verificar si el nombre del producto ya existe
    $query = "SELECT COUNT(*) as count FROM productos WHERE nombre = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $nombre); // "s" indica que el tipo de dato es string
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // Verificar si el nombre existe
    $exists = $row['count'] > 0;

    // Preparar la respuesta
    $response = [
        'exists' => $exists
    ];

    // Devolver la respuesta como JSON
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // Si no se proporciona el nombre, devolver un error
    http_response_code(400);
    echo json_encode(['error' => 'Nombre del producto no proporcionado.']);
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
