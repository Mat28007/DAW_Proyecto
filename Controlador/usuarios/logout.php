<?php  
session_start();

require '../../Model/account_class.php';
$account = new Account();
$logout = FALSE;


try
{
	$login = $account->sessionLogin();

}
catch (Exception $e)
{
	echo $e->getMessage();
	die();
}
if($login){
	try
	{
		$logout= $account->logout();
		// remove all session variables
session_unset();

// destroy the session
session_destroy(); 	

	}
	catch (Exception $e)
	{
		echo $e->getMessage();
		die();

	}
}

header('location:../../index.php' );
?>