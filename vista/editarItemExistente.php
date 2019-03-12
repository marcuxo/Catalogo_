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
	<link rel="stylesheet" type="text/css" href="./CSS/bootstrap-4.css">
	<link rel="stylesheet" href="CSS/estilos.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	
</head>
<body onload="loadGrupos2()">

<header>
	<div class="container-fluid bg-primary">
		<div class="row align-items-center">
			<div class="col-6">
				<h1 class="text-info font-italic"></h1>
			</div>
			<div class="col-6 text-right py-2">
				
				<a href="Mantenedor_Datos.php" class="btn btn-sm btn-success">Mantenedor Datos</a>

				<a href="buscadorDeItems.php" class="btn btn-sm btn-info text-white"><i class="fas fa-search"></i> Buscar</a>
				<a href="editarItemExistente.php" class="btn btn-sm btn-info text-white disabled"><i class="fas fa-search"></i> Editar Items Antiguo</a>

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
		</div>
			<div class="col-4" id="lado">
				<div id="tipo"></div>
				<div id="tipoPagUno"></div>
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
	</div>
</div>

<!-- -----------------------------------------  modal----------------------------------------------  -->
<div class="modal fade" id="modalBusqueda" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title lead" id="exampleModalLongTitle">Editar Datos</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<!-- contenido del modal -->	
						<form action="../controlador/addItemFormal.php" method="post" onsubmit="return sub_envio()">
							<small id="modalRespuesta"></small>		
							<div id="esconder" class=""><a class="btn btn-sm btn-info col-12" onclick="loadGrupos();esconde()">EDITAR LOS DATOS</a></div>						
							<div id="grupos"></div>

							<div id="familias"></div>
							
							<div id="materiales"></div>
							<div id="tipoPag"></div>
							<!-- fin conttenido del modal -->
						</div>
						<div class="modal-footer">
							<input id="esconder2" type="submit" class=" btn btn-secondary btn-sm " name="btn_dc" value="Datos Correctos">
							<input type="submit" id="mostrarBTN" class="btn btn-primary btn-sm invisible" name="btn_add" value="Agregar">
						</form>
					</div>
			</div>
		</div>
	</div>

	
	<footer>
			<div class="container mt-5 fixed-bottom">
				<div class="row">
					<div class="col text-center rounded-top">
						<small class="text-primary">Para Mantencion Ariztia por <label><a href="#marcourrutia" class="">Marco Urrutia</a></label></small>
					</div>
				</div>
			</div>
		</footer>

 	<script type="text/javascript" src="./JS/jquery.js"></script>
 	<script type="text/javascript" src="./JS/tether.1.4.js"></script>
 	<script type="text/javascript" src="./JS/bootstrap.4.alfa.js"></script>
	<script type="text/javascript" src="./JS/sweetAlert.js"></script>
</body>
</html>
<script>





// modal---------
	function selGrupo() {
		//alert("diste click");
		$("#familias").html("");
		$("#tipoPag").html("");
		$("#materiales").html("");
		document.getElementById('grupo').selected = "true";
        var select = document.getElementById("grupo");
        var index = select.selectedIndex; 
        var value = select.options[index].value;
		var text = select.options[index].text;
		if(value != "1"){
				$.ajax({
				url: './../controlador/TraerFamilias2.php',
				type: 'POST',
						dataType: 'html',
						data: { valor: value }
			}).done(function(respuesta){
				// console.log('logrado');
				$("#familias").html(respuesta)
			})//fin done
			.fail(function(){
				console.log('error');
			});
		}//fin if
	};

	function loadGrupos(){
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
        var txt = "<select class='form-control form-control-sm my-2' name='grupo' id='grupo' onclick='selGrupo()'><option value='1' onclick='selGrupo()'>Selecciona Grupo de items</option>";
        grupo.forEach(function(element) {
            txt += "<option value='"+element+"' onclick='selGrupo()'>"+element+"</option>";
        });
        txt += "</select>";
        $("#grupos").html(txt);
	};

	function selFamilia(){
		$("#tipoPag").html("");
		$("#materiales").html("");
		document.getElementById('familia').selected = "true";
        var select = document.getElementById("familia");
        var index = select.selectedIndex; 
        var value = select.options[index].value;
		var text = select.options[index].text;
		if(value != "1"){
			$.ajax({
				url: './../controlador/TraeInputs2.php',
				type: 'POST',
				dataType: 'html',
				data: { valor: value},
			})
			.done(function(respuesta){
				//console.log('logrado');
				$("#tipoPag").html(respuesta)
			})//fin done
			.fail(function(){
				console.log('error');
			});//fin fail
		}//fin if
	}

	function traeMaterialMOD(){
		var tipo = $('#acaSaleElTipoMod').val();
		$.ajax({
			url: './../controlador/consultaMateriales2.php',
			type: 'POST',
			dataType: 'html',
			data: { valor: tipo},
		})
		.done(function(respuesta){
			// console.log('logrado');
			$("#materiales").html(respuesta)
		})//fin done
		.fail(function(){
			console.log('error');
		});
	}

	function sub_envio() {
			var dato = confirm("Estas seguro de los datos");
			if(dato){
					return true;
			} else {
					return false;
			}
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
		// $("#familias2").html("");
		// $("#tipo22").html("");
		// $("#materiales2").html("");
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
		//var dato = confirm("Estas seguro de los datos");
		if(true){
			$.ajax({
				url: './../controlador/busqueda1.php',
				type: 'post',
				dataType: 'html',
				data: { valor1: grupo,
				valor2: familia,
				valor3: tipo},
			})
			.done(function(respuesta){
				// console.log('logrado');
				$("#resultado").html(respuesta)
			})//fin done
			.fail(function(){
				console.log('error');
			});
			return false;
		} else {
			return false;
		}
  }



		// muestra el modal

	function modalShow() {
		$("#grupos").html("");
		$("#familias").html("");
		$("#materiales").html("");
		$("#tipoPag").html("");
		document.getElementById('editorB').selected = "true";
		var select = document.getElementById("editorB");
		var index = select.selectedIndex; 
		var value = select.options[index].value;
		var text = select.options[index].text;

		var txt = text.split("-")
		var txt2 = text.split("*")
		var inp ="";
		for (var i=0; i < txt2.length; i++) {
			//inp+=(txt2[i] + "  ");
			inp+=`
				<input type="text" class="form-control form-control-sm my-1" value="`+txt2[i] +`" name="`+i+`" readonly>
			`;
	  }
	 
		if(true){
			$('#modalBusqueda').modal('show')
			$("#modalRespuesta").html(inp)
			//loadGrupos()
		}
	}

	function esconde() {
		var element = document.getElementById("esconder");
		element.classList.add("invisible");
		var element2 = document.getElementById("esconder2");
		element2.classList.add("invisible");
		var element = document.getElementById("mostrarBTN");
		element.classList.remove("invisible");
	}

	function muestra() {
		var element = document.getElementById("esconder");
		element.classList.remove("invisible");
		var element2 = document.getElementById("esconder2");
		 element2.classList.remove("invisible");
		 var element2 = document.getElementById("mostrarBTN");
		element2.classList.add("invisible");
	}

	function reiniciaMod() {
		
	}

</script>
<!--
0=RODAMIENTOS+Y+SELLOS
1=RODAMIENTO
2=CONTRATO+MEYN
3=CM+RODAMIENTO+6002+2RS+S.S.+89.0689.017.0003
btn_dc=ok

grupo=RODAMIENTOS+Y+SELLOS
familia=RODAMIENTO
tipo=seleccionar
material=ACERO
dato_3=dato_3
dato_4=dato_3
dato_5=dato_4
dato_6=dato_5
dato_7=dato_6
dato_8=dato_opcional
btn_add=ok

 -->