<?php

namespace controller;

use App\App;
use model\TournamentManager;

class Controller extends MainController {
	
	public function __construct() {
		parent::__construct();
	}

	public function index()	{
	    $tournamentsData = array(
	        'General'    => array(),
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

	public function register() {
		$title = 'Inscription';
		$scripts = array('registrationForm');
		$token = App::generateCsrfToken();
		$this->render('register', compact('title', 'token', 'scripts'));
	}
}
