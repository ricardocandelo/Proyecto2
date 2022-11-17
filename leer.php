<?php
include ("header.php");
if (isset($_REQUEST['id'])){
$id = $_REQUEST['id'];
if(array_key_exists('id', $_REQUEST)){
    $obj_noticia = new agenda();
    $actividades =$obj_noticia->ver_nota($_REQUEST['id']);
}

    foreach($actividades as $actividad) {
        print("<td><h1>" . $actividad['titulo'] . "</h1></td>");
        print("<td><p><h2>" . $actividad['tipo_actividad'] . "</h2></td>");
        print("<td><p>" . $actividad['texto'] . "</td><br><br>");
        print("<td><b>Ubicacion:</b> &nbsp&nbsp " . $actividad['ubicacion'] . "</td><br>");
        $datetimerange = new DateTime($actividad['rango']);
        print("<td><b>Desde:</b> &nbsp" . $datetimerange->format("d/M/Y") . "</td>");
        $datetimerange = new DateTime($actividad['rango_final']);
        print("<td><b>&nbsp Hasta el:</b> &nbsp&nbsp" . $datetimerange->format("d/M/Y") . "</td><br>");
        $datetime = new DateTime($actividad['fecha']);
        print("<td><b>Creada el:</b> &nbsp" . $datetime->format("d/M/Y") . "</td><br>");
    }
    ?>
    <br><br>
    <a href="eliminar.php?id=<?php echo $id ?>"><input type="button" value="ELIMINAR"></a>
    <a href="editar.php?id=<?php echo $id ?>"><input type="button" value="EDITAR"></a>
    <?php
}else {
    print"No hay regitro";
}

?> 
<?php
include ("footer.php");
?>