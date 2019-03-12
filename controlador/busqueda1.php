<?php
require_once './../modelo/Class_Catalogo.php';
$catalogo = Catalogo::singleton();
if(!isset($_POST['valor3'])){
    $data3 = " ";
    $data1 = strtolower($_POST['valor1']);
    $data2 = strtolower($_POST['valor2']);
    $mos = ucwords($data1." ".$data2." ".$data3);
    $data_1 = "%".$data1."%";
    $data_2 = "%".$data2."%";
    $data_3 = "%".$data3."%";
    $txt = "Estas Buscando ";
    echo($txt.$mos."<br><br>");
    $catalogo->buscaParaEditar($data_1,$data_2,$data_3);
} else {
    $data1 = strtolower($_POST['valor1']);
    $data2 = strtolower($_POST['valor2']);
    $data3 = strtolower($_POST['valor3']);
    $mos = ucwords($data1." ".$data2." ".$data3);
    $data_1 = "%".$data1."%";
    $data_2 = "%".$data2."%";
    $data_3 = "%".$data3."%";
    $txt = "Estas Buscando ";
    echo($txt.$mos."<br><br>");
    $catalogo->buscaParaEditar($data_1,$data_2,$data_3);
}


// $data1 = strtolower($_POST['valor1']);
// $data2 = strtolower($_POST['valor2']);
// $data3 = strtolower($_POST['valor3']);
// $mos = ucwords($data1." ".$data2." ".$data3);
// $data_1 = "%".$data1."%";
// $data_2 = "%".$data2."%";
// $data_3 = "%".$data3."%";
// $txt = "Estas Buscando ";
// echo($txt.$mos."<br><br>");
// $catalogo->buscaParaEditar($data_1,$data_2,$data_3);