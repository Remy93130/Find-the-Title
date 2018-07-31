<?php

namespace controller;

use model\UsersManager;
use App\App;

class Controller extends MainController {
	
	public function __construct() {
		parent::__construct();
	}

	public function index()	{
		if (App::userLogged()) {
			$page = 'indexLogged';
		} else {
			$page = 'indexGuest';
		}
		$title = 'Index';
		$this->render($page, compact('title'));
	}
}
