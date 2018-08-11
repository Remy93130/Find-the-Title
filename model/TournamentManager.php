<?php

namespace model;

use \PDO;

require_once 'entity/Leaderboard.php';

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
			if ($tournament == 'Thematique') {
				$manager = new CategoryManager();
				$cat = $manager->getRandomCategory();
				$this->createQuestions($tournament, $cat->name);
			} else {
				$this->createQuestions($tournament);
			}
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
	
	public function getLeaderboard($tournamentName) {
	    $db = Database::getInstance();
	    $sql = 'SELECT T.name, U.username, L.points
                FROM leaderboards L, users U, tournaments T 
                WHERE L.user = U.id
	               AND L.tournament = T.id
                   AND T.name = ?
				ORDER BY points DESC';
	    $req = $db->prepare($sql, array($tournamentName));
	    return $req->fetchAll(PDO::FETCH_CLASS);
	}
	
	public function setScore($user, $tournament, $score) {
		$db = Database::getInstance();
		$sql = 'INSERT INTO leaderboards (user, points, tournament)
				VALUES (?, ?, ?)';
		$param = array($user, $score, $tournament);
		$db->prepare($sql, $param);
	}
}