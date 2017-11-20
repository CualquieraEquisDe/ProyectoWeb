<?php include("includes/encabezado.php"); ?>
	<div class="contenedor" >
			<ul>
			  <li><a class="principal" > UD Juegos </a></li>
			  <li><a href="index.php" >Inicio</a></li>
			  <li><a href="registro.php"> Registro</a></li>
			  <li><a class="active" href="puntajes.php"> Puntajes</a></li>
			</ul>	
	</div>
	<br><br><br><br><br>
	<center>
		<img src="imagenes/trophy.png" alt = "trophy">
		<h1>Registro de Puntuaciones</h1>

	</center>

	<?php
	$conexion = mysqli_connect("localhost", "root", "", "plataforma");

	if($conexion){


		$select = "SELECT puntaje.puntaje,jugador.gamertag_jugador,juego.n_juego,jugador.nombre_jugador,jugador.apellido_jugador,puntaje.fecha_puntaje from puntaje INNER JOIN jugador ON puntaje.id_jugador = jugador.id_jugador INNER JOIN juego ON puntaje.id_juego = juego.id_juego ORDER BY puntaje DESC";
		$resultadoSql =mysqli_query($conexion, $select);
	}
	?>

	<section><table width="70%" border="0">
  <tbody>
    <tr>
      <td width="10%"  class="titulos"><strong>Puntaje</strong></td>
      <td width="20%" class="titulos"><strong>Gamertag</strong></td>
      <td width="20%" class="titulos"><strong>Juego</strong></td>
      <td width="20%" class="titulos"><strong>Nombre</strong></td>
      <td width="20%" class="titulos"><strong>Apellido</strong></td>
      <td width="80%" class="titulos"><strong>Fecha</strong></td>
    </tr>
	<?php
while($fila1 = mysqli_fetch_assoc($resultadoSql)){
	
	echo "<tr>";
	echo "<td class='titulos2'>";
	echo $fila1['puntaje'];
	echo "</td>";
	echo "<td class='titulos2'>";
	echo $fila1['gamertag_jugador'];
	echo "</td>";
	echo "<td class='titulos2'>";
	echo $fila1['n_juego'];
	echo "</td>";
	echo "<td class='titulos2'>";
	echo $fila1['nombre_jugador'];
	echo "</td>";
	echo "<td class='titulos2'>";
	echo $fila1['apellido_jugador'];
	echo "</td>";
	echo "<td class='titulos2'>";
	echo $fila1['fecha_puntaje'];
	}
	?>


</table>
</section>
</body>
</html>
