<?php 

namespace App\Orm;

use App\DBInterface\DBInterface;

class SingleDbMysql implements DBInterface 
{
	private static $instance;
	private $connection;
	private $resultSet;

	private function __construct () 
	{
		$this->connection = mysqli_connect(HOST, USER, PASSWORD) or die("Erro de conexão");
		mysqli_select_db($this->connection, DATABASE);
	}

	public static function getInstance () 
	{
		if ( !isset(self::$instance) ) {
			self::$instance = new SingleDbMysql();
		}

		return self::$instance;
	}

	public function get ($sql)
	{
		$this->resultSet = mysqli_query($this->connection, $sql);

		return $this->resultSet;
	}

	public function mfo () : mixed 
	{
		return mysqli_fecth_object($this->resultSet);
	}

}