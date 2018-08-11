<?php

namespace model;

use \PDO;
use PDOStatement;

class Database {

	/**
	 * The PDO class
	 * @var PDO
	 */
	private $PDOInstance = null;

	/**
	 * The Database class
	 * @var Object
	 * @static
	 */
	private static $instance = null;

	private function __construct() {
		$data = $this->getData();
		$this->PDOInstance = new PDO(
			'mysql:host='.$data->database->db_host.';dbname='.$data->database->db_name,
			$data->database->db_user,
			$data->database->db_pwd
		);
		$this->PDOInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$req = $this->PDOInstance->prepare("SET NAMES 'utf8'");
		$req->execute();
	}

	/**
	 * Read the data in the file config.json
	 * @return Object
	 */
	private function getData() {
		$file = fopen(dirname(__DIR__) . '/App/config.json', 'r');
		$data = "";
		while ($line = fgets($file)) {
			$data .= $line;
		}
		return json_decode($data);
	}

	/**
	 * Create and return the database
	 * @return Database $_instance
	 */
	public static function getInstance() {  
		if(is_null(self::$instance)) {
			self::$instance = new Database();
		}
		return self::$instance;
	}

	/**
	 * Execute an SQL request
	 * @param  String $query The request
	 * @return PDOStatement 
	 */
	public function query($query) {
		return $this->PDOInstance->query($query);
	}

	/**
	 * Execute a prepare SQL request
	 * @param  string $query      The request
	 * @param  array $attributes  Different var to bind
	 * @return PDOStatement
	 */
	public function prepare($query, $attributes) {
		$req = $this->PDOInstance->prepare($query);
		$req->execute($attributes);
		return $req;
	}
}
