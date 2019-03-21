<?php
require_once './../modelo/Class_Catalogo.php';
$catalogo = Catalogo::singleton();

$user = $_POST['valor1'];
$clave = $_POST['valor2'];
$nombre = $_POST['valor3'];
$info = $_POST['valor4'];

// echo $user.$clave.$nombre.$info;

$catalogo->addUserDB($user,$clave,$nombre,$info);
