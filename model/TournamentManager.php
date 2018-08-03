<?php

namespace model;

use \PDO;
use App\App;

require_once 'Database.php'; // Delete after test

require_once 'QuestionManager.php'; // Try to delete after test

class TournamentManager {
	
	public function createTournaments()	{
		$db = Database::getInstance();
		$sql = 'DELETE FROM tournaments';
		$db->query($sql);
		$sql = 'DELETE FROM selectedquestions';
		$db->query($sql);
		$tournamentName = array("Général", "Thématique");
		$sql = 'INSERT INTO tournaments(name, date)
				VALUES (?, CURRENT_DATE)';
		foreach ($tournamentName as $tournament) {
			$db->prepare($sql, array($tournament));
			$this->createQuestions($tournament);
		}
	}

	/**
	 * Create Questions for the tournament
	 * @param  int     $tournamentId   id of the tournament
	 * @param  mixed   $cat            if a specific category
	 */
	private function createQuestions($tournament, $cat=false) {
		$db = Database::getInstance();
		$qManager = new QuestionManager();
		$data = $qManager->generateQuestions(5, $cat);
		$sql = 'INSERT INTO selectedquestions(idTournament, idQuestions)
				VALUES (
					(SELECT id
					 FROM tournaments
             WHERE name = :tournament), :idQ)';
		foreach ($data as $question) {
			$param = array(
				'tournament' => $tournament,
				'idQ' => intval($question->id)
			);
			$db->prepare($sql, $param);
		}
	}
}

$m = new TournamentManager();
$m->createTournaments();