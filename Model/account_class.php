<?php

class Account
{
	/* Class properties (variables) */
	
	/* The ID of the logged in account (or NULL if there is no logged in account) */
	private $id;
	private $email;
	/* The name of the logged in account (or NULL if there is no logged in account) */
	private $name;
	
	/* TRUE if the user is authenticated, FALSE otherwise */
	private $authenticated;

	private $ciudad;
	/* Public class methods (functions) */

	/* Constructor */
	public function __construct()
	{
		/* Initialize the $id and $name variables to NULL */
		$this->id = NULL;
		$this->name = NULL;
		$this->authenticated = FALSE;
		$this->ciudad = NULL;
		$this->email = NULL;
	}
	
	/* Destructor */
	public function __destruct()
	{
		
	}
	/*The :int, :bool etc. syntax defines the function return value. So, :bool means the function returns a Boolean, :int means the function returns an Integer number.
	The ? before int, : ?int, simply means that the function can also return a NULL value.*/

	/* "Getter" function for the $id variable */
	public function getId()
	{
		return $this->id;
	}
		public function getEmail()
	{
		return $this->email;
	}
	
	/* "Getter" function for the $name variable */
	public function getName()
	{
		return $this->name;

	}
	
	/* "Getter" function for the $authenticated variable */
	public function isAuthenticated()
	{
		return $this->authenticated;
	}
	/* "Getter" function for the $ciudad variable */
	public function getCiudad()
	{
		return $this->ciudad;
	}
	/* "Getter" function for the $ciudad variable */
	public function getLat(): string
	{
		return $this->lat;
	}
	/* "Getter" function for the $ciudad variable */
	public function getLong(): string
	{
		return $this->long;
	}
	/*  "Getter" function for the connection to the Data Base */
	private function getConection ()
	{
		require_once  'config/db.php';
		$connect = new Conection();
		return $connect->get_conexion();
	}
	
	/* Add a new account to the system and return its ID (the account_id column of the accounts table) */
	public function addAccount(string $name, string $email, string $direccion,int $cp, string $ciudad, string $provincia, float $lat,float $long, string $passwd ): int
	{
		/* Global $pdo object */
		$pdo = $this->getConection();
		var_dump($pdo);
		/* Trim the strings to remove extra spaces */
		$name = trim($name);
		$passwd = trim($passwd);
		$direccion =trim($direccion);
		$ciudad=trim($ciudad);
		$email=trim($email);
		
		
		/* Check if the user name is valid. If not, throw an exception */
		if (!$this->isNameValid($name))
		{
			throw new Exception('Invalid user name');
		}
		
		/* Check if the password is valid. If not, throw an exception */
		if (!$this->isPasswdValid($passwd))
		{
			throw new Exception('Invalid password');
		}
		
		/* Check if an account having the same name already exists. If it does, throw an exception */
		if (!is_null($this->getIdFromName($name)))
		{
	
			throw new Exception('User name not available');
		}
		// generate unique token
		$token = bin2hex(random_bytes(16)); 

		// Check if email already exists
	/*	if (!$this->isEmailExist($email))
		{
			throw new Exception('Email already exists');
		}
   */
		/* Finally, add the new account */
		
		/* Insert query template */
		$query = 'INSERT INTO accounts (account_name, account_token, account_email,account_address,account_cp,account_ciudad,account_provincia,account_lat,account_lon,account_passwd,account_enabled) VALUES (:name,:token, :email, :address, :cp,:ciudad,:provincia,:lat,:long,:passwd,:enabled)';
		
		/* Password hash */
		$hash = password_hash($passwd, PASSWORD_DEFAULT);
		/* Validacion email = false */
		$enabled=0;
		
		/* Values array for PDO */
		$values = array(':name' => $name, ':token'=>$token,':email' => $email, ':address' => $direccion, ':cp' => $cp,':ciudad'=>$ciudad,':provincia'=>$provincia, ':lat'=>$lat,':long'=>$long, ':passwd' => $hash,':enabled'=>$enabled);
		
		/* Execute the query */
		try
		{
			$res = $pdo->prepare($query);
			$res->execute($values);
		}
		catch (Exception $e)
		{
			/* If there is a PDO exception, throw a standard exception */
			echo $e->getMessage();
		}

		/* Return the new ID */
		return $pdo->lastInsertId();
	}



	// Check if email already exists
	public function isEmailExist(string $email):bool
	{
		$pdo = $this->getConection();
		$query = 'SELECT account_email FROM accounts WHERE (account_email=:email) LIMIT 1';
		$values = array(':email' => $email);
			try
			{
				$res = $pdo->prepare($query);
				$res->execute($values);
			}
			catch (PDOException $e)
			{
				throw new Exception('Database query error');
			}
			$row = $res->fetch(PDO::FETCH_ASSOC);
			/* Check if there is a result*/
			if (is_array($row))
			{
			//return false si email no existe en la DBB
			return false;
			}
			return true;
		}


	/* Comprobacion del email del usuario ->account_enabled->1 si email OK. */
	public function verificarEmail($token):bool
	{
		$pdo = $this->getConection();
		$row = $this->getInfoFromToken($token);
		$idd=$row['account_id'];
		$this->registerLoginSession2($idd);
			if($row>0)
			{
				$query='UPDATE accounts SET account_enabled=1 WHERE (account_token =:token)';
				/* Values array for PDO */
				$values = array(':token' => $token);
				try {
				$res = $pdo->prepare($query);
				$res->execute($values);

				} catch (Exception $e) {
					echo $e->getMessage();
				}

				return true;
			}
			return false;
	}

	/*get user Info from Token */
	public function getInfoFromToken($token)
	{
		$pdo = $this->getConection();
		$query='SELECT * FROM accounts WHERE (account_token =:token) LIMIT 1';
		$values = array('token'=>$token);
		try {
			$res = $pdo->prepare($query);
			$res->execute($values);

		} catch (Exception $e) {
			echo $e->getMessage();
		}
		$row = $res->fetch(PDO::FETCH_ASSOC);
		return $row;
	}
	    

	
	/* Delete an account (selected by its ID) */
	public function deleteAccount(int $id)
	{
		/* Global $pdo object */
		$pdo = $this->getConection();
		
		/* Check if the ID is valid */
		if (!$this->isIdValid($id))
		{
			throw new Exception('Invalid account ID');
		}
		
		/* Query template */
		$query = 'DELETE FROM accounts WHERE (account_id = :id)';
		
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
			throw new Exception('Database query error');
		}
		
		/* Delete the Sessions related to the account */
		$query = 'DELETE FROM account_sessions WHERE (account_id = :id)';
		
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
			throw new Exception('Database query error');
		}
	}
	
	/* Edit an account (selected by its ID). The name, the password and the status (enabled/disabled) can be changed */
	public function editAccount(int $id, string $name, string $passwd, bool $enabled,string $email, string $direccion,int $cp, string $ciudad, string $provincia, float $lat,float $long)

	{
		/* Global $pdo object */
		$pdo = $this->getConection();
		
		/* Trim the strings to remove extra spaces */
		$name = trim($name);
		$passwd = trim($passwd);
		$direccion =trim($direccion);
		$ciudad=trim($ciudad);
		$email=trim($email);
		
		/* Check if the ID is valid */
		if (!$this->isIdValid($id))
		{
			throw new Exception('Invalid account ID');
		}
		
		/* Check if the user name is valid. */
		if (!$this->isNameValid($name))
		{
			throw new Exception('Invalid user name');
		}
		
		/* Check if the password is valid. */
		if (!$this->isPasswdValid($passwd))
		{
			throw new Exception('Invalid password');
		}
		
		/* Check if an account having the same name already exists (except for this one). */
		$idFromName = $this->getIdFromName($name);
		
		if (!is_null($idFromName) && ($idFromName != $id))
		{
			throw new Exception('User name already used');
		}
		
		/* Finally, edit the account */
		$query = 'UPDATE accounts SET account_name = :name, account_passwd  = :passwd, account_enabled = :enabled, account_email = :email, account_address = :address, account_cp = :cp, account_ciudad= :ciudad,
		account_provincia= :provincia, account_lat = :lat, account_lon = :lon WHERE account_id = :id';
		
		/* Password hash */
		$hash = password_hash($passwd, PASSWORD_DEFAULT);
		
		/* Int value for the $enabled variable (0 = false, 1 = true) */
		$intEnabled = $enabled ? 1 : 0;
		
		/* Values array for PDO */
		$values = array(':name' => $name, ':passwd' => $hash, ':enabled' => $intEnabled, ':email'=>$email,':address'=>$direccion,':cp'=>$cp,':ciudad'=>$ciudad,':provincia'=>$provincia,':lat'=>$lat,':lon'=>$long,':id' => $id);
		
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
	



	/* Login with username and password */
	public function loginUsuario(string $name, string $passwd): bool
	{
		/* Global $pdo object */
		//global $pdo;
		$pdo = $this->getConection();
		
		/* Trim the strings to remove extra spaces */
		$name = trim($name);
		$passwd = trim($passwd);
		
		/* Check if the user name is valid. If not, return FALSE meaning the authentication failed */
		if (!$this->isNameValid($name))
		{
			return FALSE;
		}
		
		/* Check if the password is valid. If not, return FALSE meaning the authentication failed */
		if (!$this->isPasswdValid($passwd))
		{
			return FALSE;
		}
		
		/* Look for the account in the db. Note: the account must be enabled (account_enabled = 1) */
		$query = 'SELECT * FROM accounts WHERE (account_name = :name) AND (account_enabled = 1)';
		
		/* Values array for PDO */
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
		
		$row = $res->fetch(PDO::FETCH_ASSOC);
		
		/* If there is a result, we must check if the password matches using password_verify() */
		if (is_array($row))
		{
			if (password_verify($passwd, $row['account_passwd']))
			{
				/* Authentication succeeded. Set the class properties (id and name) */
				$this->id = intval($row['account_id'], 10);
				$this->name = $name;
				$this->authenticated = TRUE;				

/*Once the remote client has been authenticated, this function gets the ID of the current PHP Session and saves it on the database together with the account ID.
This way, the next time the same remote client will connect, it will be automatically authenticated just by looking at its Session ID.
(The Session ID is linked to the remote browser, so it will remain the same the next time the same client will connect again).
*/
/* Register the current Sessions on the database */
$this->registerLoginSession();

/* Finally, Return TRUE */
return TRUE;
}
}

/* If we are here, it means the authentication failed: return FALSE */
return FALSE;
}




/* A sanitization check for the account username */
public function isNameValid(string $name): bool
{
	/* Initialize the return variable */
	$valid = TRUE;

	/* check: the length must be between 8 and 16 chars */
	$len = mb_strlen($name);

	if (($len <2) || ($len > 16))
	{
		$valid = FALSE;
	}
	return $valid;
}

/* A sanitization check for the account password */
public function isPasswdValid(string $passwd): bool
{
	/* Initialize the return variable */
	$valid = TRUE;

	/* check: the length must be between 8 and 16 chars */
	$len = mb_strlen($passwd);

	if (($len < 2) || ($len > 16))
	{
		$valid = FALSE;
	}
	return $valid;
}

/* A sanitization check for the account ID */
public function isIdValid(int $id): bool
{
	/* Initialize the return variable */
	$valid = TRUE;
	/* check: the ID must be between 1 and 1000000 */
	if (($id < 1) || ($id > 1000000))
	{
		$valid = FALSE;
	}
	return $valid;
}

/* Login using Sessions */
public function sessionLogin(): bool
{
	$pdo = $this->getConection();
	/* Check that the Session has been started */
	if (session_status() == PHP_SESSION_ACTIVE)
	{
			/* 
				Query template to look for the current session ID on the account_sessions table.
				The query also make sure the Session is not older than 7 days
			*/
				$query = 

				'SELECT * FROM account_sessions, accounts WHERE (account_sessions.session_id = :sid) ' . 
				'AND (account_sessions.login_time >= (NOW() - INTERVAL 7 DAY)) AND (account_sessions.account_id = accounts.account_id) ' . 
				'AND (accounts.account_enabled = 1)';

				/* Values array for PDO */
				$values = array(':sid' => session_id());

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

				$row = $res->fetch(PDO::FETCH_ASSOC);

				if (is_array($row))
				{
					/* Authentication succeeded. Set the class properties (id and name) and return TRUE*/
					$this->id = intval($row['account_id'], 10);
					$this->name = $row['account_name'];
					$this->authenticated = TRUE;
					$this->ciudad=$row['account_ciudad'];


					return TRUE;
				}
			}


			return FALSE;
		}

		/* Logout the current user */
		public function logout()
		{
			/* Global $pdo object */
			$pdo = $this->getConection();

			/* If there is no logged in user, do nothing */
			if (is_null($this->id))
			{
				echo "no logged";
				return;
			}

			/* Reset the account-related properties */
			$this->id = NULL;
			$this->name = NULL;
			$this->authenticated = FALSE;

			/* If there is an open Session, remove it from the account_sessions table */
			if (session_status() == PHP_SESSION_ACTIVE)
			{
				/* Delete query */
				$query = 'DELETE FROM account_sessions WHERE (session_id = :sid)';

				/* Values array for PDO */
				$values = array(':sid' => session_id());

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
			}
		}

		/* Close all account Sessions except for the current one (aka: "logout from other devices") */
		public function closeOtherSessions()
		{
			/* Global $pdo object */
			$pdo = $this->getConection();

			/* If there is no logged in user, do nothing */
			if (is_null($this->id))
			{
				return;
			}

			/* Check that a Session has been started */
			if (session_status() == PHP_SESSION_ACTIVE)
			{
				/* Delete all account Sessions with session_id different from the current one */
				$query = 'DELETE FROM account_sessions WHERE (session_id != :sid) AND (account_id = :account_id)';

				/* Values array for PDO */
				$values = array(':sid' => session_id(), ':account_id' => $this->id);

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
			}
		}

		/* Returns the account id having $name as name, or NULL if it's not found */
		public function getIdFromName(string $name)
		{
			/* Global $pdo object */
			$pdo = $this->getConection();
var_dump( $name);
			/* Since this method is public, we check $name again here */
			if (!$this->isNameValid($name))
			{
				throw new Exception('Invalid user name');
			}

			/* Initialize the return value. If no account is found, return NULL */
			$id = NULL;

			/* Search the ID on the database */
			$query = 'SELECT account_id FROM accounts WHERE (account_name = :name)';
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
				$id = intval($row['account_id'], 10);
			}

			return $id;
		}


		/* Private class methods */

		/* Saves the current Session ID with the account ID */
		private function registerLoginSession()
		{
			/* Global $pdo object */
			$pdo = $this->getConection();

			/* Check that a Session has been started */
			if (session_status() == PHP_SESSION_ACTIVE)
			{
			/* 	Use a REPLACE statement to:
				- insert a new row with the session id, if it doesn't exist, or...
				- update the row having the session id, if it does exist.
			*/
				$query = 'REPLACE INTO account_sessions (session_id, account_id, login_time) VALUES (:sid, :accountId, NOW())';
				$values = array(':sid' => session_id(), ':accountId' => $this->id);

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

	private function registerLoginSession2($id)
	{
		$pdo = $this->getConection();
			if (session_status() == PHP_SESSION_ACTIVE)
			{
				$query = 'REPLACE INTO account_sessions (session_id, account_id, login_time) VALUES (:sid, :accountId, NOW())';
				$values = array(':sid' => session_id(), ':accountId' => $id);
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


		/* Devuelve  provincia,Latitude,Longitude,codigo Postal en funcion de la ciudad */
		public function getCpFromCity(string $city)
		{
			/* Global $pdo object */
			$pdo = $this->getConection();


			/* Initialize the return value. If no account is found, return NULL */
			$cp = NULL;
			$provincia=NULL;

			/* Search the CP on the database */
		//select poblacion,provincia,lat,lon,codigopostalid from poblacion p join codigopostal c on p.provinciaid=c.provinciaid join provincia pp on pp.provinciaid=c.provinciaid and c.poblacionid=p.poblacionid WHERE p.poblacion='madrid' 
	//	$query = 'SELECT codigopostalid FROM proyecto.poblacion p JOIN proyecto.codigopostal c ON 	p.provinciaid=c.provinciaid
	//	and c.poblacionid=p.poblacionid WHERE (poblacion=:poblacion)'; 
			$query ='SELECT provincia,lat,lon,codigopostalid 
			FROM poblacion p 
			join codigopostal c 
			on p.provinciaid=c.provinciaid 
			join provincia pp 
			on pp.provinciaid=c.provinciaid 
			and c.poblacionid=p.poblacionid 
			WHERE(poblacion=:poblacion)';

			$values = array(':poblacion' => $city);

			try
			{
				$res = $pdo->prepare($query);
				$res->execute($values);
			}
			catch (Exception $e)
			{
				/* If there is a PDO exception, throw a standard exception */
		//   throw new Exception('Database query error');
				echo $e->getMessage();
			}

			$row = $res->fetch(PDO::FETCH_ASSOC);

			return $row;
		}

		/*contar cuantas ciudades tenemos en la base de datos*/
		public function ContUsuarios()
		{
		//global $pdo;

			$pdo = $this->getConection();
			$query='SELECT count(*) FROM accounts';
			try
			{
				$res = $pdo->prepare($query);
				$res->execute();
			}
			catch (Exception $e)
			{
				echo $e->getMessage();
			}
			$number_of_rows = $res->fetchColumn();
			return $number_of_rows;
		}

		public function selectCiudad()
		{
			$pdo = $this->getConection();
			$query='SELECT account_ciudad FROM accounts';
			foreach ($pdo->query($query) as $row) {
				
			}
		}

		public function getDettalesCuentaUsuario(int $id)
		{
			$pdo = $this->getConection();
		
			$usuarioSql="SELECT * FROM accounts WHERE account_id=$id";
			$resUsuarioSql=$pdo->query($usuarioSql);
			/* Values array for PDO */
		    $values = array(':id' => $id);
			try 
			{
				$res = $pdo->prepare($usuarioSql);
				$res->execute($values);

			} catch (Exception $e) {
				echo $e->getMessage();
			}
			$row = $res->fetch(PDO::FETCH_ASSOC);
			return $row;
		}
		//Controlar si el email introducido existe en la BDD
		public function getEmails(string $email):bool
		{
			$pdo = $this->getConection();
			$usuarioSql="SELECT * FROM accounts WHERE (account_email=:email)";
			$values = array(':email' => $email);
		
		    try 
			{
				$res = $pdo->prepare($usuarioSql);
				$res->execute($values);

			} catch (Exception $e) {
				echo $e->getMessage();
			}
			$row = $res->fetch(PDO::FETCH_ASSOC);

			if($row>0)
			{
				return true;
			}
			return false;
		}

	}
		
