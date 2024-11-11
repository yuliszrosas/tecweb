<?php
namespace Product_app\Backend\Myapi\Update;
use Product_app\Backend\Myapi\DataBase;
require_once __DIR__ . '/../DataBase.php';

class Update extends DataBase {
    public function __construct($db, $user='root', $pass='') {
        $this->data = array();
        parent::__construct($db, $user, $pass);
    }
    public function edit($object) {
        // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
        $this->data = array(
            'status'  => 'error',
            'message' => 'La consulta falló'
        );
        // SE VERIFICA HABER RECIBIDO EL ID
        if( isset($object->id) ) {
            // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
            $sql =  "UPDATE productos SET nombre='{$object->nombre}', marca='{$object->marca}',";
            $sql .= "modelo='{$object->modelo}', precio={$object->precio}, detalles='{$object->detalles}',"; 
            $sql .= "unidades={$object->unidades}, imagen='{$object->imagen}' WHERE id={$object->id}";
            $this->conexion->set_charset("utf8");
            if ( $this->conexion->query($sql) ) {
                $this->data['status'] =  "success";
                $this->data['message'] =  "Producto actualizado";
            } else {
                $this->data['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($this->conexion);
            }
            $this->conexion->close();
        }
    }
}
?>
