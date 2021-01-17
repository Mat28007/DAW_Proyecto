<?php

function sendEmailAlquiler()
{
	session_start();
require'../PHPMailer-master/src/PHPMailer.php';
require'../PHPMailer-master/src/SMTP.php';
require'../PHPMailer-master/src/Exception.php';
require'../PHPMailer-master/src/OAuth.php';
require'../PHPMailer-master/src/POP3.php';
header('location:confirmationEnvio.php');
  $mail = new PHPMailer();
  $mail->CharSet = 'UTF-8';
  $body='';
    	$game=		 $_SESSION['gameName'];
		$usuario=   $_SESSION["login_user"];
		$emailUsuarioActivo= $_SESSION['email_user'];
    $body.=file_get_contents('https://senet.es/Email/alquilarEmail.php?a='.$usuario.'&b='.$game.'&c='.$emailUsuarioActivo);

   $mail->SMTPOptions = array(
    'ssl' => array(
      'verify_peer' => false,
      'verify_peer_name' => false,
      'allow_self_signed' => true
    )
  );
  $mail->IsSMTP();
  $mail->Host       = 'smtp.gmail.com';
  $mail->SMTPSecure = 'tls';
  $mail->Port       = 587;
  $mail->SMTPDebug  = 1;
  $mail->SMTPAuth   = true;
  $mail->Username   = 'informationSenet@gmail.com';
  $mail->Password   = 'Info@000';
  $mail->SetFrom('informationSenet@gmail.com', "SENET");
  $mail->AddReplyTo('no-reply@mycomp.com','no-reply');
  $mail->Subject    = 'Solicitud de reserva de un juego de mesa';
  $mail->MsgHTML($body);
  $mail->SMTPDebug = SMTP::DEBUG_SERVER;
  $mail->AddAddress($_SESSION['usuarioEmail'], 'SENET');
  $mail->send();
  
}

if(isset($_POST['alquilarJuego'])){
  sendEmailAlquiler();
}