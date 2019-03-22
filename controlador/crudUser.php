<?php
require_once './../modelo/Class_Catalogo.php';
$catalogo = Catalogo::singleton();

$id = $_POST['valor1'];
$nombre = $_POST['valor2'];
$usuario = $_POST['valor3'];
$nClave = $_POST['valor4'];
$tCuenta = $_POST['valor5'];
$info = $_POST['valor6'];
$estado = $_POST['valor7'];



$catalogo->updateUserCrud($id,$nombre,$usuario,$nClave,$tCuenta,$info, $estado);
