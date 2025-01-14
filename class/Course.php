<?php
require __DIR__ . "/../interface/coursInterface.php";
require __DIR__ . "/../class/Database.php";
class course implements coursInterface
{
    private $id;
    private $titre;
    private $description;
    private $content;
    private $contentVedeo;
    private $categorieId;
    private $enseignantId;
    public function __construct($titre, $description, $content, $contentVedeo, $categorieId, $enseignantId)
    {
        $this->titre = $titre;
        $this->description = $description;
        $this->content = $content;
        $this->contentVedeo = $contentVedeo;
        $this->categorieId = $categorieId;
        $this->enseignantId = $enseignantId;
    }


    public function createCourse($tagsArray)
    {
        $db = Database::getInstance()->getConnection();

        try {
            $db->beginTransaction();
            $sql = "insert into cours(titre,description,contenu,vedeo,categorie_id,enseignant_id) values(?,?,?,?,?,?)";
            $stmt = $db->prepare($sql);
            $stmt->execute([$this->titre, $this->description, $this->content, $this->contentVedeo, $this->categorieId, $this->enseignantId]);

            $coursId = $db->lastInsertId();

            foreach ($tagsArray as $tag) {
                $sql2 = "insert into cours_tags(cours_id,tag_id) values(?,?)";
                $stmt = $db->prepare($sql2);
                $stmt->execute([$coursId, $tag]);
            }
            $db->commit();
            echo "new course added";
        } catch (Exception $e) {
            $db->rollBack();
            echo "Failed to create course and attach tags: " . $e->getMessage();
        }
    }
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

//add new course with tags
$test = new course("Be A MASTER IN JS", "sagittis leo, sed interdum nisl nisl in erat. Aliquam volutpat suscipit faucibus. Suspendisse potenti.", NULL, "VEDEO.mp4", 2, 3);
$test->createCourse([3, 4]);
