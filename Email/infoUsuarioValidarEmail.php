<?php 
  session_start(); 
  ?>

  <link rel="stylesheet" href="../View/css/style.css">

  <div class="container">
    <div class="row">
      <div class="col-md-4 offset-md-4 home-wrapper">
        <h4>Bienvenido! <?php echo $_SESSION['username']; ?></h4>

        <?php if ($_SESSION['verified']==0){ ?>
          <div class="" role="alert">
          Debe validar su direccion email. <br>
          Por favor haga click en el email de comprobación que le hemos enviado a: 

            <strong><?php echo $_SESSION['email']; ?></strong>
          </div>
      
          <?php }?>
      </div>
    </div>
  </div>

