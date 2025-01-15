<?php
// require __DIR__ . "/../interface/coursInterface.php";
require_once __DIR__ . "/../class/Database.php";
abstract class course
{
    protected $id;
    protected $titre;
    protected $description;
    protected $content;
    protected $contentVedeo;
    protected $categorieId;
    protected $enseignantId;
    protected $type;
    protected $price;

    public function __construct($titre, $description, $content, $contentVedeo, $categorieId, $enseignantId,$price,$type=null)
    {
        $this->titre = $titre;
        $this->description = $description;
        $this->content = $content;
        $this->contentVedeo = $contentVedeo;
        $this->categorieId = $categorieId;
        $this->enseignantId = $enseignantId;
        $this->type = $type;
        $this->price = $price;
    }


    abstract public function createCourse($tagsArray);
    // work on createCourse and showCourse

    public static function showCourse()
    {
        $db = Database::getInstance()->getConnection();
        $sql = "select cours.*,categories.nom as CategoryName,user.name as Enseignant , group_concat(tags.nom) as tags from cours 
        join categories on categories.idCategory = cours.categorie_id 
        join user on user.id = cours.enseignant_id 
        join cours_tags on cours.idCours = cours_tags.cours_id
        join tags on tags.idTag = cours_tags.tag_id
        group by cours.idCours";
        $stmt = $db->prepare($sql);
        if ($stmt->execute()) {
            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $user;
        } else {
            return [];
        }
    }
    public static function search($keyword)
    {
        $db = Database::getInstance()->getConnection();
        $sql = "select cours.* , categories.nom as CategoryName from cours join categories on categories.idCategory = cours.categorie_id where categories.nom like ? or cours.titre like ?";
        $stmt = $db->prepare($sql);
        $keyword = "%" . $keyword . "%";
        $stmt->execute([$keyword, $keyword]);

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
