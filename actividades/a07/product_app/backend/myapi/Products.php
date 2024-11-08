<?php
    namespace Product_app\Backend\Myapi;

    use Product_app\Backend\Myapi\DataBase;
    require_once __DIR__ . '/DataBase.php';

    class Products extends DataBase {
        private $data;

        public function __construct($db, $user='root', $pass='',) {
            $this->data = array();
            parent::__construct($db, $user, $pass);
        }

        public function add($object) {
            $this->data = array(
                'status'  => 'error',
                'message' => 'Ya existe un producto con ese nombre'
            );
            if(isset($jsonOBJ->nombre)) {
                $sql = "SELECT * FROM productos WHERE nombre = '{$object->nombre}' AND eliminado = 0";
                $result = $this->conexion->query($sql);
                
                if ($result->num_rows == 0) {
                    $this->conexion->set_charset("utf8");
                    $sql = "INSERT INTO productos VALUES (null, '{$object->nombre}', '{$object->marca}', '{$object->modelo}', {$object->precio}, '{$object->detalles}', {$object->unidades}, '{$object->imagen}', 0)";
                    if($this->conexion->query($sql)){
                        $this->data['status'] =  "success";
                        $this->data['message'] =  "Producto agregado";
                    } else {
                        $this->data['message'] = "Error al agregar el producto. " . mysqli_error($this->conexion);
                    }
                }

                $result->free();
                $this->conexion->close();
            }
        }

        public function delete($id) {
            $this->data = array(
                'status'  => 'error',
                'message' => 'Falló en la consulta'
            );

            if( isset($id) ) {
                $sql = "UPDATE productos SET eliminado=1 WHERE id = {$id}";
                if ( $this->conexion->query($sql) ) {
                    $this->data['status'] =  "success";
                    $this->data['message'] =  "Producto eliminado";
                } else {
                    $this->data['message'] = "Error al eliminar el producto. " . mysqli_error($this->conexion);
                }
                $this->conexion->close();
            } 
        }

        public function edit($object) {
            $this->data = array(
                'status'  => 'error',
                'message' => 'Falló en la consulta'
            );
            if( isset($object->id) ) {
                $sql =  "UPDATE productos SET nombre='{$object->nombre}', marca='{$object->marca}',";
                $sql .= "modelo='{$object->modelo}', precio={$object->precio}, detalles='{$object->detalles}',"; 
                $sql .= "unidades={$object->unidades}, imagen='{$object->imagen}' WHERE id={$object->id}";
                $this->conexion->set_charset("utf8");
                if ( $this->conexion->query($sql) ) {
                    $this->data['status'] =  "success";
                    $this->data['message'] =  "Producto actualizado";
                } else {
                    $this->data['message'] = "Error al actualizar el producto. " . mysqli_error($this->conexion);
                }
                $this->conexion->close();
            }
        }

        public function list() {
            if ( $result = $this->conexion->query("SELECT * FROM productos WHERE eliminado = 0") ) 
            {
                $rows = $result->fetch_all(MYSQLI_ASSOC);

                if(!is_null($rows)) {
                    foreach($rows as $num => $row) {
                        foreach($row as $key => $value) {
                            $this->data[$num][$key] = $value;
                        }
                    }
                }
                $result->free();
            } else {
                die('Query Error: '.mysqli_error($this->conexion));
            }
            $this->conexion->close();
        }

        public function search($search) {
            if( isset($search) ) {
                $sql = "SELECT * FROM productos WHERE (id = '{$search}' OR nombre LIKE '%{$search}%' OR marca LIKE '%{$search}%' OR detalles LIKE '%{$search}%') AND eliminado = 0";
                if ( $result = $this->conexion->query($sql) ) {
                    $rows = $result->fetch_all(MYSQLI_ASSOC);

                    if(!is_null($rows)) {
                        foreach($rows as $num => $row) {
                            foreach($row as $key => $value) {
                                $this->data[$num][$key] = $value;
                            }
                        }
                    }
                    $result->free();
                } else {
                    die('Query Error: '.mysqli_error($this->conexion));
                }
                $this->conexion->close();
            }
        }

        public function single($id) {
            if( isset($id) ) 
            {
                if ( $result = $this->conexion->query("SELECT * FROM productos WHERE id = {$id}") ) {
                    $row = $result->fetch_assoc();
                    if(!is_null($row)) {
                        foreach($row as $key => $value) {
                            $this->data[$key] = $value;
                        }
                    }
                    $result->free();
                } else {
                    die('Query Error: '.mysqli_error($this->conexion));
                }
                $this->conexion->close();
            }
        }

        public function singleByName($name) {
            if (isset($name)) {
                // Escapamos el nombre para prevenir inyecciones SQL
                $name = $this->conexion->real_escape_string($name);
        
                if($result = $this->conexion->query("SELECT * FROM productos WHERE nombre = '{$name}' AND eliminado = 0"))
                {
                    $row = $result->fetch_assoc();
        
                    if (!is_null($row)) {
                        foreach ($row as $key => $value) {
                            $this->data[$key] = $value;
                        }
                    }
        
                    $result->free();
                } else {
                    die('Query Error: ' . mysqli_error($this->conexion));
                }
        
                $this->conexion->close();
            }
        }
        
        public function getData() {
            return json_encode($this->data, JSON_PRETTY_PRINT);
        }
    }
?>
