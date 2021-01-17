<?php

	// Incluyo la configuración de BBDD
	include('../../Model/config/db.php');
	
	try {
		
		// Recogemos los datos de BBDD
		$usuariosSql    = " SELECT * FROM accounts";
		$resusuariosSql = $connection->query($usuariosSql);


	} catch (Exception $e) {
		echo $e->getMessage();
	}

?>