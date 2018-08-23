<?php
namespace ftt\model;

use PDO;

class LeaderboardManager
{

    /**
     * Wipe leaderboards
     */
    public static function clearLeaderboards()
    {
        $db = Database::getInstance();
        $sql = 'DELETE FROM leaderboards';
        $db->query($sql);
    }

    /**
     * Insert a user in a leaderboard
     * @param int $user
     * @param int $points
     * @param int $tournament
     */
    public function addUser(int $user, int $points, int $tournament)
    {
        $db = Database::getInstance();
        $sql = 'INSERT INTO leaderboards(user, points, tournament)
                VALUES (:idUser, :points, :idTournament)';
        $param = array(
            'idUser' => $user,
            'points' => $points,
            'idTournament' => $tournament
        );
        $db->prepare($sql, $param);
    }

    /**
     * Get the leaderboard from a tournament
     * @param string $tournament
     * @return array
     */
    public function getLeaderboard(string $tournament) : array
    {
        $db = Database::getInstance();
        $sql = 'SELECT U.username, T.name, L.points FROM leaderboards L, users U, tournaments T
                WHERE L.user = U.id
	               AND L.tournament = T.id
                   AND L.tournament = ?
                ORDER BY points DESC';
        $param = array(
            $tournament
        );
        $req = $db->prepare($sql, $param);
        return $req->fetchAll(PDO::FETCH_CLASS);
    }
}
