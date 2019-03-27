<?php
require_once './../modelo/Class_Catalogo.php';
$catalogo = Catalogo::singleton();
$codigo = $_POST['valor'];
$id = $_POST['valor2'];
// echo $codigo."//".$id;
$catalogo->addCodigoNGLS($codigo, $id);