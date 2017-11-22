<?php //include("includes/encabezado.php"); 
require_once("includes/conexion.php"); 

if(isset($_POST["subir"])){

	$id_juego = $_POST["id_Juego"];
	$id_jugador = $_POST["id_Jugador"];
	$puntaje = $_POST["puntaje"];
	// echo '<script>alert("' . $id_juego . '");</script>';
	// echo '<script>alert("' . $id_jugador . '");</script>';
	// echo '<script>alert("' . $puntaje . '");</script>';
	$sentencia = "INSERT INTO puntaje (id_juego, id_jugador, puntaje) VALUES ('".$id_juego."', '".$id_jugador."', '".$puntaje."')";
	$query = NULL;
	if($puntaje != 0){
		$query = mysqli_query($conexion, $sentencia);
	}
	
	if($query){
	 $message = "Puntaje subido";
	} else {
	 $message = "Intente de nuevo";
	}
	 if (!empty($message)) {		
	//echo '< nombre = "'.$nombre.'" & apellido = "'.$apellido.'" & result= "'.$result.'">';
	echo '<br><br><br>'; 	
	echo '<script>alert("' . $message . '");</script>';
	//header("http://localhost/Plataforma/puntajes.php");
	header("http://localhost/Plataforma/puntajes.php");
	//window.location.assign("'.$href .'?e = '.$estado.'")	
    //</script>';

	} 
}
?>