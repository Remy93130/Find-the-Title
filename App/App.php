<?php
namespace App;

/**
 * Class who contain static methods for the application
 *
 * @author Barberet Rémy
 * @version 1.0.2
 */
class App
{

    /**
     * Generate 404 error
     */
    public static function notFound()
    {
        header('HTTP/1.0 404 Not Found');
        require_once '../view/404.php';
        die();
    }

    /**
     * Generate 403 error
     */
    public static function forbiddenAccess()
    {
        header('HTTP/1.0 403 Forbidden');
        die('You can\'t see this page.');
    }

    /**
     * Add a message in the flashbag with session
     * Expected work with the file flashbag.php
     *
     * @param string $type
     *            type of message
     * @param string $message
     *            message
     */
    public static function addMessage($type, $message)
    {
        if (! isset($_SESSION['flashBag'])) {
            $_SESSION['flashBag'] = array();
        }
        $message = array(
            'type' => $type,
            'message' => $message
        );
        array_push($_SESSION['flashBag'], $message);
    }

    /**
     * Check if an user is connected with var 'id' in $_SESSION array
     *
     * @return boolean
     */
    public static function userLogged()
    {
        return isset($_SESSION['id']);
    }

    /**
     * Create a session for the user
     *
     * @param array $data
     *            associative array with the
     *            name and the value
     */
    public static function createUserSession($data)
    {
        foreach ($data as $name => $value) {
            $_SESSION[$name] = $value;
        }
    }

    /**
     * Generate a token to avois CSRF breach and insert
     * the token in $_SESSION['array']
     *
     * @return string The token
     */
    public static function generateCsrfToken() : string
    {
        $token = bin2hex(random_bytes(32));
        $_SESSION['token'] = $token;
        return $token;
    }

    /**
     * Check if the token given in $_POST['token'] match with
     * the token $_SESSION['token']
     *
     * @return bool
     */
    public static function checkCsrfToken() : bool
    {
        return (
            isset($_SESSION['token']) && isset($_POST['token']) &&
            ! empty($_SESSION['token']) && ! empty($_POST['token']) &&
            $_SESSION['token'] == $_POST['token']
        );
    }
}
