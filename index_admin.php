<?php

use App\Autoload;
use App\App;
use controller\AdminController;

require_once 'App/Autoload.php';

Autoload::register();

$controller = new AdminController();

session_start();

if (isset($_GET['action'])) {
	$route = $_GET['action'];
} else {
	$route = 'index';
}


if ($route === 'index') {
	$controller->index();
} elseif ($route === 'delete') {
	$controller->delete();
} else {
	App::notFound();
}
