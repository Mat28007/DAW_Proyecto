<?php 
	
$game   = $_GET['b'];
$usuario = $_GET['a'];
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
									Alquiler juego de mesa !
								</td>
							</tr>
							<tr>
								<td height="30" style="font-size: 30px;line-height: 30px;"> &nbsp;</td> 
							</tr>
							<tr>
								<td align="center" style="text-align:center; font-family: 'Questrial',Helvetica, sans-serif;   mso-line-height-rule:exactly; line-height: 26px;">
							El usuario <?php echo  $usuario; ?> ha acceptado alquilarte <?php echo  $game; ?>.
							<br> 
							Puedes pasar a buscarlo... 
			
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

</body>
</html>