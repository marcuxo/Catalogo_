<?php
require_once './../modelo/Class_Catalogo.php';
$catalogo = Catalogo::singleton();
if(!isset($_POST['valor2'])){
	$tipo = "N/A";
} else {
	$tipo = $_POST['valor2'];
}
$familia = $_POST['valor'];

if($tipo == "Seleccione el Tipo"){
    $tipo = "N/A";
}
//echo $familia." /\ ".$tipo;

$catalogo->cargaImagen2($familia, $tipo);