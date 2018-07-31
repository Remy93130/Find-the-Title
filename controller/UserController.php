<?php

namespace controller;

use model\UserManager;
use App\App;

class UserController extends MainController {
	
	function __construct() {
		parent::__construct();
	}

	public function login()	{
		if (!isset($_POST['username'])) {
			header('Location: index.php');
		}
		extract($_POST);
		$title = 'Index';
		$manager = new UserManager();
		if ($data = $manager->loginUser($username, $password)) {
			App::createUserSession(array(
				'id'       => $data[0]->id,
				'username' => $data[0]->username,
				'slug'     => $data[0]->slug
			));
			$page = 'indexLogged';
		} else {
			$str = 'Nom de compte ou mot de passe incorrect !';
			App::addMessage('danger', $str);
			$page = 'indexGuest';
		}
			$this->render($page, compact('title'));
	}
}