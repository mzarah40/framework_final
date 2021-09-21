<?php 

namespace App\Helper;

class SecurityHelper
{
	public static function cleanInjection (string $sql) : string 
	{
		$sql     = preg_replace('/(from|alter table|select|insert|delete|update|where|drop table|show tables|#|--|\\\)/i', '', $sql);
   		$sql     = trim($sql);
	    $sql     = strip_tags($sql);

	   	if ( !get_magic_quotes_gpc() ) {
	    	$sql = addslashes($sql);
	   	}
	    
	    return $sql;
	}

	public static function csrf () : string 
	{
		return md5(uniqid(time()));
	}

	public static function xss($string) : string 
	{
		return htmlentities($string);
	}
}