<?php
require_once './../modelo/Class_Catalogo.php';
$catalogo = Catalogo::singleton();

$data = $_POST['valor1'];
$data2 = $_POST['valor2'];
// echo($data."//".$data2 ." from controlador");
$catalogo->funActivarItemGFT($data, $data2);