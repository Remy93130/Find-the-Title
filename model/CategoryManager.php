<?php

namespace model;

use \PDO;
use App\App;

require 'entity/Category.php';

require_once 'Database.php'; // Delete after test

class CategoryManager {
	
	public function getCategories()	{
		$db = Database::getInstance();
		$sql = 'SELECT * FROM categories';
		$req = $db->query($sql);
		return $req->fetchAll(PDO::FETCH_CLASS, "Category");
	}

	public function getRandomCategory()	{
		$data = $this->getCategories();
		return $data[array_rand($data)];
	}
}

/*$m = new CategoryManager();
var_dump($m->getCategories());
var_dump($m->getRandomCategory());
*/
