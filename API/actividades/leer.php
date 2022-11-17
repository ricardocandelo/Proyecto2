<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once('../config/conexion.php');
include_once('../obj/Agenda.php');
// obtener conexion a la base de datos
$conex = new Conexion();
$db = $conex->obtenerConexion();
// preparar el objeto producto
$nota = new agend($db);
// set ID property of record to read
$id = isset($_GET['id']) ? $_GET['id'] : die();

$stmt = $nota->ver_nota($id);
$num = $stmt->rowCount();
if ($num > 0) {

    $notas_arr = array();
    $notas_arr["records"] = array();
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $nota_item = array(
            "id" => $id, 
            "tipo_actividad" => $tipo_actividad, 
            "titulo" => $titulo, 
           "texto" => $texto, 
            "fecha" => $fecha
        );
        array_push($notas_arr["records"], $nota_item);
    }
    http_response_code(200);
    echo json_encode($notas_arr);
} else {
    http_response_code(404);
    echo json_encode(
        array("message" => "No se encontraron Notas.")
    );

}

