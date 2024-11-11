<?php
    namespace Product_app\Backend\Myapi;
    abstract class DataBase {
        protected $conexion;
        protected $data;

        public function __construct($db, $user, $pass) {
            $this->data = array();
            $this->conexion = @mysqli_connect(
                'localhost',
                $user,
                $pass,
                $db
            );
        
            if(!$this->conexion) {
                die('¡Base de datos NO conextada!');
            }
        }

        public function getData() {
            return json_encode($this->data, JSON_PRETTY_PRINT);
        }
        
    }
?>