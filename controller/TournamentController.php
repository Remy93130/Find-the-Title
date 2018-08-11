<?php

namespace controller;

use model\TournamentManager;

class TournamentController extends MainController {

	public function __construct() {
		parent::__construct ();
	}
	
	public function setScore() {
		//if (!App::checkCsrfToken($_POST['token'])) {
		//	die();
		//}
		echo $_SESSION['id'] . " " . $_POST["tournament"] . " " . $_POST['score'];
		$manager = new TournamentManager();
		$manager->setScore($_SESSION['id'], $_POST['tournament'], $_POST['score']);
	}
}
