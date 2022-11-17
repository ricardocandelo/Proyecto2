<?php
    
    class agend{
        private $conn;

        public function __construct($db)
        {
            $this->conn = $db;
        }

        function listar_notas(){
            $instruccion = "CALL sp_listar_notas";

            $stmt = $this->conn->prepare($instruccion);
         
            
    
            $stmt->execute();
            return $stmt;

        }
        
        function ver_nota($id){
            $query = "CALL sp_leer('?')";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $id);
            $stmt->execute();
            return $stmt;
           
        }

        function nueva_nota($titulo, $texto, $ubicacion, $rango, $actividad, $rango_final){
            $instruccion = "CALL sp_nueva_nota(?, ?, ?, ?, ?, ?)";
            $stmt = $this->_db->prepare($instruccion);
            $stmt->bind_param("ssssss", $titulo, $texto, $ubicacion, $rango, $actividad, $rango_final);
            $stmt->execute();
        }
        

        function eliminar_nota($id){
                $instruccion = "CALL sp_eliminar($id)";
                $stmt = $this->_db->prepare($instruccion);
                $stmt->execute();
                
        }

        function editar_nota($id, $titulo, $texto, $ubicacion, $rango, $actividad, $rango_final){
            $instruccion = "CALL sp_editar(?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->_db->prepare($instruccion);
            $stmt->bind_param("issssss",$id, $titulo, $texto, $ubicacion, $rango, $actividad, $rango_final);
            $stmt->execute();
            if ($stmt){
                header("Location: leer.php?id=$id");
            }
        }  

        function filtrar_actividad($campo, $valor){ 
            $instruccion = "CALL sp_filtrar_actividad('".$campo."','".$valor."')";
            $consulta=$this->_db->query($instruccion);
            $resultado=$consulta->fetch_all(MYSQLI_ASSOC);
            if($resultado){
                return $resultado;
                $resultado->close();
                $this->_db->close();
            }
        }   
    }

?>