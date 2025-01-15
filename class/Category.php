<?php 
require_once __DIR__."/../class/Database.php";
class Category{
    protected $id;
    protected $name;

    public function __construct($name)
    {
        $this->name = $name;
    }
// WORK ON SHOW CATEGORIES
    public static function showcateroies(){
        $db = Database::getInstance()->getConnection();
        $sql = "select * from categories";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}