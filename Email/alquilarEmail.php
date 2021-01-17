<?php 
$game   = $_GET['b'];
$usuario = $_GET['a'];
$emailUsuarioActivo=$_GET['c'];
 ?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns:v="urn:schemas-microsoft-com:vml">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
	<link href='https://fonts.googleapis.com/css?family=Questrial' rel='stylesheet' type='text/css'>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
	<!--HEADER -->
	<table  width="100%" border="0" cellpadding="0" cellspacing="0">
		<tbody>
			<tr>
				<td>
					<table  align="center" width="590px" border="0" cellpadding="0" cellspacing="0">
						<tbody>
							<tr>
								<td height="30" style="font-size: 30px;line-height: 30px;"> &nbsp;</td> 
							</tr>
							<tr>
								<td style="text-align:center;">
									<a href=""></a>
									<img src="https://senet.es/View/imagenes/o.png" alt="logo" width="100" border="0">

								</td>
							</tr>
							<tr>
								<td height="30" style="font-size: 30px;line-height: 30px;"> &nbsp;</td> 
							</tr>
							<tr>
								<td align="center" style="text-align:center; font-family: 'Questrial',Helvetica, sans-serif; font-size: 40px; mso-line-height-rule:exactly; line-height: 28px;">
									Alquiler de juego de mesa !
								</td>
							</tr>
							<tr>
								<td height="30" style="font-size: 30px;line-height: 30px;"> &nbsp;</td> 
							</tr>
							<tr>
								<td align="center" style="text-align:center; font-family: 'Questrial',Helvetica, sans-serif;   mso-line-height-rule:exactly; line-height: 26px;">
						El usuario, <?php echo  $usuario; ?> esta interesado en alquilar su juego de mesa <?php echo $game; ?>.
						Por favor compruebe que lo tiene disponible en estas fechas.
						Recuerda que puede ponerse en contacto con nosotros por cualquier duda que puedas tener. 
			
								</td>
							</tr>
							<tr>
								<td height="30" style="font-size: 30px;line-height: 30px;"> &nbsp;</td> 
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
		</tbody>
	</table>
	<!-- FIN HEADER -->

	<!-- TITRE -->
	<table bgcolor="#414655" width="100%" border="0" cellpadding="0" cellspacing="0">
		<tbody>
			<tr>
				<td height="30" style="font-size: 30px;line-height: 30px;"> &nbsp;</td> 
			</tr>
			<tr>
				<td>
					<table  align="center" width="590px" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<th align="center" style="text-align:center; font-family: 'Questrial',Helvetica, sans-serif; font-size: 40px; mso-line-height-rule:exactly; line-height: 28px;color:#FFFFFF;">Validar el alquiler
							</th>
						</tr>
						<tr>
							<td height="15" style="font-size: 15px;line-height: 15px;"> &nbsp;</td> 
						</tr>
						<tr>
							<td align="center">
								<table  align="center" width="24px" border="0" cellpadding="0" cellspacing="0" bgcolor="#7fffd4">
									<tbody>
										<tr>
											<td height="4" style="font-size: 4px;line-height: 4px;"> &nbsp;>
												
											</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
						<tr>
							<td height="30" style="font-size: 30px;line-height: 30px;"> &nbsp;</td> 
						</tr>
							<tr>
								<td align="center">

									<table align="center" width="240" cellspacing="0" cellpadding="0">
										<tbody>
											<tr>
												<td height="60" align="center"  bgcolor="#78ab4e" >
			<a href="https://senet.es/Email/emailConfirmation.php?emailUsuarioActivo=<?=$emailUsuarioActivo?>"  
				
													style="font-size: 18px; font-family: 'Questrial',Helvetica, sans-serif;color:#FFFFFF;vertical-align: middle;text-align: center; text-decoration: none;line-height: 60px;display: block;height: 60px;">Validar la transaccion.</a>
												</td>
											</tr>
										</tbody>
											
											<tr>
							<td height="30" style="font-size: 30px;line-height: 30px;"> &nbsp;</td> 
						</tr>
									</table>
								</td>
							</tr>
						<tr>
							
						</tr>
					</table>
				</td>
			</tr>
		</tbody>
	</table> 
</body>
</html>