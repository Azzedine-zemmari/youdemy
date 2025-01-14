<?php
require __DIR__. "/../interface/coursInterface.php";
require __DIR__. "/../class/Database.php";
class course implements coursInterface{
    private $id;
    private $titre;
    private $description;
    private $content;
    private $contentVedeo;
    private $categorieId;
    private $enseignantId;
    public function __construct($titre,$description,$content,$contentVedeo,$categorieId,$enseignantId)
    {
        $this->titre = $titre;
        $this->description = $description;
        $this->content = $content;
        $this->contentVedeo = $contentVedeo;
        $this->categorieId = $categorieId;
        $this->enseignantId = $enseignantId;
    }


    public function createCourse(){
        $db = Database::getInstance()->getConnection();
        $sql = "insert into cours(titre,description,contenu,vedeo,categorie_id,enseignant_id) values(?,?,?,?,?,?)";
        $stmt = $db->prepare($sql);

        $result = $stmt->execute([$this->titre,$this->description,$this->content,$this->contentVedeo,$this->categorieId,$this->enseignantId]);
        if($result){
            echo "new course added";
        }
        else{
            echo "shit";
        }

    }
    public static function showCourse()
    {
        $db = Database::getInstance()->getConnection();
        $sql = "select cours.*,categories.nom as CategoryName,user.name as EnseignantName from cours join categories on categories.idCategory = cours.categorie_id join user on user.id = cours.enseignant_id";
        $stmt = $db->prepare($sql);
        if($stmt->execute()){
            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $user;
        }
        else{
            return [];
        }
    }
    public static function recherche($keyword){
        $db = Database::getInstance()->getConnection();
        $sql = "select cours.* , categories.nom as CategoryName from cours join categories on categories.idCategory = cours.categorie_id where categories.nom like ? or cours.titre like ?";
        $stmt = $db->prepare($sql);
        $keyword = "%".$keyword."%";
        $stmt->execute([$keyword,$keyword]);

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
        
    }
}

// $test = new course("from zero to hero in HTML5","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum semper, libero sed mollis porta, purus mi sagittis leo, sed interdum nisl nisl in erat. Aliquam volutpat suscipit faucibus. Suspendisse potenti.","
// Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum semper, libero sed mollis porta, purus mi sagittis leo, sed interdum nisl nisl in erat. Aliquam volutpat suscipit faucibus. Suspendisse potenti. Donec non turpis semper, tempus metus id, molestie dolor. Quisque nec dolo",NULL,1,3);
// $test->createCourse();

// $courses = course::showCourse();
// if(!empty($courses)){
//     foreach($courses as $course){
//         echo "Title: ".$course['titre']."<br/>";
//         echo "Description: ".$course['description']."<br/>";
//         echo "Contenu: ".$course['contenu']."<br/>";
//         echo "Category: ".$course['CategoryName']."<br/>";
//         echo "Formateur: ".$course['EnseignantName']."<br/>";
//     }
// }

// $test = course::recherche("css");
// if(!empty($test)){
//     foreach($test as $t){
//         echo "Title: ".$t['titre'];
//     }
// }
// else{
//     echo "nothing found ";
// }
