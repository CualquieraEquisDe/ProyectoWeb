<?php include("C:/xampp/htdocs/Plataforma/includes/encabezado.php"); ?>
<?php require_once("C:/xampp/htdocs/Plataforma/includes/conexion.php"); ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title> juego 2048 programacion avanzada</title>
        <link href="style/main.css" rel ="stylesheet" type ="text/css">
        <script>
            function EntradaDeTeclado(){
                this.eventos={};
                this.listen();
            }

            //recibe el evento y lo vincula con la funcion necesaria
            EntradaDeTeclado.prototype.on = function(evento, callback){
                if(!this.eventos[evento]){
                    this.eventos[evento]=[];
                }
                this.eventos[evento].push(callback);
            };

            //vincula el evento y la informacion del mismo con la funcion a responder por el evento
            EntradaDeTeclado.prototype.emitir=function(evento, info){  //Antes data
                var callbacks=this.eventos[evento];
                if(callbacks){
                    callbacks.forEach(function(callback){
                        callback(info);
                    });
                }  
            };


            //Asigna listeners sobre acciones del teclado a la pagina
            EntradaDeTeclado.prototype.listen=function(){
                var self=this;
                var mapa={
                    38:0, //arriba
                    39:1, //derecha
                    40:2, //abajo
                    37:3, //izquierda
                };
                //Responde a las flechas
                document.addEventListener("keydown", function(event){
                    var teclaPresionada= mapa[event.which];            //Antes mapped
                    
                    if(teclaPresionada !== undefined){
                        event.preventDefault();
                        self.emitir("mover",teclaPresionada);
                    }
                });    

                //responde a los botones presionados
                this.botonPresionado(".boton-reintentar", this.reiniciar);
                this.botonPresionado(".reiniciar", this.reiniciar);
                this.botonPresionado(".boton-seguir-jugando", this.mantenerJugando );
            };

            //emite el evento "reiniciar" para reiniciar el juego
            EntradaDeTeclado.prototype.reiniciar = function(evento){
                evento.preventDefault();
                this.emitir("reiniciar");
            };

            //emite el evento "seguirJugando" para seguir luego de alcanzar la ficha 2048
            EntradaDeTeclado.prototype.mantenerJugando= function(evento){
                evento.preventDefault();
                this.emitir("mantenerJugando")
            };

            //agrega un listener a los botones en pantalla
            EntradaDeTeclado.prototype.botonPresionado=function(selector, fn){
                var boton= document.querySelector(selector);
                boton.addEventListener("click", fn.bind(this));
            };

         </script>
        <script> 
            function ManejoDOM(){
                this.contenedorFicha = document.querySelector(".contenedor-ficha");
                this.puntajeActual = document.querySelector(".puntaje-actual");
                this.mensajeFinal = document.querySelector(".mensaje-final");
                this.puntaje =0;
            }


            //realiza los cambios en el dom luego del movimiento de las fichas
            ManejoDOM.prototype.cambio = function(cuadricula, infoJuego){
                var self = this;
                window.requestAnimationFrame(function(){
                    self.limpiarContenedor(self.contenedorFicha);
                    cuadricula.celdas.forEach(function(columna){
                        columna.forEach(function(celda){
                            if(celda){
                                self.agregarFicha(celda);
                            }
                        });
                    });
                    
                    self.actualizarPuntaje(infoJuego.puntaje);
                    if(infoJuego.terminado){
                        if(infoJuego.perdio){
                            self.mensaje(false);
                        }else if(infoJuego.gano){
                            self.mensaje(true);
                        }
                    }
                    
                });
            };


            //continua el juego
            ManejoDOM.prototype.continuarJuego = function(){
                this.quitarMensajeFinal();
            };


            //elimina el primer nodo hijo del div que se le pase
            ManejoDOM.prototype.limpiarContenedor = function(contenedor){
                while(contenedor.firstChild){
                    contenedor.removeChild(contenedor.firstChild);
                }
            };



            //agrega las nuevas fichas al la cuadricula
            ManejoDOM.prototype.agregarFicha = function(ficha){
                var self = this;
                
                var caja = document.createElement("div");
                var contenido = document.createElement("div");
                var posicion = ficha.posicionPrevia || { x: ficha.x, y: ficha.y };
                var clasePosicion = this.clasePosicion(posicion);
                var clases = ["ficha", "ficha-"+ficha.valor, clasePosicion];
                
                if(ficha.valor > 2048) clases.push("ficha-super");
                
                this.aplicarClases(caja,clases);
                
                contenido.classList.add("contenido-ficha");
                contenido.textContent = ficha.valor;
                
                if(ficha.posicionPrevia){
                    window.requestAnimationFrame(function(){
                        clases[2] = self.clasePosicion({ x: ficha.x, y: ficha.y });
                        self.aplicarClases(caja,clases);
                    });
                }else if(ficha.combinadaCon){
                    clases.push("combinacion-ficha");
                    this.aplicarClases(caja,clases);
                    ficha.combinadaCon.forEach(function(combinada){
                        self.agregarFicha(combinada);
                    });
                }else{
                    clases.push("nueva-ficha");
                    this.aplicarClases(caja, clases);
                }
                
                caja.appendChild(contenido);
                this.contenedorFicha.appendChild(caja);
            };


            //pone el atrubuto clase y su valor a los div generados durante el juego
            ManejoDOM.prototype.aplicarClases = function(elemento, clases){
                elemento.setAttribute("class",clases.join(" "));
            };


            //determina la posicion final de la ficha en la cuadricula
            ManejoDOM.prototype.posicionFinal = function(posicion){
                return { x: posicion.x + 1, y: posicion.y + 1 };
            };



            //completa la clase del div de la ficha correspondiente a la posicion ingresada
            ManejoDOM.prototype.clasePosicion = function(posicion){
                posicion = this.posicionFinal(posicion);
                return "posicion-ficha-" + posicion.x + "-" + posicion.y;
            };



            //actualiza el puntaje
            ManejoDOM.prototype.actualizarPuntaje = function(puntaje){
                this.limpiarContenedor(this.puntajeActual);
                this.puntajeActual.textContent = puntaje;
            };


            //determina que mensaje final se debe mostrar al terminar la partida
            ManejoDOM.prototype.mensaje = function(gano){
                var tipo;
                var mensaje;
                if(gano){
                    tipo = "juego-ganado";
                    mensaje = "Ganaste";
                }else{
                    tipo = "juego-perdido";
                    mensaje = "Perdiste";
                }
                
                this.mensajeFinal.classList.add(tipo);
                this.mensajeFinal.getElementsByTagName("p")[0].textContent = mensaje;
            };



            //quita el mensaje final cuando se termina la partida para seguir jugando
            ManejoDOM.prototype.quitarMensajeFinal = function(){
                this.mensajeFinal.classList.remove("juego-ganado");
                this.mensajeFinal.classList.remove("juego-perdido");
            };

        </script>

        <script>
            function Cuadricula(tamano, estadoPrevio){
                this.tamano = tamano;
                if(estadoPrevio){
                    this.celdas = this.delEstado(estadoPrevio);
                }else{
                    this.celdas = this.vacio();
                }
            }

            //inicializa el arreglo "celdas" con espacios vacios
            Cuadricula.prototype.vacio = function(){
                var celdas = [];
                for(var x = 0; x<this.tamano; x++){
                    var fila = celdas[x] = [];
                }
                return celdas;
            };

            //determina el estado de una celda
            Cuadricula.prototype.delEstado = function(estado){
                var celdas = [];
                for(var x=0; x<this.tamano; x++){
                    
                    var fila = celdas[x] = [];
                    
                    for(var y=0; y<this.tamano; y++){
                        var ficha = estado[x][y];
                        if(ficha){
                            row.push(new Ficha(ficha.posicion, ficha.valor));
                        }else{
                            row.push(null);
                        }
                    }
                }
                return celdas;
            };

            //encuentra el primer lugar para colocar las fichas de manera aleatoria
            Cuadricula.prototype.celdaDisponibleAleatoria =function(){
                var celdas = this.celdasDisponibles();
                if(celdas.length){
                    return celdas[Math.floor(Math.random()*celdas.length)];
                }
            };

            //determina que celdas estan libres
            Cuadricula.prototype.celdasDisponibles = function(){
                var celdas = [];
                this.cadaCelda(function (x,y,ficha){
                    if(!ficha){
                        celdas.push({ x: x, y: y });
                    }
                });
                return celdas;
            };

            //
            Cuadricula.prototype.cadaCelda = function(callback){
                for(var x=0; x<this.tamano; x++){
                    for(var y=0; y<this.tamano; y++){
                        callback(x,y,this.celdas[x][y]);
                    }
                }
            };

            //determina que celda esta disponible
            Cuadricula.prototype.celdasDis = function(){
                return !!this.celdasDisponibles().length
            }

            //determina que celda esta disponible
            Cuadricula.prototype.celdaDis = function(celda){
                return !this.celdaOcupada(celda);
            }

            //determina si una celda esta ocupada
            Cuadricula.prototype.celdaOcupada = function(celda){
                return !!this.contenidoCelda(celda);
            }

            //determina el contenido de una celda
            Cuadricula.prototype.contenidoCelda = function(celda){
                if(this.dentroLimites(celda)){
                    return this.celdas[celda.x][celda.y];
                }
                else{
                  return null;
                }
            };

            //inserta una nueva ficha
            Cuadricula.prototype.insertarFicha = function(ficha){
                this.celdas[ficha.x][ficha.y] = ficha;
            };

            //remueve una ficha
            Cuadricula.prototype.removerFicha = function(ficha){
                this.celdas[ficha.x][ficha.y] = null;
            };

            //determina que las fichas no se salgan de la cuadricula
            Cuadricula.prototype.dentroLimites = function(posicion){
                return posicion.x >= 0 && posicion.x < this.tamano && posicion.y >=0 && posicion.y < this.tamano;
            };


            //unifica las propiedades de las celdas
            Cuadricula.prototype.serializar = function(){
                var estadoCelda =[];
                for(var x=0; x<this.tamano; x++){
                    var fila = estadoCelda[x]=[];
                    
                    for(var y=0; y<this.tamano; y++){
                        if(this.celdas[x][y]){
                            fila.push(this.celdas[x][y].serializar());
                        }else{
                            fila.push(null);
                        }
                    }
                }
                return{
                    tamano: this.tamano,
                    celdas: estadoCelda
                };
            };




         </script>

        <script>
            function Ficha (posicion, valor){
                this.x = posicion.x;
                this.y = posicion.y;
                this.valor = valor || 2;
                this.posicionPrevia = null;
                this.combinadaCon = null;
            }


            //guarda la posicion de la ficha
            Ficha.prototype.guardarPosicion = function(){
                this.posicionPrevia = {x:this.x, y:this.y};
            };


            //actualiza la posicion de una ficha
            Ficha.prototype.actualizarPosicion = function(posicion){
                this.x = posicion.x;
                this.y = posicion.y;
            };

            //retorna la posicion y valor actualizados de la ficha
            Ficha.prototype.serializar = function(){
                return{
                    posicion:{
                        x: this.x,
                        y: this.y
                    },
                    value: this.valor
                };
            };

         </script>
        

        <script>
            function AdministradorJuego(tamano, Teclado, ManejoDOM){
                this.tamano = tamano;
                this.teclado = new Teclado;
                this.manejoDOM = new ManejoDOM;
                this.primerasFichas = 2;
                this.teclado.on("mover", this.mover.bind(this));
                this.teclado.on("reiniciar", this.reiniciar.bind(this));
                this.teclado.on("mantenerJugando", this.mantenerJugando.bind(this));
                this.lanzador();
            }


            //Genera el tablero inicial
            AdministradorJuego.prototype.reiniciar = function(){
                this.manejoDOM.continuarJuego();
                this.lanzador();
            };

            // Seguir jugando despues de ganar (llegar a 2048)
            AdministradorJuego.prototype.mantenerJugando = function(){
                this.mantenerJugando = true;
                this.manejoDOM.continuarJuego();
            };

            //Terminar el juego al llegar a 2048
            AdministradorJuego.prototype.juegoTerminado = function(){
                return this.perdio || (this.gano && !this.mantenerJugando);
            };

            //Configura el juego
            AdministradorJuego.prototype.lanzador = function(){
                this.cuadricula = new Cuadricula(this.tamano);
                this.puntaje =0;
                this.perdio = false;
                this.gano = false;
                this.mantenerJugando=false;
                this.fichaInicial();
                this.cambio();
            };

            //inicia el juego con el numero de fichas
            AdministradorJuego.prototype.fichaInicial= function(){
                for(var i=0; i < this.primerasFichas; i++){
                    this.agregarFichaAleatoria();
                }
            };


            //Agrega las fichas aleatoriamente al empezar (ficha 2 o 4)
            AdministradorJuego.prototype.agregarFichaAleatoria = function(){
                if(this.cuadricula.celdasDis()){
                    var valor;
                    if(Math.random()<0.9){
                        valor = 2;
                    }
                    else{ 
                        valor = 4;
                    }
                    var ficha = new Ficha(this.cuadricula.celdaDisponibleAleatoria(), valor);
                    this.cuadricula.insertarFicha(ficha);
                }
            };

            //realiza los cambios y las comprobaciones luego de cada movimiento
            AdministradorJuego.prototype.cambio= function(){
                this.manejoDOM.cambio(this.cuadricula,{
                    puntaje: this.puntaje,
                    perdio: this.perdio,
                    gano: this.gano,
                    terminado: this.juegoTerminado()
                });
            };


            //unifica los atributos principales del juego
            AdministradorJuego.prototype.serializar=function(){
                return{
                    cuadricula: this.cuadricula.serializar(),
                    puntaje: this.puntaje,
                    perdio: this.perdio,
                    gano: this.gano,
                    mantenerJugando: this.mantenerJugando
                };
            };

            // guarda las posiciones de las fichas y quita informacion de combinacion previa
            AdministradorJuego.prototype.prepararFichas= function(){
                this.cuadricula.cadaCelda(function(x, y, ficha){
                    if(ficha){
                        ficha.combinadaCon = null;
                        ficha.guardarPosicion();
                    }
                });
            };

            // mueve la ficha y su representacion
            AdministradorJuego.prototype.moverFicha= function(ficha, celda){
                this.cuadricula.celdas[ficha.x][ficha.y] = null;
                this.cuadricula.celdas[celda.x][celda.y] = ficha;
                ficha.actualizarPosicion(celda);
            };

            // mueve las fichas en la direccion respectiva
            AdministradorJuego.prototype.mover=function(direccion){
                var self = this;
                if(this.juegoTerminado()) return;
                var celda, ficha;
                
                var vector= this.vectorMovimiento(direccion);
                var recorridos= this.recorridos(vector);
                var movido=false;
                
                this.prepararFichas();
                
                  // recorre las fichas en la cuadricula en la direccion correcta
                  recorridos.x.forEach(function(x){
                    recorridos.y.forEach(function(y){
                        celda = { x: x, y: y };
                        ficha = self.cuadricula.contenidoCelda(celda);
                        
                        if(ficha){
                            var posiciones=self.posicionMasLejana(celda, vector);
                            var proximo=self.cuadricula.contenidoCelda(posiciones.siguente);
                            
                        // realiza solo una fusion por fila o columna
                            if(proximo && proximo.valor == ficha.valor && !proximo.combinadaCon){
                                var combinado = new Ficha(posiciones.siguente, ficha.valor * 2);
                                combinado.combinadoCon = [ficha, proximo];
                            
                                self.cuadricula.insertarFicha(combinado);
                                self.cuadricula.removerFicha(ficha);
                            
                                ficha.actualizarPosicion(posiciones.siguente);
                                 // actualiza el puntaje
                                self.puntaje += combinado.valor;
                            
                                // Se declara el tope para ganar (se puede modificar para efectos de pruebas)
                                if(combinado.valor === 2048){
                                    self.gano = true;
                                }
                            }else{
                                self.moverFicha(ficha, posiciones.maximo);
                            }
                            if(!self.posicionesIguales(celda, ficha)){
                                movido=true;
                            }
                        }
                    });
                });
                  
                  if (movido){
                    this.agregarFichaAleatoria();
                    if(!this.movimientosDisponibles()){
                        this.perdio=true;// Si no quedan movimientos se declara el juego como perdido
                    }
                        this.cambio();
                }   
            };


            //define el vector de movimiento de acuerdo a la flecha presionada
            AdministradorJuego.prototype.vectorMovimiento = function(direccion){
                var mapa ={
                    0: { x: 0, y: -1 },
                    1: { x: 1, y: 0 },
                    2: { x: 0, y: 1 },
                    3: { x: -1, y: 0 }
                };
                
                return mapa[direccion];
            };


            //crea los recorridos de extremo a extremo de acuerdo al vector de movimiento
            AdministradorJuego.prototype.recorridos = function(vector){
                var recorridos = { x: [], y: [] };
                
                for(var pos = 0; pos < this.tamano; pos++){
                    recorridos.x.push(pos);
                    recorridos.y.push(pos);
                }
                if(vector.x === 1){
                    recorridos.x = recorridos.x.reverse();
                } 
                if(vector.y === 1){
                    recorridos.y = recorridos.y.reverse();
                }
                
                return recorridos;
            };


            //determina cual es la posicion mas lejana posible de alcanzar
            AdministradorJuego.prototype.posicionMasLejana = function(celda, vector){
                var anterior;
                do{
                    anterior = celda;
                    celda = {x: anterior.x + vector.x, y: anterior.y + vector.y};
                }while(this.cuadricula.dentroLimites(celda)&& this.cuadricula.celdaDis(celda));
                
                return{
                    maximo: anterior,
                    siguente: celda
                };
            };


            //determina si hay movimientos disponibles o no para continuar o terminar el juego
            AdministradorJuego.prototype.movimientosDisponibles = function(){
                return this.cuadricula.celdasDis() || this.unionesDisponibles();
            };


            //determina que fichas estan en condiciones de combinarse para continuar o no el juego
            AdministradorJuego.prototype.unionesDisponibles = function(){
                var self = this;
                var ficha;
                
                for (var x = 0; x < this.tamano; x++){
                    for(var y = 0; y<this.tamano; y++){
                        ficha = this.cuadricula.contenidoCelda({x: x, y: y});
                    
                        if(ficha){
                           for(var dir =0; dir<4; dir++){
                               var vector = self.vectorMovimiento(dir);
                               var celda = { x: x + vector.x, y: y + vector.y }
                               
                               var otro = self.cuadricula.contenidoCelda(celda);
                               
                               if(otro && otro.valor === ficha.valor){
                                   return true;
                               }
                           } 
                        }
                    }
                }
                return false;
            };


            //
            AdministradorJuego.prototype.posicionesIguales = function(p1,p2){
                return p1.x === p2.x && p1.y===p2.y;
            };

         </script>



        <script>
            window.requestAnimationFrame(function(){
            new AdministradorJuego(4,EntradaDeTeclado,ManejoDOM);
              });
         </script>
    </head>
    <body>
        <div class="contenedor-general">
            <div class="cabecera">
                <h1 class="titulo"> <strong>2048</strong> </h1>
                <div class="contenedor-puntajes">
                    <div class="puntaje-actual">0</div>
                </div>
            </div>
        <div class="acerca-del-juego">
            <p class="intro-juego">Una los numeros y forme la ficha <strong>2048</strong></p>
            <a class="reiniciar">Nuevo juego</a>
            </div>
        <div class="contenedor-tablero">
            <div class="mensaje-final">
                <p></p>
                <div class="contenedor-botones">
                    <a class="boton-seguir-jugando">Sigue Jugando</a>
                    <a class="boton-reintentar">Intentar de nuevo</a>
                </div> 
            </div>
            <div class="contenedor-cuadricula">
            <div class="contenedor-filas">
                <div class="contenedor-celda"></div>
                <div class="contenedor-celda"></div>
                <div class="contenedor-celda"></div>
                <div class="contenedor-celda"></div>
            </div>
            <div class="contenedor-filas">
                <div class="contenedor-celda"></div>
                <div class="contenedor-celda"></div>
                <div class="contenedor-celda"></div>
                <div class="contenedor-celda"></div>
            </div>
            <div class="contenedor-filas">
                <div class="contenedor-celda"></div>
                <div class="contenedor-celda"></div>
                <div class="contenedor-celda"></div>
                <div class="contenedor-celda"></div>
            </div>
            <div class="contenedor-filas">
                <div class="contenedor-celda"></div>
                <div class="contenedor-celda"></div>
                <div class="contenedor-celda"></div>
                <div class="contenedor-celda"></div>
            </div>
        </div>
             <div class="contenedor-ficha"></div>
        </div>
            <p>
            <strong>¿Como jugar?:</strong> Use las flechas para mover las fichas, cuando dos fichas del mismo numero se tocan estas forman una sola ficha.
            </p>
            <hr>
            <p>
            Realizado por Carlos Andres Felipe Beltran Triana, David Alejandro Aparicio y Jairo Andres Romero Triana
            </p>
        </div>  
         <?php 
                    if(isset($_SESSION["session_username"])) {
                        $_jugador =  $_SESSION["session_iduser"];
                        
                    }else{
                        $_jugador = "0";
                    }
                    ?>
                    <br>
                    Puntos: 
            <output id ="puntaje1" name="puntaje1"  > </output> 
        <form action = "http://localhost/plataforma/puntos.php" method="POST">
            <input  type = "hidden" id ="id_Juego" name="id_Juego" value="4" >
            <input  type = "hidden" id ="id_Jugador" name="id_Jugador" value= <?php echo $_jugador ?> >

            <input type = "hidden" id ="puntaje" name="puntaje"> </input> 
            <button class= "jugar" id="subir" type="submit" name="subir" >Subir Puntaje</button> <br>

        </form>      
    </body>
    

</html>