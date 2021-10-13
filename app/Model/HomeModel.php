<?php 

namespace App\Model;

use App\Orm\FlashQuery;

class HomeModel
{
	private $flashQuery = "";


	public function __construct()
	{
		$this->flashQuery = new FlashQuery();
	}

	public function all()
	{
		return $this->flashQuery->select(['*'])
								->from(['users'])
								->get();
	}

	public function findById(int $id)
	{
		return $this->flashQuery->select(['*'])
								->from(['users'])
								->where('id = '.$id)
								->get();
	}
}