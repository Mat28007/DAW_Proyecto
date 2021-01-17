<?php
session_start();
require_once  '../Model/account_class.php';
$account = new Account();
if (isset($_GET['token'])) 
{
    $token = $_GET['token'];
        try
        {
            $verif= $account->verificarEmail($token);
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
            die();
        }
            if($verif)
            {
                $infoUser=    $account->getInfoFromToken($token);
                $username=    $infoUser['account_name'];
                $iduser  =    $infoUser['account_id'];
                $userEmail=   $infoUser['account_email'];
                $_SESSION['login_user']= $username;
                $_SESSION['id_user']   = $iduser;
                $_SESSION['email_user']= $userEmail;
                header('location:../index.php' ); 
            }
            else
            {
                header('location:../login.html' );
            }
}