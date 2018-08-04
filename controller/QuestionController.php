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
       $manager = new QuestionManager();
       $tournament = $_POST['tournament'];
       $manager->getQuestionsAJAX($tournament);
   }
}
