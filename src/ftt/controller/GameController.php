<?php
namespace ftt\controller;

use App\App;
use ftt\model\LeaderboardManager;

class GameController extends AbstractController
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Redirect to the game view with good parameters
     * and check if tournament if player can do it
     */
    public function game()
    {
        if (!App::userLogged()) {
            App::forbiddenAccess();
        }
        $played = false;
        $title = "Jouer";
        $token = App::generateCsrfToken();
        $tournament = $_GET['tournament'];
        $manager = new LeaderboardManager();
        $data = $manager->getLeaderboard($tournament);
        foreach ($data as $score) {
            if ($score->username == $_SESSION['username']) {
                $played = true;
            }
            break;
        }
        if ($played) {
            $title = "Index";
            $str = "Vous avez déjà participé à ce tournoi.";
            App::addMessage('danger', $str);
            var_dump($_SESSION);
            header('Location: index.php');
            die();
        } else {
            $scripts = array(
                'app'
            );
            $this->render('game', compact('title', 'scripts', 'token', 'tournament'));
        }
    }
}
