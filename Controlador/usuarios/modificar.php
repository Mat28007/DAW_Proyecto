<?php 
session_start();
	// Incluyo la configuración de BBDD
	include('../../Model/config/db.php');
	/* Include the Account class file */
	require '../../Model/account_class.php';
	// Recuperamos los datos del formulario modificar Usuarios
		$cp  = 0;
		$nombre  = $email = $direccion = $ciudad = $provincia = $password = "";
		$id 		= $_SESSION['id_user'];
	  	$nombre 	= $_POST['nameModif'];
	  	$password 	= $_POST['passwordModif'];
		$email      = $_POST['emailModif'];
		$direccion  = $_POST['direccion'];
		$ciudad		= $_POST['ciudad'];
		$cp         = $_POST['cp'];
		$provincia	= $_POST['provincia'];
		$lat 		= floatval($_POST['latitude']);
		$long 		= floatval($_POST ['longitude']);
		$intEnabled=1;
		if($cp=='cp'|| $cp==""){
			$cp=00000;
		}

$account = new Account();
try
{
$account->editAccount($id, $nombre, $password,$intEnabled, $email, $direccion, $cp, $ciudad, $provincia, $lat, $long);
}
catch (Exception $e)
{
	echo $e->getMessage();
	die();
}

echo 'Cuenta modificada ';
header('location:../../index.php' );


 
 