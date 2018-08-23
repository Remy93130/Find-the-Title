<?php
namespace ftt\controller;

use App\App;
use ftt\model\AdminManager;

class AdminController extends AbstractController
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Method to display the admin panel check if the
     * user is logged or not and redirect to the good view
     */
    public function index()
    {
        if (empty($_SESSION['id']) && $_SESSION['id'] != 1) {
            App::forbiddenAccess();
        }
        $manager = new AdminManager();
        $token = App::generateCsrfToken();
        $title = "Panel admin";
        $messages = $manager->getMessages();
        $users = $manager->getUsers();
        $questions = $manager->getQuestions();
        foreach ($questions as $question) {
            if ($question->image) {
                $slug = sha1($question->answer);
                $question->slug = "<a href='image_answer/$slug' target='_blank'>Image</a>";
            } else {
                $question->slug = "N/A";
            }
        }
        $this->render('admin', compact('title', 'token', 'messages', 'users', 'questions'));
    }

    /**
     * Method to delete an item from the database
     * call the good manager to do the action
     */
    public function delete()
    {
        if (isset($_SESSION['token']) && $_GET['token'] == $_SESSION['token']) {
            App::forbiddenAccess();
        }
        $manager = new AdminManager();
        if ($_GET['target'] === 'user') {
            $manager->deleteUser($_GET['id']);
        } elseif ($_GET['target'] === 'question') {
            $manager->deleteQuestion($_GET['id']);
        } elseif ($_GET['target'] === 'message') {
            $manager->deleteMessage($_GET['id']);
        }
        App::addMessage('success', 'Suppresion effectuee');
        header('Location: index_admin.php');
        die();
    }
}
