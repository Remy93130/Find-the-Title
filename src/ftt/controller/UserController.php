<?php
namespace ftt\controller;

use App\App;
use ftt\model\UserManager;

class UserController extends AbstractController
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Check if the user typed right logs and create is session if true
     * else redirect to the index page
     */
    public function login()
    {
        if (empty($_POST['token']) || ! App::checkCsrfToken($_POST['token'])) {
            header('Location: index.php');
        }
        if (empty($_POST['username']) || empty($_POST['password'])) {
            die();
        }
        $manager = new UserManager();
        if ($data = $manager->loginUser($_POST['username'], $_POST['password'])) {
            App::createUserSession(array(
                'id' => $data[0]->id,
                'username' => $data[0]->username,
                'email' => $data[0]->email,
                'slug' => $data[0]->slug
            ));
            header('Location: index.php');
        } else {
            $str = 'Nom de compte ou mot de passe incorrect !';
            App::addMessage('danger', $str);
            header('Location: index.php');
        }
    }

    /**
     * Ajax request get all username
     */
    public function getAllUsername()
    {
        $manager = new UserManager();
        if (!App::checkCsrfToken()) {
            App::forbiddenAccess();
        }
        echo json_encode($manager->getAllUsername());
    }

    /**
     * Check if the information to create an account are correct
     */
    public function registration()
    {
        if (!App::checkCsrfToken()) {
            App::forbiddenAccess();
        }
        if ($_POST['username'] != "" && $_POST['password'] != "" && $_POST['cgu'] &&
            filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $manager = new UserManager();
            $manager->addUser($_POST['username'], $_POST['email'], $_POST['password']);
            $str = "Votre compte a bien été créée vous pouvez maintenant vous connecter.";
            App::addMessage('success', $str);
            header("Location: index.php");
        } else {
            $str = "Merci de remplir tout les champs correctement !";
            App::addMessage("danger", $str);
            header('Location: index.php?action=register');
        }
    }

    /**
     * Check is the new email is correct
     */
    public function updateEmail()
    {
        if (!App::checkCsrfToken()) {
            App::forbiddenAccess();
        }
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $manager = new UserManager();
            $manager->updateEmail($_POST['email'], $_SESSION['id']);
            $str = "Votre adresse Email a bien été modifier.";
            App::addMessage('success', $str);
        } else {
            $str = "Merci de rentrer une adresse Email valide.";
            App::addMessage('danger', $str);
        }
        header('Location: index.php');
    }

    /**
     * Check if the old password is correct to insert a new one
     */
    public function updatePassword()
    {
        if (!App::checkCsrfToken()) {
            App::forbiddenAccess();
        }
        $manager = new UserManager();
        if ($manager->loginUser($_SESSION['username'], $_POST['old-password'])) {
            $manager->updatePassword($_POST['password'], $_SESSION['id']);
            $str = "Votre mot de passe a bien ete modifier.";
            App::addMessage('success', $str);
        } else {
            $str = "Votre mot de passe est incorrect.";
            App::addMessage('danger', $str);
        }
        header('Location: index.php');
    }

    /**
     * Check if the password is correct to delete the account
     */
    public function deleteAccount()
    {
        if (!App::checkCsrfToken()) {
            App::forbiddenAccess();
        }
        $manager = new UserManager();
        if ($manager->loginUser($_SESSION['username'], $_POST['password'])) {
            $manager->deleteAccount($_SESSION['id']);
            session_unset();
            $str = "Votre compte a bien été supprimer.";
            App::addMessage('success', $str);
        } else {
            $str = "Votre mot de passe est incorrect.";
            App::addMessage('danger', $str);
        }
        header('Location: index.php');
    }
}
