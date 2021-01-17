<?php 

session_start();
/* Include the database connection file (remember to change the connection parameters) */
require '../Model/config/db.php';
/* Include the Account class file */
require '../Model/account_class.php';

require '../login.html';
/* Create a new Account object */
$account = new Account();
// 4. Login with username and password.
$login = FALSE;
$username=htmlentities(addslashes($_POST["login"]));
$password=htmlentities(addslashes($_POST["password"]));
	try
	{
		$login = $account->loginUsuario($username, $password);
	}
	catch (Exception $e)
	{
		echo $e->getMessage();
		die();
	}
				if ($login)
		{
			$_SESSION['login_user']= $username;
			$_SESSION['id_user']   = $account->getId();
try 
			{
				$row= $account->getDettalesCuentaUsuario($_SESSION['id_user']);
			} 
			catch (Exception $e) 
			{
				echo $e->getMessage();
				die();
			}
					
                $_SESSION['email_user']=  $row['account_email'];
                echo 'ici'. $_SESSION['email_user'];
			header('location:../index.php' );
		}
		else
		{
			header('location:../login.html' );
		}

?>
