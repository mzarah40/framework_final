<?php 

namespace App\Controller;

use App\Model\HomeModel;


class HomeController 
{
	use \App\Machinery\TraitMachinery;

	private $homeModel = null;
	private $loadView = null;
	private $data = [];

	public function __construct() 
	{
		$this->homeModel  = new HomeModel();
	}

	public function index() : void
	{
		$this->data['resultSet'] = $this->homeModel->all();
		$this->data['title']     = "Home - MZ Framework 1.0";

		$this->traitLoadView('template/header', $this->data);
		$this->traitLoadView('content/index'  , $this->data);
		$this->traitLoadView('template/footer',[]);
	}

	public function add() : void 
	{
		$this->data['title'] = "Adicionar - MZ Framework 1.0";

	}
}