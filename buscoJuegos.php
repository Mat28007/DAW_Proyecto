<?php 
session_start();
?>
<html>
<head>
	<title>Buscar juegos</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

</head>
<header>
	<?php 
  include_once 'View/includes/header.php'; 
  include_once 'Controlador/usuarios/usuario_controler.php';
  include_once 'Controlador/productos/Producto_controler.php';
  require_once 'Faker-1.9.1/src/autoload.php';
  ?>
  <!-- class de styleHeader.css   -->
  <div class="contenedoor2 "> </div>
</header>

<body>
	<div class ="text-center mt-5  ">
		<h1 class="section-heading  ">Buscar vuestro juego de mesa</h1><br>
	</div>

	<div  id="content" class=" d-flex justify-content-center" >
   <form action="" method="POST" role="search" > 
     <div class="p-1 bg-info rounded rounded-pill shadow-lg p-1 mb-1 rounded">
      <div class="input-group mb-1">
       <input  type="text" autocomplete="off" placeholder="Búsqueda en catálogo" name="" id=""  aria-describedby="button-addon1" 
       class="form-control border-0 bg-info">
       <div class="input-group-append">
        <button id="" class="btn btn-link text-primary">
         <i class="fa fa-search fa-5x "></i>
       </button>
     </div>
   </div>
 </div>
 <div id="suggestions" class=" overflow-auto"></div>
</form>
</div>

<?php $faker=Faker\Factory::create();?>


<?php 
$productos = new ProductoControler();
//contar num de usuarios de la BDD
$account = new UsuarioControler();
$num = $account->countNumUsuarios();
//Hay que controlar que los juegos que se muestran no sean del usuario activo
//Puede ser que sea null si no ha hecho login
$name="";
if(isset( $_SESSION['login_user']))
{
  $name= $_SESSION['login_user'];
        //recuperar informacion necesaria de los juegos menos la del usuario activo
  $juegos=  $productos -> getProductLessUsuarioActivo($name);
}
else
{
 $juegos=  $productos -> getProducts();
}
//echo 'numero de usuarios : '.$num.' y numeros de juegos '.count($juegos). ' usuario activo:'. $name;

?>

<div class="cont">
  <div class="list">
    <?php 
    $idJ=$url_onclick='';
    for ($i=0; $i <count($juegos) ; $i++)
    { 
      $url_onclick = "verJuego.php?nombreJuego=".$juegos[$i]['product_name']
      ."&precioDia=".$juegos[$i]['product_precioDia']
      ."&precioSemana=".$juegos[$i]['product_precioSemana']
      ."&precioFinSemana=".$juegos[$i]['product_finSemana']
      ."&precioMes=".$juegos[$i]['product_mes']
      ."&precioVenta=".$juegos[$i]['product_venta']
      ."&usuarioName=".$juegos[$i]['account_name']
      ."&usuarioEmail=".$juegos[$i]['account_email']
      ."&imagenJuego=".$juegos[$i]['product_image']
      ."&categoriaJuego=".$juegos[$i]['product_category']
      ."&numMinJuego=".$juegos[$i]['product_playersMin']
      ."&numMaxJuego=".$juegos[$i]['product_playersMax']
      ."&tiempoJuego=".$juegos[$i]['product_time']
      ."&edadJuego=".$juegos[$i]['product_age']
      ."&descripctionJuego=".$juegos[$i]['product_description'];
      
      ?>

      <div class="item js-marker" id="items" 
      onclick="location.href='<?= $url_onclick ?>'"
      data-lat="<?=  $juegos[$i]['account_lat'] ?> "
      data-lng="<?=  $juegos[$i]['account_lon']  ?> "
      data-price="<?php echo $juegos[$i]['product_precioDia'] ?>">
      <img src="/tmp/<?php echo $juegos[$i]['product_image'] ?>" alt="" >
      <h3><?php echo  $juegos[$i]['product_name'] ?> </h3>
      <?php 
      if($juegos[$i]['product_precioDia']==0 || $juegos[$i]['product_precioDia']=='')
      {
        $juegos[$i]['product_precioDia']=0;
      }
      ?>
      <?php echo  "Alquiler al dia: "."<span class='precioSpan'>" . $juegos[$i]['product_precioDia'].'€'. "</span>";?></p>
    </div> 
    <?php 
  } 
  ?>

</div>

<div class="map" id="map"></div>

</div>

<script src="View/templateJS/vendor.js"></script>
<script src="View/templateJS/map.js"></script>
</body>


<div style="margin-top: 200px;"></div>


<?php include_once 'View/includes/footer.html';  ?>
