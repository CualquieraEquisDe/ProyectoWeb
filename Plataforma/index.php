<?php include("includes/encabezado.php"); ?>
<?php include("includes/conexion.php"); ?>

	<br><br><br>
	<center>
		<?php //<img src="imagenes/man.png" alt = "man"> ?>
		<?php //<h1>Index</h1>?>
    <h1>UD Juegos</h1>
		<?php

			if(isset($_SESSION["session_username"])){?>
				<h1>Bienvenido, <span><?php echo $_SESSION['session_username'];?></span></h1>
			<?php }?>
      <img src="imagenes/gamepad.png" alt = "gamepad" width="300" height="300">

 	<div>
    <br>
   
<?php 

  if($conexion){

    $select = "SELECT * FROM juego INNER JOIN juego_categoria ON juego_categoria.id_juego = juego.id_juego INNER JOIN categoria ON juego_categoria.id_categoria = categoria.id_categoria INNER JOIN esrb ON juego.id_esrb = esrb.id_esrb";
    $resultadoSql =mysqli_query($conexion, $select);
  }else{
    echo '<script> alert("Error de conexion")</script>';
  }

while($fila1 = mysqli_fetch_assoc($resultadoSql)){
  
    echo '<table width="70%" border="0">';
    echo '<tbody>';
    echo '<tr>';
    echo '<td rowspan = "4">';

  echo '<img src=';
  echo '"';
  echo $fila1['portada_juego'];
  echo '"';
  echo " alt = ";
  echo '"Imagen"';
  echo 'width = "100" height = "100" align = "center">';

  echo "</td>";
  echo '<td align = "center">';
  echo $fila1['n_juego'];

  echo '<td align="center" rowspan="4">';
  echo '<imput type = "submit" class="jugar" id="Donkey" onclick="window.location=';
  echo "'";
  echo $fila1['ubicacion_juego'];
  echo "'; ";
  echo '"/>Jugar</td>';

  echo "</tr>";

  echo "<tr>";
  echo "<td>";
  echo $fila1['descripcion_categoria'];
  echo "</td>";
  echo "</tr>";

  echo "<tr>";
  echo "<td>";
  echo $fila1['descripcion_juego'];
  echo "</td>";
  echo "</tr>";

  echo "<tr>";
  echo "<td>";
  echo $fila1['n_esrb'];
  echo "</td>";
  echo "</tr>";
  echo "<br><br>";

  echo "</tbody>";
  echo "</table>";

  }
?>
	</div>


	</center>

	</body>
</html>
