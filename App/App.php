<?php

namespace App;

/**
 * Class who contain static methods for the application
 * @author Barberet Rémy
 * @version 1.0.0
 */
class App {

	/**
	 * Generate 404 error
	 */
	public static function notFound() {
		header('HTTP/1.0 404 Not Found');
		die('Page not found.');
	}

	/**
	 * Generate 403 error
	 */
	public static function forbiddenAccess() {
		header('HTTP/1.0 403 Forbidden');
		die('You can\'t see this page.');
	}

	/**
	 * Add a message in the flashbag with session
	 * Expected work with the file flashbag.php
	 * @param string $type    type of message
	 * @param string $message message
	 */
	public static function addMessage($type='info', $message) {
		if (!isset($_SESSION['flashBag'])) {
			$_SESSION['flashBag'] = array();
		}
		$message = array(
			'type'    => $type, 
			'message' => $message
		);
		array_push($_SESSION['flashBag'], $message);
	}

	/**
	 * Check if an user is connected with var 'id' in $_SESSION array
	 * @return boolean 
	 */
	public static function userLogged() {
		return isset($_SESSION['id']);
	}

	/**
	 * Create a session for the user
	 * @param  array $data associative array with the
	 *                     name and the value
	 */
	public static function createUserSession($data) {
		foreach ($data as $name => $value) {
			$_SESSION[$name] = $value;
		}
	}

	/**
	 * Generate a token to avois CSRF breach and insert
	 * the token in $_SESSION['array']
	 * @return string The token
	 */
	public static function generateCsrfToken() {
		$token = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
		$_SESSION['token'] = $token;
		return $token;
	}

	/**
	 * Check if the token given in parameter match with
	 * the token $_SESSION['token']
	 * @return boolean
	 */
	public static function checkCsrfToken($token)	{
		return (
			isset($_SESSION['token']) && 
			isset($_POST['token']) && 
			!empty($_SESSION['token']) && 
			!empty($_POST['token']) &&
			$_SESSION['token'] == $token
		);
	}
}
