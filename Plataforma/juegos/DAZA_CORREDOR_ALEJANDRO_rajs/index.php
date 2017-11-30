<?php include("C:/xampp/htdocs/Plataforma/includes/encabezado.php"); ?>
<?php require_once("C:/xampp/htdocs/Plataforma/includes/conexion.php"); ?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta name="description" content="Juego asteroids">
		<meta name="keywords" content="juego transformaciones asteroids colisiones jquery canvas ajax">
		<meta name="author" content="Alejandro Paolo Daza">
		<title>Asteroids HTML5</title>
		<link rel="stylesheet" type="text/css" href="estilos.css" media="screen">
		<script src="libs/jquery-1.11.0.min.js" language="JavaScript1.2"></script>
		<script>
		var x = 350;
		var y = 250;
		var vida = 0;
		var duracion = 0;
		var rotacion = 0;
		var msg = 0;
		var ast = [[aleatorio(700),aleatorio(500)],
				   [aleatorio(700),aleatorio(500)],
				   [aleatorio(700),aleatorio(500)],
				   [aleatorio(700),aleatorio(500)],
				   [aleatorio(700),aleatorio(500)],
				   [aleatorio(700),aleatorio(500)],
				   [aleatorio(700),aleatorio(500)],
				   [aleatorio(700),aleatorio(500)],
				   [aleatorio(700),aleatorio(500)],
				   [aleatorio(700),aleatorio(500)]];

		$(document).ready(inicio);
		$(document).keydown(capturaTeclado);

		function inicio(){
			var lienzo = $("#lienzo")[0];
			var contexto = lienzo.getContext("2d");
			var buffer = document.createElement("canvas");
			buffer.width = lienzo.width;
			buffer.height = lienzo.height;
			contextoBuffer = buffer.getContext("2d");
			contextoBuffer.fillStyle = "#ffffff"; 
			contextoBuffer.clearRect(0,0,700,500);
			contextoBuffer.font = "bold 50px sans-serif";
			contextoBuffer.fillText("BIENVENIDO", 180, 200);
			contextoBuffer.fillStyle = "#ff0000"; 
			contextoBuffer.font = "bold 30px sans-serif";
			contextoBuffer.fillText("Juega Elude Asteroids", 170, 230);
			contexto.clearRect(0,0,700,500);
			contexto.drawImage(buffer, 0, 0);
			$('#brisa')[0].play();
			$("button").click(function(){	
				x = 350;
				y = 250;	
				vida = 100;
				duracion = 0;
				run();		
			});
			$("#recomendaciones").load("recomendaciones.html");
		}

		function aleatorio(tope){
			return Math.floor((Math.random() * tope) + 1);
		} 

		function capturaTeclado(event){
			//alert(event.which);
			if(event.which==38 || event.which==87)
				y -= 10;
			if(event.which==40 || event.which==83)
				y += 10;
			if(event.which==39 || event.which==68)
				x += 10;
			if(event.which==37 || event.which==65)
				x -= 10;
			x = (700 + x)%700;
			y = (500 + y)%500;
		}

		function Nave(){
			this.img = [$("#ship")[0],$("#explosion")[0]];
			this.msgs = ["verifca el frente", "cuidado al lado", "mejor moverse", 
			             "ojo alrededor", "cuidado con el asteroide", "evita los asteroides",
			             "acelera","no puedes colisionar mas","debes mantener la vida",
			             "atiende los controles"];
			
			this.dibujar = function(ctx,i){
				var img = this.img[i];
				ctx.drawImage(img, x, y);
				ctx.save();
				ctx.fillStyle = "#aaaaff";
				ctx.font = "10px sans-serif";
				ctx.fillText("pos x: "+ x + " pos y: " + y, x - 25, y + 50);
				ctx.fillStyle = "#ff8888";
				ctx.fillText(this.msgs[msg], x - 25, y + 60);
				ctx.restore();
			}
			
			this.colision = function(xx,yy){
				var distancia=0;
				distancia=Math.sqrt( Math.pow( (xx-x), 2)+Math.pow( (yy-y),2));
				if(distancia>40)
				   return false;
				else
				   return true;	
			}
		}

		function Asteroid(){
			this.img = $("#asteroid")[0];			
			this.dibujar = function(ctx, x1, y1){
				var img = this.img;
				ctx.save();
				ctx.translate(x1,y1);
				ctx.rotate(rotacion*Math.PI/180);
				ctx.drawImage(img,-img.width/2,-img.height/2);
				ctx.restore();
			}
		}
		
		function run(){ 
			var puntaje=parseInt(duracion/10);
			var lienzo = $("#lienzo")[0];
			var contexto = lienzo.getContext("2d");
			var buffer = document.createElement("canvas");
			buffer.width = lienzo.width;
			buffer.height = lienzo.height;
			contextoBuffer = buffer.getContext("2d");
			contextoBuffer.fillStyle = "#ffffff"; 
			if(vida >= 0){  		
				duracion++;
				if(duracion % 50 == 0)
					msg = aleatorio(9);
				var objnave = new Nave();
				var objasteroid = [new Asteroid(),new Asteroid(),new Asteroid(),
								   new Asteroid(),new Asteroid(),new Asteroid(),
								   new Asteroid(),new Asteroid(),new Asteroid(),
								   new Asteroid()]; 
				contextoBuffer.clearRect(0,0,700,500);

				contextoBuffer.font = "bold 25px sans-serif";
				contextoBuffer.fillText("vida = "+vida, 25, 25);
				contextoBuffer.fillText("puntos = "+ puntaje, 250, 25);
				objnave.dibujar(contextoBuffer,0);
				rotacion -= 5;
				for(i=0;i<10;i++){
					
					objasteroid[i].dibujar(contextoBuffer,ast[i][0],ast[i][1]);
					if(objnave.colision(ast[i][0],ast[i][1])){
						vida -=1;
						objnave.dibujar(contextoBuffer,1);
						$('#explode')[0].play();
					}
					ast[i][0]-=5;
					ast[i][1]+=3;
					ast[i][0] = (700 + ast[i][0])%700;
					ast[i][1] = (500 + ast[i][1])%500;
				}
				contexto.clearRect(0,0,700,500);
				contexto.drawImage(buffer, 0, 0);
				setTimeout("run()",20);
				// $("button").css("display","none");
			}else{
				$('#brisa')[0].pause();
				
				contextoBuffer.clearRect(0,0,700,500);

				contextoBuffer.font = "bold 50px sans-serif";
				document.getElementById("puntaje").value = puntaje;
				contextoBuffer.fillText("GAME OVER", 180, 200);
				contextoBuffer.fillText(puntaje+" pts", 250, 250);
				contexto.clearRect(0,0,700,500);
				contexto.drawImage(buffer, 0, 0);
				// $("button").css("display","inline");
				
			}

			document.getElementById("puntaje").value = puntaje;

		}
		</script>
	</head>
	<body>
		<aside>
			<img id="ship" src="imagenes/ship.png"/><br>
			<img id="asteroid" src="imagenes/asteroid.png"/><br>
			<img id="explosion" src="imagenes/explosion.png"/><br>
			<h1>Elude Asteroids</h1>
			<hr>
			<h3>Controles del juego</h3>
			<img id="contrles" src="imagenes/wasd.png"/>
			<img id="contrles" src="imagenes/arrows.png"/>
			<br>
			<div id="recomendaciones"></div>
			<button class="jugar">iniciar</button>
			<hr>
			<p>Copyright @2014 Alejandro Paolo Daza</p>
		</aside>
		<section>
			
			<canvas id="lienzo" width="700" height="500">
				Tu navegador no es compatible
			</canvas>
			
			<audio id="brisa">
				<source src="sonidos/brisa.ogg" type="audio/ogg">
				<source src="sonidos/brisa.mp3" type="audio/mpeg">
				Tu navegador no es compatible
			</audio>
			<audio id="explode">
				<source src="sonidos/explode.ogg" type="audio/ogg">
				<source src="sonidos/explode.mp3" type="audio/mpeg">
				Tu navegador no es compatible
			</audio> 
			
		</section>
		     <?php 
					if(isset($_SESSION["session_username"])) {
						$_jugador =  $_SESSION["session_iduser"];
						
					}else{
						$_jugador = "0";
					}
					?>
        <form action = "http://localhost/plataforma/puntos.php" method="POST">
			<input  type = "hidden" id ="id_Juego" name="id_Juego" value="3" >
			<input  type = "hidden" id ="id_Jugador" name="id_Jugador" value= <?php echo $_jugador ?> > 
			<input  type = "hidden" id ="puntaje" name="puntaje" > 
   			<input class = "jugar" id="subir" type="submit" name="subir" value="Subir"> </input> <br>

   		</form>
		
		
	</body>
</html>
