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
			<div class="col-4">
			<div class="col-6"><img src="img_/logo.png" height="75px"></div>
			</div>
			<div class="col-8 text-right py-2">
					<!-- Muestra en nombre de la session -->
					<?php echo '<label class="text-info font-italic mr-3">Bienvenido '.$_SESSION["usuario"].'</label>'; ?>
				
				<a href="Mantenedor_Datos_ss.php" class="btn btn-sm btn-success"><i class="fas fa-pen"></i> Mantenedor Datos</a>

				<a href="busquedaAvanzada_ss.php" class="btn btn-sm btn-info text-white"><i class="fas fa-search"></i> Buscar</a>
				<a href="editarItemExistente_ss.php" class="btn btn-sm btn-info text-white disabled"><i class="far fa-edit"></i> Editar Items Antiguo</a>

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
						<!-- <form action="../controlador/addItemFormal.php" method="post" onsubmit="return sub_envio()"> -->
							<small id="modalRespuesta"></small>		
							<div id="esconder" class=""><a class="btn btn-sm btn-info col-12" onclick="loadGrupos();esconde()">EDITAR LOS DATOS</a></div>						
							<div id="grupos"></div>

							<div id="familias"></div>
							
							<div id="materiales"></div>
							<div id="tipoPag"></div>
							<!-- fin conttenido del modal -->
						</div>
						<div class="modal-footer">
							<!-- contenedor de fecha y hora actual para generar un dato de ingreso con fecha actual de guardado en base de datos -->
							<input type="text" name="horaActual" id="fechita"  class="form-control form-control-sm col-2 text-center invisible">
							<input id="mostrarBTN" class="btn btn-primary btn-sm invisible" name="btn_add" value="Agregar" onclick="selFormADD()">
						<!-- </form> -->
					</div>
			</div>
		</div>
	</div>

	
	<footer>
			<div class="container mt-5 fixed-bottom bg-info rounded-top">
				<div class="row">
					<div class="col text-center rounded-top">
						<small class="">Para Mantencion Ariztia por <label><a href="#marcourrutia" class="font-italic text-gray-dark">Marco Urrutia</a></label></small>
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

	function selFormADD() {
		//$('input:text[name=nombre]').val()
		var grupo = $('#grupo').val()
		var familia = $('#familia').val()
		var tipo = $('#tiposel').val()
		var material = $('#materialMod').val()
		var dato3 = $('input:text[name=dato_3]').val()
		var dato4 = $('input:text[name=dato_4]').val()
		var dato5 = $('input:text[name=dato_5]').val()
		var dato6 = $('input:text[name=dato_6]').val()
		var dato7 = $('input:text[name=dato_7]').val()
		var dato8 = $('input:text[name=dato_8]').val()
		var dato9 = $('input:text[name=0]').val()

		if(!tipo){
			tipo = "N/A";
		}
		if(!material){
			material = "N/A";
		}
		if(!dato3){
			dato3 = "N/A";
		}
		if(!dato4){
			dato4 = "N/A";
		}
		if(!dato5){
			dato5 = "N/A";
		}
		if(!dato6){
			dato6 = "N/A";
		}
		if(!dato7){
			dato7 = "N/A";
		}	


			var dato = confirm("Estas seguro de los datos");
			if(dato){
					//console.log(grupo+"//"+familia+"//"+tipo+"//"+material+"//"+dato3+"//"+dato4+"//"+dato5+"//"+dato6+"//"+dato7+"//"+dato8+"//"+dato9+"//"+laFechita());
					$.ajax({
						url: '../controlador/addItemFormal.php',
						type: 'POST',
						dataType: 'html',
						data: { valor1: grupo,
						valor2: familia,
						valor3: tipo,
						valor4: material,
						valor5: dato9,
						valor6: laFechita(),
						valor7:dato8,
						valor8:dato3,
						valor9: dato4,
						valor10: dato5,
						valor11: dato6,
						valor12: dato7},
					})
					.done(function(respuesta){
						console.log(respuesta);
						//$("#materiales").html(respuesta)
						$('#modalBusqueda').modal('hide')
						swal("Operacion Realizada con exito", "", "success")
					})//fin done
					.fail(function(){
						console.log('error');
					});
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
		//$("#grupos2").html("");
		$("#familias2").html("");
		$("#tipo").html("");
		$("#tipoPagUno").html("");
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
		if(grupo != "1"){
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
		// var element2 = document.getElementById("esconder2");
		// element2.classList.add("invisible");
		var element = document.getElementById("mostrarBTN");
		element.classList.remove("invisible");
	}

	function muestra() {
		var element = document.getElementById("esconder");
		element.classList.remove("invisible");
		// var element2 = document.getElementById("esconder2");
		//  element2.classList.remove("invisible");
		 var element2 = document.getElementById("mostrarBTN");
		element2.classList.add("invisible");
	}


	
//cierra la seccion despues d en munutos
	function CerrarCession() {
	location.href ="./../controlador/CerrarSession.php";
	}
//genera fecha y hora para ser guardada como dato
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

		setTimeout("laFechita()",1000);
		return fecha;
	}
	laFechita()

</script>
