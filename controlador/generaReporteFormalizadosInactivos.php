<?php
require_once './../modelo/Class_Catalogo.php';
$reporte = Catalogo::singleton();

//echo "Reporte de cuentas";
$reporte->reporte_FormalizadoInactivos();
//$reporte->retorno();