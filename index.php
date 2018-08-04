<?php

use App\Autoload;
use App\App;
use controller\Controller;
use controller\UserController;
use controller\QuestionController;

require_once 'App/Autoload.php';

Autoload::register();

/* === TEST ZONE ===*/



/* ================ */

$controller = new Controller();
$userController = new UserController();
$questionController = new QuestionController();

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
} elseif ($route == 'registration') {
	$userController->registration();
} else {
	App::notFound();
}
