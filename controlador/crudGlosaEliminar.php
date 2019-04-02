<?php
require_once './../modelo/Class_Catalogo.php';
$catalogo = Catalogo::singleton();

$id = $_POST['valor'];

//echo "Desca Controlador ".$user;
$catalogo->crudGlosaEliminar($id);
