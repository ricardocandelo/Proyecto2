<?php

//encabezados obligatorios
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// incluir archivos de conexion y objetos
include_once('../config/conexion.php');
include_once('../obj/Agenda.php');

// inicializar base de datos y objeto producto
$conex = new conexion();
$db = $conex->obtenerConexion();


// inicializar objeto
$Notas = new agend($db);

$filtro = isset($_GET['filtro']) ? $_GET['filtro'] : die();
$opcion = isset($_GET['opcion']) ? $_GET['opcion'] : die();

// query productos
$stmt = $Notas->filtrar_actividad($opcion, $filtro);
$num = $stmt->rowCount();

if ($num > 0) {

    $products_arr = array();
    $products_arr["records"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $product_item = array(
            "id" => $id,
            "titulo" => html_entity_decode($titulo),
            "fecha" => $fecha,
            "hora" => $hora,
            "ubicacion" => html_entity_decode($ubicacion),
            "repetir" => $repetir,
            "tiempo_repetir_hora" => $tiempo_repetir_hora,
            "descripcion" => html_entity_decode($descripcion)
        );
        array_push($products_arr["records"], $product_item);
    }
    http_response_code(200);
    echo json_encode($products_arr);
} else {
    http_response_code(404);
    echo json_encode(
        array("message" => "No se encontraron Notas.")
    );
}
