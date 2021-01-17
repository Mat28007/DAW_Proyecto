<?php 
session_start();
require'../PHPMailer-master/src/PHPMailer.php';
require'../PHPMailer-master/src/SMTP.php';
require'../PHPMailer-master/src/Exception.php';
require'../PHPMailer-master/src/OAuth.php';
require'../PHPMailer-master/src/POP3.php';
header('location:aprobacionEmail.php');
if (isset($_GET['emailUsuarioActivo'])) 
{
  $mail = new PHPMailer();
  $mail->CharSet = 'UTF-8';
  $body='';
	$destinarioEmail=$_GET['emailUsuarioActivo'];
    $usuario=    $_SESSION['usuarioName']; 	//nombre proprio juego
    $game=		 $_SESSION['gameName'];
    $body.=file_get_contents('https://senet.es/Email/comprarEmailConfirmation.php?a='.$usuario.'&b='.$game);

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
  $mail->Subject    = 'Confirmación de compra de un juego de mesa';
  $mail->MsgHTML($body);
  $mail->SMTPDebug = SMTP::DEBUG_SERVER;
  $mail->AddAddress($destinarioEmail, 'SENET');
  $mail->send();
}

 ?> 