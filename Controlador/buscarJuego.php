
<?php

	// Validamos los parámetros de entrada
	$myInput = $_POST['myInput'];
	echo 'MYINPUT-> ' .$myInput;
	include_once '../Controlador/productos/Producto_controler.php';	
	// Accedemos a BBDD con el título del input (myInput) y obtenemos el nombre de la imagen
	  $product = new ProductoControler();
      $imge=$product->getImageControler($myInput);

	echo $image;


?>