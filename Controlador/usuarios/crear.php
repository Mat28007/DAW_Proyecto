<?php 
 session_start();

	/* Include the Account class file */
	require '../../Model/account_class.php';
	// incluimos el fichero para mandar el email de comprobacion.
	require_once '../../Email/sendEmails.php';

	// Recuperamos los datos del formulario Usuarios
		$id  = $cp  = 0;
		$nombre  = $email = $direccion = $ciudad = $provincia = $password = "";

	  	$nombre 	= $_POST['nombre'];
		$email      = $_POST['email'];
		$direccion  = $_POST['addrese'];
		$ciudad		= $_POST['ciudad'];
		$cp         = $_POST['cp'];
		$provincia	= $_POST['provincia'];
		$password 	= $_POST['password'];
		$lat 		= floatval($_POST['latitude']);
		$long 		= floatval($_POST ['longitude']);
		if($cp=='cp'|| $cp==""){
			$cp=00000;
		}
		$account = new Account();
		try
		{
			$newId = $account->addAccount($nombre, $email,$direccion,$cp,$ciudad,$provincia,$lat,$long,$password);
			var_dump($newId);
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
			die();
		}
		if($newId!='')
		{
			try 
			{
				$row= $account->getDettalesCuentaUsuario($newId);
			} 
			catch (Exception $e) 
			{
				echo $e->getMessage();
				die();
			}
				$token=$row['account_token'];			
				/*   Mandar email de comprobacion al usuario */		    
				$_SESSION['message'] = 'You are logged in!';
				$_SESSION['type'] = 'alert-success';
				$_SESSION['username'] = $nombre;
				$_SESSION['verified'] = 0;
				$_SESSION['email'] = $email;
				header('location:../../Email/infoUsuarioValidarEmail.php' );
				sendVerificationEmail($email, $token);
			}
 ?>

