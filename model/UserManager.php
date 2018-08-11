<?php

namespace model;

use PDO;

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
	public function addUser($username, $email, $password) {
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

	private function generateSlug($username) {
		return sha1($username);
	}
	
	public function updateEmail($email, $id) {
		$db = Database::getInstance();
		$sql = 'UPDATE users SET email = ? WHERE id = ?';
		$param = array($email, $id);
		$db->prepare($sql, $param);
	}
	
	public function updatePassword($password, $id) {
		$db = Database::getInstance();
		$sql = 'Update users SET password = ? WHERE id = ?';
		$param = array(sha1($password), $id);
		$db->prepare($sql, $param);
	}

	public function deleteAccount($id) {
		$db = Database::getInstance();
		$sql = 'DELETE FROM users WHERE id = ?';
		$param = array($id);
		$db->prepare($sql, $param);
	}

	public function sendMessage($name, $email, $message) {
		$db = Database::getInstance();
		$sql = 'INSERT INTO messages(name, email, message)
				VALUES (?, ?, ?)';
		$param = array($name, $email, $message);
		$db->prepare($sql, $param);
	}
}
