<?php
require_once './../modelo/Class_Catalogo.php';
$catalogo = Catalogo::singleton();

 //echo $user.$clave.$nombre.$info.$tipo;
$catalogo->loadUsers();
