<?php



$fechora = "22-03-2019 10:45:59";

$glosa = "591891  RODAMIENTOS Y SELLOS  RODAMIENTO  BOLA  ACERO  1205  etn9  ";

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
				<p class="lead">Se intenta ingresar la siguiente glosa con fecha '.$fechora.'<p>
				<p class="lead font-weight-bold">'.$glosa.'<p>
			</div>
		</div>
	</div>

	<div class="container my-5">
		<div class="row">
			<div class="col">
			<p class="lead">Ingrese a la aplicacion web para activarla o eliminarla<p>
				<a href="http://192.168.1.152/Catalogo_/vista/" class="btn btn-primary">Ir a la Aplicacion</a>
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

	//$catalogo->Correo($msgConcatenado);
	echo $msgConcatenado;