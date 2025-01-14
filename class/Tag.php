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
    public function attachTagToCours($coursId){
        $db = Database::getInstance()->getConnection();
        try{
            $db->beginTransaction();
            foreach($this->tags as $tagId){
                $sql = "insert into cours_tags(cours_id,tag_id) values(?,?)";
                $stmt = $db->prepare($sql);
                $stmt->execute([$coursId,$tagId]);
            }
            $db->commit();
            echo "insterted successfully";
        }
        catch(PDOException $e){
            $db->rollBack();
            echo "failed to attach this tags to cours ".$e->getMessage(); 
        }
        // echo "inseerted successfully";
    }
}

// $arragyTags = [1,2,3];
// $obj = new tag($arragyTags);
// $obj->attachTagToCours(1);
// $obj = new tag($arragyTags);
// $obj->createTags();

