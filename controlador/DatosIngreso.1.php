<?php
require_once './../modelo/Class_Catalogo.php';
$enviaMail = Catalogo::singleton();

$codigo = "N/A";
$imagen = "N/A";
$descripcion = "N/A";
$grupo = "N/A";
$familia = "N/A";
$tipo = "N/A";
$material = "N/A";
$dato_2 = "N/A";
$dato_3 = "N/A";
$dato_4 = "N/A";
$dato_5 = "N/A";
$dato_6 = "N/A";
$dato_7 = "N/A";
$nn = count($_POST);
//var_dump($_FILES['imagenFoto']['error']);
$msg = "Estos son los datos que se ingresaran previa aprobacion.</br>";// cuenta los datos por post que llegan
// metodo para carga y guardado de archivo de imagen
$directorio = "../vista/img_/";//-****************cambiar esta direccion por la que usara para gusrdar las imagenes
$directorioDB = $directorio.($_FILES['imagenFoto']['name']);
$fichero_subido = $directorio.($_FILES['imagenFoto']['name']);

if(move_uploaded_file($_FILES['imagenFoto']['tmp_name'], $fichero_subido)){
	echo "La imagen es valida
 y se subio con exito<br>";
} else {
	echo "La imagen no es valida o contiene errores.<br>";
}

// Verifica que la variable contenga algun dato y si es asi sobreescribe la variable de lo contrario su valos sera N/A
if(isset($_FILES['imagenFoto']['tmp_name'])){
    $imagen = $_FILES['imagenFoto']['name'];
    // echo $imagen."</br>";
}


if(isset($_POST['codigo_item'])){
    $codigo = $_POST["codigo_item"];
    // echo $codigo."</br>";
}
if(isset($_POST['descripcion_item'])){
    $descripcion = $_POST["descripcion_item"];
    // echo $descripcion."</br>";
}
if(isset($_POST['grupo'])){
    $grupo = $_POST["grupo"];
    // echo $grupo."</br>";
}
if(isset($_POST['familia'])){
    $familia = $_POST["familia"];
    // echo $familia."</br>";
}
if(isset($_POST['tipo'])){
    $tipo = $_POST["tipo"];
    // echo $tipo."</br>";
}
if(isset($_POST['material'])){
    $material = $_POST["material"];
    // echo $material."</br>";
}
if(isset($_POST['dato_2'])){
    $dato_2 = $_POST["dato_2"];
    // echo $dato_2."</br>";
}
if(isset($_POST['dato_3'])){
    $dato_3 = $_POST["dato_3"];
    // echo $dato_3."</br>";
}
if(isset($_POST['dato_4'])){
    $dato_4 = $_POST["dato_4"];
    // echo $dato_4."</br>";
}
if(isset($_POST['dato_5'])){
    $dato_5 = $_POST["dato_5"];
    // echo $dato_5."</br>";
}
if(isset($_POST['dato_6'])){
    $dato_6 = $_POST["dato_6"];
    // echo $dato_6."</br>";
}
if(isset($_POST['dato_7'])){
    $dato_7 = $_POST["dato_7"];
    // echo $dato_7."</br>";
}

// muestra todos los datos recibidos desde la app
$msg .= "Codigo: ".$codigo."<br>Dir.Imagen: ".$directorioDB."<br>Descripción: ".$descripcion."<br>Grupo: ".$grupo."<br>Familia: ".$familia."<br>Tipo: "
    .$tipo."<br>Material: ".$material."<br>Dato tecnico 1: "
    .$dato_2."<br>Dato tecnico 2: ".$dato_3."<br>Dato tecnico 3: ".$dato_4."<br>Dato tecnico 4: "
    .$dato_5."<br>Dato tecnico 5: ".$dato_6."<br>Dato tecnico 6: ".$dato_7;




$smg3 = "Descripcion: ".$grupo.", ";
$smg3 .=$familia.", ";

if($tipo !="N/A"){
    $smg3 .=$tipo.", ";
} else if($material != "N/A"){
    $smg3 .=$material.", ";
} else if($dato_2 != "N/A"){
    $smg3 .=$dato_2.", ";
} else if($dato_3 != "N/A"){
    $smg3 .=$dato_3.", ";
} else if($dato_4 != "N/A"){
    $smg3 .=$dato_4.", ";
} else if($dato_5 != "N/A"){
    $smg3 .=$dato_5.", ";
} else if($dato_6 != "N/A"){
    $smg3 .=$dato_6.", ";
} else if($dato_7 != "N/A"){
    $smg3 .=$dato_7.", ";
}














    
// $descripcion = $_POST["descripcion_item"];
// $grupo = $_POST['grupo'];
// $familia = $_POST['familia'];
// $tipo = $_POST['tipo'];
// $material = $_POST['material'];
// $dato_2 = $_POST['dato_2'];
// $dato_3 = $_POST['dato_3'];
// $dato_4 = $_POST['dato_4'];
// $dato_5 = $_POST['dato_5'];
// $dato_6 = $_POST['dato_6'];
// $dato_7 = $_POST['dato_7'];

//echo $msg."<br>";
echo "<br>";
$min = strtolower($smg3);
echo ucwords($min);
echo "<br>";
echo "<br>";

$enviaMail->ingresoDatos($directorioDB,$grupo,$familia,$tipo,$material,$dato_2,$dato_3,$dato_4,$dato_5,$dato_6,$dato_7);
$msg2 = '
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Verificacion Datos</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
</head>
<body>
<center>
<div class="container-fluid">
    <div class="row">
        <div class="col bg-inverse rounded-bottom">
            <h1 class="text-white">Datos a Verificar</h1>
        </div>
    </div>
</div>

<div class="container-fluid">
<div class="row">
<div class="col">
    <p class="lead">Codigo: '.$codigo.'</p>
    <p class="lead">Dir. Imagen: '.$directorioDB.'</p>
    <p class="lead">Descripcion: '.$descripcion.'</p>
    <p class="lead">Grupo: '.$grupo.'</p>
    <p class="lead">Familia: '.$familia.'</p>
    <p class="lead">Tipo: '.$tipo.'</p>
    <p class="lead">Material: '.$material.'</p>
    <p class="lead">Dato Tecnico 1: '.$dato_2.'</p>
    <p class="lead">Dato Tecnico 2: '.$dato_3.'</P>
    <p class="lead">Dato Tecnico 3: '.$dato_4.'</p>
    <p class="lead">dato Tecnico 4: '.$dato_5.'</p>
    <p class="lead">Dato Tecnico 5: '.$dato_6.'</p>
    <p class="lead">Dato Tecnico 6: '.$dato_7.'</p>
<br>
<br>



<a href="http://www.google.cl/datos?tokken=123456&accion=insert&id=10023" target="_blank" class="btn btn-sm btn-success mx-md-2 text-white">Insertar Datos</a>
<a href="datos?tokken=123456&action=update&id=10023" target="_blank" class="btn btn-sm btn-info mx-md-2 text-white">Modificar Datos</a>
<a href="datos?tokken=123456&action=delete&id=10023" target="_blank" class="btn btn-sm btn-danger mx-md-2 text-white">Eliminaar Datos</a>
</div>
</div>
</div>
</center>
<footer>
<div class="container bg-inverse mt-5 rounded-top fixed-bottom">
	<div class="row">
		<div class="col text-center">
			<small class="text-white">Para Ariztia por Marco Urrutia M.</small>
		</div>
	</div>
</div>
</footer>
</body>
</html>';

//$enviaMail->Correo($min);

