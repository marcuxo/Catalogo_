<?php
require_once './../modelo/Class_Catalogo.php';
$catalogo = Catalogo::singleton();


if(isset($_POST['elTipo'])){
    $tabla_tipo = $_POST['elTipo'];
    $newTipo = $_POST['sacaTipo'];
    $tabla = strtolower($tabla_tipo);
    //echo $tabla_tipo."#".$newTipo;
    $catalogo->addNewTipo($tabla_tipo, $newTipo);
}
// else {
//     $tipo = "N/A";
//     $grupo = $_POST['grupo'];
//     $familia = $_POST['familia'];
//     echo $grupo."#".$familia."#".$tipo;
//}



//$catalogo->crearTabla();