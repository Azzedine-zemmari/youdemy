<?php 
// session_start();
require_once __DIR__. "/./User.php";
class Etudiant extends User{
    public function __construct($nom,$email,$password)
    {
        parent::__construct($nom,$email,$password,'Etudiant');
    }

    public static function login($email,$password){
        $db = Database::getInstance()->getConnection();
        $sql = "select * from user where email = ? and role = 'Etudiant' ";
        $stmt = $db->prepare($sql);
        if($stmt->execute([$email])){
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if($user && password_verify($password,$user['password'])){
                $_SESSION['userId'] = $user['id'];
                $_SESSION['nom'] = $user['name'];
                $_SESSION['role'] = $user['role'];
                echo "welcome {$user['role']} {$user['name']}";
                return true;
            }
            else{
                return false;
            }
        }
    }
    // show enrolled Courses by a student
    public static function showEnrolledCourses($userId){
        $db = Database::getInstance()->getConnection();
        $sql = "select user.name as etudiantName , cours.titre as titreCours , cours.description as description , cours.vedeo as vedeo , cours.idCours as CoursId   from youdemy.favoris 
        join user on user.id = favoris.etudiant_id 
        join cours on cours.idCours = favoris.cours_id
        where user.id = ?";
        $stmt = $db->prepare($sql);
        if($stmt->execute([$userId])){
           return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
}

// $test = new Etudiant("amine","amine@gmail.com","amine4000");
// $test->register();
// $test->login("ilyas@gmail.com","ilyass2000");
// $test->logout();