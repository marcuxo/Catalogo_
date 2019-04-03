<?php 
	//echo "Login";
session_start();
?>
 <!DOCTYPE html>
 <html>
 <head>
	 <title>Login Catalogo</title>
	 <link rel="icon" type="image/png" href="img_/icon.png" />
	 <!-- import de hojas de estilos estilos.css solo contiene el color del fondo de la app -->
	<link rel="stylesheet" type="text/css" href="./CSS/bootstrap-4.css">
	<link rel="stylesheet" type="text/css" href="./CSS/estilos.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
 </head>
 <body class="imgfondo">

<header>
	<div class="container-fluid">
 	<div class="row">
 		<div class="col-8">
 			<h1 class="display-4 text-white font-italic invisible">Login_</h1>
		 </div>
		 <div class="col-4 text-right">
		 	<a href="busquedaAvanzadaUSR.php" class="btn btn-sm btn-primary"><i class="fas fa-search"></i> Busqueda</a>
			<a href="index.php" class="btn btn-sm btn-success"><i class="fas fa-home"></i> Inicio</a>
		 </div>
 	</div>
 </div>
</header>

<!-- div que contiene el cuadro para login -->
<content>
	<div class="container">
		<div class="row align-items-center text-center my-2">
			<div class="col-3"></div>
			<div class="col-6 bg-semitrans rounded login p-5">
				<img src="./img_/logo-login.png" width="200px" class="img_login">
					<form method="POST"  id="FormLogin" onsubmit="return Login_btn();">

						<div class="input-group">
							<span class="input-group-addon corm-control" id="sizing-addon2"><i class='fas fa-user-shield'></i></span>
							<input type="text" class="form-control form-control-sm text-primary" name="usuarioL" placeholder="Ingrese su Usuario" aria-describedby="sizing-addon2" style="background-color:transparent;">
						</div><br>
						<div class="input-group">
							<span class="input-group-addon corm-control" id="sizing-addon2"><i class="fas fa-key"></i></span>
							<input type="password" class="form-control form-control-sm text-primary" placeholder="Ingrese su Clave" aria-describedby="sizing-addon2" style="background-color:transparent;">
						</div>
						<br>
						<div class="input-group">
							<input type="submit" class="btn btn-primary btn-sm col rounded" value="Entrar" aria-describedby="sizing-addon2">
							</form>
						</div>
				<!-- este label contiene la respuesta erronea del login, lo representa como un alert en pagina -->
				<br><label id="rspta_login" class="text-danger"></label>
			</div>
			<div class="col-3"></div>

		</div>
	</div>
</content>

<!-- footer o pie de pagina -->
<footer>
	<div class="container mt-5 fixed-bottom">
		<div class="row">
			<div class="col fondo text-center rounded-top">
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
