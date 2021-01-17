
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Senet</title>

  <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700&display=swap" rel="stylesheet"> 
  <link rel="stylesheet" href="View/css/normalize.css">
  <link rel="stylesheet" href="bootstrap_dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="View/css/style.css">
  <link rel="stylesheet" href="View/css/styleHeader.css"> 
  <link rel="stylesheet" href="View/css/font-awesome.min.css">
  <link rel="stylesheet" href="View/css/footer.css"> 


</head>

<header>
<nav class="nav">

  <div class="container">
    <div class="logo">
      <a href="index.php"> <img src="View/imagenes/o.png" alt="Logotipo">SENET</a>
    </div>
    <div id="mainListDiv" class="main_list">
      
      <ul class="navlinks" >
        <?php 
       if(isset($_SESSION["login_user"]))
       {
          ?>
          <li>
            <a  href="ProponerJuegos.php">Proponer mis Juegos </a>
          </li>
          <li>
            <a  href="buscoJuegos.php">Busco Juegos</a>
          </li>
          <li>
           <a onclick="dropdownHeader()" class="dropbtn">
            <i class=" fa-user fa" aria-hidden="true"></i>
            <?php echo $_SESSION['login_user'];?>

            <div id="myDropdown" class="dropdown-content">
              
              <a href="#home">Home</a>
               <a href="ModificarCuentaUsuario.php">Preferencias</a>
              <a href="Controlador/usuarios/logout.php">Cerrar sessíon</a>
            
            </div>
          </a>   
      
       
        </li>
      <?php } else { ?>
        <li>
          <a  href="buscoJuegos.php">Busco Juegos</a>
        </li>
        <li>
          <a  href="login.html">Inicia sesión</a>
        </li>            
        <li>
          <a  href="CrearCuentaUsuario.php">Hazte una cuenta</a>
        </li>
      <?php    }  ?>
    </ul>
  </div>
  <span class="navTrigger">
    <i></i>
    <i></i>
    <i></i>
  </span>
</div>
</nav>

</header>
<script src="Jquerydownloadfile/jquery-3.4.1.min.js"></script>
<script src="bootstrap_dist/js/bootstrap.min.js"></script>
<script src="View/templateJS/index.js" ></script> 
<script src="View/templateJS/crearCuenta.js" ></script> 
<script src="View/templateJS/header.js" ></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>


