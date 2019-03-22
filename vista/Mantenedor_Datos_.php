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
<body onload="loadGrupo2();loadGruposFinder()" class="imgfondo">
<header>
	<div class="container-fluid bg-primary">
		<div class="row align-items-center">
			<div class="col-4">
				<h1 class="text-info font-italic">Mantenedor de Datos</h1>
			</div>
			<div class="col-8 text-right">
				<!-- Muestra en nombre de la session -->
				<?php echo '<label class="text-info font-italic mr-3">Bienvenido '.$_SESSION["usuario"].'</label>'; ?>

				<div class="btn-group">
					<button type="button" class="btn btn-success dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fas fa-pen"></i> Editar Items
					</button>
					<div class="dropdown-menu">
						<a class="dropdown-item" onclick="modalShow2()"><i class="fas fa-plus-square"></i> Nuevo tipo</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" onclick="showMfoto()"><i class="fas fa-folder-plus"></i> Agregar Foto tipo</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" onclick="showModalItemInactivo()"><i class="fas fa-check-circle"></i> Activar Item</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" onclick="showModalItemActivo()"><i class="fas fa-times-circle"></i> Desactivar Item</a>
					</div>
				</div>

				<div class="btn-group">
					<button type="button" class="btn btn-success dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fas fa-user-edit"></i> Usuario
					</button>
					<div class="dropdown-menu">
						<a class="dropdown-item" onclick="showModalAddUser()"><i class="fas fa-plus-square"></i> Agregar Usuario</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" onclick="showModalChangePass()"><i class="fas fa-user-shield"></i> Modificar Usuario</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" onclick="showModalMantenUsuario()"><i class="fas fa-users-cog"></i> Administrar Usuarios</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" onclick="showModalSuperUser()" ><i class="fas fa-user-tie"></i> Usuario privilegiado</a>
					</div>
				</div>

				<a href="busquedaAvanzada.php" class="btn btn-sm btn-info text-white"><i class="fas fa-search"></i> Buscar</a>
				<a href="editarItemExistente.php" class="btn btn-sm btn-info text-white"><i class="far fa-edit"></i> Editar Items Antiguo</a>

				<button onclick="CerrarCession()" class="btn btn-sm btn-danger"><i class="fas fa-sign-out-alt"></i> Salir</button>
			</div>
			<div class="col bg-info p-1"></div>
		</div>
	</div>
</header> 
<!-- /desplega todos los datos a medida que se selecciones pra su conpletado y previo envio de datos  -->

<div class="container-fluid">
	<div class="row">
		<div class="col-4"><img src="img_/logo.png" height="150px"></div>
		<div class="col-4 text-center"><h1 class="display-4 text-white">busqueda por imagen</h1></div>
		<div class="col-4 text-right"><img src="img_/logo_mante.png" height="150px"></div>
	</div>
</div>
<finder2>

	<div class="container-fluid pb-5">
		<div class="row">

				<div class="col-4" id="gruposFinder2"></div>
				<div class="col-4 pt-2" id="familiaXtipo"></div>
				<div class="col-4 pt-2" id="materialXtipo"></div>
				<div class="col-4 pt-2" id="tipoXtipo"></div>

		</div>
		<!-- id="loading" -->
		<!-- <div class="row d-flex justify-content-center"> -->
		<div class="row d-flex justify-content-center" id="loading">
	<!-- borrar -->
<p class="lead" id="rsptaAddUser"></p>
<!-- borrar -->
		</div>
	</div>
</finder2>

<!-- footer o pie de pagina -->
<footer>
	<div class="container mt-5 fixed-bottom">
		<div class="row fondo">
			<div class="col text-center rounded-top">
				<small class="">Para Mantencion Ariztia por <label><a href="#marcourrutia" class="text-gray-dark font-italic">Marco Urrutia</a></label></small>
			</div>
		</div>
	</div>
</footer>
<!-- -----------------------------------------  MODAL SUPER USER----------------------------------------------  -->
<div class="modal fade" id="modalSuperUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title lead" id="exampleModalLongTitle">Crear Super Usuario</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<!-- contenido del modal -->	
					<!-- <form id="formAddUser" method="POST" onsubmit="return sub_AddUser()"> -->
						<div class="row invisible">
							<div class="col-9">
									<input type="text" class="form-control form-control-sm" placeholder="" name="" id="">
							</div>
							<div class="col-3">
									<a class="btn btn-sm btn-info text-white"><i class="fas fa-search"></i>Buscar</a>
							</div>
						</div>
						<label for=""><small>Nombre de Usuario:</small></label>
							<input type="text" class="form-control form-control-sm mb-2" placeholder="Ingrese El Nombre de Usuario" name="usuaro" id="usuario" required>
						<label for=""><small>Contraseña:</small></label><label class="text-danger ml-2" id="cl_1"></label>
							<input type="password" class="form-control form-control-sm mb-2" placeholder="Ingrese la contraseña" name="clave1" id="clave1" required>
						<label for=""><small>Confirmar Contraseña:</small></label><label class="text-danger ml-2" id="cl_2"></label>
							<input type="password" class="form-control form-control-sm mb-2" placeholder="Ingrese la contraseña nuevamente" name="clave2" id="clave2" onchange="passValida()" required>
						<label for=""><small>Propietario Cuenta:</small></label>
							<input type="text" class="form-control form-control-sm mb-2" placeholder="Persona a cargo de la Cuenta" name="nombre" id="nombre" required>
						<label for=""><small>Comentario:</small></label>
							<input type="text" class="form-control form-control-sm mb-2" placeholder="Comentario sobre la cuenta" name="info" id="info" required>
							<div class="text-center">
								
							</div>
						<!-- fin conttenido del modal -->
					</div>
					<div class="modal-footer">
						<input type="reset" class="btn btn-danger btn-sm" name="btn_add" value="Borrar">
						<input type="submit" id="mostrarBTN" class="btn btn-success btn-sm" name="btn_add" value="Agregar" onclick="sub_AddUser()">
					<!-- </form> -->
				</div>
		</div>
	</div>
</div>

	<!-- -----------------------------------------  MODAL editar o desactivar usuario----------------------------------------------  -->
	<div class="modal fade" id="modalMantenedorUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title lead" id="exampleModalLongTitle">Administrar Usuarios</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<!-- contenido del modal -->	
						<!-- <form id="formAddUser" method="POST" onsubmit="return sub_AddUser()"> -->
							<div class="row invisible">
								<div class="col-9">
										<input type="text" class="form-control form-control-sm" placeholder="" name="" id="">
								</div>
								<div class="col-3">
										<a class="btn btn-sm btn-info text-white"><i class="fas fa-search"></i>Buscar</a>
								</div>
							</div>
							<label for=""><small>Nombre de Usuario:</small></label>
								<input type="text" class="form-control form-control-sm mb-2" placeholder="Ingrese El Nombre de Usuario" name="usuaro" id="usuario" required>
							<label for=""><small>Contraseña:</small></label><label class="text-danger ml-2" id="cl_1"></label>
								<input type="password" class="form-control form-control-sm mb-2" placeholder="Ingrese la contraseña" name="clave1" id="clave1" required>
							<label for=""><small>Confirmar Contraseña:</small></label><label class="text-danger ml-2" id="cl_2"></label>
								<input type="password" class="form-control form-control-sm mb-2" placeholder="Ingrese la contraseña nuevamente" name="clave2" id="clave2" onchange="passValida()" required>
							<label for=""><small>Propietario Cuenta:</small></label>
								<input type="text" class="form-control form-control-sm mb-2" placeholder="Persona a cargo de la Cuenta" name="nombre" id="nombre" required>
							<label for=""><small>Comentario:</small></label>
								<input type="text" class="form-control form-control-sm mb-2" placeholder="Comentario sobre la cuenta" name="info" id="info" required>
								<div class="text-center">
									
								</div>
							<!-- fin conttenido del modal -->
						</div>
						<div class="modal-footer">
							<input type="reset" class="btn btn-danger btn-sm" name="btn_add" value="Borrar">
							<input type="submit" id="mostrarBTN" class="btn btn-success btn-sm" name="btn_add" value="Agregar" onclick="sub_AddUser()">
						<!-- </form> -->
					</div>
			</div>
		</div>
	</div>

	<!-- -----------------------------------------  MODAL CAMBIAR CLAVE----------------------------------------------  -->
	<div class="modal fade" id="modalCambiaClave" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title lead" id="exampleModalLongTitle">Modificar Datos de Usuario</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<!-- contenido del modal -->	
						<!-- <form id="formAddUser" method="GET"> -->
							<div class="row">
								<div class="col" id="LoadCuentas">
								</div>
							</div>
							<hr>
							
								<div class="" id="acaLosDatosDelUsuario">
								</div>
							<!-- fin conttenido del modal -->
						</div>
						<div class="modal-footer">
							<input type="submit" id="mostrarBTN" class="btn btn-success btn-sm col" name="btn_add" value="Modificar" onclick="sub_CrudUser()">
						<!-- </form> -->
					</div>
			</div>
		</div>
	</div>

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
						<!-- <form id="formAddUser" method="POST" onsubmit="return sub_AddUser()"> -->

							<label for=""><small>Nombre de Usuario:</small></label>
								<input type="text" class="form-control form-control-sm mb-2" placeholder="Ingrese El Nombre de Usuario" name="usuaro" id="usuarioAdd">

							<label for=""><small>Contraseña:</small></label><label class="text-danger ml-2" id="cl_1Add"></label>
								<input type="password" class="form-control form-control-sm mb-2" placeholder="Ingrese la contraseña" name="clave1" id="clave1Add">

							<label for=""><small>Confirmar Contraseña:</small></label><label class="text-danger ml-2" id="cl_2Add"></label>
								<input type="password" class="form-control form-control-sm mb-2" placeholder="Ingrese la contraseña nuevamente" name="clave2" id="clave2Add" onchange="passValida()">

							<label for=""><small>Propietario Cuenta:</small></label>
								<input type="text" class="form-control form-control-sm mb-2" placeholder="Persona a cargo de la Cuenta" name="nombre" id="nombreAdd">

							<label for=""><small>Comentario:</small></label>
								<input type="text" class="form-control form-control-sm mb-2" placeholder="Comentario sobre la cuenta" name="info" id="infoAdd">

								<div class="text-center">
									<hr>
									<p class="lead">Tipo de Cuenta</p>
									<div class="form-check form-check-inline">
											<label class="form-check-label" data-toggle="tooltip" title="Este tipo de usuario solo puede modificar los datos de los items">
												<input class="form-check-input" type="radio" name="tipoUser" id="adminUser" value="administrador"> Usuario Administrador
											</label>
										</div>
										<div class="form-check form-check-inline" data-toggle="tooltip" title="Este tipo de usuario puede crear cuentas de usuarios y modificar items">
											<label class="form-check-label">
												<input class="form-check-input" type="radio" name="tipoUser" id="superUser" value="privilegiado"> Usuario Privilegiado
											</label>
										</div>
									
								</div>
							<!-- fin conttenido del modal -->
						</div>
						<div class="modal-footer">
							<input type="submit" id="mostrarBTN" class="btn btn-success btn-sm col" name="btn_add" value="Agregar" onclick="sub_AddUser()">
						<!-- </form> -->
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
						<form action="../controlador/addImgTipo.php" method="POST" onsubmit="return sub_envioFotoXitem()" enctype="multipart/form-data">
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
						<h5 class="modal-title" id="exampleModalLongTitle">Items Activos</h5>
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
						<form action="./../controlador/addNewItem.php" method="POST" onsubmit="return sub_envio()">
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
//conjunt de funciones que cierran session despues de n minutos
	function e() {
    document.body.appendChild( document.createTextNode("Fin Session") );
    document.body.appendChild( document.createElement("BR") );
		location.href ="./../controlador/CerrarSession.php";
	}
	var t=null;
	function contadorInactividad() {
			t=setTimeout("e()",600000);//600.000 = 10 minutos //60.000 = 1 minuto.// eliminar los puntos al llevar  al afuncion
	}
	window.onblur=window.onmousemove=function() {
			if(t) clearTimeout(t);
			contadorInactividad();
	}//conjunt de funciones que cierran session despues de n minutos

	function sub_envio() {
		var data = confirm("esta seguro de los datos INGRESADOS");
		if(data){
			return true;
		} else {
			return false;
		}
	}

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
	
	function sub_envioFotoXitem() {

	}

	function verificaImagen() {
		var data = confirm("verificando");
		if(data){
			return true;
		} else {
			return false;
		}
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
		var conItem = confirm("Esta seguro de ACTIVAR este Item");
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
		var conItem = confirm("Esta seguro de DESACTIVAR este Item");
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
				swal("el dato fue DESACTIVADO.");
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
		
		$("#newMaterial").html("");
		$("#newTipo").html("");
		document.getElementById('familiaNew').selected = "true";
    var select = document.getElementById("familiaNew");
    var index = select.selectedIndex; 
    var value = select.options[index].value;
		var text = select.options[index].text;
		if(value != "1"){
			$.ajax({
				url: './../controlador/TraeInputsXtipo2.php',
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

	function traetipoXtipo2() {
			var tipo = $('#acaSaleElTipo').val();
			$.ajax({
				url: './../controlador/traeTipoXtipo.php',
				type: 'POST',
				dataType: 'html',
				data: { valor: tipo},
			})
			.done(function(respuesta){
				// console.log('logrado');
				$("#newMaterial").html(respuesta)
				loadImagenXtipo()
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


	//finder 2---------
	
	function loadGruposFinder(){
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
    var txt = "<select class='form-control form-control-sm my-2' name='grupo' id='grupoFinder2' onclick='selGrupoFinder()'><option value='1' onclick='selGrupoFoto()'>Selecciona Grupo de items</option>";
    grupo.forEach(function(element) {
        txt += "<option value='"+element+"' onclick='selGrupoFinder()'>"+element+"</option>";
    });
    txt += "</select>";
    $("#gruposFinder2").html(txt);
	};
		
	function selGrupoFinder() {
		$("#familiaXfoto").html("");
		$("#materialXtipo").html("");
		$("#tipoXtipo").html("");
		$("#loading").html("");
		document.getElementById('grupoFinder2').selected = "true";
		var select = document.getElementById("grupoFinder2");
		var index = select.selectedIndex; 
		var value = select.options[index].value;
		var text = select.options[index].text;
		if(value != 1){
			$.ajax({
				url: './../controlador/TraerFamiliasXtipo.php',
				type: 'POST',
				dataType: 'html',
					data: { valor: value},
				}).done(function(respuesta){
					// console.log('logrado');
					$("#familiaXtipo").html(respuesta)
				})//fin done
				.fail(function(){
					console.log('error');
				});
		}
	}

	function selFamiliaXfoto() {
		$("#materialXtipo").html("");
		$("#tipoXtipo").html("");
		//$("#materiales").html("");
		document.getElementById('familiaXfoto').selected = "true";
		var select = document.getElementById("familiaXfoto");
		var index = select.selectedIndex; 
		var value = select.options[index].value;
		var text = select.options[index].text;
		if(value != 1){
			$.ajax({
				url: './../controlador/traeInputsXtipo.php',
				type: 'POST',
				dataType: 'html',
					data: { valor: value},
				}).done(function(respuesta){
					// console.log('logrado');
					$("#tipoXtipo").html(respuesta)
					loadImagenXtipoF()
				})//fin done
				.fail(function(){
					console.log('error');
				});
		}
	}

	function traetipoXtipo() {
			var tipo = $('#acaSaleElTipo').val();
			$.ajax({
				url: './../controlador/traeTipoXtipo.php',
				type: 'POST',
				dataType: 'html',
				data: { valor: tipo},
			})
			.done(function(respuesta){
				// console.log('logrado');
				$("#materialXtipo").html(respuesta)
				loadImagenXtipo()
			})//fin done
			.fail(function(){
				console.log('error');
			});
	}

	function loadImagenXtipoF() {
		textT = "N/A";
		document.getElementById('familiaXfoto').selected = "true";
		var selectF = document.getElementById("familiaXfoto");
		var indexF = selectF.selectedIndex;
		var textF = selectF.options[indexF].text;

		$.ajax({
		url: './../controlador/cargaImagen.php',
		type: 'POST',
		dataType: 'html',
		data: { valor: textF , valor2: textT},
		}).done(function(respuesta){
			// console.log('logrado');
			$("#loading").html(respuesta)
		})//fin done
		.fail(function(){
			console.log('error');
		});
	}

	function loadImagenXtipo() {
		document.getElementById('familiaXfoto').selected = "true";
		var selectF = document.getElementById("familiaXfoto");
		var indexF = selectF.selectedIndex;
		var textF = selectF.options[indexF].text;

		document.getElementById('tipoXtipo').selected = "true";
		var selectT = document.getElementById("tipoXtipo");
		var indexT = selectT.selectedIndex;
		var textT = selectT.options[indexT].text;

		$.ajax({
		url: './../controlador/cargaImagen.php',
		type: 'POST',
		dataType: 'html',
		data: { valor: textF , valor2: textT},
		}).done(function(respuesta){
			// console.log('logrado');
			$("#loading").html(respuesta)
		})//fin done
		.fail(function(){
			console.log('error');
		});
	}


//modal addUser


	function showModalAddUser() {
		if(true){
			$('#modalNewUser').modal('show')
			$('#usuarioAdd').val("");
			$('#clave1Add').val("");
			$('#clave2Add').val("");
			$('#nombreAdd').val("");
			$('#infoAdd').val("");
			document.getElementById("adminUser").checked = false;
			document.getElementById("superUser").checked = false;
		}
	}


	function sub_AddUser() {
		var user = $('#usuarioAdd').val();
		var cl1 = $('#clave1Add').val();
		var cl2 = $('#clave2Add').val();
		var nombre = $('#nombreAdd').val();
		var info = $('#infoAdd').val();
		che1 =document.getElementById("adminUser");
		che2 = document.getElementById("superUser");
		
		if(user != "" && cl1 != "" && cl2 != "" && nombre != "" && info != "" && passValida() && (che1.checked || che2.checked)){
			add_ = confirm("Esta seguro de los datos ingresados")
			if(add_){
				addUsser_DB()
			} else {
				alert("Verifica los datos")
			}
		} else {
			alert("Completa Todos Los Datos");
		}
		
	}

	function addUsser_DB() {

		var usr = $('#usuarioAdd').val();
		var clv = $('#clave1Add').val();
		var nm = $('#nombreAdd').val();
		var inf = $('#infoAdd').val();
		
		che1 =document.getElementById("adminUser");
		che2 = document.getElementById("superUser");
		if(che1.checked){
			tipo = che1.value;
		}
		if(che2.checked){
			tipo = che2.value;
		}

		//alert(usr+clv+nm+inf+tipo);
			$.ajax({
				url: './../controlador/addNewUser.php',
				type: 'POST',
				dataType: 'html',
				data: { valor1: usr,
					valor2: clv,
					valor3: nm,
					valor4: inf,
					valor5: tipo},
			})
			.done(function(respuesta){
				// console.log('logrado');
				console.log(respuesta);
				$('#modalNewUser').modal('hide')
				swal("Operacion realizada con EXITO!")
				//$("#rsptaAddUser").html(respuesta)
			})//fin done
			.fail(function(){
				console.log('error');
			});
	}


	function passValida() {
		var clave1 = $('#clave1Add').val();
		var clave2 = $('#clave2Add').val();
		if(clave1 != clave2){
			$("#cl_1Add").html("Clave distinta")
			$("#cl_2Add").html("Clave distinta")
			document.getElementById("clave1Add").focus()
			return false;
		} else {
			$("#cl_1Add").html(".")
			$("#cl_2Add").html(".")
			return true;
		}
	}


//modal CAMBIO CLAVE

	function showModalChangePass() {
		if(true){
			$('#modalCambiaClave').modal('show')
			$('#acaLosDatosDelUsuario').html("")
			loadCuentasUser()
		}
	}
	
	function loadCuentasUser() {
		$.ajax({
		url: './../controlador/loadUsers.php',
		type: 'POST',
		dataType: 'html',
		}).done(function(respuesta){
			// console.log('logrado');
			//$("#loading").html(respuesta)
			$('#LoadCuentas').html(respuesta)
		})//fin done
		.fail(function(){
			console.log('error');
		});
	}

	function seleccionaUser() {
		$("#acaLosDatosDelUsuario").html('<i class="text-center fas fa-spinner fa-spin fa-5x text-success"></i>')
		document.getElementById('selUserDB').selected = "true";
		var select = document.getElementById("selUserDB");
		var index = select.selectedIndex; 
		var value = select.options[index].value;
		var text = select.options[index].text;

		$.ajax({
		url: './../controlador/traeUsuario.php',
		type: 'POST',
		dataType: 'html',
		data: { valor: value },
		})
		.done(function(respuesta){
			//alert(respuesta);
			$("#acaLosDatosDelUsuario").html(respuesta)
		})//fin done
		.fail(function(){
			console.log('error');
		});
	}

	function verClave() {
		document.getElementById('crudClaveN').type = 'text';
	}

	function ocultaClave() {
		document.getElementById('crudClaveN').type = 'password';
	}

	function verClaveOld() {
		document.getElementById('crudClaveO').type = 'text';
	}

	function ocultaClaveOld() {
		document.getElementById('crudClaveO').type = 'password';
	}

	function sub_CrudUser() {
		document.getElementById('selUserDB').selected = "true";
		var select = document.getElementById("selUserDB");
		var index = select.selectedIndex; 
		var value = select.options[index].value;
		var text = select.options[index].text;

		var nombre = $('#crudNombre').val();
		var usuario = $('#crudUser').val();
		var newClave = $('#crudClaveN').val();
		var oldCuenta = $('#crudTypoCuentaOld').val();
		var newCuenta = $('#crudTypoCuentaNew').val();
		var actides = $('#crudActivaDesactivaCta').val();
		var info = $('#crudInfo').val();


		//alert(usr+clv+nm+inf+tipo);
		var conf = confirm("Esta seguro d elos datos ingresados");
		if(conf){
			if(newClave != "" && newCuenta != "0" && actides != "3"){
				$.ajax({
				url: './../controlador/crudUser.php',
				type: 'POST',
				dataType: 'html',
				data: { valor1: value,
					valor2: nombre,
					valor3: usuario,
					valor4: newClave,
					valor5: newCuenta,
					valor6: info,
					valor7: actides},
			})
			.done(function(respuesta){
				console.log(respuesta);
				$('#modalCambiaClave').modal('hide')
				swal("Operacion realizada con EXITO!")
			})//fin done
			.fail(function(){
				console.log('error');
			});
			} else {
				alert("Completa todos los campos")
			}
		} else {
			alert("Verifica los datos");
		}
	}



	//MODAL MANTENEDOR DE USUARIO

	function showModalMantenUsuario() {
		if(true){
			$('#modalMantenedorUsuario').modal('show')
			// //document.getElementById("formAddUser").reset();
			// $('#usuario').val("");
			// $('#clave1').val("");
			// $('#clave2').val("");
			// $('#nombre').val("");
			// $('#info').val("");

		}
	}


//MODAL CREAR SUPER USUARIO

	function showModalSuperUser() {
		if(true){
			$('#modalSuperUser').modal('show')
			// //document.getElementById("formAddUser").reset();
			// $('#usuario').val("");
			// $('#clave1').val("");
			// $('#clave2').val("");
			// $('#nombre').val("");
			// $('#info').val("");

		}
	}





</script>
selUserDB=6
crudNombre=Joel+Herrera
crudUser=joel
crudClaveN=nuevaclave
crudTypoCuentaOld=Administrador
crudTypoCuentaNew=Privilegiado
crudInfo=solo+puede+editar+datos+new+data
btn_add=Agregar