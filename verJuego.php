<?php 
session_start();
 ?>
<html>
<head>
	<title>Ver juego</title>

	<link rel="stylesheet" href="View/css/styleVerJuego.css">  
	<link rel="stylesheet" href="View/css/jquery-ui.css" />


</head>

<header>
	<?php 
 	 include_once 'View/includes/header.php'; 
	
	 	// incluimos el fichero para mandar el email de comprobacion.
	require_once 'Email/sendEmailUsuarioAlquiler.php';
	?>
	<!-- class de styleHeader.css   -->
	<div class="contenedoor2 "> </div>
</header>

<body>
	<div class="container-fluid contModif">
		<div class="row shadow">

			<div class="  col-sm-4 col-sm-push-8">
				<img src="/tmp/<?php echo $_GET["imagenJuego"]; ?>" class="imageborder d-block mx-auto img-fluid img-rounded" alt="Responsive image">
			</div>

			<div class=" col-sm-8 col-sm-pull-4 ">
				<h1 class="titulo"> 
<?php //echo"email:".$_SESSION['email_user']; ?>
					<?php  echo "El usuario ". "<span class='usuarioSpan'>" . $_GET["usuarioName"]. "</span>".	" te propone " . "<span class='JuegoSpan'>" . $_GET["nombreJuego"] . "</span>"; ?> 
				</h1>
				<?php 
				if(isset( $_SESSION['login_user']))
				{
						$data_toggle='collapse';

				}
				else{
						$data_toggle='';
						echo 'Debe iniciar session para alquilar o comprar un juego de otro usuario.';
				}
				 ?>
				<div class="" id="accordionExample">
					<div id="headingOne">
						<button type="button" class="titulo2"  data-toggle= "<?php echo $data_toggle ?>"

						data-target="#collapseOne"
						
						>
						<h2> Alquila el juego: </h2>
						<div class="price">
							<h4 id="price1"> ➤ <?php echo "<span class='precioSpan2'>" . $_GET["precioDia"].'€'. "</span>"; ?> al dia 
								➤ <?php echo  "<span class='precioSpan2'>" . $_GET["precioFinSemana"].'€'. "</span>"; ?> fin de semana  </h4>
								<h4 id="price2"> ➤ <?php echo  "<span class='precioSpan2'>" . $_GET["precioSemana"].'€'. "</span>"; ?> a la semana  
									➤ <?php echo  "<span class='precioSpan2'>" . $_GET["precioMes"].'€'. "</span>"; ?> al mes  </h4>
								</div>
							</button>           
						</div>
					
						<div id="collapseOne" class="collapse"  data-parent="#accordionExample">
							<div class="card-body ">
								<h1>Elegir la fecha:</h1>

								<div class="container ">
									<div class="row row-cols-4">
										<div class=" col-lg-1 ">
											<label for="datepicker" >Inicio:</label>
										</div>
										<div class=" col-lg-4 ">
											<input type="text" id="datepicker" name="datepicker">
										</div>
										<div class=" col-lg-1 "> 
											<label for="datepicker2" >Hasta:</label>
										</div>
										<div class=" col-lg-4 ">
											<input type="text" name="datepicker2" id="datepicker2">
										</div>
									</div>
								</div>
						
								<?php 

								$name=$description="";
								if(isset( $_SESSION['login_user']))
								{
									$name= $_SESSION['login_user'];
								}

								?>
								<h3><i class=" fa fa-edit"></i>Manda un email para reservar tu juego:</h3> 
								<?php 
							 $_SESSION['usuarioEmail']  = $_GET["usuarioEmail"]; 
							 $_SESSION['usuarioName']   = $_GET["usuarioName"]; 
							 $_SESSION['gameName']      = $_GET["nombreJuego"];
								
							if(isset($_POST['alquilarJuego']))
							{
							 $_SESSION['dateInicio'] 	= $_POST["datepicker"];
							 $_SESSION['dateFinal'] 	= $_POST["datepicker2"];
				
							}

									?> 
					<form method="POST" action="Email/sendEmailUsuarioAlquiler.php" >
						 <button class="btn btn-primary " style="margin-top:10px"   
							type="submit" id="alquilarJuego"name="alquilarJuego"><h3>Mandar Email</h3>
						</button>
					</form>
						
						</div>
					</div>
					<br>

					<div class="" id="headingTwo">
						<button type="button" class=" titulo2 " data-toggle= "<?php echo $data_toggle ?>" data-target="#collapseTwo">
							<h2 class="">Compra el juego: </h2>
							<h3>➤ Comprar por: <?php echo "<span class='precioSpan2'>" .  $_GET["precioVenta"].'€'. "</span>"; ?>
						</h3> 
					</button>
				</div>
					<?php 
						$description2= "Buenos dias, soy ". $name. " he visto tu juego de mesa ".$_GET["nombreJuego"]. " ,en la pagina web SENET. Me gustaria comprarlo.";
					 ?>
				<div id="collapseTwo" class="collapse " aria-labelledby="headingTwo" data-parent="#accordionExample">
					<div class="card-body">
						<p>
						<h3><i class=" fa fa-edit"></i>Manda un email para comprar el juego:</h3> 

								<form method="POST" action="Email/sendEmailUsuarioComprar.php" >
						 <button class="btn btn-primary " style="margin-top:10px"   
							type="submit" id="comprarJuego"name="comprarJuego"><h3>Mandar Email</h3>
						</button>
					</form>
						</p>
					</div>
				</div>
			</div>
			<br>
		</div>

	</div>
</div>

<div class="container tableModif">
	<h2><?php echo $_GET["nombreJuego"]  ?>:</h2>            
	<table class="table table-striped tableDescriptionJuego">
		<h3><?php echo $_GET["descripctionJuego"]  ?></h3> 
		<tbody>
			<tr>
				<th>Categoria</th>
				<td><?php echo $_GET["categoriaJuego"]  ?></td>
			</tr>
			<tr>
				<th>Núm. jugadores</th>
				<td><?php echo "De ". $_GET["numMinJuego"] . " a " . $_GET["numMaxJuego"] ." jugadores"?></td>
			</tr>
			<tr>
				<th>Tiempo de juego</th>
				<td><?php echo $_GET["tiempoJuego"] ." minutos" ?></td>
			</tr>
			<tr>
				<th>Edad</th>
				<td><?php echo "A partir de ". $_GET["tiempoJuego"] ." años" ?></td>
			</tr>
		</tbody>
	</table>
</div>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="View/templateJS/datePickeres.js"></script>
<script src="View/templateJS/verJuego.js"></script>

</body>
<div style="margin-top: 200px;"></div>
  

<?php include_once 'View/includes/footer.html';  ?>