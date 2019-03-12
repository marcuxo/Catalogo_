<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sube Una Imagen</title>
	<link rel="stylesheet" href="CSS/estilos.css">
	<link rel="stylesheet" type="text/css" href="./CSS/bootstrap-4.css">
</head>
<body onload="">
<header>
    <div class="container-fluid bg-inverse mb-3">
        <div class="row">
            <div class="col">
                <h1 class="display-4 text-white font-italic">Seleciona una imagen</h1>
            </div>
        </div>
    </div>
</header>

<container>
<div class="container-fluid">
    <div class="row">
        <div class="col text-center">
            <form action="../controlador/DatosIngreso.php" method="post" enctype="multipart/form-data">

            <input type="file" name="imagenFoto" id="imagenFoto" accept="image/*" class="btn btn-sm btn-info form-control col" onclick="imagen_load()" required>
                <div class="m-2" id=""><img id="imgSalida" width="40%" height="40%" src="img_/previa_2.png" /></div>
            <button class="btn btn-sm btn-success mt-3">Subir Imagen</button>
            </form>

        </div>
    </div>
</div>
    

</container>
<script src="JS/loadImg.js"></script>
<script type="text/javascript" src="./JS/jquery.2.3.js"></script>
</body>
</html>