<?php 

namespace App\Orm;

use App\Helper\SecurityHelper;
use App\Orm\SingleDbMysql;

class FlashQuery
{
	private $sql;
	private $run;

	public function __construct()
	{
		$this->run = SingleDbMysql::getInstance();
	}


	public function select (array $vetSql) 
	{
		$this->sql = ' SELECT ';

		foreach ( $vetSql as $idx => $value ) {

			$this->sql .= SecurityHelper::cleanInjection($value) . ',';

		}

		$this->sql = substr($this->sql, 0, -1);

		return $this;
	}

	public function from (array $table) 
	{
		$this->sql .= ' FROM ';

		foreach ( $table as $idx => $value ){
			$this->sql .= SecurityHelper::cleanInjection($value) . ',';
		}


		$this->sql = substr($this->sql, 0, -1);

		$this->sql .= " ";

		return $this;
	}

	public function inner ( string $table, string $on ) 
	{
		$this->sql .= ' INNER JOIN ' . SecurityHelper::cleanInjection($table) . ' ON ' . SecurityHelper::cleanInjection($on) . ' ';

		return $this;
	}

	public function left ( $table, $on ) 
	{
		$this->sql .= " LEFT JOIN " . SecurityHelper::cleanInjection($table) . " ON " . SecurityHelper::cleanInjection($on) . ' ';

		return $this;
	}

	public function where ( string $condition ) 
	{
		$this->sql .= " WHERE " . SecurityHelper::cleanInjection($condition) . ' ';

		return $this;
	}

	public function and ( string $condition ) 
	{
		$this->sql .= " AND " . SecurityHelper::cleanInjection($condition) . " ";

		return $this;
	}

	public function or ( string $condition ) 
	{
		$this->sql .= " OR " . SecurityHelper::cleanInjection($condition) . " ";

		return $this;
	}

	public function like (string $like) 
	{
		$this->sql .= " LIKE '%" . SecurityHelper::cleanInjection($like) . "%' ";

		return $this;
	}

	public function where_like(string $field, $condition) 
	{
		$this->sql .= " WHERE " . SecurityHelper::cleanInjection($field) . " LIKE '%" . SecurityHelper::cleanInjection($condition) . "%' ";

		return $this;
	}

	public function having ( string $condition ) 
	{
		$this->sql .= " HAVING " . SecurityHelper::cleanInjection($condition) . " ";
	}

	public function group_by ( array $agrupment) 
	{
		$this->sql .= " GROUP BY ";
		
		foreach ($agrupment as $value) {
			$this->sql .= SecurityHelper::cleanInjection($value) . ",";
		} 

		$this->sql = substr($this->sql, 0, -1);

		$this->sql .= ' ';

		return $this;
	}

	public function order_by ( array $ob ) 
	{
		foreach ($ob as $idx => $value) {
			$this->sql .= " ORDER BY " . SecurityHelper::cleanInjection($idx) . " " . SecurityHelper::cleanInjection($value) . ",";
		}

		$this->sql = substr($this->sql, 0, -1);

		$this->sql .= ' ';

		return $this;
	}

	public function insert (string $table, array $fields)
	{
		$this->sql = " INSER INTO " . SecurityHelper::cleanInjection($table) . " VALUES ( ";

		foreach ( $fields as $idx => $value ) {
			$this->sql .= " $idx = '" . SecurityHelper::cleanInjection($value) . "',";
		}

		$this->sql = substr($this->sql, 0, -1);

		// executa e retorna um resultado

		return $this->run->execute($this->sql);

	}

	public function insertBySelect (string $table, string $select) 
	{
		$this->sql = " INSERT INTO " . $table . " " . $select;

		// executa e retorna um resultado

		return $this->run->execute($this->sql);

	}


	public function update (string $table, $fields) 
	{
		$this->sql = " UPDATE " . SecurityHelper::cleanInjection($table) . " SET ";

		foreach ( $fields as $idx => $value ) {

			$this->sql .= " $idx = '" . SecurityHelper::cleanInjection($value) . "',";

		}

		$this->sql = substr($this->sql, 0, -1);

		// executa e retorna um resultado

		return $this->run->execute($this->sql);

	}

	public function delete (int $id, string $table) : bool 
	{
		$this->sql = "DELETE FROM " . $table . " WHERE id = '" . SecurityHelper::cleanInjection($id) . "'";

		// executa e retorna um resultado

		return $this->run->execute($this->sql);
	}

	public function get() 
	{
		return $this->run->execute($this->sql);
	}

}