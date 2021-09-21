<?php 

namespace App\Migration;

class FirstMigration
{

	private $sql;

	public function __construct() {
		$this->sql = "
			CREATE DATABASE framework;
			USE framework;
			CREATE TABLE users(
				id int(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
				nome varchar(150) DEFAULT NULL,
				email varchar(250) DEFAULT NULL,
				password varchar(255) NOT NULL
			);
		";
	}

	public function run() {
		
	}
}