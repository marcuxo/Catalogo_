<?php
require_once './../modelo/Class_Catalogo.php';
$catalogo = Catalogo::singleton();
//$data = $_POST['valor'];
//$catalogo->traeDatos_1_7_foto($data);

$grupo = "N/A"; 
$familia = "N/A";
$tipo = "N/A";
$material =  "N/A";
$dato3 = "N/A";
$dato4 = "N/A";
$dato5 = "N/A";
$dato6 = "N/A";
$dato7 = "N/A";
$dato8 = "N/A";

if(isset($_POST['btn_add'])){
    //echo "datos modificados";
    if(isset($_POST['grupo'])){
        $grupo = $_POST['grupo']; 
    }
    if(isset($_POST['familia'])){
        $familia = $_POST['familia'];
    }
    if(isset($_POST['tipo'])){
        $tipo = $_POST['tipo'];
    }
    if(isset($_POST['material'])){
        $material =  $_POST['material'];
    }
    if(isset($_POST['dato_3'])){
        $dato3 = $_POST['dato_3'];
    }
    if(isset($_POST['dato_4'])){
        $dato4 = $_POST['dato_4'];
    }
    if(isset($_POST['dato_5'])){
        $dato5 = $_POST['dato_5'];
    }
    if(isset($_POST['dato_6'])){
        $dato6 = $_POST['dato_6'];
    }
    if(isset($_POST['dato_7'])){
        $dato7 = $_POST['dato_7'];
    }
    if(isset($_POST['dato_8'])){
        $dato8 = $_POST['dato_8'];
    }
    $catalogo->addDato_DM($grupo, $familia, $tipo, $material, $dato3, $dato4, $dato5, $dato6, $dato7, $dato8);
    //echo  $grupo."--".$familia."--".$tipo."--".$material."--".$dato3."--".$dato4."--".$dato5."--".$dato6."--".$dato7."--".$dato8;

}
else if(isset($_POST['btn_dc'])){
    //echo "datos  correctos";
    $dato_1 = $_POST['0'];
    $dato_2 = $_POST['1'];
    $dato_3 = $_POST['2'];
    $dato_4 = $_POST['3'];
    // $catalogo->traeDatos_1_7_foto($data);
    // echo $dato_1."--".$dato_2."--".$dato_3."--".$dato_4;
    $catalogo->addDato_DC($dato_1, $dato_2, $dato_3, $dato_4);
} else {
    echo "ninguna de las nateriores.";
}