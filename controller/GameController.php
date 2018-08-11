<?php

namespace controller;

use App\App;
use model\LeaderboardManager;

class GameController extends MainController {
	
	public function __construct() {
		parent::__construct ();
	}
	
	public function game() {
		$played = false;
		$title = "Jouer";
		$token = App::generateCsrfToken();
		$tournament = $_GET['tournament'];
		$manager = new LeaderboardManager();
		$data = $manager->getLeaderboard($tournament);
		foreach ($data as $score) {
			if ($score->username == $_SESSION['username'])
			$played = true;
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
			$scripts = array('app');
			$this->render('game', compact('title', 'scripts', 'token', 'tournament'));
		}
	}	
}
