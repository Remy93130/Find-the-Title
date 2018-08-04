<?php
namespace model;

use \PDO;

require_once 'entity/Leaderboard.php';

require_once 'Database.php';

class LeaderboardManager {
    
    public static function clearLeaderboards() {
        $db = Database::getInstance();
        $sql = 'DELETE FROM leaderboards';
        $db->query($sql);
    }
    
    public function addUser($user, $points, $tournament) {
        $db = Database::getInstance();
        $sql = 'INSERT INTO leaderboards(user, points, tournament)
                VALUES (:idUser, :points, :idTournament)';
        $param = array(
            'idUser'       => $user,
            'points'       => $points,
            'idTournament' => $tournament
        );
        $db->prepare($sql, $param);
    }
    
    public function getLeaderboard($tournament) {
        $db = Database::getInstance();
        $sql = 'SELECT U.username, T.name, L.points FROM leaderboards L, users U, tournaments T
                WHERE L.user = U.id
	               AND L.tournament = T.id
                   AND L.tournament = ?
                ORDER BY points DESC';
        $param = array($tournament);
        $req = $db->prepare($sql, $param);
        return $req->fetchAll(PDO::FETCH_CLASS, 'Leaderboard');
    }
}
