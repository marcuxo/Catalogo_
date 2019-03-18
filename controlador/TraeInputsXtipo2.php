<?php
require_once './../modelo/Class_Catalogo.php';
$catalogo = Catalogo::singleton();
$data = $_POST['valor'];
$catalogo->traeDatos_1_7_Xtipo2($data);