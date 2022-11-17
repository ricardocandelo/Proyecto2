<?php
    include ("header.php");
?>
<h1>Nueva actividad</h1>

<form name="AgregarNuevaActividad" method="post" action="nueva_actividad.php">
    <br>
    <label for="cars">Tipo de actividad:</label>
    <select name="actividad" id="actividad">
    <option value="Trabajo">Trabajo</option>
    <option value="Estudios">Estudios</option>
    <option value="pHogar">Pendientes del Hogar</option>
    </select><br><br><br>
    Titulo: <input type="text" name="titulo"><br><br><br>
    <textarea name="texto" id="" cols="30" rows="10"></textarea><br><br><br>
    Ubicacion: <input type="text" name="ubicacion"><br><br><br>
    Fecha Inicial: <input type="date" name="rango" value="aaaa-mm-dd"><br><br><br>
    Fecha Final: <input type="date" name="rango_final" value="aaaa-mm-dd"><br><br><br>
    <input type="submit" name="Agregar" value="Agregar">
</form>
<br><br>

<?php
    require_once("logica/Agenda.php");
    if(array_key_exists('Agregar', $_POST)) {
        $obj_agenda = new agenda();
        $obj_agenda->nueva_nota($_REQUEST['titulo'], $_REQUEST['texto'], $_REQUEST['ubicacion'], $_REQUEST['rango'], $_REQUEST['actividad'], $_REQUEST['rango_final']);
        echo '<script>alert("Se agrego correcatmenet")</script>';
}

?>

<?php
    include ("footer.php");
?>