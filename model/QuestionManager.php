<?php

namespace model;

use \PDO;

require 'entity/Question.php';

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


	public function getQuestionsAJAX($tournament, $all) {
		$db = Database::getInstance();
		if ($all == 1) {
			$sql = 'SELECT * FROM questions';
			$req = $db->query($sql);
		} else {
			$sql = 'SELECT Q.id, Q.category, Q.question, Q.image, Q.answer, T.name
					FROM questions Q, tournaments T, selectedquestions SQ
					WHERE T.id = SQ.idTournament
						AND Q.id = SQ.idQuestions
						AND T.id = ?';
			$param = array($tournament);
			$req = $db->prepare($sql, $param);
		}
		$data = $req->fetchAll(PDO::FETCH_CLASS, "Question");
		foreach ($data as $question) {
			if ($question->image) {
				$question->slug = $question->insertImage(dirname(__DIR__) . "/public/image_answer/");
				$question->image = null;
		    }
		}
		echo json_encode($data);
	}
	
	public static function clearQuestions() {
	    $db = Database::getInstance();
	    $sql = 'DELETE FROM selectedquestions';
	    $db->query($sql);
	}
	
	public function insertQuestion($category, $question, $answer, $image=false) {
		$db = Database::getInstance();
        if ($image) {
            $sql = 'INSERT INTO questions (category, question, image, answer)
                    VALUES (?, ?, ?, ?)';
            $param = array($category, $question, file_get_contents($image), $answer);
        } else {
        	$sql = 'INSERT INTO questions (category, question, answer)
        	        VALUES (?, ?, ?)';
        	$param = array($category, htmlspecialchars($question), htmlspecialchars($answer));
        }
        $db->prepare($sql, $param);
	}
}
