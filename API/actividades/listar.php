<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


include_once('../config/conexion.php');
include_once('../obj/Agenda.php');


$conex = new conexion(); 
$db  = $conex->obtenerConexion(); 
  
 

$Agenda 	 = new agend($db); 
$stmt = $Agenda->listar_notas(); 
$num = $stmt->rowCount(); 

if($num>0){ 
 
  
    $notas_arr=array(); 
    $notas_arr[ 	"records"]=array(); 

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){ 
        extract($row); 
  	 
        $nota_item=array( 
             "id" => $id, 
             "tipo_actividad" => $tipo_actividad, 
             "titulo" => $titulo, 
            "texto" => $texto, 
            "rango" => $rango, 
             "fecha" => $fecha
        );  
  
 
        array_push($notas_arr["records"], $nota_item); 
    } 	 
    http_response_code(200); 
  
     echo json_encode($notas_arr); 

}

   





