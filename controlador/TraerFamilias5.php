<?php
require_once './../modelo/Class_Catalogo.php';
$catalogo = Catalogo::singleton();
$dato = $_POST['valor'];
$catalogo->traer_familia5($dato);
//echo $dato;