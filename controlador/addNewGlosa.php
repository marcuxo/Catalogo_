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


	$msg2 = '
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Verificacion Datos</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
</head>
<body>
<center>
<div class="container-fluid">
    <div class="row">
        <div class="col bg-inverse rounded-bottom">
            <h1 class="text-white">Datos a Verificar</h1>
        </div>
    </div>
</div>

<div class="container-fluid">
  <div class="row">
    <div class="col">
        <p class="lead">Se Intenta agregar estos datos</p>
        <p class="lead">Codigo: '.$codigo.'</p>
        <p class="lead">Dir. Imagen: '.$directorioDB.'</p>
        <p class="lead">Descripcion: '.$descripcion.'</p>
        <p class="lead">Grupo: '.$grupo.'</p>
        <p class="lead">Familia: '.$familia.'</p>
        <p class="lead">Tipo: '.$tipo.'</p>
        <p class="lead">Material: '.$material.'</p>
        <p class="lead">Dato Tecnico 1: '.$dato_2.'</p>
        <p class="lead">Dato Tecnico 2: '.$dato_3.'</P>
        <p class="lead">Dato Tecnico 3: '.$dato_4.'</p>
        <p class="lead">dato Tecnico 4: '.$dato_5.'</p>
        <p class="lead">Dato Tecnico 5: '.$dato_6.'</p>
        <p class="lead">Dato Tecnico 6: '.$dato_7.'</p>
    <br>
    <br>
    <br>


    <p class="lead">Si los datos son correctos  
    <a href="" target="_blank" class="btn btn-sm btn-danger mx-md-2 text-white"> ir a la aplicacion </a>
     para activarlos, de otro modo solo omita este correo
    </p>
    </div>
  </div>
</div>
</center>
<footer>
<div class="container bg-inverse mt-5 rounded-top fixed-bottom">
	<div class="row">
		<div class="col text-center">
			<small class="text-white">Para Ariztia por Marco Urrutia M.</small>
		</div>
	</div>
</div>
</footer>
</body>
</html>';
$catalogo->addNewFamiliCorreo($msg2);