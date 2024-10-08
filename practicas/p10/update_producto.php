<?php
// Conexión a la base de datos MySQL
$link = mysqli_connect("localhost", "root", "", "marketzone");

// Chequea la conexión
if($link === false){
    die("ERROR: No pudo conectarse con la DB. " . mysqli_connect_error());
}

// Verifica si se han enviado los datos del formulario
if (isset($_POST['id']) && isset($_POST['nombre']) && isset($_POST['marca']) && isset($_POST['modelo']) && isset($_POST['precio']) && isset($_POST['unidades']) && isset($_POST['detalles'])) {
    
    // Obtiene los datos enviados del formulario
    $id = mysqli_real_escape_string($link, $_POST['id']);
    $nombre = mysqli_real_escape_string($link, $_POST['nombre']);
    $marca = mysqli_real_escape_string($link, $_POST['marca']);
    $modelo = mysqli_real_escape_string($link, $_POST['modelo']);
    $precio = mysqli_real_escape_string($link, $_POST['precio']);
    $unidades = mysqli_real_escape_string($link, $_POST['unidades']);
    $detalles = mysqli_real_escape_string($link, $_POST['detalles']);

    // Verifica si se subió una imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        // Directorio donde se guardarán las imágenes
        $target_dir = "images/";
        // Nombre del archivo de imagen (se recomienda renombrarlo para evitar colisiones)
        $target_file = $target_dir . basename($_FILES["imagen"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Verifica si el archivo es una imagen válida
        $check = getimagesize($_FILES["imagen"]["tmp_name"]);
        if($check === false) {
            echo "El archivo no es una imagen válida.";
            exit;
        }

        // Extensiones de archivo permitidas
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageFileType, $allowed_extensions)) {
            echo "Solo se permiten archivos JPG, JPEG, PNG y GIF.";
            exit;
        }

        // Verifica el tamaño del archivo (por ejemplo, máximo 5MB)
        if ($_FILES["imagen"]["size"] > 5000000) {
            echo "El archivo es demasiado grande.";
            exit;
        }

        // Si todo está bien, mueve el archivo a la carpeta de destino
        if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
            // Actualiza el producto en la base de datos, incluyendo la imagen
            $sql = "UPDATE productos SET 
                        nombre='$nombre', 
                        marca='$marca', 
                        modelo='$modelo', 
                        precio='$precio', 
                        unidades='$unidades', 
                        detalles='$detalles',
                        imagen='$target_file' 
                    WHERE id='$id'";
        } else {
            echo "Hubo un error al subir la imagen.";
            exit;
        }
    } else {
        // Si no se subió una nueva imagen, solo se actualizan los demás campos
        $sql = "UPDATE productos SET 
                    nombre='$nombre', 
                    marca='$marca', 
                    modelo='$modelo', 
                    precio='$precio', 
                    unidades='$unidades', 
                    detalles='$detalles'
                WHERE id='$id'";
    }
    
    // Ejecuta la consulta y verifica si se realizó correctamente
    if(mysqli_query($link, $sql)){
        echo "Producto actualizado exitosamente.";
    } else {
        echo "ERROR: No se pudo ejecutar $sql. " . mysqli_error($link);
    }
} else {
    echo "Por favor completa todos los campos.";
}

// Cierra la conexión
mysqli_close($link);
?>
