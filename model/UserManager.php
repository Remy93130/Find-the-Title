<?php

namespace model;

use \PDO;
use App\App;

require 'entity/User.php';
require 'Database.php';

class UserManager {

	public function loginUser($username, $password) {
		$db = Database::getInstance();
		$sql = 'SELECT * FROM users 
				WHERE username = ? AND password = ?';
		$param = array($username, sha1($password));
		$req = $db->prepare($sql, $param);
		return $req->fetchAll(PDO::FETCH_CLASS, "User");
	}

	public function getUsers() {
		$db = Database::getInstance();
		$sql = 'SELECT * FROM users';
		$req = $db->query($sql);
		return $data = $req->fetchAll(PDO::FETCH_CLASS, "User");
	}

	public function getUser($id) {
		$db = Database::getInstance();
		$sql = 'SELECT * FROM users WHERE id = :id';
		$param = array('id' => $id);
		$req = $db->prepare($sql, $param);
		$data = $req->fetchAll(PDO::FETCH_CLASS, "User");
		if ($data == array()) {
			App::notFound();
		}
		return $data[0];
	}

	public function getAllUsername() {
		$db = Database::getInstance();
		$sql = 'SELECT username FROM users';
		$req = $db->query($sql);
		return $req->fetchAll(PDO::FETCH_COLUMN);
	}
}

$UserManager = new UserManager();
$UserManager->getAllUsername();
