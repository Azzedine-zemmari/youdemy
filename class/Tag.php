<?php 
require __DIR__. "/../class/Database.php";
class tag{
    private $id;
    private $tags;

    public function __construct($tags)
    {
        $this->tags = $tags;
    }

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
    public function
}

// $arragyTags = ['HTML5','Basics','Web','dev'];
// $obj = new tag($arragyTags);
// $obj->createTags();