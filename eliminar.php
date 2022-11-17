<?php
require_once("logica/Agenda.php");
if(isset($_REQUEST['id'])) {
    $id=$_REQUEST['id'];
    echo '¿Estas seguro que deseas eliminar la actividad?';
    ?>
    <br><br>
    <form action="" method="post">
    <input type="hidden" name="<?php $id ?>">
    <input type="submit" value="SI" name="SI">
    <a href="leer.php?id=<?php echo $id ?>"><input type="button" value="NO"></a>

    </form>
    <?php
    if(isset($_POST['SI'])){
    if($_POST['SI']){
    $obj_eliminar_nota = new agenda();
    $obj_eliminar_nota->eliminar_nota($id);
    echo '<script>alert("Se elimino correctamente")</script>';   
    ?>
    <a href="index.php"><input type="button" value="VOLVER"></a>
    <?php      
    }
    }
    } 
else{
    echo '<script>alert("Error")</script>';
    ?>
    <a href="index.php"><input type="button" value="VOLVER"></a>
    <?php
}
?>