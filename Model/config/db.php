<?php
class Conection
{
	private $host;
	private $user;
	private $passwd;
	private $schema;
	private $pdo;
	private $dsn;
	public function __construct()
	{
		/* Host name of the MySQL server */
		$this->host = 'PMYSQL130.dns-servicio.com:3306';
	//	$this->host = 'localhost';
		/* MySQL account username */
	//	$this->user = 'root';
		$this->user = 'mat2';
		/* MySQL account password */
		//$this->passwd = 'root';
		$this->passwd = 'Senet$020';
		/* The schema you want to use */
//		$this->schema = 'senet';
	$this->schema = '7552822_senet2';	
		/* The PDO object */
		$this->pdo = NULL;
		/* the cotejamiento */
		$this->charset = 'utf8';
		/* Connection string, or "data source name" */
		$this->dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->schema.';charset='.$this->charset;
	}


	public function get_conexion(){
		try
		{  
			/* PDO object creation */
			$return = new PDO($this->dsn, $this->user,  $this->passwd);

			/* Enable exceptions on errors */
			$return->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			

			return $return;
		}
		catch (PDOException $e)
		{
			/* If there is an error an exception is thrown */
			echo 'Database connection failed<br>';
			print_r($e);
			die("error" . $e->getMessage());
			echo "Linea del error " . $e->getLine();
		}
	}
}