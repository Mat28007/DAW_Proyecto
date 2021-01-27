<?php 
session_start();
?>

<head>
	<title>Modificar Cuenta usuario</title>
</head>

<header>
	<?php 
	require_once 'View/includes/headerSecundary.html';
	include_once 'Controlador/usuarios/usuario_controler.php';
	include_once 'Controlador/productos/Producto_controler.php';
	?>
</header>

<?php  
$id =  $_SESSION['id_user'];
$account = new UsuarioControler();
$res = $account->getDatosUsuario($id);

$name = $res['account_name'];
$passwd = $res['account_passwd'];
$email = $res ['account_email'];
$adress = $res['account_address'];
?>
<body>
<!--  Presentamos los datos personales del usuario para modificarlos    -->
<div class="container ">
	<div class="row main">
		<div class="panel-heading">
			<div class="panel-title text-center">
				<h1 class="title">SENET</h1>

				<h3> Hola, <?php echo  $name ?> <br> Modificar su datos personales</h3>	
			</div>
		</div> 
		<div class="main-login main-center">
			<form id="formCrearCuenta"class="form-horizontal" method="POST" action="Controlador/usuarios/modificar.php" onsubmit="return validation(this)" >

				<div class="form-group">
					<label for="name" class="cols-sm-2 control-label">Su nombre</label>
					<div class="cols-sm-10">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
							<input type="text"  class="form-control" name="nameModif" id="nameModif"  value="<?php echo $name;?>" >
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="email" class="cols-sm-2 control-label">Su Email</label>
					<div class="cols-sm-10">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
							<input type="email" class="form-control" name="emailModif" id="id_mail" onKeyUp="javascript:validateMail('id_mail')"  value="<?php echo $email; ?> "/>
						</div>
					</div>
				</div>


				<div class="form-group">
					<label for="address" class="cols-sm-2 control-label">Dirección</label>
					<div class="cols-sm-10">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-location-arrow fa" aria-hidden="true"></i></span>
							<input type="text" class="form-control" name="direccion" value="<?php echo $adress; ?> " id="direccion"  onKeyPress="javascript:validarAdresse()" >
						</div>
						<p style="margin:5px"></p>
					</div>
				</div>

				<div class="form-group">
					<label for="password" class="cols-sm-2 control-label">Contraseña</label>
					<div class="cols-sm-10">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
							<input type="password" class="form-control" name="passwordModif" id="passwordModif"  value=" <?php  echo $passwd ?> " />
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="confirm" class="cols-sm-2 control-label">Confirmar contraseña</label>
					<div class="cols-sm-10">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
							<input type="password"  class="form-control" name="confirm" id="confirm"  placeholder="Confirm your Password"/>
						</div>
					</div>
				</div>

				<div class="form-group ">
					<input type="hidden" id="tipo" value="crear">
					<input type="submit" class="btn btn-primary btn-lg btn-block login-button" value="Modificar usuario"  >
				</div>

				<div class="login-register">
					<a href="Controlador/usuarios/logout.php">Cerrar sessíon</a>
				</div>
				<input type="hidden" name="longitude" id="longitude">
				<input type="hidden" name="latitude" id="latitude">
				<input type="hidden" name="addrese" id="addrese">
				<input type="hidden" name="ciudad" id="ciudad">
				<input type="hidden" name="cp" id="cp">
				<input type="hidden" name="provincia" id="provincia">
			</form>
		</div>
	</div>
</div>
<!--  Presentamos los juegos del usuario para modificar los precios o eliminarlos  -->
<br>

<?php 
$labels = ['Juego', 'Precio dia', 'Precio fin de semana', 'Precio semana', 'Precio mes', 'Precio venta'];
$nbreLabels = count($labels); 
//get precios del juego del usuario
$preciosProductos= new ProductoControler();

if(isset($_POST['modificar'])) 
{
  $idJuego=			intval($_POST['idJuego']);
  $precioDia=       floatval($_POST['importeDia']);
  $precioSemana=    floatval($_POST['resulSemana']);
  $precioFinSemana= floatval($_POST['resulFindeSemana']);
  $precioMes=       floatval($_POST['resulMes']);
  $precioVenta=     floatval($_POST['importeVenta']);


 $preciosProductos->modifProducto($idJuego,$precioDia,$precioSemana,$precioFinSemana,$precioMes,$precioVenta);

}
if (isset($_POST['eliminar'])) {
	$idJuego=	intval($_POST['idJuego']);
	$preciosProductos->deleteGameUser($idJuego);
}


$resutados = $preciosProductos->getPreciosJuegoUsuario($id);
?> 

<div class="container ">
	<div class="row main">
		<div class="panel-heading">
			<div class="panel-title text-center">
				<h2> Modificar sus juegos </h2>	
			</div>
		</div>
	</div>

	
<table class="table table-striped table-sm   ">
		<thead > 
			<tr> <?php for($i=0; $i<$nbreLabels; $i++): ?> 
			<th> <?= $labels[$i] ?></th> 
		<?php endfor; ?> 
	</tr> 
</thead> 
<tbody> 
	<?php for($j=0; $j<count($resutados) ; $j++): ?>
	<form action="" method="POST" > 
		<tr>
		
			<td><strong><?php echo $resutados[$j]['product_name'];?></strong></td>
			<td>
				<input type="text" id='importeDia' name='importeDia' class="form-control form-control input-lg"  value="<?= $resutados[$j]['product_precioDia']." €";?>" ></td>
			<td>
				<input type="text"  id='resulFindeSemana' name='resulFindeSemana' class="form-control form-control input-lg"  value="<?= $resutados[$j]['product_finSemana']." €";?>" ></td>
			<td>
				<input type="text" id='resulSemana' name='resulSemana' class="form-control form-control input-lg" value="<?= $resutados[$j]['product_precioSemana']." €";?>" ></td>
			<td> 
				<input type="text"  id='resulMes' name='resulMes' class="form-control form-control input-lg" value="<?= $resutados[$j]['product_mes']." €";?>" ></td>
			<td>
				<input type="text" id='importeVenta' name='importeVenta' class="form-control form-control input-lg" value="<?= $resutados[$j]['product_venta']." €";?>" ></td>
	
			<td>
			<input type="hidden" name="idJuego" id="idJuego" value="<?php echo  $resutados[$j]['idPrecioJuego'];?>">
			<button  class="btn-info btn-lg" type="submit" name="modificar" id="modificar" >Modificar</button>
			</td>

			<td>	
			<input type="hidden" name="idJuego" id="idJuego" value="<?php  echo $resutados[$j]['idPrecioJuego']; ?>">
			<button   class="btn-warning btn-lg" type="submit" name="eliminar"  id="eliminar" >Eliminar</button>
			</td>
				
		</tr>  
	</form>
		<?php 
	endfor; ?>
</tbody> 
</table> 
</div>

<!-- key to be changed -->
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=key"></script>
<script src="Jquerydownloadfile/jquery-3.4.1.min.js"></script>

<script src="View/templateJS/crearCuenta.js" ></script>
<script type="text/javascript" src="bootstrap_dist/js/bootstrap.min.js"></script>
</body>

