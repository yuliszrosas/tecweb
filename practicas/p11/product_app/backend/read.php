<?php
    include_once __DIR__.'/database.php';

    // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
    $data = array();
    
    if( isset($_POST['search']) ) {
        $search = $_POST['search'];
        
        // SE REALIZA LA QUERY CON LIKE PARA PERMITIR BÚSQUEDA PARCIAL
        $query = "SELECT * FROM productos 
                  WHERE nombre LIKE '%$search%' 
                  OR marca LIKE '%$search%' 
                  OR detalles LIKE '%$search%'";
        

        if ( $result = $conexion->query($query) ) {
            // SE RECORREN LOS RESULTADOS Y SE ALMACENAN EN EL ARREGLO
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $producto = array();
                foreach($row as $key => $value) {
                    $producto[$key] = utf8_encode($value);
                }
                $data[] = $producto;  // SE AGREGA CADA PRODUCTO AL ARREGLO DE DATOS
            }
            $result->free();
        } else {
            die('Query Error: '.mysqli_error($conexion));
        }
		$conexion->close();
    } 
    
    // SE HACE LA CONVERSIÓN DE ARRAY A JSON
    echo json_encode($data, JSON_PRETTY_PRINT);
?>