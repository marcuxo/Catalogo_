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
							<a class="dropdown-item" onclick="modalShow2()"><i class="fas fa-plus-square"></i> <small>Nuevo tipo</small></a>
						<!-- <div class="dropdown-divider"></div> -->
							<a class="dropdown-item" onclick="showModNewFamili()"><i class="fas fa-plus-square"></i> <small>Nueva Familia</small></a>
						<!-- <div class="dropdown-divider"></div> -->
							<a class="dropdown-item" onclick="showModalActivarItemEnEspera()"><i class="fas fa-check-circle"></i> <small>Items En ESPERA</small></a>
						<!-- <div class="dropdown-divider"></div> -->
							<a class="dropdown-item" onclick="showModalActivarItem()"><i class="fas fa-check-circle"></i><small> Activar item</small></a>
						<!-- <div class="dropdown-divider"></div> -->
							<a class="dropdown-item" onclick="showModalDesactivarItem()"><i class="fas fa-check-circle"></i><small> Desctivar item</small></a>
						<!-- <div class="dropdown-divider"></div> -->
							<a class="dropdown-item" onclick="showMfoto()"><i class="fas fa-folder-plus"></i><small> Agregar Foto tipo</small></a>
						<div class="dropdown-divider"></div>
							<a class="dropdown-item" onclick="showNewGlosa()"><i class="fas fa-plus-square"></i> <small>Nueva Glosa</small></a>
						<!-- <div class="dropdown-divider"></div> -->
							<a class="dropdown-item" onclick="showModalItemInactivo()"><i class="fas fa-check-circle"></i> <small>Activar Glosa</small></a>
						<!-- <div class="dropdown-divider"></div> -->
							<a class="dropdown-item" onclick="showModalItemActivo()"><i class="fas fa-times-circle"></i><small> Desactivar Glosa</small></a>
					</div>
				</div>
				
				<div class="btn-group">
					<button type="button" class="btn btn-success dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fas fa-user-edit"></i> Usuario
					</button>
					<div class="dropdown-menu">
						<a class="dropdown-item" onclick="showModalAddUser()"><i class="fas fa-plus-square"></i> <small>Agregar Usuario</small></a>
						<!-- <div class="dropdown-divider"></div> -->
						<a class="dropdown-item" onclick="showModalChangePass()"><i class="fas fa-user-shield"></i><small> Modificar Usuario</small></a>
					</div>
				</div>

				<a href="busquedaAvanzada_ss.php" class="btn btn-sm btn-info text-white"><i class="fas fa-search"></i> Buscar</a>
				<a href="editarItemExistente_ss.php" class="btn btn-sm btn-info text-white"><i class="far fa-edit"></i> Editar Items Antiguo</a>

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

	<!-- -----------------------------------------  MODAL IGRESA CODIGO----------------------------------------------  -->
	<div class="modal info" id="modalIngresaCodigo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Ingresa el Codigo para la Glosa</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>

					<div class="modal-body">
						<!-- contenido del modal -->
						<div class="col-12 text-center" id="">
								<div class='input-group input-group-sm mb-2'><span class='input-group-addon' id='sizing-addon2'>Codigo</span>
									<input name='nuevoCodigoNGLS' id='nuevoCodigoNGLS' type='text' class='form-control' placeholder='Ingrese el codigo' aria-describedby='sizing-addon2' ><br></div>
									<input type="text" id="iDnuevoCodigoNGLS" class="invisible">
							<div class="col mb-3" id="textCodigo"></div>
						</div>
						<div class="modal-footer">
								<div class="col-12">
										<div class="row">
												<div class="col text-right">
														<button type="button" class="btn btn-sm btn-danger" onclick="selAddCodigo()">Agregar Codigo</button>
												</div>
										</div>
								</div>
						</div>
				</div>
			</div>
		</div>
	</div>

	<!-- -----------------------------------------  MODAL ACTIVAR ITEM EN ESPERA----------------------------------------------  -->
	<div class="modal info" id="modalActivaritemEnEspera" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Activar Item En espera</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>

					<div class="modal-body">
						<!-- contenido del modal -->
						<div class="col-12 text-center" id="activarItemES"></div>
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

	<!-- -----------------------------------------  MODAL ACTIVAR ITEM----------------------------------------------  -->
	<div class="modal info" id="modalActivaritem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Activar Item</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>

					<div class="modal-body">
						<!-- contenido del modal -->
						<div class="col-12 text-center mb-3" id="loadItemsInactivosGFT"></div>
						<div class="col-12 text-center mb-3" id="loadTipoIGFT_"></div>
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

	<!-- -----------------------------------------  MODAL DESACTIVAR ITEM ----------------------------------------------  -->
	<div class="modal info" id="modalDesctivaritem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Desactivar Item</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					
					<div class="modal-body">
						<!-- contenido del modal -->
						<div class="col-12 text-center mb-3" id="loadItemsActivosGFT"></div>
						<div class="col-12 text-center mb-3" id="loadTipoGFT_"></div>
						
						<div class="modal-footer">
								<div class="col-12">
										<div class="row">
												<div class="col-12">
														<small class="">Haz click En un item de la lista para DESACTIVAR</small>
												</div>
												<div class="col-12 text-right">
														<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal" aria-label="Close">Cerrar</button>
												</div>
										</div>
								</div>
						</div>
				</div>
			</div>
		</div>
	</div>

	<!-- -----------------------------------------  MODAL NUEVA GLOSA----------------------------------------------  -->
	<div class="modal info" id="modalIngresarGlosa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Ingresar Glosa</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>

					<div class="modal-body">
						<!-- contenido del modal -->
						<div class="col-12 text-center">
							<div class="col" id="codigoNGLS"></div>
							<div class="col" id="grupoNGLS"></div>
							<div class="col" id="familiaNGLS"></div>
							<div class="col" id="tipoNGLS2"></div>
							<div class="col" id="tipoNGLS"></div>
						</div>
						<div class="modal-footer">
							<div class="col-12">
								<div class="row">
									<div class="col text-right">
										<button type="button" class="btn btn-sm btn-danger" onclick="selNewGlosaNGLS()">Ingresar</button>
									</div>
								</div>
							</div>
						</div>
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
									<p class="text-danger"><small>** Por defecto la cuenta creada quedara ACTIVADA **</small></p>
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
							<input type="button" id="mostrarBTN" class="btn btn-primary btn-sm" name="btn_add" value="Agregar">
						</form>
					</div>
			</div>
		</div>
	</div>

	<!-- -----------------------------------------  MODAL glosa inactivos----------------------------------------------  -->
	<div class="modal info" id="modalInactivos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Glosa Inactivos</h5>
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

	<!-- -----------------------------------------  MODAL glosa activos----------------------------------------------  -->
	<div class="modal info" id="modalActivos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Glosa Activos</h5>
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

	<!-- -----------------------------------------  MODAL NUEVO TIPO----------------------------------------------  -->
	<div class="modal fade" id="modalNuevoItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title lead" id="exampleModalLongTitle">Crear Nuevo Tipo</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<!-- contenido del modal -->	
						<!-- <form action="" method="get"> -->
							<small id="modalRespuesta"></small>			
							<div id="newGrupo"></div>
							<div id="newFamilia"></div>
							<div id="newTipo"></div>
							<!-- fin conttenido del modal -->
						</div>
						<div class="modal-footer">
							<input type="button" id="mostrarBTN" class="btn btn-primary btn-sm" name="btn_add" value="Agregar" onclick="sel_newTipo_()">

						<!-- </form> -->
					</div>
			</div>
		</div>
	</div>

	<!-- -----------------------------------------  Modal familia----------------------------------------------  -->
	<div class="modal fade" id="modalNewFalili" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title lead" id="exampleModalLongTitle">Crear Nueva Familia</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<!-- contenido del modal -->	
						<!-- <form action="./../controlador/addNewItem.php" method="POST" onsubmit="return sub_envio()"> -->
							<small id="modalRespuesta"></small>			
							<div id="grupoNweFam"></div>
							<div class="pt-2" id="familiNweFam"></div>
							<div class="pt-2" id="tipoNweFam"></div>
							<!-- fin conttenido del modal -->
						</div>
						<div class="modal-footer">
							<input type="submit" id="mostrarBTN" class="btn btn-primary btn-sm" name="btn_add" value="Agregar" onclick="sub_newFamili()">

						<!-- </form> -->
					</div>
			</div>
		</div>
	</div>
<input type="text" id="fechita" name="fechaAqui" class="form-control form-control-sm invisible">
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
	var mat_creado = 0;
	var tTipo_crew = 0;
	var sh_mat = 0;
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
	}
	
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
	}

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

	//modal Ingreso Codigo
	
	function ShowModalIngresaCodigo(txt, id) {
		$('#modalIngresaCodigo').modal('show')
		$('#iDnuevoCodigoNGLS').val(id)
		$('#nuevoCodigoNGLS').val("");

		txt1 = txt.indexOf("N/A")
		txt2 = txt.length;
		var res = txt.substr(0, (txt1-1));
		$('#textCodigo').html(res)
	} 

	function selAddCodigo() {
		var codigo = $('#nuevoCodigoNGLS').val();
		var idCodigo = $('#iDnuevoCodigoNGLS').val();
		if(codigo != ""){
			var optn = confirm("Estas seguro del codigo ingresado")
			if(optn){
				$.ajax({
				url: './../controlador/addCodigoNGLS.php',
				type: 'POST',
				dataType: 'html',
				data: { valor: codigo,
				valor2: idCodigo},
				})
				.done(function(respuesta){
					console.log(respuesta);
					$('#modalIngresaCodigo').modal('hide')
					//$("#fotoTipo").html(respuesta)
				})//fin done
				.fail(function(){
					console.log('error');
				});//fin fail
			}
		} else {
			swal("Ingresa el codigo!!")
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

		//aqui funcion cambia codigo pieza
	function selInactivo(){
		// $("#fotoTipo").html("");
		// $("#fotoTipo2").html("");
		document.getElementById('itemInactivo').selected = "true";//TRAE EL VALOR DESDE FOTO GRUPO
		var select = document.getElementById("itemInactivo");
		var index = select.selectedIndex; 
		var value = select.options[index].value;
		var text = select.options[index].text;
		var codigo = text.indexOf("Sin Codigo");
		if(codigo != -1){
			var conCode = confirm("La glosa no tiene codigo \nDesea Ingresarle un Codigo")
				if(conCode){
					$('#modalInactivos').modal('hide')
					ShowModalIngresaCodigo(text,value)
				}
		} else {
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


	

	//modal nuevo item--

	function sel_newTipo_() {
		var grupo = $("#grupoNew").val();
		var familia = $("#familiaNew").val();
		var material = $("#materialAddNewTipo").val();
		var material2 = $("#materialAddNewTipo2").val();
		var tipo = $("#newTipoTipo").val();
		var dT1 = $("#newTipoDT1").val();
		var dT2 = $("#newTipoDT2").val();
		var dT3 = $("#newTipoDT3").val();
		var dT4 = $("#newTipoDT4").val();
		var fecha = laFechita();

		if(tTipo_crew == 0){
			tipo = "N/A";
		}
		if(sh_mat == 0){
			material = "N/A";
			material2 = "N/A";
		}

		if(mat_creado != 1){
			if(grupo != "1" && familia != "1" && material != "1" && tipo != "" && dT1 != "" && dT2 != "" && dT3 != "" && dT4  != ""){
				var optn = confirm("Estas seguro de los datos ingresados");
				if(optn){
					$.ajax({
						url: './../controlador/addNewItem.php',
						type: 'POST',
						dataType: 'html',
						data: { valor0: grupo,
						valor1: familia,
						valor2: tipo,
						valor3: material,
						valor4: "N/A",
						valor5: dT1,
						valor6: dT2,
						valor7: dT3,
						valor8: dT4,
						valor9: fecha },
					}).done(function(respuesta){
						console.log(respuesta);
						//$("#dInactivo").html(respuesta)
						$('#modalNuevoItem').modal('hide')
					})//fin done
						.fail(function(){
						console.log('error');
					});swal("Ingesando datos");
				} else {
					swal("Verifica TODOS los datos")
				}
			} else {
				swal("Completa Todos los Campos")
			}
		} else if(mat_creado == 1){
			if(grupo != "1" && familia != "1" && material2 != "" && tipo != "" && dT1 != "" && dT2 != "" && dT3 != "" && dT4  != ""){
				var optn = confirm("Estas seguro de los datos ingresados");
				if(optn){
					$.ajax({
						url: './../controlador/addNewItem.php',
						type: 'POST',
						dataType: 'html',
						data: { valor0: grupo,
						valor1: familia,
						valor2: tipo,
						valor3: "N/A",
						valor4: material2,
						valor5: dT1,
						valor6: dT2,
						valor7: dT3,
						valor8: dT4,
						valor9: fecha },
					}).done(function(respuesta){
						console.log(respuesta);
						//$("#dInactivo").html(respuesta)
						$('#modalNuevoItem').modal('hide')
					})//fin done
						.fail(function(){
						console.log('error');
					});swal("Ingesando datos");
				} else {
					swal("Verifica TODOS los datos")
				}
			} else {
				swal("Completa Todos los Campos")
			}
		}

		
	}
	
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
	}
	
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

		// inputsIngreso = "<label><small>Tipo</small></label><input pype='text' class='form-control form-control-sm' placeholder='Ej:' name='newTipoTipo' id='newTipoTipo'>";
		// inputsIngreso += "<div id='mateEsconder'><small>Material</small></label><p id='materiales__here'> Cargando Materiales... .</p></div>";
		// inputsIngreso += "<div id='materialNoEsta'><small>Si el material no esta, haz click en el boton</small><a class='btn btn-sm btn-danger text-white' onclick='generarNewMaterial()'>Generar un nuevo Material</a></div>";

		if(value != "1"){
			inputsIngreso = "<div id='chaoBtnTipo'><small class='pr-5'>el item tiene un tipo?</small><a class='btn btn-sm btn-info text-white' onclick='showTipoAddNewItem()'> Genere un Tipo para el item </a></div>";
			inputsIngreso += "<div id='acaVaElTipo'></div>";
			inputsIngreso += "<div id='chaoBtnMaterial'><small class='pr-5'>el item tiene un material?</small><a class='btn btn-sm btn-info text-white' onclick='showANTmaterial()'> Genere un Material para el item </a></div>";
			inputsIngreso += "<div id='acaVaElMaterial'></div>";
			inputsIngreso += "<label><small>Dato tecnico 1</small></label><input type='text' class='form-control form-control-sm' placeholder='Ej: Medida ' name='newTipoDT1' id='newTipoDT1'>";
			inputsIngreso += "<label><small>Dato tecnico 2</small></label><input type='text' class='form-control form-control-sm' placeholder='Ej: Voltage' name='newTipoDT2' id='newTipoDT2'>";
			inputsIngreso += "<label><small>Dato tecnico 3</small></label><input type='text' class='form-control form-control-sm' placeholder='Ej: Color' name='newTipoDT3' id='newTipoDT3'>";
			inputsIngreso += "<label><small>Dato tecnico 4</small></label><input type='text' class='form-control form-control-sm' placeholder='Ej: Modelo' name='newTipoDT4' id='newTipoDT4'>";
			traetipoXtipo2()
			$("#newTipo").html(inputsIngreso);
		}
		
	}

	function generarNewMaterial() {
		mat_creado += 1;
		$("#mateEsconder").html("");
		newMat = "<label><small>Material</small></label><input type='text' class='form-control form-control-sm col-12' placeholder='Ej: Madera Carton Metal Vinilo ' name='materialAddNewTipo2' id='materialAddNewTipo2'>";
		$("#materialNoEsta").html(newMat);
	}

	function showANTmaterial() {
		sh_mat += 1;
		$("#chaoBtnMaterial").html("");
		traetipoXtipo2()
		nMat = "<div id='mateEsconder'><small>Material</small></label><p id='materiales__here'> Cargando Materiales... .</p></div>";
		nMat += "<div id='materialNoEsta'><small>Si el material no esta, haz click en el boton</small><a class='btn btn-sm btn-danger text-white' onclick='generarNewMaterial()'>Generar un nuevo Material</a></div>";
		$("#acaVaElMaterial").html(nMat);			
	}

	function showTipoAddNewItem() {
		tTipo_crew += 1;
		$("#chaoBtnTipo").html("");
		ttttipo = "<label><small>Tipo</small></label><input pype='text' class='form-control form-control-sm' placeholder='Ej:' name='newTipoTipo' id='newTipoTipo'>";		
		$("#acaVaElTipo").html(ttttipo);
	}

	function traetipoXtipo2() {
			$.ajax({
				url: './../controlador/traelosMateriales.php',
				type: 'POST',
				dataType: 'html',
			})
			.done(function(respuesta){
				// console.log('logrado');
				$("#materiales__here").html(respuesta)
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
		var fecha = $('#fechita').val();

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
					valor5: tipo,
					valor6: fecha},
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
		var conf = confirm("Esta seguro de los datos ingresados");
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


//modal nueva familia

	function showModNewFamili() {
		$("#familiNweFam").html("");
		if(true){
			$('#modalNewFalili').modal('show')
			lGNewFam()
		}
	}

	function sub_newFamili() {
		var grupo = $('#newFamGrupo').val();
		var fam = $('#newFamFam').val();

		if(grupo != "1" && fam != "" ){
			optn = confirm("Estas seguro de los datos ingresados")
			if(optn){
				$.ajax({
				url: './../controlador/addNewFamilia.php',
				type: 'POST',
				dataType: 'html',
				data: { valor1: grupo,
					valor2: fam },
				})
				.done(function(respuesta){
					console.log(respuesta);
					//$("#acaLosDatosDelUsuario").html(respuesta)
					$('#modalNewFalili').modal('hide')
					swal("datos enviados")
				})//fin done
				.fail(function(){
					console.log('error');
				});
			} else {
				swal("datos NO enviados verificalos.")
			}
		} else {
			swal("Completa todos los datos.")
		}
	}

	function lGNewFam(){
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
    var txt = "<select class='form-control form-control-sm my-2' name='newFamGrupo' id='newFamGrupo' onclick='selNewGrupDes()'><option value='1' onclick='selNewGrupDes()'>Selecciona Grupo de items</option>";
    grupo.forEach(function(element) {
        txt += "<option value='"+element+"' onclick='selNewGrupDes()'>"+element+"</option>";
    });
		txt += "</select>";
		
		$("#grupoNweFam").html(txt);
		
	}

	function selNewGrupDes() {
		var grupo = $('#newFamGrupo').val();
		if(grupo != "1"){
			var nFam = "<label>Nombre para la Nueva Familia</label><input type='text' id='newFamFam' class='form-control form-control-sm' >";
		$("#familiNweFam").html(nFam);
		} else {
			$("#familiNweFam").html("");
		}
	}

//funcion que se encarga de generar la fecha y hora del momento en l cual se guarda un dato en la base de datos
	function laFechita() {
		var hoy = new Date();
		var dd = hoy.getDate();
		var mm = hoy.getMonth()+1;
		var yyyy = hoy.getFullYear();
		var hh = hoy.getHours();
		var mi = hoy.getMinutes();
		var ss = hoy.getSeconds();
		dd=addZero(dd);
		mm=addZero(mm);
		hh=addZero(hh);
		ss=addZero(ss);

		function addZero(i) {
				if (i < 10) {
						i = '0' + i;
				}
				return i;
		}
		var fecha = dd+"-"+mm+"-"+yyyy+" "+hh+":"+mi+":"+ss;
		$('#fecha').html(fecha)
		$('#fechita').val(fecha)
		return fecha;
		setTimeout("laFechita()",1000);
	}
	laFechita()

	//modal nueva glosa

	function showNewGlosa() {
		$("#familiaNGLS").html("");
		$("#tipoNGLS").html("");
		$("#tipoNGLS2").html("");
		$("#codigoNGLS").html("");
		if(true){
			$('#modalIngresarGlosa').modal('show')
			loadGruposNGS()
		}
	}

	function loadGruposNGS(){
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
    var txt = "<select class='form-control form-control-sm my-2' name='grupoNGLS_sel' id='grupoNGLS_sel' onclick='selGrupoNGLS()'><option value='1' onclick='selGrupoNGLS()'>Selecciona Grupo de items</option>";
    grupo.forEach(function(element) {
        txt += "<option value='"+element+"' onclick='selGrupoNGLS()'>"+element+"</option>";
    });
    txt += "</select>";
    $("#grupoNGLS").html(txt);
	}

	function selGrupoNGLS() {
		$('#codigoNGLS').html("");
		$("#tipoNGLS").html("");
		$("#tipoNGLS2").html("");
		var grupo =	$('#grupoNGLS_sel').val();
		if(grupo != "1"){
			$.ajax({
			url: './../controlador/traerFamiliasNGLS.php',
			type: 'POST',
			dataType: 'html',
			data: { valor: grupo },
			}).done(function(respuesta){
				// console.log('logrado');
				//$("#loading").html(respuesta)
				$('#familiaNGLS').html(respuesta)
			})//fin done
			.fail(function(){
				console.log('error');
			});
		}
	}

	function selFamiliaNGLS() {
		$('#tipoNGLS2').html("");
		var familia =	$('#familiaNGLS_sel').val();
	
		if(familia != "1"){
			$.ajax({
			url: './../controlador/traeInputsNGLS.php',
			type: 'POST',
			dataType: 'html',
			data: { valor: familia },
			}).done(function(respuesta){
				// console.log('logrado');
				//$("#loading").html(respuesta)
				$('#tipoNGLS').html(respuesta)
				var codigo = "<div class='input-group input-group-sm mb-2'><span class='input-group-addon' id='sizing-addon2'>CODIGO</span><input name='codigoNGLS_' id='codigoNGLS_' type='text' class='form-control' placeholder='Si no lo tiene deje este campo en blanco' aria-describedby='sizing-addon2'><br></div>";
				$('#codigoNGLS').html(codigo);
			})//fin done
			.fail(function(){
				console.log('error');
			});

		}
	}
	 
	function traeTipoNGLS() {
		var tipo = $('#acaSaleElTipo').val();
		
		$.ajax({
			url: './../controlador/traeTipo.php',
			type: 'POST',
			dataType: 'html',
			data: { valor: tipo },
			}).done(function(respuesta){
				// console.log('logrado');
				//$("#loading").html(respuesta)
				$('#tipoNGLS2').html(respuesta)
			})//fin done
			.fail(function(){
				console.log('error');
			});

	}

	function selNewGlosaNGLS() {
		
		if($('#grupoNGLS_sel').val().trim() != "1" && $('#familiaNGLS_sel').val().trim() != "1"){

			if($('#tipoSelMod').val() && $('#material').val()){
				var codigo = $('#codigoNGLS_').val();
				var grupo = $('#grupoNGLS_sel').val();
				var familia = $('#familiaNGLS_sel').val();
				var tipo = $('#tipoSelMod').val();
				var material = $('#material').val();
				var dato_8 = $('#dato_8').val();

				var dato_4 = "N/A";
				var dato_5 = "N/A";
				var dato_6 = "N/A";
				var dato_7 = "N/A";

				if($('#dato_4').val() && $('#dato_4').val().trim() != ""){
					dato_4 = $('#dato_4').val();
				}
				if($('#dato_5').val() && $('#dato_5').val().trim() != ""){
					dato_5 = $('#dato_5').val();				
				}
				if($('#dato_6').val() && $('#dato_6').val().trim() != ""){
					dato_6 = $('#dato_6').val();
				}
				if($('#dato_7').val() && $('#dato_7').val().trim() != ""){
					dato_7 = $('#dato_7').val();				
				}
				var optn = confirm("Estas seguro de los DATOS ingresados");
				if(optn){
					$.ajax({
					url: './../controlador/addNewGlosaNGLS.php',
					type: 'POST',
					dataType: 'html',
					data: { valor0: codigo,
					valor1: grupo,
					valor2: familia,
					valor3: laFechita(),
					valor4: dato_8,
					valor5: tipo,
					valor6: material,
					valor7: dato_4,
					valor8: dato_5,
					valor9: dato_6,
					valor10: dato_7,
					},
					}).done(function(respuesta){
						console.log(respuesta);
						//$('#familiaNGLS').html(respuesta)
					})//fin done
					.fail(function(){
						console.log('error');
					});
					$('#modalIngresarGlosa').modal('hide')
					swal("datos enviados para ser APROBADOS")
				}else{
					swal("Revisa los DATOS!!")
				}
				//swal(codigo+"//"+grupo+"//"+familia+"//"+tipo+"//"+material+"//"+dato_4+"//"+dato_5+"//"+dato_6+"//"+dato_7+"//"+dato_8+"//1");
			} else if($('#tipoSelMod').val()){
				var codigo = $('#codigoNGLS_').val();
				var grupo = $('#grupoNGLS_sel').val();
				var familia = $('#familiaNGLS_sel').val();
				var tipo = $('#tipoSelMod').val();
				var dato_8 = $('#dato_8').val();

				var dato_3 = "N/A";
				var dato_4 = "N/A";
				var dato_5 = "N/A";
				var dato_6 = "N/A";
				var dato_7 = "N/A";

				if($('#dato_3').val() && $('#dato_3').val().trim() != ""){
					dato_3 = $('#dato_3').val();
				}
				if($('#dato_4').val() && $('#dato_4').val().trim() != ""){
					dato_4 = $('#dato_4').val();
				}
				if($('#dato_5').val() && $('#dato_5').val().trim() != ""){
					dato_5 = $('#dato_5').val();				
				}
				if($('#dato_6').val() && $('#dato_6').val().trim() != ""){
					dato_6 = $('#dato_6').val();
				}
				if($('#dato_7').val() && $('#dato_7').val().trim() != ""){
					dato_7 = $('#dato_7').val();				
				}
				var optn = confirm("Estas seguro de los DATOS ingresados");
				if(optn){
					$.ajax({
					url: './../controlador/addNewGlosaNGLS.php',
					type: 'POST',
					dataType: 'html',
					data: { valor0: codigo,
					valor1: grupo,
					valor2: familia,
					valor3: laFechita(),
					valor4: dato_8,
					valor5: tipo,
					valor6: dato_3,
					valor7: dato_4,
					valor8: dato_5,
					valor9: dato_6,
					valor10: dato_7,},
					}).done(function(respuesta){
						console.log(respuesta);
						//$('#familiaNGLS').html(respuesta)
					})//fin done
					.fail(function(){
						console.log('error');
					});
					$('#modalIngresarGlosa').modal('hide')
					swal("datos enviados para ser APROBADOS")
				}else{
					swal("Revisa los DATOS!!")
				}
				//swal(codigo+"//"+grupo+"//"+familia+"//"+tipo+"//"+dato_3+"//"+dato_4+"//"+dato_5+"//"+dato_6+"//"+dato_7+"//"+dato_8+"//2");
			} else if($('#material').val()){
				var codigo = $('#codigoNGLS_').val();
				var grupo = $('#grupoNGLS_sel').val();
				var familia = $('#familiaNGLS_sel').val();
				var material = $('#material').val();
				var dato_8 = $('#dato_8').val();

				var dato_2 = "N/A";
				var dato_4 = "N/A";
				var dato_5 = "N/A";
				var dato_6 = "N/A";
				var dato_7 = "N/A";

				if($('#dato_2').val() && $('#dato_2').val().trim() != ""){
					dato_2 = $('#dato_2').val();
				}
				if($('#dato_4').val() && $('#dato_4').val().trim() != ""){
					dato_4 = $('#dato_4').val();
				}
				if($('#dato_5').val() && $('#dato_5').val().trim() != ""){
					dato_5 = $('#dato_5').val();				
				}
				if($('#dato_6').val() && $('#dato_6').val().trim() != ""){
					dato_6 = $('#dato_6').val();
				}
				if($('#dato_7').val() && $('#dato_7').val().trim() != ""){
					dato_7 = $('#dato_7').val();				
				}
				var optn = confirm("Estas seguro de los DATOS ingresados");
				if(optn){
					$.ajax({
					url: './../controlador/addNewGlosaNGLS.php',
					type: 'POST',
					dataType: 'html',
					data: { valor0: codigo,
					valor1: grupo,
					valor2: familia,
					valor3: laFechita(),
					valor4: dato_8,
					valor5: material,
					valor6: dato_2,
					valor7: dato_4,
					valor8: dato_5,
					valor9: dato_6,
					valor10: dato_7,},
					}).done(function(respuesta){
						console.log(respuesta);
						//$('#familiaNGLS').html(respuesta)
					})//fin done
					.fail(function(){
						console.log('error');
					});
					$('#modalIngresarGlosa').modal('hide')
					swal("datos enviados para ser APROBADOS")
				}else{
					swal("Revisa los DATOS!!")
				}
				//swal(codigo+"//"+grupo+"//"+familia+"//"+material+"//"+dato_2+"//"+dato_4+"//"+dato_5+"//"+dato_6+"//"+dato_7+"//"+dato_8+"//3");
			} else {
				var codigo = $('#codigoNGLS_').val();
				var grupo = $('#grupoNGLS_sel').val();
				var familia = $('#familiaNGLS_sel').val();
				var dato_8 = $('#dato_8').val();

				var dato_2 = "N/A";
				var dato_3 = "N/A";
				var dato_4 = "N/A";
				var dato_5 = "N/A";
				var dato_6 = "N/A";
				var dato_7 = "N/A";

				if($('#dato_2').val() && $('#dato_2').val().trim() != ""){
					dato_2 = $('#dato_2').val();
				}
				if($('#dato_3').val() && $('#dato_3').val().trim() != ""){
					dato_3 = $('#dato_3').val();
				}
				if($('#dato_4').val() && $('#dato_4').val().trim() != ""){
					dato_4 = $('#dato_4').val();
				}
				if($('#dato_5').val() && $('#dato_5').val().trim() != ""){
					dato_5 = $('#dato_5').val();				
				}
				if($('#dato_6').val() && $('#dato_6').val().trim() != ""){
					dato_6 = $('#dato_6').val();
				}
				if($('#dato_7').val() && $('#dato_7').val().trim() != ""){
					dato_7 = $('#dato_7').val();				
				}
				var optn = confirm("Estas seguro de los DATOS ingresados");
				if(optn){
					$.ajax({
					url: './../controlador/addNewGlosaNGLS.php',
					type: 'POST',
					dataType: 'html',
					data: { valor0: codigo,
					valor1: grupo,
					valor2: familia,
					valor3: laFechita(),
					valor4: dato_8,
					valor5: dato_2,
					valor6: dato_3,
					valor7: dato_4,
					valor8: dato_5,
					valor9: dato_6,
					valor10: dato_7,},
					}).done(function(respuesta){
						console.log(respuesta);
						//$("#loading").html(respuesta)
						//$('#familiaNGLS').html(respuesta)
					})//fin done
					.fail(function(){
						console.log('error');
					});
					$('#modalIngresarGlosa').modal('hide')
					swal("datos enviados para ser APROBADOS")
				}else{
					swal("Revisa los DATOS!!")
				}
				//swal(codigo+"//"+grupo+"//"+familia+"//"+dato_2+"//"+dato_3+"//"+dato_4+"//"+dato_5+"//"+dato_6+"//"+dato_7+"//"+dato_8);
			}
		} else {
			swal("Seleccione y Complete todos los DATOS!!")
		}			
		// var optn = confirm("Estas seguro de los datos ingresados");
		// if(optn){
		// 	swal("enviando datos .. . ."+laFechita())
		// 	$('#modalIngresarGlosa').modal('hide')
		// } else {
		// 	swal("Verifica los datos antes de ENVIARLOS")
		// }
	}


//modal activar item en espera

function showModalActivarItemEnEspera() {
	$('#activarItemES').html("Cargando ..")
	if(true){
		$('#modalActivaritemEnEspera').modal('show')
		loadItemsEnEsperaES()
	}
}

function loadItemsEnEsperaES() {
	$.ajax({
		url: './../controlador/loadItemEspera.php',
		type: 'POST',
		dataType: 'html',
		}).done(function(respuesta){
			//console.log('lograd0');
			//$("#loading").html(respuesta)
			$('#activarItemES').html(respuesta)
		})//fin done
		.fail(function(){
			console.log('error');
		});
}

function sel_ItemEspera() {
	alert("item en espera")
}


//modal desactiva item 
function showModalDesactivarItem() {
	$('#loadItemsActivosGFT').html("")
	$('#loadTipoGFT_').html("")
	if(true){
		$('#modalDesctivaritem').modal('show')
		familiDGFT() 
	}
}

function familiDGFT() {
	if(true){
		$.ajax({
		url: './../controlador/cargaItemsAGFT.php',
		type: 'POST',
		dataType: 'html',
		}).done(function(respuesta){
			//console.log('lograd0');
			$('#loadItemsActivosGFT').html(respuesta)
		})//fin done
		.fail(function(){
			console.log('error');
		});
	}
}

function sel_itemAGFT() {
	var item = $('#_item_AGFT').val()
	if(item != "1"){
		$.ajax({
		url: './../controlador/traeTipoAGFT.php',
		type: 'POST',
		dataType: 'html',
		data: {valor: item},
		}).done(function(respuesta){
			//console.log(respuesta);
			$('#loadTipoGFT_').html(respuesta)
		})//fin done
		.fail(function(){
			console.log('error');
		});
	}
}

function desctivarTipoGFT() {
	var item2 = $('#datoItemGFT_').val()
	alert("click " + item2)
	$.ajax({
		url: './../controlador/null.php',
		type: 'POST',
		dataType: 'html',
		data: { valor: item2 },
		}).done(function(respuesta){
			//console.log(respuesta);
			$('#loadTipoGFT_').html(respuesta)
		})//fin done
		.fail(function(){
			console.log('error');
		});
}




//modal activar item
function showModalActivarItem() {	
	if(true){
		$('#modalActivaritem').modal('show')
		loadItemsActivosAGFT()
	}
}

function loadItemsActivosAGFT() {
	$.ajax({
		url: './../controlador/cargaItemsDGFT.php',
		type: 'POST',
		dataType: 'html',
		}).done(function(respuesta){
			//console.log('lograd0');
			$('#loadItemsInactivosGFT').html(respuesta)
		})//fin done
		.fail(function(){
			console.log('error');
		});
}

function sel_itemIGFT() {
	var item = $('#_item_AGFT').val()
	if(item != "1"){
		console.log("item inactivo "+item)
		$.ajax({
		url: './../controlador/traeTipoDGFT.php',
		type: 'POST',
		dataType: 'html',
		data:{ valor1: item },
		}).done(function(respuesta){
			//console.log(respuesta);
			$('#loadTipoIGFT_').html(respuesta)
		})//fin done
		.fail(function(){
			console.log('error');
		});
	}
}

function activarItemGFT() {
	console.log("items desactivados	;")
}




</script>

