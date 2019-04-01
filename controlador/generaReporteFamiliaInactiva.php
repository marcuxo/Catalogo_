<?php
require_once './../modelo/Class_Reporte.php';
$reporte = Reporte::singleton();

//echo "Reporte de cuentas";
$reporte->reporte_familiasInctivas();
//$reporte->retorno();