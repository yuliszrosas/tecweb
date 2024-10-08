<?php
// Recibir los datos del formulario
$nombre = $_POST['nombre'];
$marca  = $_POST['marca'];
$modelo = $_POST['modelo'];
$precio = $_POST['precio'];
$cantidad = $_POST['unidades'];

// Conexión a la base de datos con @ para suprimir advertencias
@$link = new mysqli('localhost', 'root', '', 'marketzone');

// Comprobar la conexión
if ($link->connect_errno) {
    die('Falló la conexión: ' . $link->connect_error . '<br/>');
}

// Verificar si el producto ya existe
$sql_check = "SELECT * FROM productos WHERE nombre='$nombre' AND marca='$marca' AND modelo='$modelo'";
$result = $link->query($sql_check);

if ($result->num_rows > 0) {
    echo "El producto con el nombre, marca y modelo ya existe.";
} else {
    // Si el producto no existe, proceder con la carga de la imagen

    // Verificar si se subió la imagen correctamente
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0) {
        $imagen_tmp = $_FILES['imagen']['tmp_name'];
        $imagen_nombre = $_FILES['imagen']['name'];
        
        // Verificar el tipo de archivo
        $imagen_tipo = $_FILES['imagen']['type'];
        $imagen_tamaño = $_FILES['imagen']['size'];

        // Mensajes de depuración para saber qué tipo de imagen se sube y su tamaño
        echo "Tipo de archivo: " . $imagen_tipo . "<br>";
        echo "Tamaño de archivo: " . $imagen_tamaño . " bytes<br>";

        // Definir la ruta donde se almacenará la imagen
        $ruta_imagen = 'uploads/' . basename($imagen_nombre);

        // Verificar si la carpeta existe
        if (!is_dir('uploads')) {
            mkdir('uploads', 0777, true); // Crear la carpeta si no existe con permisos completos
        }

        // Mover la imagen a la carpeta destino
        if (!move_uploaded_file($imagen_tmp, $ruta_imagen)) {
            echo 'Error al subir la imagen. Código de error: ' . $_FILES['imagen']['error'] . '<br>';
            die('No se pudo mover la imagen a la carpeta de destino.');
        } else {
            echo "La imagen se subió correctamente a: " . $ruta_imagen . "<br>";
        }

        // Preparar la consulta para insertar el producto con 'eliminado' en 0 y la ruta de la imagen
        //$sql_insert = "INSERT INTO productos (nombre, marca, modelo, precio, unidades, imagen, eliminado) 
        //               VALUES ('$nombre', '$marca', '$modelo', $precio, $cantidad, '$ruta_imagen', 0)";
    
        // Nueva query sin 'id' ni 'eliminado'
        $sql_insert = "INSERT INTO productos (nombre, marca, modelo, precio, unidades, imagen) 
        VALUES (?, ?, ?, ?, ?, ?)";

        // Preparar la declaración
        $stmt = $link->prepare($sql_insert);

        // Vincular los parámetros (nombre, marca, modelo, precio, unidades, ruta de la imagen)
        $stmt->bind_param('sssdis', $nombre, $marca, $modelo, $precio, $cantidad, $ruta_imagen);

        // Ejecutar la declaración preparada
        if ($stmt->execute()) {
        // Mensaje si se inserta correctamente
        echo 'Producto insertado con ID: ' . $stmt->insert_id;
        } else {
        // Mensaje si no se pudo insertar
        echo 'El Producto no pudo ser insertado: ' . $stmt->error;
        }

        // Cerrar la declaración preparada
        $stmt->close();

        } 
        else {
        echo "Error al subir la imagen. Código de error: " . $_FILES['imagen']['error'] . "<br>";
        die('Error: No se pudo subir la imagen.');
        }
}

// Cerrar la conexión
$link->close();
?>
