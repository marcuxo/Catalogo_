<?php
require_once './../modelo/Class_Catalogo.php';
$catalogo = Catalogo::singleton();

$data = $_POST['valor1'];
// echo($data ."from controlador btn");
$catalogo->funcActivarItemGFT_btn($data);