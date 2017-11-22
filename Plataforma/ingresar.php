<?php
//session_start();
if(isset($_SESSION["session_username"])) {
	header("location:index.php");
} else {
?>
<?php include("includes/encabezado.php"); ?>
<?php require_once("includes/conexion.php"); ?>

<?php

if(isset($_POST["ingresar"])){

	if(!empty($_POST['GamerTag']) && !empty($_POST['Password'])) {
		$GamerTag = $_POST['GamerTag'];
		$Password = $_POST['Password'];

		$query =mysqli_query($conexion, "SELECT * FROM jugador WHERE gamertag_jugador='".$GamerTag."' AND password_jugador='".$Password."'");

    	$numrows=mysqli_num_rows($query);

    	if($numrows!=0){
    		while($row=mysqli_fetch_assoc($query)){
    			$dbgamertag=$row['gamertag_jugador'];
    			$dbpassword=$row['password_jugador'];
    			$dbid=$row['id_jugador'];
    			
    		}
    		if($GamerTag == $dbgamertag && $Password == $dbpassword){
    			$_SESSION['session_username']=$GamerTag;

    			$_SESSION['session_iduser']=$dbid;
    			$Usuario = $_SESSION['session_username'];
    			echo '<script>alert("Bienvenido")</script>';
    			/* Redirect browser */
    			header("Location: index.php");
    		}
    	}else{
    		$message =  "Nombre de usuario ó contraseña invalida!";
    	}

	}else{
    	$message = "Todos los campos son requeridos!";
    	
	}
	if(isset($message)){
		echo '<script>alert("'.$message.'")</script>';	
	}
	

}	
?>
			
	<br><br><br>
		<form action="ingresar.php" method="POST">
	 	 	<label for="gamertag_jugador"><b>GamerTag</b></label><br>
	   		<input type="text" id="entrada" name="GamerTag" placeholder="GamerTag"><br>
			<br>
			<label for="Password"><b>Contraseña</b></label><br>
	   		<input type="password" id="entrada" name="Password" placeholder="Contraseña"><br>
			<br>	    
	    	<button type="submit" name="ingresar" id = "ingresar" class="convertir">Ingresar</button>
	    	
	    	<p class="regtext">¿No estas registrado? Registrate<a href="registro.php" > Aquí</a></p>
	 
	    <br><br>
	    </form>
	</div>

	</body>
</html><?php
}
?>