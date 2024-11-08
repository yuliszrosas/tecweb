<?php
namespace Product_app\Backend\Myapi;
abstract class DataBase {
    // Atributo protegido para la conexión
    protected $conexion;

    // Constructor de la clase DataBase
    public function __construct($db, $user, $pass) {
        // Configuración de la conexión a la base de datos
        $this->conexion = @mysqli_connect('localhost', $user, $pass, $db);
    
        if(!$this->conexion) {
            die('¡Base de datos NO coneCtada!');
        }
    }
}
?>