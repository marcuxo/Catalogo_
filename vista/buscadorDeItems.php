<?php

?>
<!DOCTYPE html>
<html>
<head >
	<title>Catalogo Ariztia</title>
	<!-- import de hojas de estilos css estilos.css solo contiene el color del fondo -->
	<link rel="stylesheet" href="CSS/estilos.css">
	<link rel="stylesheet" type="text/css" href="./CSS/bootstrap-4.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

</head>
<body>
<header>
	<div class="container-fluid mb-3 bg-primary">
		<div class="row align-items-center">
			<div class="col-10">
				<h1 class="font-italic text-info">Buscador</h1>
			</div>
			<div class="col-2 text-right">
				<a href="index.php" class="btn btn-sm btn-info"><i class="fas fa-home"></i> Inicio</a>
				<a href="Login_Mantenedor.php" class="btn btn-sm btn-info"><i class="fas fa-sign-in-alt"></i> Entrar</a>
			</div>
			<div class="col bg-info p-1"></div>
		</div>
	</div>
</header>

<!-- modulo que contiene la busqueda -->
<div> 
	<div class="container-fluid px-5">
		<div class="row">
			<div class="col">
					<input type="search" name="txt_buscar" id="txt_buscar" class="form-control form-control-sm col-3 form-check-inline form-control-success" placeholder="Que Quieres Buscar??">
					<button onclick="buscados()" class="btn btn-sm btn-info form-check-inline"><i class="fas fa-search"></i> buscar</button>
			</div>
		</div>
	</div>
</div>

<!-- div en el cual se mostraran los datos buscados -->
<div class="text-center align-items-end px-5">
	<br>
	<div ></div>
	<p id="resultadoBusqueda" class="lead text-muted">No haz buscado nada aun :)</p>
	<br>
	<div class="container-fluid mt-2">
		<div class="row">
			<div id="copyONclick" class="col-12  bg-success text-center invisible">
			<a class="lead text-white pl-2 copyClick" id="resultadoBusqueda2" onclick="copiarAlPortapapeles('resultadoBusqueda2')" data-toggle="tooltip" title="Haz Click para COPIAR"></a>
			</div>
		</div>
	</div>

</div>
<!-- footer o pie de pagina -->
<footer>
	<div class="container mt-5 fixed-bottom">
		<div class="row">
			<div class="col bg-info text-center rounded-top">
				<small class="">Para Mantencion Ariztia por <label><a href="#marcourrutia" class="font-italic text-gray-dark">Marco Urrutia</a></label></small>
			</div>
		</div>
	</div>
</footer>



<!-- import de archivos JavaScript para funcionalidad -->
	<script src="JS/buscarJs.js"></script>
 	<script type="text/javascript" src="./JS/jquery.js"></script>
 	<script type="text/javascript" src="./JS/tether.1.4.js"></script>
 	<script type="text/javascript" src="./JS/bootstrap.4.alfa.js"></script>
	<script type="text/javascript" src="./JS/sweetAlert.js"></script>
</body>
</html>

<script>
	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	})

	function copiarAlPortapapeles(id_elemento) {
		var aux = document.createElement("input");
		aux.setAttribute("value", document.getElementById(id_elemento).innerHTML);
		document.body.appendChild(aux);
		aux.select();
		document.execCommand("copy");
		document.body.removeChild(aux);
	}
</script>