<?php
require_once './../modelo/Class_Catalogo.php';
$catalogo = Catalogo::singleton();
$data = $_POST['buscar'];
//echo "<label class='lead text-success'>Resultado(s) de la busqueda ".$data." son </label>";
$data = strtoupper("%".$data."%");
$catalogo->BuscarB($data);