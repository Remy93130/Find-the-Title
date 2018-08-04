<?php

namespace controller;

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
		$token = App::generateCsrfToken();
		$this->render($page, compact('title', 'token'));
	}

	public function register() {
		$title = 'Inscription';
		$scripts = array('registrationForm');
		$token = App::generateCsrfToken();
		$this->render('register', compact('title', 'token', 'scripts'));
	}
}
