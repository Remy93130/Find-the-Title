<?php
namespace ftt\model;

use PDO;
use App\App;

require_once 'entity/User.php';

class UserManager
{

    /**
     * Connect the user if exist
     *
     * @param string $username
     * @param string $password
     * @return array
     */
    public function loginUser($username, $password)
    {
        $db = Database::getInstance();
        $sql = 'SELECT * FROM users 
				WHERE username = ? AND password = ?';
        $param = array(
            $username,
            sha1($password)
        );
        $req = $db->prepare($sql, $param);
        return $req->fetchAll(PDO::FETCH_CLASS, "User");
    }

    /**
     * Ajax query
     *
     * @return array all usernames
     */
    public function getAllUsername()
    {
        $db = Database::getInstance();
        $sql = 'SELECT username FROM users';
        $req = $db->query($sql);
        return $req->fetchAll(PDO::FETCH_COLUMN);
    }

    /**
     * Register an user
     *
     * @param string $username
     * @param string $password
     */
    public function addUser($username, $email, $password)
    {
        $db = Database::getInstance();
        $sql = 'INSERT INTO users(username, email, password, slug)
				VALUES (?, ?, ?, ?)';
        $param = array(
            htmlspecialchars($username),
            htmlspecialchars($email),
            sha1($password),
            $this->generateSlug($username)
        );
        $db->prepare($sql, $param);
    }

    /**
     * Create a slug for the user
     * @param string $username
     * @return string
     */
    private function generateSlug(string $username) : string
    {
        return sha1($username);
    }

    /**
     * Change email for the user
     * @param string $email
     * @param int $id
     */
    public function updateEmail(string $email, int $id)
    {
        $db = Database::getInstance();
        $sql = 'UPDATE users SET email = ? WHERE id = ?';
        $param = array(
            $email,
            $id
        );
        $db->prepare($sql, $param);
        App::createUserSession(['email' => $email]);
    }

    /**
     * CHange password for the user
     * @param string $password
     * @param int $id
     */
    public function updatePassword(string $password, int $id)
    {
        $db = Database::getInstance();
        $sql = 'Update users SET password = ? WHERE id = ?';
        $param = array(
            sha1($password),
            $id
        );
        $db->prepare($sql, $param);
    }

    /**
     * Delete the account
     * @param int $id
     */
    public function deleteAccount(int $id)
    {
        $db = Database::getInstance();
        $sql = 'DELETE FROM users WHERE id = ?';
        $param = array(
            $id
        );
        $db->prepare($sql, $param);
    }

    /**
     * Put a message in the database
     * @param string $name
     * @param string $email
     * @param string $message
     */
    public function sendMessage(string $name, string $email, string $message)
    {
        $db = Database::getInstance();
        $sql = 'INSERT INTO messages(name, email, message)
				VALUES (?, ?, ?)';
        $param = array(
            $name,
            $email,
            $message
        );
        $db->prepare($sql, $param);
    }
}
