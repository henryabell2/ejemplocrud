 <?php
class db
{
	public $mysql = null;

	function __construct()
	{
		try
		{
			$this->mysql = $this->getConnection();

		}
		catch(PDOException $ex)
		{
			echo "ERROR: No puede conectarse: " . $ex->getMessage();
		}
	}

	private function getConnection()
	{
		$host = "localhost";
		$user = "root";
		$pass = "";
		$database = "dbcliente";
		$charset = "utf8";
		/* array asociativo 
		ATTR_DEFAULT_FETCH_MODE (es el modo de optencion de datos por defecto)
		FETCH_ASSOC (cuando haga una consulta me va devolver Array Asociativo)
		*/
		$opt = [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];
		$pdo = new pdo("mysql:host={$host};dbname={$database};charset={$charset}", $user, $pass, $opt);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $pdo;
	}
}