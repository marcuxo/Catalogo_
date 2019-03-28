<?php
require_once './../modelo/Class_Catalogo.php';
$catalogo = Catalogo::singleton();

//$familia = $_POST['valor'];
$catalogo->cargaItemsInactivosGFT();