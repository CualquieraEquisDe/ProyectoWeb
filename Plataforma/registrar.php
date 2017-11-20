<html>
			<link rel="icon" type="image/png" href="imagenes/icon.png" />
				<head>
					<title>UD Juegos</title>
					<link href="estilo/estilo.css" rel="stylesheet" type="text/css">
				</head>
				<body>
					<header>
						<div class="contenedor" >
						<ul>
				          <li><a class="principal" > UD Juegos </a></li>
						  <li><a href="index.html" >Inicio</a></li>
						  <li><a class="active" href="registro.html">Registro</a></li>
						  <li><a href="puntajes.php">Puntajes</a></li>
					    </ul>
					</div>
					</header>
					<br>
					<br>
					<br>
					<CENTER>
						<?php
	//conectamos Con el servidor
	$conexion = mysqli_connect("localhost", "root", "", "plataforma");

	if($conexion){

		$nombre = $_POST['nombre'];
		$apellido = $_POST['apellido'];
		$gamertag = $_POST['GamerTag'];
		$correo = $_POST['Correo'];
		$pass = $_POST['Password'];
		$pais = $_POST['Pais'];
		$nacimiento = $_POST['Nacimiento'];

		$consulta = "INSERT INTO jugador (nombre_jugador, apellido_jugador, gamertag_jugador, email_jugador, password_jugador, pais, fecha_nacimiento) VALUES('$nombre', '$apellido', '$gamertag', '$correo', '$pass', '$pais', '$nacimiento')" ;
		$subir=mysqli_query($conexion, $consulta);

		if (!$subir) {
			?>
						<h1><?php echo $nombre," ", $apellido?> No ha podido ser registrado</h1><br>
						<img src="imagenes/sad.png" alt = "sad">
			<?php
		}else{
			?>
						<h1><?php echo $nombre," ", $apellido?> ha sido registrado correctamente</h1>
						<img src="imagenes/gamepad.png" alt = "gamapad">

					</CENTER>
				</body>
			</html>
			<?php
	}
}