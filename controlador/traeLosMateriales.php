<?php
require_once './../modelo/Class_Catalogo.php';
$catalogo = Catalogo::singleton();

$catalogo->traeLosMateriales();