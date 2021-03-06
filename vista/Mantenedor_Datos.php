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
	<link rel="icon" type="image/png" href="img_/icon.png" />
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
						<a class="dropdown-item" onclick="modalShow2()">Nuevo Item</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" onclick="showMfoto()">Agregar Foto Item</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" onclick="showModalItemInactivo()" >Activar Item</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" onclick="showModalItemActivo()" >Desactivar Item</a>
					</div>
				</div>
				<a onclick="showModalAddUser()" class="btn btn-sm btn-info text-white"><i class="far fa-plus-square"></i> ususario</a>
				<a href="buscadorDeItems.php" class="btn btn-sm btn-info text-white"><i class="fas fa-search"></i> Buscar</a>
				<a href="editarItemExistente.php" class="btn btn-sm btn-info text-white"><i class="fas fa-search"></i> Editar Items Antiguo</a>

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
					<div class="col text-center invisible">
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

	<!-- -----------------------------------------  MODAL ADD NEW USER----------------------------------------------  -->
	<div class="modal fade" id="modalNewUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title lead" id="exampleModalLongTitle">Agregar Usuario</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<!-- contenido del modal -->	
						<form action="../controlador/addImgTipo.php" method="POST" onsubmit="return sub_envio()">

							<!-- fin conttenido del modal -->
						</div>
						<div class="modal-footer">
							<input type="submit" id="mostrarBTN" class="btn btn-success btn-sm" name="btn_add" value="Agregar">
						</form>
					</div>
			</div>
		</div>
	</div>

		<!-- -----------------------------------------  MODAL FOTO POR TIPO----------------------------------------------  -->
		<div class="modal fade" id="modalFotoTipo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title lead" id="exampleModalLongTitle">Cargar Foto al Tipo</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<!-- contenido del modal -->	
						<form action="../controlador/addImgTipo.php" method="POST" onsubmit="return sub_envio()" enctype="multipart/form-data">
							<small id="modalRespuesta"></small>			
							<div id="fotoGrupo"></div>
							<div id="fotoFamilia"></div>
							<div id="fotoTipo"></div>
							<div id="fotoTipo2"></div>
							<!-- fin conttenido del modal -->
						</div>
						<div class="modal-footer">
							<input type="submit" id="mostrarBTN" class="btn btn-primary btn-sm" name="btn_add" value="Agregar">
						</form>
					</div>
			</div>
		</div>
	</div>

	<!-- -----------------------------------------  MODAL items inactivos----------------------------------------------  -->
	<div class="modal info" id="modalInactivos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Items Inactivos</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>

					<div class="modal-body">
						<!-- contenido del modal -->
						<div class="col-12 text-center" id="dInactivo"></div>
						<div class="modal-footer">
								<div class="col-12">
										<div class="row">
												<div class="col-8">
														<small class="">Haz click En un item de la lista para ACTIVAR</small>
												</div>
												<div class="col-4 text-right">
														<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal" aria-label="Close">Cerrar</button>
												</div>
										</div>
								</div>
						</div>
				</div>
			</div>
		</div>
	</div>

	<!-- -----------------------------------------  MODAL items activos----------------------------------------------  -->
	<div class="modal info" id="modalActivos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Items Inactivos</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>

					<div class="modal-body">
						<!-- contenido del modal -->
						<div class="col-12 text-center" id="IActivo"></div>
						<div class="modal-footer">
								<div class="col-12">
										<div class="row">
												<div class="col-8">
														<small class="">Haz click En un item de la lista para DESACTIVAR</small>
												</div>
												<div class="col-4 text-right">
														<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal" aria-label="Close">Cerrar</button>
												</div>
										</div>
								</div>
						</div>
				</div>
			</div>
		</div>
	</div>

	<!-- -----------------------------------------  Modal NuevoItem----------------------------------------------  -->
	<div class="modal fade" id="modalNuevoItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title lead" id="exampleModalLongTitle">Crear Nuevo Item</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<!-- contenido del modal -->	
						<form action="data.php" method="GET" onsubmit="return sub_envio()">
							<small id="modalRespuesta"></small>			
							<div id="newGrupo"></div>
							<div id="newFamilia"></div>
							<div id="newMaterial"></div>
							<div id="newTipo"></div>
							<!-- fin conttenido del modal -->
						</div>
						<div class="modal-footer">
							<input type="submit" id="mostrarBTN" class="btn btn-primary btn-sm" name="btn_add" value="Agregar">
						</form>
					</div>
			</div>
		</div>
	</div>

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
 //modal carga de foto a item
	function showMfoto() {
		$("#fotoFamilia").html("");
		$("#fotoTipo").html("");
		$("#fotoTipo2").html("");
		if(true){
			$('#modalFotoTipo').modal('show')
			loadGruposFoto()
		}
	}

	function loadGruposFoto(){
    var grupo = [
        "CADENAS Y CORREAS",
        "ELEMENTOS DE FIJACION",
        "EQUIPOS INDUSTRIALES",
        "FILTROS Y LUBRICANTES",
        "HERRAMIENTAS E INSTRUMENTOS",
        "MATERIALES DE CONSTRUCCION Y FERRETERIA",
        "MATERIALES DE GASFITERIA",
        "MATERIALES Y ARTICULOS DE REFRIGERACION",
        "MATERIALES Y ARTICULOS ELECTRICOS",
        "MOTORES Y MOTORREDUCTORES",
        "REPUESTOS MAQUINAS",
        "RODAMIENTOS Y SELLOS"
    ];
    var txt = "<select class='form-control form-control-sm my-2' name='grupo' id='grupoFoto' onclick='selGrupoFoto()'><option value='1' onclick='selGrupoFoto()'>Selecciona Grupo de items</option>";
    grupo.forEach(function(element) {
        txt += "<option value='"+element+"' onclick='selGrupoFoto()'>"+element+"</option>";
    });
    txt += "</select>";
    $("#fotoGrupo").html(txt);
	};
	
	function selGrupoFoto() {
		//alert("diste click");
		$("#familias").html("");
		$("#tipoPag").html("");
		$("#materiales").html("");
		document.getElementById('grupoFoto').selected = "true";
    var select = document.getElementById("grupoFoto");
    var index = select.selectedIndex; 
    var value = select.options[index].value;
		var text = select.options[index].text;
		if(value != "1"){
				$.ajax({
				url: './../controlador/TraerFamiliasFoto.php',
				type: 'POST',
						dataType: 'html',
						data: { valor: value }
			}).done(function(respuesta){
				// console.log('logrado');
				$("#fotoFamilia").html(respuesta)
			})//fin done
			.fail(function(){
				console.log('error');
			});
		}//fin if
	};

	function selFamiliaFoto(){
		
		$("#fotoTipo").html("");
		$("#fotoTipo2").html("");
		document.getElementById('familiaFoto').selected = "true";//TRAE EL VALOR DESDE FOTO GRUPO
    var select = document.getElementById("familiaFoto");
    var index = select.selectedIndex; 
    var value = select.options[index].value;
		var text = select.options[index].text;
		//alert(text);
		if(value != "1"){
			$.ajax({
				url: './../controlador/traeInputsFoto.php',
				type: 'POST',
				dataType: 'html',
				data: { valor: value},
			})
			.done(function(respuesta){
				//console.log('logrado');
				$("#fotoTipo").html(respuesta)
			})//fin done
			.fail(function(){
				console.log('error');
			});//fin fail
		}//fin if
	}

	function fotoTipo() {
		var tipo = $('#fotoTipoD').val();
		//alert(tipo);
		$.ajax({
			url: './../controlador/traeTipo.php',
			type: 'POST',
			dataType: 'html',
			data: { valor: tipo},
		})
		.done(function(respuesta){
			// console.log('logrado');
			$("#fotoTipo2").html(respuesta)
		})//fin done
		.fail(function(){
			console.log('error');
		});
	}


  //modal carga y activa items inactivos
	function showModalItemInactivo(){
		if(true){
			$('#modalInactivos').modal('show');
			loadItemsInactivos();
		}
	}

	function loadItemsInactivos() {

		//swal("seleccionaste un item inactivo para activarlo");
		//$('#dInactivo').html('<i class="text-success fas fa-spinner fa-spin fa-5x"></i>');

		// setTimeout(function(){
		// 	//document.getElementById("dInactivo").innerHTML="Pasaron 2 segundos antes de que pudieras ver esto.";
		// 	loadItems();
		// },2000,"JavaScript");

		$.ajax({
			url: './../controlador/cargaInactivos.php',
			type: 'POST',
			dataType: 'html'
		}).done(function(respuesta){
			// console.log('logrado');
			$("#dInactivo").html(respuesta)
		})//fin done
			.fail(function(){
			console.log('error');
		});

	}

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
			url: './../controlador/upItem.php',
			type: 'POST',
			dataType: 'html',
			data: { valor: value }
			}).done(function(respuesta){
				// console.log('logrado');
				//$("#dInactivo").html(respuesta)
				loadItemsInactivos();
				swal("el dato fue ACTIVADO.");
			})//fin done
			.fail(function(){
				console.log('error');
			});
			
			loadItemsInactivos();
		} else {
			console.log("El dato a sigue DESCATIVADO");

		}
	}


  //modal carga y desactiva items activo
	function showModalItemActivo(){
		if(true){
			$('#modalActivos').modal('show');
			loadItemsActivos();
		}
	}

	function loadItemsActivos() {

		//swal("seleccionaste un item inactivo para activarlo");
		//$('#dInactivo').html('<i class="text-success fas fa-spinner fa-spin fa-5x"></i>');

		// setTimeout(function(){
		// 	//document.getElementById("dInactivo").innerHTML="Pasaron 2 segundos antes de que pudieras ver esto.";
		// 	loadItems();
		// },2000,"JavaScript");

		$.ajax({
			url: './../controlador/cargaActivos.php',
			type: 'POST',
			dataType: 'html'
		}).done(function(respuesta){
			// console.log('logrado');
			$("#IActivo").html(respuesta)
		})//fin done
			.fail(function(){
			console.log('error');
		});

	}

	function selActivo(){
		// $("#fotoTipo").html("");
		// $("#fotoTipo2").html("");
		document.getElementById('itemActivo').selected = "true";//TRAE EL VALOR DESDE FOTO GRUPO
		var select = document.getElementById("itemActivo");
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
				loadItemsActivos();
				swal("el dato fue ACTIVADO.");
			})//fin done
			.fail(function(){
				console.log('error');
			});
			
			loadItemsActivos();
		} else {
			console.log("El dato a sigue DESCATIVADO");

		}
	}


	//modal nuevo item
	function loadGrupos3(){
    var grupo = [
        "CADENAS Y CORREAS",
        "ELEMENTOS DE FIJACION",
        "EQUIPOS INDUSTRIALES",
        "FILTROS Y LUBRICANTES",
        "HERRAMIENTAS E INSTRUMENTOS",
        "MATERIALES DE CONSTRUCCION Y FERRETERIA",
        "MATERIALES DE GASFITERIA",
        "MATERIALES Y ARTICULOS DE REFRIGERACION",
        "MATERIALES Y ARTICULOS ELECTRICOS",
        "MOTORES Y MOTORREDUCTORES",
        "REPUESTOS MAQUINAS",
        "RODAMIENTOS Y SELLOS"
    ];
    var txt = "<select class='form-control form-control-sm my-2' name='grupo' id='grupoNew' onclick='selGrupo3()'><option value='1' onclick='selGrupo3()'>Selecciona Grupo de items</option>";
    grupo.forEach(function(element) {
        txt += "<option value='"+element+"' onclick='selGrupo3()'>"+element+"</option>";
    });
    txt += "</select>";
    $("#newGrupo").html(txt);
	};
	
	function selGrupo3() {
		$("#newFamilia").html("");
		$("#newMaterial").html("");
		$("#newTipo").html("");
		document.getElementById('grupoNew').selected = "true";
		var select = document.getElementById("grupoNew");
		var index = select.selectedIndex; 
		var value = select.options[index].value;
		var text = select.options[index].text;
		if(value != "1"){
			$.ajax({
			url: './../controlador/TraerFamilias4.php',
			type: 'POST',
					dataType: 'html',
					data: { valor: value }
			}).done(function(respuesta){
				// console.log('logrado');
				$("#newFamilia").html(respuesta)
			})//fin done
			.fail(function(){
				console.log('error');
			});
		}//fin if
	}

	function selFamilia3() {
		
		// $("#newMaterial").html("");
		// $("#newTipo").html("");
		document.getElementById('familiaNew').selected = "true";
    var select = document.getElementById("familiaNew");
    var index = select.selectedIndex; 
    var value = select.options[index].value;
		var text = select.options[index].text;
		if(value != "1"){
			$.ajax({
				url: './../controlador/TraeInputs4.php',
				type: 'POST',
				dataType: 'html',
				data: { valor: value},
			})
			.done(function(respuesta){
				//console.log('logrado');
				$("#newTipo").html(respuesta)
			})//fin done
			.fail(function(){
				console.log('error');
			});//fin fail
		}//fin if
	}

	function traeMaterialNew() {
		var tipo = $('#acaSaleElTipoNew').val();
		$.ajax({
			url: './../controlador/consultaMateriales.php',
			type: 'POST',
			dataType: 'html',
			data: { valor: tipo},
		})
		.done(function(respuesta){
			// console.log('logrado');
			$("#newMaterial").html(respuesta)
		})//fin done
		.fail(function(){
			console.log('error');
		});
	}

	function modalShow2() {
	
		$("#newFamilia").html("");
		$("#newMaterial").html("");
		$("#newTipo").html("");
		if(true){
			$('#modalNuevoItem').modal('show')
		//	$("#modalRespuesta").html(inp)
			loadGrupos3()
		}
	}

	
	function showModalAddUser() {
		// $("#newFamilia").html("");
		// $("#newMaterial").html("");
		// $("#newTipo").html("");
		if(true){
			$('#modalNewUser').modal('show')
		}
	}

</script>