<?php

namespace model;

use PDO;

require 'entity/Category.php';

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
