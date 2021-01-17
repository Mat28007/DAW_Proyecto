<?php 
  session_start(); 

require_once("View/includes/headerSecundary.html");
include_once 'Controlador/usuarios/usuario_controler.php';
//1. debemos comprobar si el email introducido esta en la BDD.
$account = new UsuarioControler();



	$errors = array();
	
	if(!empty($_POST))
	{

		$email 		 = $_POST['email'];
		$emailExiste = $account->getEmails($email);
	
			// Validate email
		 function isEmail($email)
		{
			if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
		  return true;
		} 
		return false;
		}
		
		if(!isEmail($email))
		{
			$errors[] = "Debe ingresar un correo electronico valido";
		}
		
		if($emailExiste)
		{			
			$user_id = getValor('id', 'correo', $email);
			$nombre  = getValor('nombre', 'correo', $email);
			$token   = generaTokenPass($user_id);
			
			$url = 'http://'.$_SERVER["SERVER_NAME"].'/login/cambia_pass.php?user_id='.$user_id.'&token='.$token;
			
			$asunto = 'Recuperar Password - Sistema de Usuarios';
			$cuerpo = "Hola $nombre: <br /><br />Se ha solicitado un reinicio de contrase&ntilde;a. <br/><br/>Para restaurar la contrase&ntilde;a, visita la siguiente direcci&oacute;n: <a href='$url'>$url</a>";
			
			if(enviarEmail($email, $nombre, $asunto, $cuerpo)){
				echo "Hemos enviado un correo electronico a las direcion $email para restablecer tu password.<br />";
				echo "<a href='index.php' >Iniciar Sesion</a>";
				exit;
			}
			} else {
			$errors[] = "La direccion de correo electronico no existe";
		}
	}
?>





<html>
	<head>
		<title>Recuperar Password</title>
	</head>
	
	<body>
		
		<div class="container">    
			<div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
				<div class="panel panel-info" >
					<div class="panel-heading">
						<div class="panel-title">Recuperar Password</div>
						<div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="login.html">Iniciar Sesi&oacute;n</a></div>
					</div>     
					
					<div style="padding-top:30px" class="panel-body" >
						
						<div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
						
						<form id="loginform" class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">
							
							<div style="margin-bottom: 25px" class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
								<input id="email" type="email" class="form-control" name="email" placeholder="email" required>                                        
							</div>
							
							<div style="margin-top:10px" class="form-group">
								<div class="col-sm-12 controls">
									<button id="btn-login" type="submit" class="btn btn-success">Enviar</a>
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-md-12 control">
									<div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
										No tiene una cuenta! <a href="CrearCuentaUsuario.php">Registrate aquí</a>
									</div>
								</div>
							</div>    
						</form>
						<?php //echo resultBlock($errors); ?>
					</div>                     
				</div>  
			</div>
		</div>
	</body>
</html>