<?php
require_once './../modelo/Class_Catalogo.php';
$catalogo = Catalogo::singleton();
//$data = $_POST['valor'];
//$catalogo->traeDatos_1_7_foto($data);

$codigo = "Sin Codigo";
$grupo = "N/A"; 
$familia = "N/A";
$fecha = "N/A";
$datoOptn =  "N/A";
$dato2 = "N/A";
$dato3 = "N/A";
$dato4 = "N/A";
$dato5 = "N/A";
$dato6 = "N/A";
$dato7 = "N/A";

//echo "datos modificados";
if($_POST['valor0'] != ""){
    $codigo = $_POST['valor0']; 
}
if(isset($_POST['valor1'])){
    $grupo = $_POST['valor1'];
}
if(isset($_POST['valor2'])){
    $familia = $_POST['valor2'];
}
if(isset($_POST['valor3'])){
    $fecha =  $_POST['valor3'];
}
if(isset($_POST['valor4'])){
    $datoOptn = $_POST['valor4'];
}
if(isset($_POST['valor5'])){
    $dato2 = $_POST['valor5'];
}
if(isset($_POST['valor6'])){
    $dato3 = $_POST['valor6'];
}
if(isset($_POST['valor7'])){
    $dato4 = $_POST['valor7'];
}
if(isset($_POST['valor8'])){
    $dato5 = $_POST['valor8'];
}
if(isset($_POST['valor9'])){
    $dato6 = $_POST['valor9'];
}
if(isset($_POST['valor10'])){
		$dato7 = $_POST['valor10'];
}


$catalogo->AddNewGlosaNGLS($codigo,$grupo,$familia,$fecha,$datoOptn,$dato2,$dato3,$dato4,$dato5,$dato6,$dato7);
	//echo "Glosa: ".$codigo."--".$grupo."--".$familia."--".$fecha."--".$datoOptn."--".$dato2."--".$dato3."--".$dato4."--".	$dato5."--".$dato6."--".$dato7;
$glosa = $codigo." ".$grupo." ".$familia." ".$dato2." ".$dato3." ".$dato4." ".$dato5." ".$dato6." ".$dato7." ".$datoOptn;
    $msgConcatenado = '
	<html>
	<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Verificacion Datos</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
	</head>
	<body>
	<center>
	<div class="container-fluid mb-5">
		<div class="row">
			<div class="col bg-inverse rounded-bottom">
				<h1 class="text-white">Datos a Verificar</h1>
			</div>
		</div>
	</div>

	<div class="container-fluid">
		<div class="row">
			<div class="col">
				<p class="lead">Se intenta ingresar la siguiente glosa con fecha '.$fecha.'<p>
				<p class="lead font-weight-bold">'.$glosa.'<p>
			</div>
		</div>
	</div>

	<div class="container my-5">
		<div class="row">
			<div class="col">
			<p class="lead">Ingrese a la aplicacion web para activarla o eliminarla<p>
				<a href="http://192.168.1.152/Catalogo_/vista/Login_Mantenedor.php" class="btn btn-primary">Ir a la Aplicacion</a>
			</div>
		</div>
	</div>

	<footer>
	<div class="container bg-inverse mt-5 rounded-top fixed-bottom">
		<div class="row">
			<div class="col text-center">
				<small class="text-white">Para Ariztia por Marco Urrutia M.</small>
			</div>
		</div>
	</div>
	</footer>
	</center>
	</body>
	</html>';

	$catalogo->Correo($msgConcatenado);
	//echo $msgConcatenado;