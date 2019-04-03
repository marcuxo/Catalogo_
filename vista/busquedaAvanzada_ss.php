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
	<link rel="stylesheet" type="text/css" href="./CSS/bootstrap-4.css">
	<link rel="stylesheet" href="CSS/estilos.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	
</head>
<body onload="loadGrupos2()">

<header>
		<div class="container-fluid bg-primary">
			<div class="row align-items-center">
				<div class="col-4">
				<div class="col-6"><img src="img_/logo.png" height="75px"></div>
				</div>
				<div class="col-8 text-right py-2">
					<!-- Muestra en nombre de la session -->
					<?php echo '<label class="text-info font-italic mr-3">Bienvenido '.$_SESSION["usuario"].'</label>'; ?>

					<a href="Mantenedor_Datos_ss.php" class="btn btn-sm btn-success"><i class="fas fa-pen"></i> Mantenedor Datos</a>
					<a href="editarItemExistente_ss.php" class="btn btn-sm btn-info text-white"><i class="far fa-edit"></i> Editar Items Antiguo</a>
					<a href="" class="btn btn-sm btn-info text-white disabled"><i class="fas fa-search"></i> Busqueda</a>
					<button onclick="CerrarCession()" class="btn btn-sm btn-danger"><i class="fas fa-sign-out-alt"></i> Salir</button>
	
				</div>
				<div class="col bg-info p-1"></div>
			</div>
		</div>
	</header>

<form action="" method="GET" onsubmit="return sub_envio2()">
<div class="container-fluid">
	<div class="row align-items-center">
		<div class="col-3">
			<img src="img_/logo_mante.png" alt="" class="w-100">
		</div>
		<div class="col-4">
			<div id="grupos2" class="col-14"></div>
			<div id="familias2" class="col-14"></div>
			<div id="tipoPagUno"></div>
			<div id="tipo"></div>
		</div>
			<div class="col-4" id="lado">
				<div class="row d-flex justify-content-center" id="loading" style="height: 220px"></div>
			</div>
			<div class="col-1">
				<button type="submit"	class="btn btn-sm btn-info">Buscar!!</button>
			</div>
		</div>
	</div>
</form>


<div class="container-fluid">
	<div class="row fondo pb-2">
			<div id="resultado" class="col-12"><p class="py-5"></p></div>
			<div class="col-12 pt-3 text-center">
				<!-- <div id="resultadoBusImg" class="text-center"></div> -->
			</div>
	</div>
</div>
<div class="container-fluid mt-2">
	<div class="row">
		<div id="copyONclick" class="col-12  bg-success text-center invisible">
		<a class="lead text-white pl-2 copyClick" id="resultadoBusImg" onclick="copiarAlPortapapeles('resultadoBusImg')" data-toggle="tooltip" title="Haz Click para COPIAR"></a>

		</div>
	</div>
</div>

	
	<footer>
			<div class="container mt-5 ">
				<div class="row">
					<div class="col text-center rounded-top bg-info">
						<small class="">Para Mantencion Ariztia por <label><a href="#marcourrutia" class="font-italic text-gray-dark">Marco Urrutia</a></label></small>
					</div>
				</div>
			</div>
		</footer>

 	<script type="text/javascript" src="./JS/jquery.js"></script>
 	<script type="text/javascript" src="./JS/tether.1.4.js"></script>
 	<script type="text/javascript" src="./JS/bootstrap.4.alfa.js"></script>
 	<script type="text/javascript" src="./JS/javascript.js"></script>
	<script type="text/javascript" src="./JS/sweetAlert.js"></script>
</body>
</html>

<style>

/* a:active { 
	font-size: 50px;
	color: lime !important; 
	animation: 3s;
} */

</style>
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


		// --------------Funcion que copia texto con un click------------------------
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

		// --------------formulario pagina------------------------
	function loadGrupos2(){
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
				var txt = "<select class='form-control form-control-sm my-2' name='grupo' id='grupo2' onclick='selGrupo2()'><option value='1' onclick='selGrupo2()'>Selecciona Grupo de items</option>";
				grupo.forEach(function(element) {
						txt += "<option value='"+element+"' onclick='selGrupo2()'>"+element+"</option>";
				});
				txt += "</select>";
				$("#grupos2").html(txt);
		};

	function selGrupo2() {
		//alert("diste click");
		 $("#familias2").html("");
		 $("#tipo").html("");
		 $("#tipoPagUno").html("");
		 $("#loading").html("");
		document.getElementById('grupo2').selected = "true";
        var select = document.getElementById("grupo2");
        var index = select.selectedIndex; 
        var value = select.options[index].value;
		var text = select.options[index].text;
		if(value != "1"){
				$.ajax({
				url: './../controlador/TraerFamilias3.php',
				type: 'POST',
						dataType: 'html',
						data: { valor: value }
			}).done(function(respuesta){
				// console.log('logrado');
				$("#familias2").html(respuesta)
			})//fin done
			.fail(function(){
				console.log('error');
			});
		}//fin if
	};

	function selFamilia2(){
		//$("#materiales").html("");
		$("#loading").html("");
		document.getElementById('familiaSelPag').selected = "true";
        var select = document.getElementById("familiaSelPag");
        var index = select.selectedIndex; 
        var value = select.options[index].value;
		var text = select.options[index].text;
		if(value != "1"){
			$.ajax({
				url: './../controlador/TraeInputs3.php',
				type: 'POST',
				dataType: 'html',
				data: { valor: value},
			})
			.done(function(respuesta){
				//console.log('logrado');
				$("#tipo").html(respuesta)
			})//fin done
			.fail(function(){
				console.log('error');
			});//fin fail
		}//fin if
	}

	function traeMaterial(){
		$("#loading").html("");
		var tipo = $('#acaSaleElTipo').val();
		$.ajax({
			url: './../controlador/consultaMateriales.php',
			type: 'POST',
			dataType: 'html',
			data: { valor: tipo},
		})
		.done(function(respuesta){
			// console.log('logrado');
			$("#tipoPagUno").html(respuesta)
		})//fin done
		.fail(function(){
			console.log('error');
		});
	}

	function sub_envio2() {
		var grupo = $('#grupo2').val();
		var familia = $('#familiaSelPag').val();
		var tipo = $('#tipoSelMod').val();
	
		if(grupo != "1" && familia != "1"){
			$.ajax({
				url: './../controlador/busqueda2.php',
				type: 'post',
				dataType: 'html',
				data: { valor1: grupo,
				valor2: familia,
				valor3: tipo},
			})
			.done(function(respuesta){
				// console.log('logrado');
				$("#resultado").html(respuesta)
				$("#resultadoBusImg").html("")
				loadImagenXtipo()
			})//fin done
			.fail(function(){
				console.log('error');
			});
			return false;
		} else {
			return false;
		}
 	}

	function showwwwImagen() {
		document.getElementById('buscaUserImg').selected = "true";
		var select = document.getElementById("buscaUserImg");
		var index = select.selectedIndex; 
		var value = select.options[index].value;
		var text = select.options[index].text;
		var nuevoTexto = text.replace("*", " ")
		//var elTextO = text.indexOf("/");
		var txt2 = text.split("*")
		var inp ="";
		for (var i=0; i < txt2.length; i++) {
			inp+=(txt2[i] + "  ");
		}
		//console.log(inp)
		$('#copyONclick').removeClass('invisible')
		$("#resultadoBusImg").html(inp)
			
	}

	function loadImagenXtipo() {
		var familia = $('#familiaSelPag').val();
		var tipo = $('#tipoSelMod').val();

		$.ajax({
		url: './../controlador/cargaImagen2.php',
		type: 'POST',
		dataType: 'html',
		data: { valor: familia , valor2: tipo},
		}).done(function(respuesta){
			// console.log('logrado');
			$("#loading").html(respuesta)
		})//fin done
		.fail(function(){
			console.log('error');
		});
	}

</script>