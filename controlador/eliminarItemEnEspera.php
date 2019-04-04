<?php
require_once './../modelo/Class_Catalogo.php';
$catalogo = Catalogo::singleton();
$data = strtolower($_POST['valor']);
$fecha = $_POST['valor0'];
// echo($data ."from controlador");
$catalogo->eliminarItemEnEspera($data, $fecha);
