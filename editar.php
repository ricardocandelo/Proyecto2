<?php
include ("header.php");
?>
<?php

    $id = $_REQUEST['id'];
    if (isset($_GET['id'])){
    $idEdi = $_GET['id'];
    if(array_key_exists('id', $_REQUEST)){
        $obj_noticia = new agenda();
        $actividades =$obj_noticia->ver_nota($_REQUEST['id']);
    }
    
        foreach($actividades as $actividad) {
            ?>
            <form action="editar.php" method="post">
            <label for="cars">Tipo de actividad:</label>
            <select name="actividad" id="actividad">
                <option value="Trabajo">Trabajo</option>
                <option value="Estudios">Estudios</option>
                <option value="pHogar">Pendientes del Hogar</option>
            </select><br><br><br>
            <input type="hidden" name="id" value="<?php echo $_REQUEST['id'] ?>">
            <input type="text" name="titulo" value="<?php echo("" . $actividad['titulo'] . ""); ?>">
            <br><br>
            <textarea name="texto" id="" cols="30" rows="10"><?php echo("" . $actividad['texto'] . ""); ?></textarea>
            <br><br>
            <input type="text" name="ubicacion" value="<?php echo("" . $actividad['ubicacion'] . ""); ?>">
            <br><br>
            Fecha inicio: <input type="date" name="rango" value="<?php echo("".($actividad['rango']).""); ?>">
            Fecha final<input type="date" name="rango_final" value="<?php echo("".($actividad['rango']).""); ?>">
            <br><br>
            <input type="submit" name="edita" value="Editar">
            </form>
        <?php
        }
    }
    
        if(array_key_exists('edita', $_POST)){
            $obj_noticia = new agenda();
            $noticias_new = $obj_noticia->editar_nota($_REQUEST["id"], $_REQUEST['titulo'], $_REQUEST['texto'], $_REQUEST['ubicacion'], $_REQUEST['rango'], $_REQUEST['actividad'], $_REQUEST['rango_final']);
        }

?>

<?php
include ("footer.php");
?>