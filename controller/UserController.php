<?php

namespace controller;

use model\UserManager;
use App\App;

class UserController extends MainController {
	
	function __construct() {
		parent::__construct();
	}

	public function login()	{
		if (!isset($_POST['token']) && !App::checkCsrfToken($_POST['token'])) {
			header('Location: index.php');
		}
		$title = 'Index';
		$manager = new UserManager();
		if ($data = $manager->loginUser($_POST['username'], $_POST['passoword'])) {
			App::createUserSession(array(
				'id'       => $data[0]->id,
				'username' => $data[0]->username,
				'slug'     => $data[0]->slug
			));
			$this->render('indexLogged', compact('title'));
		} else {
			$str = 'Nom de compte ou mot de passe incorrect !';
			App::addMessage('danger', $str);
			header('Location: index.php');
		}
	}

	/**
	 * Ajax request get all username
	 */
	public function getAllUsername() {
		$manager = new UserManager();
		if (!App::checkCsrfToken($_POST['token'])) {
			App::forbiddenAccess();
		}
		echo json_encode($manager->getAllUsername());
	}

	public function registration() {
		if (!isset($_POST['token']) && !App::checkCsrfToken($_POST['token'])) {
			App::forbiddenAccess();
		}
		if ($_POST['username'] != "" && $_POST['password'] != "" && $_POST['cgu']) {
			$manager = new UserManager();
			$manager->addUser($_POST['username'], $_POST['password']);
			$str = "Votre compte a bien été créée vous pouvez maintenant vous connecter.";
			App::addMessage('success', $str);
			header("Location: index.php");
		} else {
			$str = "Merci de remplir tout les champs !";
			App::addMessage("danger", $str);
			header('Location: index.php?action=register');
		}
	}
}
