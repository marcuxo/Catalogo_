<?php 
session_start();
$_SESSION["usuario"] = "Admin";

require_once './../modelo/Class_Catalogo.php';
$catalogo = Catalogo::singleton();
$user = $_POST['usuario'];
$pass = $_POST['clave'];
//echo "$user.$pass";
$catalogo->Login($user, $pass);
