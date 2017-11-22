<?php include("includes/encabezado.php"); ?>
<?php require_once("includes/conexion.php"); ?>

<link rel="icon" type="image/png" href="imagenes/icon.png" />
<?php

if(isset($_POST["submit"])){

if(!empty($_POST['nombre']) && !empty($_POST['apellido']) && !empty($_POST['GamerTag']) && !empty($_POST['Correo']) && !empty($_POST['Password']) && !empty($_POST['Pais'] && !empty($_POST['Nacimiento']))){

	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellido'];
	$gamerTag = $_POST['GamerTag'];
	$correo = $_POST['Correo'];
	$pass = $_POST['Password'];
	$pais = $_POST['Pais'];
	$fNacimiento = $_POST['Nacimiento'];
	$query1 = mysqli_query($conexion, "SELECT * FROM jugador WHERE gamertag_jugador='".$gamerTag."'");
	$query2 = mysqli_query($conexion, "SELECT * FROM jugador WHERE email_jugador='".$correo."'");
	$numrows1=mysqli_num_rows($query1);
	$numrows2=mysqli_num_rows($query2);
	if($numrows1 == 0 && $numrows2 == 0){

	$sql = "INSERT INTO jugador (nombre_jugador, apellido_jugador, gamertag_jugador, email_jugador, password_jugador, pais, fecha_nacimiento) VALUES('$nombre', '$apellido', '$gamerTag', '$correo', '$pass', '$pais', '$fNacimiento')" ;

	$result=mysqli_query($conexion,$sql);
	if($result){
	 $message = "Te has registrado correctamente";
	 $estado = 1;
	} else {
	 $message = "Error al ingresar datos de la informacion!";
	 $estado = 0;
	}
	} else {
	 $message = "El nombre de usuario o correo ya existe! Por favor, intenta con otro!";
	 $estado = 0;
	}
}else {
	 $message = "Todos los campos deben de estar llenos!";
	 $estado = 0;
}
$href = "registrar.php";
}
 if (!empty($message)) {		
	//echo '< nombre = "'.$nombre.'" & apellido = "'.$apellido.'" & result= "'.$result.'">';
	echo '<script>alert("' . $message . '");</script>';
	//window.location.assign("'.$href .'?e = '.$estado.'")	
    //</script>';

} ?>
	<div class="contenedor" >
			<ul>
			  <li><a class="principal" > UD Juegos </a></li>
			  <li><a href="index.php" >Inicio</a></li>
			  <li><a class="active" href="registro.php"> Registro</a></li>
			  <li><a href="puntajes.php"> Puntajes</a></li>
			</ul>	
	</div>
	<br><br><br><br>
	
	<div>
		<form action="registro.php" method="POST">
	 	 	<label for="Nombre"><b>Nombre</b></label><br>
	   		<input type="text" id="entrada" name="nombre" placeholder="Nombre"><br>
			<br>
			<label for="Apellido"><b>Apellido</b></label><br>
	   		<input type="text" id="entrada" name="apellido" placeholder="Apellido"><br>
			<br>
	    	<label for="GamerTag"><b>GamerTag</b></label><br>
	    	<input type="text" id="entrada" name="GamerTag" placeholder="GamerTag"><br>

	    	<label for="Correo"><b>Correo</b></label><br>
	    	<input type="email" id="entrada" name="Correo" placeholder="Correo"><br>

	    	<label for="Password"><b>Password</b></label><br>
	    	<input type="Password" id="entrada" name="Password" placeholder="Password"><br>

	    	<label for="Pais"><b>Pais</b></label><br>
	    	<input type="text" id="entrada" name="Pais" placeholder="Pais"><br>

	    	<label for="Nacimiento"><b>Fecha de Nacimiento</b></label><br>
	    	<input type="date" id="entrada" name="Nacimiento" placeholder="Nacimiento"><br>
	    
	    	<button type="submit" name="submit" id = "registrar" class="convertir">Enviar</button>
	 
	    <br><br>
	    </form>
	</div>

	</body>
</html>