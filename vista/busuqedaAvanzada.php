
<!DOCTYPE html>
<html>
<head >
	<title>Catalogo Ariztia</title>
	<link rel="stylesheet" type="text/css" href="./CSS/bootstrap-4.css">
	<link rel="stylesheet" href="CSS/estilos.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	
</head>
<body onload="loadGrupos2()">

<div class="container">
	<div class="row">
		<div class="col">
			<h1 class="display-4"></h1>
		</div>
	</div>
</div>

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
			<div class="col-12">
				<div id="resultadoBusImg">cadena de texto</div>
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
		$("#resultadoBusImg").html(inp)
			
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