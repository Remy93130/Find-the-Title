<?php

namespace model;

use \PDO;
use App\App;

require 'entity/Question.php';

require_once 'Database.php'; // Delete after test
require 'CategoryManager.php'; // Try to delete after test

class QuestionManager {
	
	public function getQuestions() {
		$db = Database::getInstance();
		$sql = 'SELECT * FROM questions';
		$req = $db->query($sql);
		return $req->fetchAll(PDO::FETCH_CLASS, "Question");
	}

	public function getQuestionsByCategory($cat)	{
		$db = Database::getInstance();
		$sql = 'SELECT Q.id, Q.category, Q.question, Q.image, Q.answer, C.name
				FROM questions Q, categories C
				WHERE C.id = Q.category
				 AND	C.name = ?';
		$param = array($cat);
		$req = $db->prepare($sql, $param);
		return $req->fetchAll(PDO::FETCH_CLASS, "Question");
	}

	public function generateQuestions($number, $theme=false) {
		if ($theme) {
			$data = $this->getQuestionsByCategory($theme);
		} else {
			$data = $this->getQuestions();
		}
		if ($number == 1) {
			return array($data[array_rand($data)]);
		}
		$key = array_rand($data, $number);
		$pack = array();
		foreach ($key as $i) {
			array_push($pack, $data[$i]);
		}
		return $pack;
	}


	public function getQuestionsAJAX($tournament) {
		$db = Database::getInstance();
		$sql = 'SELECT Q.id, Q.category, Q.question, Q.image, Q.answer, T.name
				FROM questions Q, tournaments T, selectedquestions SQ
				WHERE T.id = SQ.idTournament
					AND Q.id = SQ.idQuestions
					AND T.name = ?';
		$param = array($tournament);
		$req = $db->prepare($sql, $param);
		$data = $req->fetchAll(PDO::FETCH_CLASS);
		echo json_encode($data);
	}
}

$q = new QuestionManager();
$c = new CategoryManager();

var_dump($q->generateQuestions(2));
