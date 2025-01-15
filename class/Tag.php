<?php 
require_once __DIR__. "/../class/Database.php";
class tag{
    private $id;
    private $tags;

    public function __construct($tags)
    {
        $this->tags = $tags;
    }

    // this for admin to create multiple tags
    public function createTags(){
        $db = Database::getInstance()->getConnection();
        try{
            $db->beginTransaction();
            foreach($this->tags as $tag){
                $sql = "insert into tags(nom) values(?)";
                $stmt = $db->prepare($sql);
                $stmt->execute([$tag]);
            }
            $db->commit();
            echo "tags inserted successfully";
        }
        catch(PDOException $e){
            $db->rollBack();
            echo "failed to insert multiples tags".$e->getMessage();
        }
    }
    // this to show the formateur all tags
    public static function showTags(){
        $db = Database::getInstance()->getConnection();
        $sql = "select * from tags";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $tags = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

// $arragyTags = [1,2,3];
// $obj = new tag($arragyTags);
// $obj->attachTagToCours(1);
// $obj = new tag($arragyTags);
// $obj->createTags();

