
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Verificacion Datos</title>
	<link rel="stylesheet" href="CSS/bootstrap-4.css">
	<link rel="stylesheet" href="CSS/estilos.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col text-center">
				<p class="lead text-warning bg-primary" id="fecha"></p>
				<form action="" method="get">
					<input type="text" name="horaActual" id="fechita"  class="form-control form-control-sm col-2 text-center invisible">
					<button type="submit">Enviar</button>
				</form>
			</div>
		</div>
	</div>

	<!-- imports de javascript para funcionalidad -->
	<script type="text/javascript" src="./JS/jquery.js"></script>
	<script type="text/javascript" src="./JS/tether.1.4.js"></script>
	<script type="text/javascript" src="./JS/bootstrap.4.alfa.js"></script>
</body>
</html>
<script>


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

		setTimeout("laFechita()",1000);s
	}

laFechita()

</script>