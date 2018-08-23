<?php
namespace ftt\model;

use PDO;

require_once 'entity/Category.php';

class CategoryManager
{

    /**
     * get all categories
     * @return array
     */
    public function getCategories() : array
    {
        $db = Database::getInstance();
        $sql = 'SELECT * FROM categories';
        $req = $db->query($sql);
        return $req->fetchAll(PDO::FETCH_CLASS, "Category");
    }

    /**
     * Get a random category from the database
     * @return \Category
     */
    public function getRandomCategory() : \Category
    {
        $data = $this->getCategories();
        return $data[array_rand($data)];
    }
}
