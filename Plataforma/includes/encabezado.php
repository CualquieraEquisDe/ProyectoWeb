<?php 
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<link rel="icon" type="image/png" href="http://localhost/plataforma/imagenes/icon.png" />

<?php

$archivo_actual = basename($_SERVER['PHP_SELF']);
$classInicio = "";
$classPuntajes = "";
$classRegistro = "";
$classIngresar = "";
$active = 'class= "active"';
switch($archivo_actual){
	case "index.php":
	$classInicio = $active;
	break;
	case "puntajes.php":
	$classPuntajes = $active;
	break;
	case "registro.php":
	$classRegistro = $active;
	break; 
	case "ingresar.php":
	$classIngresar = $active;
	break; 
 }
 ?>


	<head>
		<title>UD Juegos</title>
		<link href="http://localhost/plataforma/estilo/estilo.css" rel="stylesheet" type="text/css"> 
		<header>
			<div class="contenedor" name = "contenedor" id="contenedor" >
				<nav>
				  <a class="principal"> UD Juegos </a>
				  <a <?php echo $classInicio; ?> href="http://localhost/plataforma/index.php"> Inicio</a>
				  <a <?php echo $classPuntajes; ?> href="http://localhost/plataforma/puntajes.php"> Puntajes</a>
				  <?php if(!isset($_SESSION["session_username"])) {?>
				  <a <?php echo $classRegistro; ?> href="http://localhost/plataforma/registro.php"> Registro</a>
				  <a <?php echo $classIngresar; ?> href="http://localhost/plataforma/ingresar.php" id="ingresar"> Ingresar</a></li>
				  <?php }else{?>
				  <a href="http://localhost/plataforma/cerrarsesion.php" id="ingresar"> Salir</a></li>			  
				  <?php }?>


				</nav>
				
			</div>
		</header>	
	<br>
		
	</head>
	<body>