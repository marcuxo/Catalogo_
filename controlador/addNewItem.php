<?php
require_once './../modelo/Class_Catalogo.php';
$catalogo = Catalogo::singleton();



$grupo = $_POST['valor0'];
$familia = $_POST['valor1'];
$newTipoTipo = $_POST['valor2'];
$materialAddNewTipo = $_POST['valor3'];
$materialAddNewTipo2 = $_POST['valor4'];
$newTipoDT1 = $_POST['valor5'];
$newTipoDT2 = $_POST['valor6'];
$newTipoDT3 = $_POST['valor7'];
$newTipoDT4 = $_POST['valor8'];

$fk_tipo = str_replace(' ','_',$newTipoTipo);
if($materialAddNewTipo == "N/A"){
  echo $grupo."-".$familia."-".$newTipoTipo."-".$materialAddNewTipo2."-".$fk_tipo."-".$newTipoDT1."-".$newTipoDT2."-".$newTipoDT3."-".$newTipoDT4;
} else {
	echo $grupo."-".$familia."-".$newTipoTipo."-".$materialAddNewTipo."-".$fk_tipo."-".$newTipoDT1."-".$newTipoDT2."-".$newTipoDT3."-".$newTipoDT4;
}
//echo $grupo."-".$familia."-".$newTipoTipo."-".$materialAddNewTipo."-".$materialAddNewTipo2."-".$newTipoDT1."-".$newTipoDT2."-".$newTipoDT3."-".$newTipoDT4;


//$catalogo->addNewTipo($tabla_tipo, $newTipo);