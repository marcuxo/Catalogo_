<?php
require_once './../modelo/Class_Catalogo.php';
$catalogo = Catalogo::singleton();

$familia = $_POST['valor'];
$tipo = $_POST['valor2'];

if($tipo == "Seleccione el Tipo"){
    $tipo = "N/A";
}
//echo $familia." /\ ".$tipo;

$catalogo->cargaImagen($familia, $tipo);