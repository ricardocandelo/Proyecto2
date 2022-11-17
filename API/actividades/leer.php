<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once('../config/conexion.php');
include_once('../obj/Agenda.php');

$conex = new conexion(); 
$db  = $conex->obtenerConexion(); 
  
 

$Agenda 	 = new agend($db); 
$Agenda->id = isset($_GET['id']) ? $_GET['id'] : die();
$Agenda->ver_nota(); 

if($Agenda->id != null){ 
 
    $notas_arr=array(); 
    $notas_arr[ 	"records"]=array(); 

  	 
        $nota_item=array( 
             "id" => $Agenda->id, 
             "tipo_actividad" => $Agenda->tipo_actividad, 
             "titulo" => $Agenda->titulo, 
            "texto" => $Agenda->texto, 
            "rango" => $Agenda->rango, 
             "fecha" => $Agenda->fecha
        );  
  
 
        array_push($notas_arr["records"], $nota_item); 	 
    http_response_code(200); 
  
     echo json_encode($notas_arr); 

}else {
    http_response_code(404);
    echo json_encode(
        array("message" => "No se encontraron Notas.")
    );

}

   





