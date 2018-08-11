<?php

namespace model;

use PDO;

require_once 'entity/Question.php';
require_once 'entity/User.php';
require_once 'entity/Message.php';

class AdminManager {
	
	public function getMessages() {
		$db = Database::getInstance();
		$sql = 'SELECT * FROM messages';
		$req = $db->query($sql);
		return $req->fetchAll(PDO::FETCH_CLASS, "Message");
	}
	
	public function getUsers() {
		$db = Database::getInstance();
		$sql = 'SELECT * FROM users';
		$req = $db->query($sql);
		return $req->fetchAll(PDO::FETCH_CLASS, 'User');
	}
	
	public function getQuestions() {
		$db = Database::getInstance();
		$sql = 'SELECT * FROM questions ORDER BY id DESC';
		$req = $db->query($sql);
		return $req->fetchAll(PDO::FETCH_CLASS, "Question");
	}
	
	public function deleteMessage($id) {
		$db = Database::getInstance();
		$sql = 'DELETE FROM messages WHERE id = ?';
		$param = [$id];
		$db->prepare($sql, $param);
	}
	
	public function deleteUser($id) {
		$db = Database::getInstance();
		$sql = 'DELETE FROM users WHERE id = ?';
		$param = [$id];
		$db->prepare($sql, $param);
	}
	
	public function deleteQuestion($id) {
		$db = Database::getInstance();
		$sql = 'DELETE FROM questions WHERE id = ?';
		$param = [$id];
		$db->prepare($sql, $param);
	}
}
