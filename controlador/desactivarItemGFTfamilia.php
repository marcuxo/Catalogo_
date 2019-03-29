<?php
require_once './../modelo/Class_Catalogo.php';
$catalogo = Catalogo::singleton();
$fam_lia = $_POST['valor1'];
//echo $fam_lia;
$catalogo->desactivar_item_gft_familia($fam_lia);
