<?php
require_once './../modelo/Class_Catalogo.php';
$catalogo = Catalogo::singleton();
$familia = "N/A";
$tipo = "N/A";
$img = "N/A";

$directorio = "../vista/img_/";//-****************cambiar esta direccion por la que usara para gusrdar las imagenes
$directorioDB = "img_/".($_FILES['fotoTipoImg']['name']);
$fichero_subido = $directorio.($_FILES['fotoTipoImg']['name']);
move_uploaded_file($_FILES['fotoTipoImg']['tmp_name'], $fichero_subido);

if(isset($_POST['tipo'])){
    $familia = $_POST['familia'];
    $tipo = $_POST['tipo'];
    $img = $directorioDB;
    //echo($familia."//".$tipo."//".$img);
    $catalogo->agregaFotoTipo($familia, $tipo, $img);
} else {
    $familia = $_POST['familia'];
    $img = $directorioDB;
    //echo($familia."//".$img);
    $catalogo->agregaFotoTipo($familia, $tipo, $img);
}

//echo($familia."//".$tipo."//".$img);
//$catalogo->buscaTipo($data);