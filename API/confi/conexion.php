<?php
    require_once('config.php');
    class modeloCredencialesDB{
        public $_db;
        public function conexion()
        {
            $this->_db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            if($this->_db->connect_errno){
                echo "fallo al conectar a la base de datos " .$this->_db->connect_errno;
                return;  
            }
        }
    }
?>