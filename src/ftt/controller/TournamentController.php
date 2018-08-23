<?php
namespace ftt\controller;

use App\App;
use ftt\model\TournamentManager;

class TournamentController extends AbstractController
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Add the score to the database
     */
    public function setScore()
    {
        if (!App::checkCsrfToken()) {
            die();
        }
        $manager = new TournamentManager();
        $manager->setScore($_SESSION['id'], $_POST['tournament'], $_POST['score']);
    }
}
