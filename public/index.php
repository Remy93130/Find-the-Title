<?php
use App\App;
use ftt\controller\Controller;
use ftt\controller\GameController;
use ftt\controller\QuestionController;
use ftt\controller\TournamentController;
use ftt\controller\UserController;
use Symfony\Component\Debug\Debug;
use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Debug\ExceptionHandler;
use Symfony\Component\Debug\DebugClassLoader;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\Session\Session;

require_once '../vendor/autoload.php';

session_start();

$controller = new Controller();
$userController = new UserController();
$questionController = new QuestionController();
$gameController = new GameController();
$tournamentController = new TournamentController();


Debug::enable();
ErrorHandler::register();
ExceptionHandler::register();
DebugClassLoader::enable();



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
