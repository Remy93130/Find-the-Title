<?php
namespace ftt\model;

use PDO;

require_once 'entity/Message.php';
require_once 'entity/User.php';
require_once 'entity/Question.php';

class AdminManager
{

    /**
     * Get all messages in the database
     * @return array
     */
    public function getMessages() : array
    {
        $db = Database::getInstance();
        $sql = 'SELECT * FROM messages';
        $req = $db->query($sql);
        return $req->fetchAll(PDO::FETCH_CLASS, 'Message');
    }

    /**
     * Get all users in the database
     * @return array
     */
    public function getUsers() : array
    {
        $db = Database::getInstance();
        $sql = 'SELECT * FROM users';
        $req = $db->query($sql);
        return $req->fetchAll(PDO::FETCH_CLASS, 'User');
    }

    /**
     * Get all questions in the database
     * @return array
     */
    public function getQuestions() : array
    {
        $db = Database::getInstance();
        $sql = 'SELECT * FROM questions ORDER BY id DESC';
        $req = $db->query($sql);
        return $req->fetchAll(PDO::FETCH_CLASS, "Question");
    }

    /**
     * Delete a message in the database
     * @param int $id
     */
    public function deleteMessage(int $id)
    {
        $db = Database::getInstance();
        $sql = 'DELETE FROM messages WHERE id = ?';
        $param = [
            $id
        ];
        $db->prepare($sql, $param);
    }

    /**
     * Delete an user in the database
     * @param int $id
     */
    public function deleteUser(int $id)
    {
        $db = Database::getInstance();
        $sql = 'DELETE FROM users WHERE id = ?';
        $param = [
            $id
        ];
        $db->prepare($sql, $param);
    }

    /**
     * Delete a question in the database
     * @param int $id
     */
    public function deleteQuestion(int $id)
    {
        $db = Database::getInstance();
        $sql = 'DELETE FROM questions WHERE id = ?';
        $param = [
            $id
        ];
        $db->prepare($sql, $param);
    }
}
