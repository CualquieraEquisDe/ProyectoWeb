<?php require_once("includes/conexion.php"); ?>

<html>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<link rel="icon" type="image/png" href="imagenes/icon.png" />
	<head>
		<title>UD Juegos</title>
		<link href="estilo/estilo.css" rel="stylesheet" type="text/css"> 
		
	</head>
	<body>

	<div class="contenedor" >
			<ul>
			  <li><a class="principal" > UD Juegos </a></li>
			  <li><a href="index.html" >Inicio</a></li>
			  <li><a href="registro.php"> Registro</a></li>
			  <li><a href="puntajes.php"> Puntajes</a></li>
			  <li><a class="active" href="ingresar">Ingresar</b></li>
			</ul>	
	</div>
	<br><br><br><br>

	<center><img src="imagenes/man.png" alt = "man"></center><br>

	<div>
		<form name = "loginform" id = "loginform" action = "" method="POST">
	    	<label for="GamerTag"><b>GamerTag</b></label><br>
	    	<input type="text" id="entrada" name="GamerTag" placeholder="GamerTag"><br>

	    	<label for="Password"><b>Password</b></label><br>
	    	<input type="Password" id="entrada" name="Password" placeholder="Password"><br>
	    
	    	<button type="submit" name="submit" class="convertir">Ingresar</button>
	    </form>
	</div>
	
	<div>
		
	</div>

	</body>
</html>