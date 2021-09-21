<?php 

namespace App\DBInterface;

interface DBInterface 
{
	public static function getInstance();
	public function get($sql);
}