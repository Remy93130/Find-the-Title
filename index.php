<?php

use App\Autoload;
use App\App;
use controller\Controller;
use controller\UserController;

require_once 'App/Autoload.php';

Autoload::register();

$controller = new Controller();
$userController = new UserController();

session_start();

if (isset($_GET['action'])) {
	$route = $_GET['action'];
} else {
	$route = 'index';
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
} else {
	App::notFound();
}
