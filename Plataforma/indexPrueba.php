<html>
<head>
<title>Plataforma de Juegos UD</title>
<link href="http://localhost/Plataforma/estilo/estilo.css" rel="stylesheet" type="text/css">

<center><h1>Juegos</h1></center>
</head>
</html>
<?php

	$conexion = mysqli_connect("localhost", "root", "", "plataforma");

	

	if (!$conexion) {
		echo "Error";
		exit;
	}
	echo "Éxito";	
	
	$tabla=mysqli_query($conexion,"SELECT * FROM puntaje");

	//mysqli_query($conexion,"INSERT INTO juego (id_juego) VALUES (3)");
?>
	<section><table width="70%" border="0">
  <body>
    <tr>
      <td width="5%" class="titulo"> <strong>ID</strong></td>
      <td width="20%" class="titulo"> <strong>NOMBRE DEL JUGADOR </strong></td>
      <td width="20%" class="titulo"> <strong>PUNTAJE </strong></td>
      <td width="20%" class="titulo"> <strong>JUEGO </strong></td>
	  <td width="20%" class="titulo"> <strong>FECHA</strong></td>
	 
    </tr>
	<?php
	if (mysqli_num_rows($tabla) > 0) {
while($row = mysqli_fetch_assoc($tabla)) {
	
	echo "<tr>";
	echo "<td class='titulos'>";
	echo $row['id_Juego'];
	echo "</td>";
	echo "<td class='titulos'>";
	echo $row['id_Jugador'];
	echo "</td>";
	echo "<td class='titulos'>";
	echo $row['Puntaje'];
	echo "</td>";
	echo "<td class='titulos'>";
	echo $row['id_Juego'];
	echo "</td>";
	echo "<td class='titulos'>";
	echo $row['Fecha'];
	echo "</tr>";
	}
}
	mysqli_close($conexion);
	?>
</table>





