<%@page import="logica.Jugador"%>
<%@page import="datos.DBJugador"%>
<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<head>
		<title>Registro</title>
		<style type="text/css">
		<%@ include file="estilo/estilo.css"%> 
		</style>
		
	</head>
	<body>

	<div class="contenedor" >
			<ul>
			  <li><a class="principal" > Plataforma Juegos</a></li>
			  <li><a href="index.html" >Inicio</a></li>
			  <li><a class="active" href="Conversiones.html"> Registro</a></li>
			  <li><a href="Operaciones.html"> aaaaa</a></li>
			</ul>	
	</div>
	<br><br><br><br>
	
	<div>
		<form action="Inicio" method="POST">
	 	 	<label for="Nombre"><b>Nombre</b></label><br>
	   		<input type="text" id="entrada" name="nombre" placeholder="Nombre"><br>
			<br>
	    	<label for="GamerTag"><b>GamerTag</b></label><br>
	    	<input type="text" id="entrada" name="GamerTag" placeholder="GamerTag"><br>

	    	<label for="Correo"><b>Correo</b></label><br>
	    	<input type="text" id="entrada" name="Correo" placeholder="Correo"><br>

	    	<label for="Password"><b>Password</b></label><br>
	    	<input type="Password" id="entrada" name="Password" placeholder="Password"><br>

	    	<label for="Pais"><b>Pais</b></label><br>
	    	<input type="text" id="entrada" name="Pais" placeholder="Pais"><br>

	    	<label for="Nacimiento"><b>Fecha de Nacimiento</b></label><br>
	    	<input type="date" id="entrada" name="Nacimiento" placeholder="Nacimiento"><br>
	    
	    	<button type="submit" name="submit" class="convertir">Enviar</button>
	 
	    <br><br>
	    </form>
	</div>

	</body>
</html>