<?php

namespace model;

use \PDO;

require_once 'Database.php'; // Delete after test

require_once 'QuestionManager.php'; // Try to delete after test
require_once 'LeaderboardManager.php'; // Try to delete after test


class TournamentManager {
    
    public static function clearTournaments() {
        $db = Database::getInstance();
        $sql = 'UPDATE tournaments
                SET date = CURRENT_DATE';
        $db->query($sql);
    }
	
	public function createTournaments()	{
		self::clearTournaments();
		QuestionManager::clearQuestions();
		LeaderboardManager::clearLeaderboards();
		$tournamentName = array("General", "Thematique");
		foreach ($tournamentName as $tournament) {
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
	
	public static function expireTournament() {
	    $currentDate = date('Y-m-d');
	    $db = Database::getInstance();
	    $sql = 'SELECT date FROM tournaments';
	    $req = $db->query($sql);
	    $date = $req->fetch(PDO::FETCH_COLUMN);
	    if ($date !== $currentDate) {
	        $m = new TournamentManager();
	        $m->createTournaments();
	    } 
	}
}

$m = new TournamentManager();
$m->expireTournament();
