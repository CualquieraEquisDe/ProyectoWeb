<?php include("includes/encabezado.php"); ?>
<br><br><br>
<CENTER>
<?php
		$estado = $_GET['estado'];
		if ($estado == 0) {
			?>
						<h1>  No ha podido ser registrado</h1><br>
						<img src="imagenes/sad.png" alt = "sad">
			<?php
		}else{
			?>
						<h1>Ha sido registrado correctamente</h1>
						<img src="imagenes/gamepad.png" alt = "gamapad">

					</CENTER>
				</body>
			</html>
			<?php
}
