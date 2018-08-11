<?php

use App\Autoload;
use App\App;
use controller\Controller;
use controller\UserController;
use controller\QuestionController;
use controller\GameController;
use controller\TournamentController;

require_once 'App/Autoload.php';

Autoload::register();

$controller = new Controller();
$userController = new UserController();
$questionController = new QuestionController();
$gameController = new GameController();
$tournamentController = new TournamentController();

session_start();

if (isset($_GET['action'])) {
	$route = $_GET['action'];
} else {
	$route = 'index';
}

if (isset($_POST['query']) && isset($_POST['request'])) {
	if ($_POST['request'] === 'getUser') {
		$userController->getAllUsername();
	} elseif ($_POST['request'] === 'getQuestions') {
	    $questionController->getQuestion();
	} elseif ($_POST['request'] === 'setScore') {
		$tournamentController->setScore();
	}
	die();
}

if ($route === 'index') {
	$controller->index();
} elseif ($route === 'about') {
	$controller->about();
} elseif ($route === 'profile') {
	$controller->profile();
} elseif ($route === 'login') {
	$userController->login();
} elseif ($route === 'register') {
	$controller->register();
} elseif ($route === 'registration') {
	$userController->registration();
} elseif ($route === 'addQuestion') {
	$controller->addQuestion();
} elseif ($route === 'insertQuestion') {
	$questionController->insertQuestion();
} elseif ($route === 'sendMessage') {
	$controller->sendMessage();
} elseif ($route === 'game') {
	$gameController->game();
} elseif ($route === 'updateEmail') {
	$userController->updateEmail();
} elseif ($route === 'updatePassword') {
	$userController->updatePassword();
} elseif ($route === 'deleteAccount') {
	$userController->deleteAccount();
} else {
	App::notFound();
}
