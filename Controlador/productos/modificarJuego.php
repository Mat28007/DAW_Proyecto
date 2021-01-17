<?php 
session_start();
require_once  '../../Model/product_class.php';
// Recuperamos el ID del juego a modificar
	 $id      = $_POST["id"];
	 $pdia    = $_POST["product_precioDia"];
	 $pfs  	  = $_POST["product_finSemana"];
	 $ps      = $_POST["product_precioSemana"];
	 $pm      = $_POST["product_mes"];
	 $pv      = $_POST["product_venta"];

$product = new Product($id,$pdia,$pfs,$ps,$pm,$pv);
try
		{
			return $product->updatePriceGame($id,$pdia,$pfs,$ps,$pm,$pv);
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
			die();
		}
 ?>