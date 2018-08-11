<?php

namespace controller;

use App\App;
use model\AdminManager;

class AdminController extends MainController {

	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		if (empty($_SESSION['id']) && $_SESSION['id'] != 1) {
			App::forbiddenAccess();
		}
		$manager = new AdminManager();
		$token = App::generateCsrfToken();
		$title = "Panel admin";
		$messages = $manager->getMessages();
		$users = $manager->getUsers();
		$questions = $manager->getQuestions();
		foreach ($questions as $question) {
			if ($question->image) {
				$slug = sha1($question->answer);
				$question->slug = "<a href='public/image_answer/$slug' target='_blank'>Image</a>";
			} else {
				$question->slug = "N/A";
			}
		}
		$this->render('admin', compact('title', 'token', 'messages', 'users', 'questions'));
	}
	
	public function delete() {
		if (App::checkCsrfToken($_GET['token'])) {
			App::forbiddenAccess();
		}
		$manager = new AdminManager();
		if ($_GET['target'] === 'user') {
			$manager->deleteUser($_GET['id']);
		} elseif ($_GET['target'] === 'question') {
			$manager->deleteQuestion($_GET['id']);
		} elseif ($_GET['target'] === 'message') {
			$manager->deleteMessage($_GET['id']);
		}
		App::addMessage('success', 'Suppresion effectuee');
		header('Location: index_admin.php');
		die();
	}
}

