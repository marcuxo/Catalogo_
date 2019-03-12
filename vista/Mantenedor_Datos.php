<?php

session_start();
if(!isset($_SESSION['usuario'])){
	header('Location: index.php');
}
?>
<!DOCTYPE html>
<html>
<head >
	<title>Catalogo Ariztia</title>
	<!-- import de estilos css, el de estilos.css solo contiene el color del fondo -->
	<link rel="stylesheet" href="CSS/estilos.css">
	<link rel="stylesheet" type="text/css" href="./CSS/bootstrap-4.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

</head>
<!-- carga datos al cargar la pagina -->
<body onload="loadGrupo2()">
<header>
	<div class="container-fluid bg-primary">
		<div class="row align-items-center">
			<div class="col-6">
				<h1 class="text-info font-italic">Mantenedor de Datos</h1>
			</div>
			<div class="col-6 text-right">
				
				<div class="btn-group">
					<button type="button" class="btn btn-success dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Editar Items
					</button>
					<div class="dropdown-menu">
						<a class="dropdown-item" onclick="">Nuevo Item</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" onclick="">Agregar Foto</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="itemsAoD.php">Activar o desactivar Item</a>
					</div>
				</div>

				<a href="buscadorDeItems.php" class="btn btn-sm btn-info text-white"><i class="fas fa-search"></i> Buscar</a>
				<a href="" class="btn btn-sm btn-info text-white"><i class="fas fa-search"></i> Busqueda avanzada</a>

				<button onclick="CerrarCession()" class="btn btn-sm btn-danger"><i class="fas fa-sign-out-alt"></i> Salir</button>
			</div>
			<div class="col bg-info p-1"></div>
		</div>
	</div>
</header> 
<!-- /desplega todos los datos a medida que se selecciones pra su conpletado y previo envio de datos  -->
<finder>
	<form method="POST" id="FormUno" action="../controlador/DatosIngreso.php" onsubmit="return submit_Envio_datos()" enctype="multipart/form-data">
	<div class="container-fluid">
		<div class="row pt-1 align-items-center">
			<div class="col-12 py-1">
					<div class="row">
						<div class="input-group col-6 input-group-sm invisible">
							<span class="input-group-addon" id="basic-addon1">Descripción Item</span>
							<input type="text" class="form-control form-control-sm" name="descripcion_item" placeholder="Ingrese el nombre del repuesto o item">
						</div>
						<div class="input-group col-6 input-group-sm invisible">
							<span class="input-group-addon" id="basic-addon1">Codigo Item</span>
							<input type="text" class="form-control form-control-sm " name="codigo_item" placeholder="Ingrese el Codigo del repuesto o item">
						</div>
					</div>
				</div>
				<div class="col-6" id="cargaGrupo"></div>
				<div class="col-5" id="cargar"></div>
					<div class="col-1 text-center" id="carga3">
						<button class="btn btn-primary" >Enviar</button>
					</div>
				<div class="col-6 px-5" id="carga2"></div>
				<div class="col-6 px-5" >
					<!-- div que contiene la carga de imagen -->
					<div class="col text-center">
						<input type="file" name="imagenFoto" id="imagenFoto" accept="image/*" class="btn btn-sm btn-info form-control col" onclick="imagen_load()" required>
						<div class="m-2" id=""><img id="imgSalida" width="40%" height="40%" src="img_/previa_2.png" /></div>
					</div>
				</div>
			</div>
		</div>
	</form>
</finder>

<!-- footer o pie de pagina -->
<footer>
	<div class="container mt-5 fixed-bottom">
		<div class="row">
			<div class="col text-center rounded-top">
				<small class="text-primary">Para Mantencion Ariztia por <label><a href="#marcourrutia" class="">Marco Urrutia</a></label></small>
			</div>
		</div>
	</div>
</footer>

<!-- imports de javascript para funcionalidad -->
 	<script type="text/javascript" src="./JS/jquery.js"></script>
 	<script type="text/javascript" src="./JS/tether.1.4.js"></script>
 	<script type="text/javascript" src="./JS/bootstrap.4.alfa.js"></script>
	<script type="text/javascript" src="./JS/javaGrupo.js"></script>
	<script type="text/javascript" src="JS/loadImg.js"></script>
	<script type="text/javascript" src="./JS/javascript.js"></script>
	<script type="text/javascript" src="./JS/sweetAlert.js"></script>
</body>
</html>
