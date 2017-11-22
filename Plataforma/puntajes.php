<?php 
//session_start();
if(isset($_SESSION["session_username"])) {?>
	<p><a href="cerrarsesion.php">Finalice</a> sesión aquí!</p>
	<?php
} 
?>
<?php include("includes/encabezado.php"); ?>
<?php include("includes/conexion.php"); ?>
	
	<br><br><br>
	<center>
		<img src="imagenes/trophy.png" alt = "trophy">
		<h1>Puntuaciones</h1>

	</center>

	<?php

	if($conexion){

		$select = "SELECT puntaje.puntaje,jugador.gamertag_jugador,juego.n_juego,jugador.nombre_jugador,jugador.apellido_jugador,puntaje.fecha_puntaje, jugador.pais from puntaje INNER JOIN jugador ON puntaje.id_jugador = jugador.id_jugador INNER JOIN juego ON puntaje.id_juego = juego.id_juego ORDER BY juego.n_juego,puntaje DESC";
		$resultadoSql =mysqli_query($conexion, $select);
	}else{
		echo '<script> alert("Error de conexion")</script>';
	}
	?>
<center>
	<section><table width="70%" border="0">
  <tbody>
    <tr>
      <td width="10%"  class="titulos"><strong>Puntaje</strong></td>
      <td width="20%" class="titulos"><strong>Gamertag</strong></td>
      <td width="20%" class="titulos"><strong>Juego</strong></td>
      <td width="20%" class="titulos"><strong>Nombre</strong></td>
      <td width="20%" class="titulos"><strong>Apellido</strong></td>
      <td width="80%" class="titulos"><strong>Fecha</strong></td>
      <td width="80%" class="titulos"><strong>Pais</strong></td>
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
	echo "</td>";
	echo "<td class='titulos2'>";
	echo $fila1['pais'];
	}
	?>


</table>
</center>
</section>
</body>
</html>
