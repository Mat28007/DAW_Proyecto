	
<?php 
require_once("View/includes/headerSecundary.html");
?>



<div class="container ">
	<div class="row main">
		<div class="panel-heading">
			<div class="panel-title text-center">
				<h1 class="title">SENET</h1>
				<h3>Crear una cuenta</h3>	
			</div>
		</div> 
		<div class="main-login main-center">
			
			<form id="formCrearCuenta"  action="Controlador/usuarios/crear.php" class="form-horizontal" method="POST"  >

				<div class="form-group">
					<label for="name" class="cols-sm-2 control-label">Su nombre</label>
					<div class="cols-sm-10">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
							<input type="text"  class="form-control" name="nombre" id="nombre"  placeholder="Escriba su nombre"/>
			
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="email" class="cols-sm-2 control-label">Su Email</label>
					<div class="cols-sm-10">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>

							<input type="email" class="form-control" name="email"  id="id_mail" 
							onKeyUp="javascript:validateMail('id_mail')"  placeholder="Escriba su Email"/>
							
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="address" class="cols-sm-2 control-label">Dirección</label>
					<div class="cols-sm-10">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-location-arrow fa" aria-hidden="true"></i></span>
							<input type="text" class="form-control" name="direccion" id="direccion"  onKeyPress="javascript:validarAdresse()" placeholder="Escriba su direccion" >
						</div>
						<p style="margin:5px"></p>
						</div>
					</div>

					<div class="form-group">
						<label for="password" class="cols-sm-2 control-label">Contraseña</label>
						<div class="cols-sm-10">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
								<input type="password" class="form-control" name="password" id="password"  placeholder="Enter your Password"/>
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
						<input type="hidden"    value="crear">
						<input type="submit" id="crearusuarioSubmit" name="crearusuarioSubmit" class="btn btn-primary btn-lg btn-block login-button" value="Crear usuario"  >
					</div>

					<div class="login-register">
						<a href="login.html">Login</a>
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
	
	<script src="Jquerydownloadfile/jquery-3.4.1.min.js"></script>
	<script src="View/templateJS/crearCuenta.js" ></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyAhS3viROB_tPYZ-MFSW1CHLpV9Mxxnyus"></script>

	