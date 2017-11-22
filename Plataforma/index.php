<?php include("includes/encabezado.php"); ?>
	
	<br><br><br>
	<center>
		<?php //<img src="imagenes/man.png" alt = "man"> ?>
		<?php //<h1>Index</h1>?>
		<?php
			if(isset($_SESSION["session_username"])){?>
				<h1>Bienvenido, <span><?php echo $_SESSION['session_username'];?></span></h1>
			<?php }
			
 ?><div>

   		<form action = "juegos/La Llorona/index.php ">
   			<input type="submit" value="Jugar La llorona " class="jugar" id="Llorona">
   		</form>

   		<form action = "juegos/Donkey Kong Js/index.php ">
   			<input type="submit" value="Jugar Donkey Kong " class="jugar" id="DK">
   		</form>	

   		<form action = "juegos/DAZA_CORREDOR_ALEJANDRO_rajs/index.php ">
   			<input type="submit" value="Jugar Elude Asteorids " class="jugar" id="EA">
   		</form>	
	</div>


	</center>

	</body>
</html>
