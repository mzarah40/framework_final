<?php 

namespace App\Model;

class AuthModel
{
	private $table = "users";
	private $fillable = ['nome','email','password'];
}