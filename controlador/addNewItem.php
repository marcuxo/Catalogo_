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
$fecha = $_POST['valor9'];

$familia = strtoupper($familia);
$newTipoTipo = strtoupper($newTipoTipo);
$materialAddNewTipo = strtoupper($materialAddNewTipo);
$materialAddNewTipo2 = strtoupper($materialAddNewTipo2);
$newTipoDT1 = strtoupper($newTipoDT1);
$newTipoDT2 = strtoupper($newTipoDT2);
$newTipoDT3 = strtoupper($newTipoDT3);
$newTipoDT4 = strtoupper($newTipoDT4);

$relleno = "N/A";
$fk_tipo = str_replace(' ','_',("tipo ".$familia));
$fk_tipo = strtoupper($fk_tipo);
if($newTipoTipo == "N/A" && $materialAddNewTipo == "N/A" && $materialAddNewTipo2 == "N/A"){
  //echo $newTipoDT1."-".$newTipoDT2."-".$newTipoDT3."-".$newTipoDT4;
  $catalogo->addNewItem($familia,$fk_tipo,$newTipoDT1,$newTipoDT2,$newTipoDT3,$newTipoDT4,$relleno,$relleno,$relleno,$fecha);
}
else if($newTipoTipo == "N/A" && $materialAddNewTipo == "N/A"){
  //echo $materialAddNewTipo2."-".$newTipoDT1."-".$newTipoDT2."-".$newTipoDT3."-".$newTipoDT4;
  $catalogo->addNewItem($familia,$fk_tipo,$materialAddNewTipo2,$newTipoDT1,$newTipoDT2,$newTipoDT3,$newTipoDT4,$relleno,$relleno,$fecha);
}
else if($newTipoTipo == "N/A" && $materialAddNewTipo2 == "N/A"){
  //echo $materialAddNewTipo."-".$newTipoDT1."-".$newTipoDT2."-".$newTipoDT3."-".$newTipoDT4;
  $catalogo->addNewItem($familia,$fk_tipo,$materialAddNewTipo,$newTipoDT1,$newTipoDT2,$newTipoDT3,$newTipoDT4,$relleno,$relleno,$fecha);
}
else if($materialAddNewTipo == "N/A" && $materialAddNewTipo2 == "N/A"){
  //echo $newTipoTipo."-".$fk_tipo."-".$newTipoDT1."-".$newTipoDT2."-".$newTipoDT3."-".$newTipoDT4;
  $catalogo->addNewItem($familia,$fk_tipo,"TIPO",$newTipoTipo,$newTipoDT1,$newTipoDT2,$newTipoDT3,$newTipoDT4,$relleno,$fecha);
}
else if($materialAddNewTipo == "N/A"){
  //echo $newTipoTipo."-".$fk_tipo."-".$materialAddNewTipo2."-".$newTipoDT1."-".$newTipoDT2."-".$newTipoDT3."-".$newTipoDT4;
  $catalogo->addNewItem($familia,$fk_tipo,"TIPO",$newTipoTipo,$materialAddNewTipo2,$newTipoDT1,$newTipoDT2,$newTipoDT3,$newTipoDT4,$fecha);
}
else if($materialAddNewTipo2 == "N/A"){
  //echo $newTipoTipo."-".$fk_tipo."-".$materialAddNewTipo."-".$newTipoDT1."-".$newTipoDT2."-".$newTipoDT3."-".$newTipoDT4;
  $catalogo->addNewItem($familia,$fk_tipo,"TIPO",$newTipoTipo,$materialAddNewTipo,$newTipoDT1,$newTipoDT2,$newTipoDT3,$newTipoDT4,$fecha);
}
