<?php
namespace ftt\controller;

use App\App;
use ftt\model\CategoryManager;
use ftt\model\TournamentManager;
use ftt\model\UserManager;

class Controller extends AbstractController
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Redirect to the index check if the user is logged
     */
    public function index()
    {
        $tournament = new TournamentManager();
        $tournament->expireTournament();
        $tournamentsData = array(
            'General' => array(),
            'Thematique' => array()
        );
        if (App::userLogged()) {
            $page = 'indexLogged';
            $manager = new TournamentManager();
            array_push($tournamentsData['General'], $manager->getLeaderboard('General'));
            array_push($tournamentsData['Thematique'], $manager->getLeaderboard('Thematique'));
        } else {
            $page = 'indexGuest';
        }
        $title = 'Index';
        $token = App::generateCsrfToken();
        $this->render($page, compact('title', 'token', 'tournamentsData'));
    }

    /**
     * Redirect to the registration page
     */
    public function register()
    {
        $title = 'Inscription';
        $scripts = array(
            'registrationForm'
        );
        $token = App::generateCsrfToken();
        $this->render('register', compact('title', 'token', 'scripts'));
    }

    /**
     * Redirect to the add question page
     */
    public function addQuestion()
    {
        if (! App::userLogged()) {
            $str = "Vous devez être connecté pour ajouter une question.";
            App::addMessage('danger', $str);
            header('Location: index.php');
            die();
        }
        $title = 'Ajouter une question';
        $token = App::generateCsrfToken();
        $manager = new CategoryManager();
        $categories = $manager->getCategories();
        $this->render('addQuestion', compact('title', 'token', 'categories'));
    }

    /**
     * Redirect to the about page
     */
    public function about()
    {
        $title = 'A propos';
        $token = App::generateCsrfToken();
        $this->render('about', compact('title', 'token'));
    }

    /**
     * Check if the message submit is good
     */
    public function sendMessage()
    {
        if (!App::checkCsrfToken()) {
            App::forbiddenAccess();
        }
        if ($_POST['name'] == "" || $_POST['message'] == "" || ! filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $str = "Merci de remplir tout les champs";
            App::addMessage('danger', $str);
        } else {
            $manager = new UserManager();
            $manager->sendMessage($_POST['name'], $_POST['email'], $_POST['message']);
            $str = "Votre message a bien été envoyé";
            App::addMessage('success', $str);
        }
        header('Location: index.php?action=about');
    }
}
