<?php
require_once './../modelo/Class_Catalogo.php';
 $reporte = Catalogo::singleton();
//$reporte = new Reporte();

//echo "Reporte de cuentas";
$reporte->reporte_Cuentas();
//$reporte->retorno();