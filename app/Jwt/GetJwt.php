<?php 

namespace App\Jwt;

class GetJwt
{

	private $user = null;
	private $email = null;

	public function __construct($arrayUserEmail) : void 
	{
		$this->user  = $arrayUserEmail['user'];
		$this->email = $arrayUserEmail['email'];
	}

	public function getToken () : string
	{
		$key = '35xs6817xrfde7e';

		//Header Token
		$header = [
		    'typ' => 'JWT',
		    'alg' => 'HS256'
		];

		//Payload - Content
		$payload = [
		    //'exp' => (new DateTime("now"))->getTimestamp(),
		    //'uid' => 1,
		    'name'  => $this->user,
		    'email' => $this->email
		];

		//JSON
		$header = json_encode($header);
		$payload = json_encode($payload);

		//Base 64
		$header = base64_encode($header);
		$payload = base64_encode($payload);

		//Sign
		$sign = hash_hmac('sha256', $header . "." . $payload, $key, true);
		$sign = base64_encode($sign);

		//Token
		$token = $header . '.' . $payload . '.' . $sign;

		return $token;
	}
}