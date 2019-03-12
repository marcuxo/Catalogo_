<?php
require_once './../modelo/Class_Catalogo.php';
$catalogo = Catalogo::singleton();
$elId = $_POST['valor'];
echo($elId);
$catalogo->upItem($elId);