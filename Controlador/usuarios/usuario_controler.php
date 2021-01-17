<?php 

class UsuarioControler
{
		// Incluyo la configuración de BBDD
	function getUsuarioControler1 ()
	{

		require_once  'Model/account_class.php';
	}

	function getID(){
		$this->getUsuarioControler1();
		$account = new Account();
		try
		{
			$id= $account->getId();
			echo 'step1'.$id;
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
			die();
		}
	}
	
		

	function createUser($nombre, $email,$direccion, $cp, $password) 
	{
		$this->getUsuarioControler1();
		/* Create a new Account object */
		$account = new Account();
		try
		{
			$newId = $account->addAccount($nombre, $email,$direccion, $cp, $password);
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
			die();
		}
		echo 'The new account ID is ' . $newId;
	}

	function countNumUsuarios()
	{
		$this->getUsuarioControler1();
		$account = new Account();
		try
		{
			return	$numeroCiudades = $account->ContUsuarios();
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
			die();
		}
		
	}
	function ciudad(){
		$this->getUsuarioControler1();
		$account = new Account();
		try
		{
			$account->selectCiudad();
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
			die();
		}
	}
	function login(){
		$this->getUsuarioControler1();
		$account = new Account();
		try
		{
			return $login= $account->sessionLogin();

		}
		catch (Exception $e)
		{
			echo $e->getMessage();
			die();
		}
	}

	function getName(){
		$this->getUsuarioControler1();
		$account = new Account();
		try
		{
			return $name= $account->getName();

		}
		catch (Exception $e)
		{
			echo $e->getMessage();
			die();
		}

	}
	
	function modifUsuario($id, $name,$passwd, $password)
	{
		$this->getUsuarioControler1();
		$account = new Account();
		try 
		{
			 $account->editAccount($id, $name,$passwd, $password);
				echo'updated';
		} 
		catch (Exception $e) 
		{
			echo $e->getMessage();
			die();
		}
	}

	function getDatosUsuario($id)
	{
		$this->getUsuarioControler1();
		$account = new Account();
		try 
		{
			return $account->getDettalesCuentaUsuario($id);
		} 
		catch (Exception $e) 
		{
			echo $e->getMessage();
			die();
		}

	}
	//comprobar si el email introcucido existe
	function getEmails($email)
	{
		$this->getUsuarioControler1();
		$account = new Account();
		try {
			return $account->getEmails($email);
		} catch (Exception $e) {
			echo $e->getMessage();
			die();
		}

	}


}
	
?>