<?php
namespace ftt\model;

use PDO;

require_once 'entity/Question.php';

class QuestionManager
{

    /**
     * Get all questions
     * @return array
     */
    public function getQuestions() : array
    {
        $db = Database::getInstance();
        $sql = 'SELECT * FROM questions';
        $req = $db->query($sql);
        return $req->fetchAll(PDO::FETCH_CLASS, "Question");
    }

    /**
     * get all questions from a category
     * @param string $cat
     * @return array
     */
    public function getQuestionsByCategory(string $cat) : array
    {
        $db = Database::getInstance();
        $sql = 'SELECT Q.id, Q.category, Q.question, Q.image, Q.answer, C.name
				FROM questions Q, categories C
				WHERE C.id = Q.category
				 AND	C.name = ?';
        $param = array(
            $cat
        );
        $req = $db->prepare($sql, $param);
        return $req->fetchAll(PDO::FETCH_CLASS, "Question");
    }

    /**
     * Generate questions randomly
     * @param int $number
     * @param string|bool $theme
     * @return array
     */
    public function generateQuestions(int $number, $theme = false) : array
    {
        if ($theme) {
            $data = $this->getQuestionsByCategory($theme);
        } else {
            $data = $this->getQuestions();
        }
        if ($number == 1) {
            return array(
                $data[array_rand($data)]
            );
        }
        $key = array_rand($data, $number);
        $pack = array();
        foreach ($key as $i) {
            array_push($pack, $data[$i]);
        }
        return $pack;
    }

    /**
     * Display all questions from a tournament
     * @param string $tournament
     * @param bool $all
     */
    public function getQuestionsAJAX(string $tournament, bool $all)
    {
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
            $param = array(
                $tournament
            );
            $req = $db->prepare($sql, $param);
        }
        $data = $req->fetchAll(PDO::FETCH_CLASS, "Question");
        foreach ($data as $question) {
            if ($question->image) {
                $question->slug = $question->insertImage(dirname(__DIR__) . "/../../public/image_answer/");
                $question->image = null;
            }
        }
        echo json_encode($data);
    }

    /**
     * Wipe questions from tournaments
     */
    public static function clearQuestions()
    {
        $db = Database::getInstance();
        $sql = 'DELETE FROM selectedquestions';
        $db->query($sql);
    }

    /**
     * Insert a question in the database
     * @param string $category
     * @param string $question
     * @param string $answer
     * @param string|bool $image
     */
    public function insertQuestion(string $category, string $question, string $answer, $image = false)
    {
        $db = Database::getInstance();
        if ($image) {
            $sql = 'INSERT INTO questions (category, question, image, answer)
                    VALUES (?, ?, ?, ?)';
            $param = array(
                $category,
                $question,
                file_get_contents($image),
                $answer
            );
        } else {
            $sql = 'INSERT INTO questions (category, question, answer)
        	        VALUES (?, ?, ?)';
            $param = array(
                $category,
                htmlspecialchars($question),
                htmlspecialchars($answer)
            );
        }
        $db->prepare($sql, $param);
    }
}
