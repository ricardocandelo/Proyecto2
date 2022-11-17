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
        
        function ver_nota(){
            try{
            $query = "CALL sp_leer(id)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->id);
            
                $stmt->execute();
            return $stmt;
            }catch(PDOException $e){
            }
            
           
        }
        

        function nueva_nota(){
            $instruccion = "CALL sp_nueva_nota(titulo=:titulo, texto=:texto, ubicacion=:ubicacion, rango=:rango, tipo_actividad=:tipo_actividad, rango_final=:rango_final)";
            $stmt = $this->_db->prepare($instruccion);
            $this->titulo = htmlspecialchars(strip_tags($this->tuitulo));
            $this->texto = htmlspecialchars(strip_tags($this->texto));
            $this->ubicacion = htmlspecialchars(strip_tags($this->ubicacion));
            $this->rango = htmlspecialchars(strip_tags($this->rango));
            $this->tipo_actividad = htmlspecialchars(strip_tags($this->tipo_actividad));
            $this->rango_final = htmlspecialchars(strip_tags($this->rango_final));
            // bind values
            $stmt->bindParam(":titulo", $this->titulo);
            $stmt->bindParam(":texto", $this->texto);
            $stmt->bindParam(":ubicacion", $this->ubicacion);
            $stmt->bindParam(":rango", $this->rango);
            $stmt->bindParam(":tipo_actividad", $this->tipo_actividad);
            $stmt->bindParam(":rango_final", $this->rango_final);
            // execute query
            if ($stmt->execute()) {
                return true;
            }
            return false;
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