console.log("Grupos On Line");

function loadGrupo(){
    //alert("load de gruposssssssssssss");
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
    var txt = "<select multiple class='form-control form-control-sm' name='grupo' id='grupo'>";
    grupo.forEach(function(element) {
        txt += "<option value='"+element+"' onclick='carga_familia()'>"+element+"</option>";
    });
    txt += "</select>";
    $("#cargaGrupo").html(txt)
}
function loadGrupo2(){
    $.ajax({
		url: './../controlador/TraeGrupo.php',
		type: 'POST',
        dataType: 'html',
	}).done(function(respuesta){
		console.log('logrado');
		$("#cargaGrupo").html(respuesta)
	})//fin done
	.fail(function(){
		console.log('error');
	});
}

function carga_familia(){
    $("#carga2").html("");
    document.getElementById('grupo').selected = "true";
    var select = document.getElementById("grupo");
    var index = select.selectedIndex; 
    var value = select.options[index].value;
    var text = select.options[index].text;
    //alert (value)
    $.ajax({
		url: './../controlador/TraerFamilias.php',
		type: 'POST',
        dataType: 'html',
        data: { valor: value }
	}).done(function(respuesta){
		// console.log('logrado');
		$("#cargar").html(respuesta)
	})//fin done
	.fail(function(){
		console.log('error');
	});
}
function submit_Envio_datos(){
    var dato1, dato2, dato3, dato4, dato5, dato6, dato7,dato8= "N/A";

    var cont = document.getElementsByClassName("form-control").length; 
    
    //alert(cont);
    
    if(cont <= "2"){
        alert("Aun no seleccionas Nada;");
        return false;
     } else if(cont >= "3"){
        var sw_a = confirm("Esta seguro de los datos ingresados")
        if (sw_a) {
            return true;
        } else {
            alert("Revisa los datos para luego enviarlos")
            return false;
        }
        
     }
    
}

function envarFormularioCorreo(){
    alert("enviando Correo")
}
