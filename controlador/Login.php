<?php 



require_once './../modelo/Class_Catalogo.php';
$catalogo = Catalogo::singleton();
$user = $_POST['usuario'];
$pass = $_POST['clave'];
//echo "$user.$pass";
//$_SESSION["usuario"] = $user;
$catalogo->Login($user, $pass);
