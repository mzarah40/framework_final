<?php 

namespace App\Machinery;

trait TraitMachinery
{

	public function traitLoadView($view, $arrayVariables=[]) 
	{
		
		extract($arrayVariables);

		require __DIR__ . './../View/' . $view. '.php';
	}

}