<?php
// encabezados obligatorios
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-AllowHeaders, Authorization, X-Requested-With");

include_once('../config/conexion.php');
include_once('../obj/Agenda.php');

$conex = new conexion();
$db = $conex->obtenerConexion();

$nota = new agend($db);


$data = json_decode(file_get_contents("php://input"));

if(
 !empty($data->titulo) &&
 !empty($data->texto) &&
 !empty($data->ubicacion)&&
 !empty($data->rango)&&
 !empty($data->tipo_actividad)&&
 !empty($data->rango_final)
){

 $nota->titulo = $data->titulo;
 $nota->texto = $data->texto;
 $nota->ubicacion = $data->ubicacion;
 $nota->rango = $data->rango;
 $nota->tipo_actividad = $data->tipo_actividad;
 $nota->rango_final =$data->rango_final;
 $stms = $nota->nueva_nota();
  
 if($stms){

    http_response_code(201);

    echo json_encode(array("message" => "Nuevo evento creado"));
    }

    else{

    http_response_code(503);

    echo json_encode(array("message" => "No se creado nuevo evento."));
    }
   }

   else{
   
    http_response_code(400);

    echo json_encode(array("message" => "No se puede crear nuevo evento. Los datos
   están incompletos."));
   }
