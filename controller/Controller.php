<?php

namespace controller;

use model\UserManager;
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

	public function register() {
		$title = 'Inscription';
		$manager = new UserManager();
		$allUsernames = $manager->getAllUsername();
		$this->render('register', compact('title', 'allUsernames'));
	}
}
