<?php include("C:/xampp/htdocs/Plataforma/includes/encabezado.php"); ?>
<?php require_once("C:/xampp/htdocs/Plataforma/includes/conexion.php"); ?>


<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta name="description" content="Juego llorona">
		<meta name="keywords" content="canvas colisiones jquery ajax">
		<meta name="author" content="Alejandro Daza">
		<title>La leyenda de la llorona</title>
		
		<link rel="stylesheet" type="text/css" href="estilos/default.css" media="screen">
		<script src="js/jquery-1.11.0.min.js" language="JavaScript1.2"></script>

		<script type="text/javascript">
			//Script script

			
			var jugando;

			$(document).ready(inicio);
			$(document).keydown(capturaTeclado);

			function inicio(){
				jugando = true;
				miCanvas = $("#mi_canvas")[0];
				contexto = miCanvas.getContext("2d");
				buffer = document.createElement("canvas");
				quica = new Quica();
				calacas = [new Calaca(), new Calaca(),
							   new Calaca(), new Calaca(),
							   new Calaca()];
				run();	
				
				$('#instrucciones').click(function(){
			        $('#popup').fadeIn('slow');
			        $('.popup-overlay').fadeIn('slow');
			        $('.popup-overlay').height($(window).height());
			        return false;
			    });
			    
			    $('#close').click(function(){
			        $('#popup').fadeOut('slow');
			        $('.popup-overlay').fadeOut('slow');
			        return false;
			    });
			    
			    $("#iniciar").click(function(){	
					if(jugando==false)
						inicio();	
				});

				
			}

			function capturaTeclado(event){
				if(event.which==38 || event.which==87)
					quica.actualizar('arriba');
				if(event.which==40 || event.which==83)
					quica.actualizar('abajo');
				if(event.which==39 || event.which==68)
					quica.actualizar('derecha');
				if(event.which==37 || event.which==65)
					quica.actualizar('izquierda');
				
			}



			function run(){ 
				buffer.width = miCanvas.width;
				buffer.height = miCanvas.height;
				contextoBuffer = buffer.getContext("2d");
					 
				if(jugando){  
					contextoBuffer.clearRect(0,0,buffer.width,buffer.height);

					quica.dibujar(contextoBuffer);
					for(i=0;i<calacas.length;i++){
						calacas[i].dibujar(contextoBuffer);
						calacas[i].actualizar();
						if(quica.colision(calacas[i].x,calacas[i].y)){
							quica.sprite = 2;
							quica.vida--;
							$('#pierde')[0].play();
						}
					}
					
					if(quica.vida <= 0){
						jugando = false;
						document.getElementById("puntaje").value = quica.puntos;
					}
					contexto.clearRect(0,0,miCanvas.width,miCanvas.height);
					contexto.drawImage(buffer, 0, 0);
					setTimeout("run()",20);
					
				}else{
					contextoBuffer.clearRect(0,0,buffer.width,buffer.height);
					contextoBuffer.fillStyle = "#ffffff";
					quica.sprite = 3;
					quica.vida = 0;
					quica.dibujar(contextoBuffer);
					contextoBuffer.font = "50px sans-serif";
					
					contextoBuffer.fillText("GAMEOVER", 300, 440);
					contextoBuffer.fillStyle = "#ff0000";
					contextoBuffer.font = "15px sans-serif";
					contextoBuffer.fillText("try again", 550, 460);
					contexto.clearRect(0,0,miCanvas.width,miCanvas.height);
					contexto.drawImage(buffer, 0, 0);
				}
				
			}

		</script>

		<script type="text/javascript">
			//////script QUICA
			function Quica(){
				this.x = 310;
				this.y = 15;
				this.img = [$("#abajo")[0],$("#arriba")[0],$("#salto")[0],$("#sentado")[0]];
				this.sprite = 0;
				this.vida = 100;
				this.puntos = 0;
				this.seguro = "arriba";
				
				this.dibujar = function(ctx){
					var img = this.img[this.sprite];
					var x = this.x;
					var y = this.y;
					ctx.drawImage(img, x, y);
					ctx.save();
					ctx.fillStyle = "#ffffff";
					ctx.font = "12px sans-serif";
					ctx.fillText("puntos: "+ this.puntos, x, y + 65);
					ctx.fillText("vida: "+ this.vida, x, y);
					ctx.fillText("ultimo seguro: "+ this.seguro, x, y+75);
					if(this.sprite==2){
						ctx.fillStyle = "#ff0000";
						ctx.font = "20px sans-serif";
						ctx.fillText("HEY!!!!", x+65, y + 25);
					}
					ctx.restore();
				}
				
				this.actualizar = function(accion){
					if(accion=="arriba" && this.y > 15){
						this.y -= 10;
						//this.sprite = 1;
					}
					if(accion=="abajo"  && this.y < 390){
						this.y += 10;
						//this.sprite = 0;
					}
					if(accion=="izquierda"){
						this.x -= 10;
						this.sprite = 1;
					}
					if(accion=="derecha"){
						this.x += 10;
						this.sprite = 0;
					}
					this.x = (640 + this.x)%640;
					this.y = (480 + this.y)%480;
					
					if(this.y > 340 && this.seguro == "arriba"){
						this.seguro = "abajo";
						this.puntos++;
					}
					if(this.y < 20 && this.seguro == "abajo"){
						this.seguro = "arriba";
						this.puntos++;
					}
				}
				
				this.colision = function(x,y){
					var distancia=Math.sqrt( Math.pow( (x-this.x), 2)+Math.pow( (y-this.y),2));
					if(distancia>this.img[this.sprite].width)
					   return false;
					else
					   return true;	
				}
			}

		</script>
		
		<script type="text/javascript">
			//////script calaca

			
			function aleatorio(piso,techo){
				return Math.floor(Math.random() * (techo - piso + 1)) + piso;
			}

			function Calaca(x,y){
				var opc = aleatorio(1,100) % 2;
				if(opc==1)
					this.img = $("#calaca_1")[0];	
				else
					this.img = $("#calaca_2")[0];		
				this.x = aleatorio(0,620);
				this.y = aleatorio(100,330);
				this.velocidad = 0;
				while(this.velocidad == 0)
					this.velocidad=aleatorio(-3,3);
						
				this.dibujar = function(ctx){
					var img = this.img;
					ctx.drawImage(img,this.x,this.y);
				}
				
				this.actualizar = function(){
					this.x += this.velocidad;
					this.x = (640 + this.x)%640;
				}
			}

		</script>

	</head>
	<body>
		<section>
			<canvas id="mi_canvas" width="640" height="480">
				Tu navegador no es compatible
			</canvas>			
		</section>
		<section>
			<div id="popup" style="display: none;">
				<div class="content-popup">
					<div class="close"><a href="#" id="close"><img src="imagenes/close.png"/></a></div>
					<div>
					   <h2>Teclas de juego</h2>

					   <img src="imagenes/teclado.png"/>
					   <h2>Creditos</h2>
					   <p>Alejandro Paolo Daza Corredor</p>
						<p>UNIR</p>
						<p>Computación en el Cliente</p>
					</div>
				</div>
			</div>
			<h1>La Llorona</h1>
			<button class = "jugar" id="instrucciones">Ver Instrucciones</button><br>
			<!-- <button id="iniciar">Iniciar</button> -->
			<?php 
		if(isset($_SESSION["session_username"])) {
			$_jugador =  $_SESSION["session_iduser"];
			
		}else{
			$_jugador = "0";
		}
		?>
			<form action = "http://localhost/plataforma/puntos.php" method="POST">
			<input type = "hidden" id ="id_Juego" name="id_Juego" value="2" >
			<input type = "hidden" id ="id_Jugador" name="id_Jugador" value= <?php echo $_jugador ?> > 
			<input type = "hidden" id ="puntaje" name="puntaje" > 
   			<button class= "jugar" id="subir" type="submit" name="subir"> Subir </button> <br>

   		</form>
		</section>
		<audio id="pierde">
			<source src="sonidos/pierde_vida.ogg" type="audio/ogg">
			<source src="sonidos/pierde_vida.mp3" type="audio/mpeg">
			<source src="sonidos/pierde_vida.wav" type="audio/wav">
			Tu navegador no es compatible
		</audio>
		
		<img id="abajo" src="imagenes/kika.png"/>
		<img id="arriba" src="imagenes/kika2.png"/>
		<img id="salto" src="imagenes/kika.png"/>
		<img id="sentado" src="imagenes/kika3.png"/>
		<img id="calaca_1" src="imagenes/calaca_child.png"/>
		<img id="calaca_2" src="imagenes/calaca_girl.png"/>
		
		<br><br><br><br>
		
	</body>
</html>
