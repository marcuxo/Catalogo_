
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

					<a href="index.php" class="btn btn-sm btn-info text-white"><i class="fas fa-home"></i> Inicio</a>
					<a href="" class="btn btn-sm btn-info text-white disabled"><i class="fas fa-search"></i> Busqueda Avanzada</a>
	
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
			<div id="tipo"></div>
			<div id="tipoPagUno"></div>
		</div>
			<div class="col-4" id="lado">
				<div class="row d-flex justify-content-center" id="loading"></div>
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
		// document.getElementById('familiaXfoto').selected = "true";
		// var selectF = document.getElementById("familiaXfoto");
		// var indexF = selectF.selectedIndex;
		// var textF = selectF.options[indexF].text;

		// document.getElementById('tipoXtipo').selected = "true";
		// var selectT = document.getElementById("tipoXtipo");
		// var indexT = selectT.selectedIndex;
		// var textT = selectT.options[indexT].text;
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