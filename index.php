<?php
include ("header.php");
?>
    <form name="FormFiltro" action="index.php" method="post">
        <br>
        Buscar por: <select name="campos">
            <option value="tipo_actividad" selected>Atividad</option>
            <option value="titulo">Titulo</option>
            <option value="texto">Texto</option>
        </select>
        <input type="text" name="valor">
        <input type="submit" value="Filtrar Datos" name="ConsultarFiltro">
        <input type="submit" value="Ver Todos" name="ConsultarTodos">
    </form>
<?php

 $obj_agenda = new agenda();
    $actividades = $obj_agenda->listar_notas();
    if(array_key_exists('ConsultarTodos', $_POST)){
        $obj_actividad = new agenda();
        $agenda_new = $obj_actividad->listar_notas();
    }
    if(array_key_exists('ConsultarFiltro', $_POST)){
        $obj_agenda = new agenda();
        $actividades = $obj_agenda->filtrar_actividad($_REQUEST['campos'], $_REQUEST['valor']);
    }
if(isset($actividades)){
    $nfilas = count($actividades);

    if($nfilas > 0) {
        print("<table>\n");
        print("<tr>\n");
        print("<th>&nbsp Titulo</th>\n");
        print("<th>&nbsp Actividad</th>\n");
        print("<th>&nbsp Texto</th>\n");
        print("<th>&nbsp Programado para el &nbsp</th>\n");
        print("</tr>\n");

        foreach($actividades as $actividad) {
            print("<tr>\n");
            print("<tr>\n<td> &nbsp".$actividad['titulo']."&nbsp</td>\n");
            print("<td> &nbsp" . $actividad['tipo_actividad'] . "&nbsp</td>\n");
            print("<td> &nbsp" . $actividad['texto'] . "&nbsp</td>\n");
            $datetimerange = new DateTime($actividad['rango']);
            print("<td>&nbsp" . $datetimerange->format("d/M/Y") . "&nbsp</td>\n");
            print("<td> &nbsp")?><a href="leer.php?id=<?php echo $actividad['id']?>"><input type="button" value="VER MAS"></a> 
            <?php
             print("&nbsp</td>\n");
            print("</tr>\n");
        }
        print("</table>\n");

    } else {
        print("No tiene actividades registradas.");
    }
}else { print("No hay registro");
}

    ?>

<?php
include ("footer_index.php");
?>