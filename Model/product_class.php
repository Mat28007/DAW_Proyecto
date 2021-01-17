<?php 
class Product
{

	/* Class properties (variables) */
	
	/* The ID of the logged in account (or NULL if there is no logged in account) */
	private $id;
	
	/* The name of the logged in account (or NULL if there is no logged in account) */
	private $name;
	
	private $image;
	/* Public class methods (functions) */
	
	/* Constructor */
	public function __construct()
	{
		/* Initialize the $id and $name variables to NULL */
		$this->id = NULL;
		$this->name = NULL;
		$this->image=NULL;

	}
	
	/* Destructor */
	public function __destruct()
	{
		
	}

	/* "Getter" function for the $id variable */
	public function getId(): int
	{
		return $this->id;
	}
	
	/* "Getter" function for the $name variable */
	public function getName(): string
	{
		return $this->name;
	}
	public function getImage():string
	{
		return $this->image;
	}
	
	/*  "Getter" function for the connection to the Data Base */
	private function getConection ()
	{
		require_once  'config/db.php';
		$connect = new Conection();
		return $connect->get_conexion();
	}

	public function listProductos(string $name)
	{
		/* Global $pdo object */
		$pdo = $this->getConection();

		/* Search all the products on the database */
		$query = 'SELECT * FROM products WHERE (product_name = :name)';
		$values = array(':name' => $name);

		/* Execute the query */
		try
		{
			$res = $pdo->prepare($query);
			$res->execute($values);
		}
		catch (PDOException $e)
		{
			/* If there is a PDO exception, throw a standard exception */
			throw new Exception('Database query error');
		}
		
		return $query->fetchAll();
	}

	public function verImagen(string $name)
	{
		/* Global $pdo object */
		$pdo = $this->getConection();

		/* Search all the products on the database */
		$query = 'SELECT product_image FROM products WHERE (product_name = :name)';
		$values = array(':image' => $image);

		/* Execute the query */
		try
		{
			$res = $pdo->prepare($query);
			$res->execute($values);
		}
		catch (PDOException $e)
		{
			/* If there is a PDO exception, throw a standard exception */
			throw new Exception('Database query error');
		}

		return $query->fetch();
	}

	/* Obtener los id de los juegos del usuario activo   */ 
	public function getlistGamesUsuario($usuarioID)
	{
		$pdo = $this->getConection();
		$query='SELECT idJuego
		FROM juegousuario 
		INNER JOIN products
		ON products.product_id=juegousuario.idJuego
		INNER JOIN  accounts 
		ON accounts.account_id=juegousuario.idUsuario 
		WHERE (idUsuario =:usuarioId)';
		try
		{
			$res = $pdo->prepare($query);
			$res->execute(array(':usuarioId' => $usuarioID));
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
		}
		$resultado = $res->fetchAll();
		return $resultado;
	}
	

	/*  Insert prices if the gameboard already exist  */
	public function insertPriceGame(int $idGame,int $usuarioID,float $precioDia,float$precioSemana,float$precioFinSemana,float$precioMes,float$precioVenta)
	{
		$pdo = $this->getConection();


		$nuevoJuegoUsuario=' INSERT INTO juegousuario (idJuego,idUsuario) VALUES (:idJuego,:idUsuario)';
		$values=array(':idJuego'=>$idGame, ':idUsuario'=>$usuarioID);
		try
		{
			$res = $pdo->prepare($nuevoJuegoUsuario);
			$res->execute($values);
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
		}

		$newGameUser= $pdo->lastInsertId();

		$precioJuego='INSERT INTO precio(product_precioDia,product_precioSemana,product_finSemana,product_mes,product_venta) VALUES(:precioDia,:precioSemana,:precioFinSemana,:precioMes,:precioVenta)';

		$values =array(':precioDia'=>$precioDia,':precioSemana'=>$precioSemana,':precioFinSemana'=>$precioFinSemana,':precioMes'=>$precioMes,':precioVenta'=>$precioVenta);

		try
		{
			$res = $pdo->prepare($precioJuego);
			$res->execute($values);
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
		}

		$newPriceGame= $pdo->lastInsertId();

		$precioJuegoUsuario='INSERT INTO juegoprecio (idJuego,idPrecioJuego,idUsuario) VALUES (:idJuego,:idPrecioJuego,:idUsuario)';
		$values=array(':idJuego'=>$idGame, ':idPrecioJuego'=>$newPriceGame, ':idUsuario'=>$usuarioID);
		try
		{
			$res = $pdo->prepare($precioJuegoUsuario);
			$res->execute($values);
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
		}

		return $pdo->lastInsertId();
	}



	/* Returns the Board Game having $name as name, or NULL if it's not found */
	public function getProductFromName(string $name)
	{
		$pdo = $this->getConection();
		$query = 'SELECT * FROM products WHERE product_name LIKE :name';
		try
		{
			$res = $pdo->prepare($query);
			$res->execute(array(':name' => $name));
		}
		catch (PDOException $e)
		{
			throw new Exception('Database query error');
		}
		$row = $res->fetch(PDO::FETCH_ASSOC);
		return $row;
	}


	/* Returns all the Board Games, or NULL if it's not found */
	public function getProducts()
	{
		
		$pdo = $this->getConection();
		$query ='SELECT products.*, precio.*, accounts.* 
		FROM products INNER JOIN juegoprecio ON products.product_id=juegoprecio.idJuego 
		INNER JOIN precio ON precio.idPrecioJuego= juegoprecio.idPrecioJuego 
		INNER JOIN accounts ON accounts.account_id=juegoprecio.idUsuario';
		try
		{
			$res = $pdo->prepare($query);
			$res->execute();
		}
		catch (PDOException $e)
		{
			throw new Exception('Database query error');
		}
		$resultado = $res->fetchAll();
		return $resultado;
	}
	/* Returns all the Board Games LESS The active User */
	public function getProductslessActiveUse($name){

		$pdo = $this->getConection();
		$query ='SELECT products.*, precio.*, accounts.* 
		FROM products 
		INNER JOIN juegoprecio ON products.product_id=juegoprecio.idJuego 
		INNER JOIN precio ON precio.idPrecioJuego= juegoprecio.idPrecioJuego 
		INNER JOIN accounts ON accounts.account_id=juegoprecio.idUsuario 
		WHERE (account_name !=:name)';

		try
		{
			$res = $pdo->prepare($query);
			$res->execute(array(':name' => $name));
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
		}
		$resultado = $res->fetchAll();
		return $resultado;
	}
	


	/* Returns the account image having $name as name, or NULL if it's not found */
	public function getImageFromName(string $name): string
	{
		/* Global $pdo object */
		$pdo = $this->getConection();


		/* Search the ID on the database */
		$query = 'SELECT product_image FROM products WHERE product_name LIKE :name';
		try
		{
			$res = $pdo->prepare($query);
			$res->execute(array(':name' => $name));
		}
		catch (PDOException $e)
		{
			/* If there is a PDO exception, throw a standard exception */
			throw new Exception('Database query error');
		}
		$row = $res->fetch(PDO::FETCH_ASSOC);

		/* There is a result: get it's ID */
		if (is_array($row))
		{
			$image = $row['product_image'];
		}		
		return $image;
	}

	public function buscarNombreJuego(string $term)
	{
		$pdo = $this->getConection();

		$stmt = $pdo->prepare("SELECT  * FROM products p  WHERE p.product_name LIKE :search GROUP BY product_name");
		$stmt->execute([':search' => $term.'%']);
		$lists = array();
		while (false !== ($row = $stmt->fetch())) {
			$var = $row["product_name"];
			array_push($lists, $var);
		}
		return ($lists);
	}

	/* Returns the account id having $name as name, or NULL if it's not found */
	public function getIdFromName(string $name)
	{
		$pdo = $this->getConection();

		/* Initialize the return value. If no account is found, return NULL */
		$id = NULL;
		$query = 'SELECT product_id FROM products WHERE (product_name = "'.$name.'")';
		$values = array(':name' => $name);
		try
		{
			$res = $pdo->prepare($query);
			$res->execute($values);
		}
		catch (PDOException $e)
		{
			/* If there is a PDO exception, throw a standard exception */
			throw new Exception('Database query error');
		}
		$row = $res->fetch(PDO::FETCH_ASSOC);
		/* There is a result: get it's ID */
		if (is_array($row))
		{
			$id = $row['product_id'];
		}	
		return $id;
	}


	/* Add a new account to the system and return its ID (the account_id column of the accounts table) */
	public function addProduct(string $name, string $image, string $description, string $categoria, int $maxPlayers, int $minPlayers,int $time, int $age ,int $usuarioID, float $precioDia,float $precioSemana,float $precioFinSemana,float $precioMes, float $precioVenta)
	{
		$pdo = $this->getConection();
		/* Trim the strings to remove extra spaces */
		$name = trim($name);
		$image = trim($image);
		$description =trim($description);
		$categoria=trim($categoria);

		// Check if an account having the same name already exists. If it does, throw an exception
	
		if (!is_null($this->getIdFromName($name)))
		{
			throw new Exception('Juego ya existe en la BDD');
		}

		/* Insert query template */
		$nuevoJuego = 'INSERT INTO products (product_name, product_description, product_category, product_playersMax, product_playersMin, product_time, product_age, product_image) VALUES (:name,  :description, :categoria, :maxplayers, :minplayers, :tiempo, :edad,:image)';
		/* Values array for PDO */
		$values = array(':name' => $name,  ':description' => $description, ':categoria' => $categoria,':maxplayers' => $maxPlayers,':minplayers' => $minPlayers, ':tiempo' => $time, ':edad' => $age,':image' => $image);
		
		try
		{
			$res = $pdo->prepare($nuevoJuego);
			$res->execute($values);
		}
		catch (Exception $e)
		{
			/* If there is a PDO exception, throw a standard exception */
			echo $e->getMessage();
		}
		$juego= $pdo->lastInsertId();

		$nuevoJuegoUsuario=' INSERT INTO juegousuario (idJuego,idUsuario) VALUES (:idJuego,:idUsuario)';
		$values=array(':idJuego'=>$juego, ':idUsuario'=>$usuarioID);

		/* Execute the query */
		try
		{
			$res = $pdo->prepare($nuevoJuegoUsuario);
			$res->execute($values);
		}
		catch (Exception $e)
		{
			/* If there is a PDO exception, throw a standard exception */
		//   throw new Exception('Database query error');
			echo $e->getMessage();
		}

		$newGameUser= $pdo->lastInsertId();

		$precioJuego='INSERT INTO precio (product_precioDia,product_precioSemana,product_finSemana,product_mes,product_venta) VALUES (:precioDia,:precioSemana,:precioFinSemana,:precioMes,:precioVenta)';
		$values =array(':precioDia'=>$precioDia,':precioSemana'=>$precioSemana,':precioFinSemana'=>$precioFinSemana,':precioMes'=>$precioMes,':precioVenta'=>$precioVenta);
		/* Execute the query */
		try
		{
			$res = $pdo->prepare($precioJuego);
			$res->execute($values);
		}
		catch (Exception $e)
		{
			/* If there is a PDO exception, throw a standard exception */
		//   throw new Exception('Database query error');
			echo $e->getMessage();
		}

		$newPriceGame= $pdo->lastInsertId();

		$precioJuegoUsuario='INSERT INTO juegoprecio (idJuego,idPrecioJuego,idUsuario) VALUES (:idJuego,:idPrecioJuego,:idUsuario)';
		$values=array(':idJuego'=>$juego, ':idPrecioJuego'=>$newPriceGame, ':idUsuario'=>$usuarioID);
		try
		{
			$res = $pdo->prepare($precioJuegoUsuario);
			$res->execute($values);
		}
		catch (Exception $e)
		{
			/* If there is a PDO exception, throw a standard exception */
		//   throw new Exception('Database query error');
			echo $e->getMessage();
		}

		return $pdo->lastInsertId();
	}

	//Devuelve los precios y nombres de los juegos del usuario activo
	public function getPreciosId($id) 
	{	

		$pdo = $this->getConection();

		$query='SELECT products.*, precio.* FROM products 
		INNER JOIN juegoprecio ON products.product_id=juegoprecio.idJuego 
		INNER JOIN precio ON precio.idPrecioJuego= juegoprecio.idPrecioJuego  
		INNER JOIN accounts ON accounts.account_id=juegoprecio.idUsuario WHERE (account_id=:id)';

		try
		{
			$res = $pdo->prepare($query);
			$res->execute(array(':id'=>$id));
			
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
		}
		$resultado = $res->fetchAll();
		return $resultado;

	}

	//modifica los precios del juego de mesa del usuario
	public function updatePriceGame(int $id, float $pdia, float $pfs, float $ps, float $pm, float $pv )
	{

		$pdo = $this->getConection();
		$query = 'UPDATE precio 
		SET product_precioDia = :pdia, product_precioSemana  = :ps, product_finSemana  = :pfs, product_mes  = :pm, product_venta = :pv WHERE idPrecioJuego = :id';
		/* Values array for PDO */
		$values = array(':pdia' => $pdia, ':ps' => $ps, ':pfs' => $pfs, ':pm'=>$pm,':pv'=>$pv,':id' => $id);
		/* Execute the query */

		try
		{
			$res = $pdo->prepare($query);
			$res->execute($values);

		}
		catch (PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function eliminarJuegoUsuario(int $id){
		$pdo = $this->getConection();
		/* Query template */
		$query = 'DELETE FROM precio WHERE (idPrecioJuego = :id)';
		
		/* Values array for PDO */
		$values = array(':id' => $id);
		
		/* Execute the query */
		try
		{
			$res = $pdo->prepare($query);
			$res->execute($values);
		}
		catch (PDOException $e)
		{
			/* If there is a PDO exception, throw a standard exception */
			echo $e->getMessage();
		}
		
	}

}


?>	


