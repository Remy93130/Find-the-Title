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
		$manager = new UserManager();
		if ($data = $manager->loginUser($_POST['username'], $_POST['password'])) {
			App::createUserSession(array(
				'id'       => $data[0]->id,
				'username' => $data[0]->username,
				'email'    => $data[0]->email,
				'slug'     => $data[0]->slug
			));
			header('Location: index.php');
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
		if (!App::checkCsrfToken($_POST['token'])) {
			App::forbiddenAccess();
		}
		if ($_POST['username'] != "" && $_POST['password'] != "" && $_POST['cgu'] && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$manager = new UserManager();
			$manager->addUser($_POST['username'], $_POST['email'], $_POST['password']);
			$str = "Votre compte a bien été créée vous pouvez maintenant vous connecter.";
			App::addMessage('success', $str);
			header("Location: index.php");
		} else {
			$str = "Merci de remplir tout les champs correctement !";
			App::addMessage("danger", $str);
			header('Location: index.php?action=register');
		}
	}
	
	public function updateEmail() {
		if (!App::checkCsrfToken($_POST['token'])) {
			App::forbiddenAccess();
		}
		if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$manager = new UserManager();
			$manager->updateEmail($_POST['email'], $_SESSION['id']);
			$str = "Votre adresse Email a bien été modifier.";
			App::addMessage('success', $str);
		} else {
			$str = "Merci de rentrer une adresse Email valide.";
			App::addMessage('danger', $str);
		}
		header('Location: index.php');
	}
	
	public function updatePassword() {
		if (!App::checkCsrfToken($_POST['token'])) {
			App::forbiddenAccess();
		}
		$manager = new UserManager();
		if ($manager->loginUser($_SESSION['username'], $_POST['old-password'])) {
			$manager->updatePassword($_POST['password'], $_SESSION['id']);
			$str = "Votre mot de passe a bien ete modifier.";
			App::addMessage('success', $str);
		} else {
			$str = "Votre mot de passe est incorrect.";
			App::addMessage('danger', $str);
		}
		header('Location: index.php');
	}

	public function deleteAccount()	{
		if (!App::checkCsrfToken($_POST['token'])) {
			App::forbiddenAccess();
		}
		$manager = new UserManager();
		if ($manager->loginUser($_SESSION['username'], $_POST['password'])) {
			$manager->deleteAccount($_SESSION['id']);
			session_unset();
			$str = "Votre compte a bien été supprimer.";
			App::addMessage('success', $str);
		} else {
			$str = "Votre mot de passe est incorrect.";
			App::addMessage('danger', $str);
		}
		header('Location: index.php');

	}
}
