<?php
require_once './../modelo/Class_Catalogo.php';
$catalogo = Catalogo::singleton();

$id = $_POST['valor1'];
$dato2 = $_POST['valor2'];
$dato3 = $_POST['valor3'];
$dato4 = $_POST['valor4'];
$dato5 = $_POST['valor5'];
$dato6 = $_POST['valor6'];
$dato7 = $_POST['valor7'];
$dato8 = $_POST['valor8'];

$catalogo->crudGlosaUpdate($id, $dato2, $dato3, $dato4, $dato5, $dato6, $dato7, $dato8);
