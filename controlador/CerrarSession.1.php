<?php 
//metodo para Cerrrar session
session_start();
session_unset($_SESSION);
session_destroy();


header('Location: ./../vista/index.php');
 ?>