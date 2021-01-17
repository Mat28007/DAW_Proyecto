

<body>
	
  <div class="container-fluid">
    <div class="row ">
      <div class ="col-lg-12 section-heading  ">
        <h1 class=" ">SENET</h1><br>
        <h2 class="">Alquila, compra, vende tus juegos de mesa</h2><br>
        <h3 class="">¿Estas preparado para descubrir nuevos juegos de mesa y jugadores cerca de tu casa?<br>
         SENET, la web indispensable para cualquier jugador ya está disponible. <br></h3>

         <div class="row ">
          <div class=" box col-lg-4">
            <img src="View/imagenes/image.jpg" class=" d-block mx-auto img-fluid img-rounded" alt="Responsive image">
          </div>
          <div class=" col-lg-1"></div>
          <div class="  col-lg-5">
           <h1> Alquilar juegos </h1>

           <h3> En el fin de semana o en vacaciones, alquila y prueba nuevos juegos de mesa a bajo coste, sin ocupar tus estanterías. ¿Tienes juegos? 💰 Gana dinero poniéndolos en alquiler con toda seguridad gracias a una fianza.     </h3>    

           <h1>Vender tus juegos </h1>

           <h3> ¡Vacia tus estanterías vendiendo los juegos a los que ya nos juegas ♟️ ! ¡Utilizando SENET, contribuyes a dar una segunda vida a los juegos de mesa y al desarrollo de una economia circular y colaborativa !  🔁 </h3>

         </div>
       </div>
     </div>
   </div>


   <div class ="text-center mt-5 "><h1>¿ Como alquilar o vender juegos en Tres pasos?</h1><br> </div>               
   <div class ="text-center mt-5 "><h2> Nuestra aplicación es sencilla y eficaz </h2><br></div>
   
   <div class="card-deck">
    <div class="card-group " >

      <div class="card fondo shadow-lg p-3 mb-5 bg-white rounded media-body">
        <div class="card-body "> 
          <h1 class="card-title "> 1. El anuncio</h1>
          <h3 class="card-text"> Registra tus juegos en nuestra plataforma indicando su nombre y sus características.</h3>
        </div>
        <div class="card-footer">
          <small class="text-muted"><p>Crea tu baúl de juegos de forma sencilla</p></small>
        </div>
        <?php 
        if(isset($_SESSION["login_user"])){
          ?> <a href="ProponerJuegos.php" class=" p-3 mt-3  btn btn-primary stretched-link" style="font-size: 1.7rem;">Proponer Juegos</a> <?php
        }else{
          ?> <a href="login.html" class=" p-3 mt-3  btn btn-primary stretched-link" style="font-size: 1.7rem;">Iniciar session</a> <?php
        }
        
        ?>
        
      </div>

      <div class="card fondo shadow-lg p-3 mb-5 bg-white rounded media-body">
        <div class="card-body">
          <h1 class="card-title">2. El acuerdo</h1>
          <h3 class="card-text">Consulta las ofertas de venta o de alquiler de otros jugadores. Puedes aceptar o no, según tu disponibilidad, la fiabilidad del jugador, etc.</h3>
        </div>
        <div class="card-footer">
          <small class="text-muted"><p>Confianza en la transación</p></small>
        </div>
        <a href="buscoJuegos.php" class=" p-3 mt-3  btn btn-primary stretched-link"style="font-size: 1.7rem;">Busco Juegos</a>
      </div>

      <div class="card fondo shadow-lg p-3 mb-5 bg-white rounded  media-body">
       <div class="card-body">
        <h1 class="card-title">3. El encuentro</h1>
        <h3 class="card-text">Encuentra jugadores cerca de tu casa para compartir los juegos. Nuestra aplicación está basada en la confianza y en la proximidad.</h3>
      </div>
      <div class="card-footer">
       <small class="text-muted"><p>Cercanía y simplicidad</p></small>
     </div>
     <a href="#" class=" p-3 mt-3  btn btn-primary stretched-link"style="font-size: 1.7rem;">Go somewhere</a> 
   </div>

 </div>
</div>

<div class ="text-center mt-5 pt-5 "><h1> FAQ </h1><br> </div>               
<div class ="text-center mt-5 "><h3> Tiene una pregunta? Tal vez tenemos la respuesta. Si no encuentra lo que busca, puede consultar la versión completa o contactarnos. </h3><br></div>

<div class="container-fluid ">
  <div class="row " style="margin-bottom: 60px">
    <div class=" text-left  col-lg-8 fondo">
     <div class="accordion" id="accordionExample">

      <div class="card fondo">
        <div id="headingOne">
          <button type="button" class=" btn btn-outline-info  collapsible" data-toggle="collapse" 
          data-target="#collapseOne">Cual es la seguridad cuando se alquila un juego</button>           
        </div>

        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
          <div class="card-body ">
            <p>
              El alquilador paga una fianza ( fijada por el propietario antes de la locación) que se le devuelve al final de la transacción cuando las dos partes validan que todo se desarrolló correctamente. En caso de litigio, la fianza puede ser cargada parcialmente o totalmente según el caso.<br>
              Además, las evaluaciones aseguran la fiabilidad de un perfil y permiten identificar las personas que no respectan los juegos. <br> 
              En fin, en caso de piezas perdidas o estropeadas, tenemos contacto con los editores para intentar arreglar el problema en las mejores condiciones posibles.
            </p>
          </div>
        </div>
      </div>

      <br>

      <div class="card fondo">
        <div class="" id="headingTwo">
          <button type="button" class="  btn btn-outline-info  collapsible" data-toggle="collapse" data-target="#collapseTwo">Se puede negar a alquilar un juego si no corresponde al anuncio</button>
        </div>
        <div id="collapseTwo" class="collapse " aria-labelledby="headingTwo" data-parent="#accordionExample">
          <div class="card-body">
            <p>
              ¡Por supuesto! Si el juego no corresponde al anuncio, tienes la posibilidad de negar la locación. Para ello hay que mandar un email en los 24h a contacto@SENET.es para que cancelamos el alquiler, sin ningún coste para ti.
              <br> Si decides alquilarlo, piensa en mencionar las diferencias con el anuncio haciendo click en "He recuperado el juego" y después "Un problema?" para que no te sean imputadas en el futuro.
            </p>
          </div>
        </div>
      </div>

      <br>
      <div class="card fondo">
        <div class="" id="headingThree">

          <button type="button" class=" btn btn-outline-info  collapsible" data-toggle="collapse" data-target="#collapseThree">He reibido una proposicíon de alquiler, que hago?</button>                     

        </div>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
          <div class="card-body">
            <p>
              Es en la pestaña ✉️ (mensajería de la aplicación) donde puedes contestar a todas las proposiciones de alquiler. Antes de aceptar o rechazar una proposición, no olvides de ponerte de acuerdo con el alquilador sobre el lugar y la hora de la cita donde le entregaras el juego. Cuando aceptas una proposición, el alquilador recibe un email de confirmación que puede pagar el importe de la transacción para validarla. 
            </p>
          </div>
        </div>
      </div>

      <br>
      <div class="card fondo">
        <div class="" id="headingFoor">
          <button type="button" class="  btn btn-outline-info  collapsible" data-toggle="collapse" data-target="#collapseFoor">Como conocer el precio de alquiler de un juego?</button>

        </div>
        <div id="collapseFoor" class="collapse " aria-labelledby="headingFoor" data-parent="#accordionExample">
          <div class="card-body">
            <p>
              En el anuncio, solo el precio a la semana es mencionando para puedes hacer una simulación de locación para conocer el precio exacto de la locación para el tiempo que lo deseas. Mientras no has pagado, puedes volver atrás. Piensa también en contactar el propietario del juego si tienes dudas.
            </p>
          </div>
        </div>
      </div>
    </div>   
  </div>
</div>
</div>
</div>

</body>
