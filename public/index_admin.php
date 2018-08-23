<?php
use App\App;
use ftt\controller\AdminController;

require_once '../vendor/autoload.php';

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
