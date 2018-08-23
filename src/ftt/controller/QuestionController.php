<?php
namespace ftt\controller;

use App\App;
use ftt\model\QuestionManager;

class QuestionController extends AbstractController
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a json array with all questions
     */
    public function getQuestion()
    {
        if (!App::checkCsrfToken()) {
            die();
        }
        $tournament = $_POST['tournament'];
        $manager = new QuestionManager();
        $manager->getQuestionsAJAX($tournament, $_POST['all']);
    }

    /**
     * Check if the user can add his question
     */
    public function insertQuestion()
    {
        if (!App::checkCsrfToken()) {
            App::forbiddenAccess();
        }
        if ($_POST['question'] == "" || $_POST['answer'] == "") {
            App::addMessage('danger', "Merci de remplir tout les champs !");
            header('Location: index.php?action=addQuestion');
            die();
        }
        $upload = true;
        if ($_FILES['image']['error'] !== 4) {
            if ($this->validImage() == true) {
                $image = true;
            } else {
                $upload = false;
            }
        } else {
            $image = false;
        }
        if ($upload) {
            $manager = new QuestionManager();
            if ($image) {
                $manager->insertQuestion(
                    $_POST['category'],
                    $_POST['question'],
                    $_POST['answer'],
                    $_FILES['image']['tmp_name']
                );
            } else {
                $manager->insertQuestion(
                    $_POST['category'],
                    $_POST['question'],
                    $_POST['answer']
                );
            }
            App::addMessage('success', "Votre question a bien été envoyée.");
            $str = $_SESSION['username'] . "\n\tQuestion : " . $_POST['question'] .
                "\n\tRéponse : " . $_POST['answer'] . "\n";
            file_put_contents("cache/logQ.txt", $str);
        }
        header('Location: index.php?action=addQuestion');
    }


    /**
     * Check if the image is valid
     * @return boolean
     */
    private function validImage(): bool
    {
        $SIZE_CAPACITY = 134217728;
        $uploadCheck = true;

        $imageFile = $_FILES['image']['type'];
        $check = getimagesize($_FILES['image']["tmp_name"]);
        if ($check !== false) {
            $uploadCheck = true;
        } else {
            App::addMessage('danger', "Vous n'avez pas envoyé une image");
            $uploadCheck = false;
        }

        if ($_FILES["image"]["size"] >= $SIZE_CAPACITY) {
            App::addMessage('danger', "L'image est trop grande");
            $uploadCheck = false;
        }

        if ($imageFile != "image/jpg" && $imageFile !== "image/jpeg" && $imageFile !== "image/png") {
            App::addMessage('danger', "Le format n'est pas accepté");
            App::addMessage('info', "Les formats accepter sont jpg, jpeg et png");
            $uploadCheck = false;
        }

        if ($uploadCheck) {
            return true;
        } else {
            return false;
        }
    }
}
