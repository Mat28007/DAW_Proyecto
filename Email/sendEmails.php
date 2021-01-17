<?php
require'../../PHPMailer-master/src/PHPMailer.php';
require'../../PHPMailer-master/src/SMTP.php';
require'../../PHPMailer-master/src/Exception.php';
require'../../PHPMailer-master/src/OAuth.php';
require'../../PHPMailer-master/src/POP3.php';


function sendVerificationEmail($userEmail, $token)
{
  $mail = new PHPMailer();
  $mail->CharSet = 'UTF-8';
  $body='';
 /*Enviando Paginas HTML
Entonces si deseamos enviar una página, deberíamos tener el contenido de esta página en una variable y luego asignársela a la propiedad Body. Para lograr esto haremos uso de la función file_get_contents el cual devuelve el contenido de una archivo en una variable.*/

  $body.=file_get_contents('https://senet.es/Email/validarEmail.php?a='.$token);

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
  $mail->Subject    = 'Validacion del Email.';
  $mail->MsgHTML($body);
  $mail->SMTPDebug = SMTP::DEBUG_SERVER;
  $mail->AddAddress($userEmail, 'SENET');
  $mail->send();
}




?>