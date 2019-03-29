<?php
require_once './../modelo/Class_Catalogo.php';
$catalogo = Catalogo::singleton();
$tipoFK = $_POST['valor1'];
$tipo = $_POST['valor2'];
$grupo = $_POST['valor3'];
//echo $tipoFK."//".$tipo."//".$grupo;
$catalogo->desactivar_item_gft($tipoFK, $tipo, $grupo);
