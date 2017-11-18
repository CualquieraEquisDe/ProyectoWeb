
	<?php
		//conectamos Con el servidor
		$conexion = mysqli_connect("localhost", "root", "", "plataforma");
	
		if($conexion){

			$nombre = $_POST['nombre'];
			$tag = $_POST['GamerTag'];
			$correo = $_POST['Correo'];
			$pass = $_POST['Password'];
			$pais = $_POST['Pais'];
			$nacimiento = $_POST['Nacimiento'];

			$consulta = "INSERT INTO jugador VALUES(3 ,'$tag', '$pass', '$nombre', '1' ,'$correo', '$nacimiento', '$pais', '1')";
			$subir=mysqli_query($conexion, $consulta) or die (mysql_error());
			
		}
	?>
