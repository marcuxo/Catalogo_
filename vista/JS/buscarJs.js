console.log("Buscador OnLine");
function buscados() {
	var dato = $("#txt_buscar").val();
	dato = dato.trim();
	//alert(dato)
	if(dato.trim() != ""){
		$.ajax({
		url: './../controlador/BuscarTodo.php',
		type: 'POST',
		dataType: 'html',
		data: { buscar: dato },
	}).done(function(respuesta){
		console.log('logrado');
		$("#resultadoBusqueda").html(respuesta)
	})//fin done
	.fail(function(){
		console.log('error');
	});//fin fail
	} else {
		swal("Aun no Escribes nada para buscar.")
	}
}

function itemSeleccionado2() {
	document.getElementById('selectBuscado').selected = "true";
    var select = document.getElementById("selectBuscado");
    var index = select.selectedIndex; 
    var value = select.options[index].value;
    var text = select.options[index].text;
	swal(value);
}

//muestra la imagen del item seleccionado en el select multiple si existe
function itemSeleccionado() {
	document.getElementById('selectBuscado').selected = "true";
    var select = document.getElementById("selectBuscado");
    var index = select.selectedIndex; 
    var value = select.options[index].value;
    var text = select.options[index].text;
	//swal(value);
	window.open(value,'popup','width=490,height=350,toolbar=no,scrollbars=no,top=100,left=100')
}

function popup(page) {
window.open(page,'popup','width=490,height=350,toolbar=false,scrollbars=false,top=120,left=180');
}