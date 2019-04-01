<?php
require_once './../modelo/Class_Catalogo.php';
$catalogo = Catalogo::singleton();
//$data = $_POST['valor'];
//$catalogo->traeDatos_1_7_foto($data);

$grupo = $_POST['valor1']; 
$familia = $_POST['valor2'];
$tipo = $_POST['valor3'];
$material =  $_POST['valor4'];
$codigo = $_POST['valor5'];
$fecha = $_POST['valor6'];
$opcional = $_POST['valor7'];
$dato3 = $_POST['valor8'];
$dato4 = $_POST['valor9'];
$dato5 = $_POST['valor10'];
$dato6 = $_POST['valor11'];
$dato7 = $_POST['valor12'];


	$catalogo->addDato_DM($codigo, $grupo, $familia, $tipo, $material, $dato3, $dato4, $dato5, $dato6, $dato7, $opcional, $fecha);
	//echo  $codigo."--".$grupo."--".$familia."--".$tipo."--".$material."--".$dato3."--".$dato4."--".$dato5."--".$dato6."--".$dato7."--".$opcional."--".$fecha;