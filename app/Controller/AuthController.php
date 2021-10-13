<?php 

namespace App\Controller;

use App\Jwt\GetJwt;
use App\Model\AuthModel;


class AuthController 
{
	use \App\Machinery\TraitMachinery;

	private $jwt = null;
	private $user = "";
	private $pass = "";
	
	public function login()
	{
		$this->traitLoadView('template/header', []);
		$this->traitLoadView('content/login',   []);
		$this->traitLoadView('template/footer', []);

	}

	public function getToken() : string 
	{
		
	}
}