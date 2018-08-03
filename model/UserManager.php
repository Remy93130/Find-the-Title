<?php

namespace model;

use \PDO;
use App\App;

require 'entity/User.php';

class UserManager {

	/**
	 * Connect the user if exist
	 * @param  string $username 
	 * @param  string $password 
	 * @return array
	 */
	public function loginUser($username, $password) {
		$db = Database::getInstance();
		$sql = 'SELECT * FROM users 
				WHERE username = ? AND password = ?';
		$param = array($username, sha1($password));
		$req = $db->prepare($sql, $param);
		return $req->fetchAll(PDO::FETCH_CLASS, "User");
	}

	/**
	 * Ajax query
	 * @return array all usernames
	 */
	public function getAllUsername() {
		$db = Database::getInstance();
		$sql = 'SELECT username FROM users';
		$req = $db->query($sql);
		return $req->fetchAll(PDO::FETCH_COLUMN);
	}

	/**
	 * Register an user
	 * @param string $username 
	 * @param string $password 
	 */
	public function addUser($username, $password) {
		$db = Database::getInstance();
		$sql = 'INSERT INTO users(username, password, slug)
				VALUES (?, ?, ?)';
		$param = array(
			htmlspecialchars($username), 
			sha1($password), 
			$this->generateSlug($username)
		);
		$req = $db->prepare($sql, $param);
	}

	private function generateSlug($username) {
		return sha1($username);
	}
}
