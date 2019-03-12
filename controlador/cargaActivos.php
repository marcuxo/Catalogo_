<?php
require_once './../modelo/Class_Catalogo.php';
$catalogo = Catalogo::singleton();
//echo($data);
$catalogo->cargaActivos();