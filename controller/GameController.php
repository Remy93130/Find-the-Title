<?php

namespace controller;

class GameController extends MainController {
	
	public function __construct() {
		parent::__construct ();
	}
	
	public function game() {
		$title = "Jouer";
		$scripts = array('app');
		$this->render('game', compact('title', 'scripts'));
	}	
}
