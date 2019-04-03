<?php

session_start();
if(!isset($_SESSION['usuario'])){
	header('Location: index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Catalogo Ariztia</title>
	<link rel="icon" type="image/png" href="img_/icon.png" />
	<!-- import de estilos css, el de estilos.css solo contiene el color del fondo -->
	<link rel="stylesheet" href="CSS/estilos.css">
	<link rel="stylesheet" type="text/css" href="./CSS/bootstrap-4.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

</head>
<!-- carga datos al cargar la pagina -->
<body onload="loadItems()">
<header>
	<div class="container-fluid bg-primary">
		<div class="row align-items-center">
			<div class="col-6">
				<h1 class="text-info font-italic">Mantenedor de Datos</h1>
			</div>
			<div class="col-6 text-right">
        <a href="Mantenedor_Datos.php" class="btn btn-sm btn-info text-white"><i class="fas fa-search"></i> Mantenedor Datos</a>
				<a href="buscadorDeItems.php" class="btn btn-sm btn-info text-white"><i class="fas fa-search"></i> Buscar</a>
				<a href="busuqedaAvanzada.php" class="btn btn-sm btn-info text-white"><i class="fas fa-search"></i> Busqueda avanzada</a>

				<button onclick="CerrarCession()" class="btn btn-sm btn-danger"><i class="fas fa-sign-out-alt"></i> Salir</button>
			</div>
			<div class="col bg-info p-1"></div>
		</div>
	</div>
</header> 


<container>
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="col-12">
						<div class="row align-items-end">
							<div class="col-6">
								<h1 class="font-italic text-primary">Items Inactivos <label class="lead">Haz click en la lista para activar item</label></h1>
							</div>
							<div class="col-6 text-right">
								<a class="text-success align-text-top pt-2" onclick="loadItems()"><i class="fas fa-sync-alt fa-2x"></i></a>
							</div>
						</div>
				</div>
				<div class="col-12 text-center" id="dInactivo">
						
				</div>
			</div>
			<div class="col-12 pt-5">
					<div class="col-12">
							<div class="row align-items-end">
								<div class="col-6">
									<h1 class="font-italic text-primary">Items Inactivos <label class="lead">Haz click en la lista para desativar item</label></h1>
								</div>
								<div class="col-6 text-right">
									<a class="text-success align-text-top pt-2" onclick=""><i class="fas fa-sync-alt fa-2x"></i></a>
								</div>
							</div>
					</div>
					<div class="col-12 text-center" id="dInactivo">
							<select multiple name="" id="" class="col-12 form-control" style="height:220px">
									<option value="" onclick="selActivo()">Lorem ipsum dolor sit amet.</option>
								</select>
					</div>
				</div>
		</div>
	</div>



</container>

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
<script>
function selInactivo(){
	// $("#fotoTipo").html("");
	// $("#fotoTipo2").html("");
	document.getElementById('itemInactivo').selected = "true";//TRAE EL VALOR DESDE FOTO GRUPO
	var select = document.getElementById("itemInactivo");
	var index = select.selectedIndex; 
	var value = select.options[index].value;
	var text = select.options[index].text;
	var conItem = confirm("Esta seguro de activar este Item");
	if(conItem){
		console.log("El dato a fue ACTIVADO");
		
		$.ajax({
		url: './../controlador/downItem.php',
		type: 'POST',
		dataType: 'html',
		data: { valor: value }
		}).done(function(respuesta){
			// console.log('logrado');
			//$("#dInactivo").html(respuesta)
			loadItems();
			swal("el dato fue ACTIVADO.");
		})//fin done
		.fail(function(){
			console.log('error');
		});
		
		loadItems();
	} else {
		console.log("El dato a sigue DESCATIVADO");

	}
}

//funcion que carga los items desactivados de la base de datos
function loadItems() {

	//swal("seleccionaste un item inactivo para activarlo");
	$('#dInactivo').html('<i class="text-success fas fa-spinner fa-spin fa-5x"></i>');

	// setTimeout(function(){
	// 	//document.getElementById("dInactivo").innerHTML="Pasaron 2 segundos antes de que pudieras ver esto.";
	// 	loadItems();
	// },2000,"JavaScript");

	$.ajax({
		url: './../controlador/cargaInactivos.php',
		type: 'POST',
				dataType: 'html',
		}).done(function(respuesta){
			// console.log('logrado');
			$("#dInactivo").html(respuesta)
		})//fin done
		.fail(function(){
			console.log('error');
		});
	
}

function selActivo(){
	data = confirm("seleccionaste un item activo para desactivarlo");	
	if(data){
		swal("Activado");
	} else {
		swal("El dato no sufrio Cambios");
	}
}

</script>