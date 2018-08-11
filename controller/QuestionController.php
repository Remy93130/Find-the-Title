<?php
namespace controller;

use model\QuestionManager;
use App\App;

class QuestionController extends MainController {
    
   function __construct() {
       parent::__construct();
   }
   public function getQuestion() {
        if (empty($_POST['token']) || !App::checkCsrfToken($_POST['token'])) {
            die();
        }
       $tournament = $_POST['tournament'];
       $manager = new QuestionManager();
       $manager->getQuestionsAJAX($tournament, $_POST['all']);
   }
   
    public function insertQuestion() {
        if (!App::checkCsrfToken($_POST['token'])) {
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
                $manager->insertQuestion($_POST['category'], $_POST['question'], $_POST['answer'], $_FILES['image']['tmp_name']);
            } else {
                $manager->insertQuestion($_POST['category'], $_POST['question'], $_POST['answer']);
            }
            App::addMessage('success', "Votre question a bien été envoyée.");
            $str = $_SESSION['username'] . "\n\tQuestion : " . $_POST['question'] . "\n\tRéponse : " . $_POST['answer'] . "\n";
            file_put_contents("cache/logQ.txt",  $str);
        }
        header('Location: index.php?action=addQuestion');
    }
   
    private function validImage() {
        $SIZE_CAPACITY = 134217728;
        $uploadCheck = true;

        $target_file = basename($_FILES["image"]["name"]);
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
            return $target_file;
        } else {
            return false;
        }
    }
}
