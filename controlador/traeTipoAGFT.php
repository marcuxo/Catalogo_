<?php
require_once './../modelo/Class_Catalogo.php';
$catalogo = Catalogo::singleton();
$data = strtolower($_POST['valor']);
// echo($data ."from controlador");
$catalogo->loadTipoAGFT($data);