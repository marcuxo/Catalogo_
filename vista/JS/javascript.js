console.log("##------->");
//cierra el alert de bootstrap no borrar


// se activa al se leccionar un item del select familia par mostrar todos sus cuadros de ingreso de datos
function traeDatos() {
    document.getElementById('selector').selected = "true";
    var select = document.getElementById("selector");
    var index = select.selectedIndex; 
    var value = select.options[index].value;
    var text = select.options[index].text;
    //console.log("value: "+value+" //texto: "+text+"//");

    $.ajax({
		url: './../controlador/TraeInputs.php',
		type: 'POST',
		dataType: 'html',
		data: { valor: value},
	})
	.done(function(respuesta){
		//console.log('logrado');
		$("#carga2").html(respuesta)
	})//fin done
	.fail(function(){
		console.log('error');
	});//fin fail
}

//esta funcion es la encargada de recopilar todos los datos seleccionados y enviarlos a php para ser procesados
function btn_const() {
	console.log("prsionaste el boton para hacer la consulta");
	var datos = "cadena de texto con los datos recopilados";
	swal(datos, {
	  buttons: {
	    Cancelar: {
	      value: "Cancelar",
	    },
	    OK: true,
	  },
	})
	.then((value) => {
	  switch (value) {
	 
	    case "OK":
	      return true;;
	      break;
	 
	    case "Cancelar":
	      swal("Revisa los datos y solo cuando estes seguro los");
	      break;
	  }
	});
}
// esta funcion se carga automaticamente en la pagina al seleccionar un item que contenga el campo item
function btn_trae_tipo() {
	var tipo = $('#acaSaleElTipo').val();
	//alert(tipo);
	$.ajax({
		url: './../controlador/consultaMateriales.php',
		type: 'POST',
		dataType: 'html',
		data: { valor: tipo},
	})
	.done(function(respuesta){
		// console.log('logrado');
		$("#tipo").html(respuesta)
	})//fin done
	.fail(function(){
		console.log('error');
	});
}

function Login_btn_copi() {
	var inpt_login = document.getElementsByClassName("form_login").length;

	//alert(inpt_login);
	var usuario = document.forms['FormLogin'].elements[0].value;
	var clave = document.forms['FormLogin'].elements[1].value;
	//alert(usuario+clave);
	if (usuario != "" && clave != "") {
		if(usuario == "admin" && clave == "123"){
			swal('validando datos');
			return true;
		} else {
		$("#rspta_login").html("<div class='alert alert-danger alert-dismissible fade show' role='alert'>"+
			"<button type='button' class='close' data-dismiss='alert' aria-label='Close'>"+
			"<span aria-hidden='true'>&times;</span>"+
			"</button>"+
			  "<strong>ERROR!</strong>Los datos ingresados son incorrectos."+
			"</div>");
		return false;
		}
	} else {
		swal('Debes completar los datos');
		return false;
	}
}

// funcion que valida los datos del login no esten vacios y delega la busqueda en base de datos a otra funcion
function Login_btn() {
	var inpt_login = document.getElementsByClassName("form_login").length;

	//alert(inpt_login);
	var usuario = document.forms['FormLogin'].elements[0].value;
	var clave = document.forms['FormLogin'].elements[1].value;
	//alert(usuario+clave);
	if (usuario != "" && clave != "") {
		validaFormulario(usuario, clave);
		return false;
	} else {
		$("#rspta_login").html("<div class='alert alert-danger alert-dismissible fade show' role='alert'>"+
			"<button type='button' class='close' data-dismiss='alert' aria-label='Close'>"+
			"<span aria-hidden='true'>&times;</span>"+
			"</button>"+
			  "<strong>ERROR!</strong>Los datos ingresados son incorrectos."+
			"</div>");
		return false;
	}
}
//valida formulario de login en la base de datos y responde
function validaFormulario(user, pass) {
	//swal("validando");
	$.ajax({
		url: './../controlador/Login.php',
		type: 'POST',
		dataType: 'html',
		data: { usuario: user,
				clave: pass},
	})
	.done(function(respuesta){
		 console.log(respuesta);
		 if(respuesta == "ok"){
		 	console.log("la respuesta es ok");
		 	location.href ="./Mantenedor_Datos.php";
		 }else{
		 	$("#rspta_login").html("<div class='alert alert-danger alert-dismissible fade show' role='alert'>"+
			"<button type='button' class='close' data-dismiss='alert' aria-label='Close'>"+
			"<span aria-hidden='true'>&times;</span>"+
			"</button>"+
			  "<strong>ERROR!</strong>Los datos ingresados son incorrectos."+
			"</div>");
			return false;
		 }
	})//fin done
	.fail(function(){
		console.log('error');
	});
}
//valida los inputs y combobox del ingreso de datos --falta el item grupo para terminar --no en uso
function submitEnvio() {
	var dato1, dato2, dato3, dato4, dato5, dato6, dato7,dato8= "";

	var inpt = document.getElementsByClassName("form-control").length; 
 

	alert(inpt);
	if(inpt === "8"){
		var dato1  = document.forms["FormUno"].elements[0].value;
		var dato2  = document.forms["FormUno"].elements[1].value;
		var dato3  = document.forms["FormUno"].elements[2].value;
		var dato4  = document.forms["FormUno"].elements[3].value;
		var dato5  = document.forms["FormUno"].elements[4].value;
		var dato6  = document.forms["FormUno"].elements[5].value;
		var dato7  = document.forms["FormUno"].elements[6].value;
		var dato8  = document.forms["FormUno"].elements[7].value;
		if(dato1!=""&&dato2!=""&&dato3!=""&&dato4!=""&&dato5!=""&&dato6!=""&&dato7!=""&&dato8!=""){
		var conf = confirm("Es corercto el dato "+dato1+dato2+dato3+dato4+dato5+dato6+dato7+dato8);
			if(conf){
				return true;
			}
				return false;
		}

	} else if(inpt =="7"){
		var dato1  = document.forms["FormUno"].elements[0].value;
		var dato2  = document.forms["FormUno"].elements[1].value;
		var dato3  = document.forms["FormUno"].elements[2].value;
		var dato4  = document.forms["FormUno"].elements[3].value;
		var dato5  = document.forms["FormUno"].elements[4].value;
		var dato6  = document.forms["FormUno"].elements[5].value;
		var dato7  = document.forms["FormUno"].elements[6].value;
		if(dato1!=""&&dato2!=""&&dato3!=""&&dato4!=""&&dato5!=""&&dato6!=""&&dato7!=""){
		var conf = confirm("Es corercto el dato "+dato1+dato2+dato3+dato4+dato5+dato6+dato7);
			if(conf){
				return true;
			}
				return false;
		}

	} else if(inpt =="6"){
		var dato1  = document.forms["FormUno"].elements[0].value;
		var dato2  = document.forms["FormUno"].elements[1].value;
		var dato3  = document.forms["FormUno"].elements[2].value;
		var dato4  = document.forms["FormUno"].elements[3].value;
		var dato5  = document.forms["FormUno"].elements[4].value;
		var dato6  = document.forms["FormUno"].elements[5].value;
		if(dato1!=""&&dato2!=""&&dato3!=""&&dato4!=""&&dato5!=""&&dato6!=""){
		var conf = confirm("Es corercto el dato "+dato1+dato2+dato3+dato4+dato5+dato6);
			if(conf){
				return true;
			}
				return false;
		}
	} else if(inpt =="5"){
		var dato1  = document.forms["FormUno"].elements[0].value;
		var dato2  = document.forms["FormUno"].elements[1].value;
		var dato3  = document.forms["FormUno"].elements[2].value;
		var dato4  = document.forms["FormUno"].elements[3].value;
		var dato5  = document.forms["FormUno"].elements[4].value;
		if(dato1!=""&&dato2!=""&&dato3!=""&&dato4!=""&&dato5!=""){
		var conf = confirm("Es corercto el dato "+dato1+dato2+dato3+dato4+dato5);
			if(conf){
				return true;
			}
				return false;
		}
	} else if(inpt =="4"){
		var dato1  = document.forms["FormUno"].elements[0].value;
		var dato2  = document.forms["FormUno"].elements[1].value;
		var dato3  = document.forms["FormUno"].elements[2].value;
		var dato4  = document.forms["FormUno"].elements[3].value;
		if(dato1!=""&&dato2!=""&&dato3!=""&&dato4!=""){
		var conf = confirm("Es corercto el dato "+dato1+dato2+dato3+dato4);
			if(conf){
				return true;
			}
				return false;
		}
	} else if(inpt =="3"){
		var dato1  = document.forms["FormUno"].elements[0].value;
		var dato2  = document.forms["FormUno"].elements[1].value;
		var dato3  = document.forms["FormUno"].elements[2].value;
		if(dato1!=""&&dato2!=""&&dato3!=""){
		var conf = confirm("Es corercto el dato "+dato1+dato2+dato3);
			if(conf){
				return true;
			}
				return false;
		}
	} else if(inpt =="2"){
		var dato1  = document.forms["FormUno"].elements[0].value;
		var dato2  = document.forms["FormUno"].elements[1].value;
		if(dato1!=""&&dato2!=""){
			var conf = confirm("Es corercto el dato "+dato1+dato2);
			if(conf){
				return true;
			}
				return false;

		}
	} else if(inpt =="1"){
		var dato1  = document.forms["FormUno"].elements[0].value;
		swal("aun no seleccionas nada :)");
		return false;

	} else {
		alert("No haz seleccionado nada aun :(")
		return false;
	}
}//fin metodo Submit


//REDIRECCIONA EL LOGUIN RESPUESTA
function Redireccion_login() {
	location.href ="./Mantenedor_Datos.php";
}
//cierra la session de usuario y borra todos los datos que esta session tenga guardados
function CerrarCession() {
	location.href ="./../controlador/CerrarSession.php";
}

//habre una nueva ventana con medidas predeterminadas
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}





$(".alert").alert('close');
//carga los datos del primer select y se activa al cargar la pagina
