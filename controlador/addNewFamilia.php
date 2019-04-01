<?php
require_once './../modelo/Class_Catalogo.php';
$catalogo = Catalogo::singleton();

$grupo = $_POST['valor1'];
$familia = $_POST['valor2'];
$familia = strtoupper($familia);
 //echo $grupo.$familia.$tipo;
$catalogo->addNewFamili($grupo,$familia);

