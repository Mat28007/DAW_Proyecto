<?php 

class ProductoControler
{
	function getProductoControler1 ()
	{
		require_once  'Model/product_class.php';
	}

	function getImageControler($nameJuego){
		$this->getProductoControler1();

			//$nombre_juego = $_GET['product_name'];
		$product = new Product();
		try
		{
			return $product->getImageFromName($nameJuego);
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
			die();
		}
	}

	function getProductName($nameJuego){
		$this->getProductoControler1();

		$product = new Product();
		try
		{
			return $product->getProductFromName($nameJuego);
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
			die();
		}
	}
	function getProducts()
	{
		$this->getProductoControler1();
		$product = new Product();
		try
		{
			return $product->getProducts();
			
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
			die();
		}
	}
	function getProductLessUsuarioActivo($name)
	{
		$this->getProductoControler1();
		$product = new Product();
		try 
		{
			return $product->getProductslessActiveUse($name);
		} catch (Exception  $e) {
			echo $e->getMessage();
			die();
		}
	}
		//Obtener id de los juegos del usuario activo
		function getlistGamesUsuario($usuarioID)
		{
				$this->getProductoControler1();
				$product = new Product();
				try {
					return $product->getlistGamesUsuario($usuarioID);
				} catch (Exception $e) {
					echo $e->getMessage();
					die();
				}
		}

	// A FAIRE/*************************************************************************
	function getPrecioDia(){
		$this->getProductoControler1();
		$product = new Product();
		try
		{
			return $product->getPriceDay();
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
			die();
		}
	}
		// insertar precios Juego ya existante
	function insertProductoPrecios($idGame,$usuarioID,$precioDia,$precioSemana,$precioFinSemana,$precioMes,$precioVenta)
	{
		  
		$this->getProductoControler1();
		$product = new Product();
		try {

		$product->insertPriceGame($idGame,$usuarioID,$precioDia,$precioSemana,$precioFinSemana,$precioMes,$precioVenta);
			
		} catch (Exception $e) {
			echo $e->getMessage();
			die();
		}
		echo 'Precios associados al juego: '.$idGame;
	}

	function insertProducto($nom,$imge, $description, $category, $maxJugadores,$minJugadores,$tiempoJuego,$ageJuego,$usuarioID,$precioDia,$precioSemana,$precioFinSemana,$precioMes,$precioVenta){
		
		$this->getProductoControler1();

		$product = new Product();
		try
		{
		
			$newId = $product->addProduct($nom,$imge, $description, $category, $maxJugadores,$minJugadores,$tiempoJuego,$ageJuego,$usuarioID,$precioDia,$precioSemana,$precioFinSemana,$precioMes,$precioVenta);

		}
		catch (Exception $e)
		{
			echo $e->getMessage();
			die();
		}
			echo 'Juego creado.';
	}
	

	function datos_imagen($files)
	{
		$nombre_imagen=$files['seleccionArchivos'] ['name'];
		$tipo_imagen=$files['seleccionArchivos'] ['type'];
		$taille_imagen=$files['seleccionArchivos'] ['size'];
		if ($taille_imagen<=3000000) {
			if ($tipo_imagen=="image/jpeg" || $tipo_imagen=="image/jpg"|| $tipo_imagen=="image/png"|| $tipo_imagen=="image/gif") {
				//ruta de la carpeta destino servidor
				$carpeta_destino=$_SERVER['DOCUMENT_ROOT'] .'/tmp/';
			
				move_uploaded_file(	$files['seleccionArchivos'] ['tmp_name'], $carpeta_destino.$nombre_imagen);
			}else{
				echo"formato incorrecto";
			}
		}else{
			echo"tamaño incorrecto";
		}
		return $nombre_imagen;
	}


	function searchProducto($searchTerm){
		$this->getProductoControler1();
		$product = new Product();
		try
		{
			return $product->buscarNombreJuego($searchTerm);
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
			die();
		}
	}


// Recuperamos el ID del juego a partir de su nombre
	function getIdFromNameControler($nombre_juego)
	{
		$this->getProductoControler1();
		$product = new Product();
		try
		{
			return $product->getIdFromName($nombre_juego);
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
			die();
		}
	}
//get precios de los juegos del usuario activo
	function getPreciosJuegoUsuario($id)
	{
		$this->getProductoControler1();
		$product = new Product();
		try {
			return $product->getPreciosId($id);
		} catch (Exception $e) {
			echo $e->getMessage();
			die();
		}

	}
//modificar Precios Juego
	function modifProducto($idJuego,$precioDia,$precioSemana,$precioFinSemana,$precioMes,$precioVenta)
	{
		$this->getProductoControler1();
		$product = new Product();
		try {
			$product->updatePriceGame($idJuego,$precioDia,$precioSemana,$precioFinSemana,$precioMes,$precioVenta);
		} catch (Exception $e) {
			echo $e->getMessage();
			die();
		}
	}
//eliminar precio juego de un usuario
	function deleteGameUser($idPrecioJuego)
	{
		$this->getProductoControler1();
		$product = new Product();
		try {
			$product->eliminarJuegoUsuario($idPrecioJuego);
		} catch (Exception $e) {
			echo $e->getMessage();
			die();
		}
	}
}

?>

