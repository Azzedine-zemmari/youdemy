<?php
session_start();
require_once __DIR__. "/./User.php";

class Enseignant extends User{
    public function __construct($nom,$email,$password)
    {
        parent::__construct($nom,$email,$password,"Enseignant");
    }
    public static function login($email,$password){
        $db = Database::getInstance()->getConnection();

        $sql = 'select * from user where email = ? and role = "Enseignant"';
        $stmt = $db->prepare($sql);

        if($stmt->execute([$email])){
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if($user && password_verify($password,$user['password'])){
                $_SESSION['userId'] = $user['id'];
                $_SESSION['userName'] = $user['name'];
                $_SESSION['role'] = $user['role'];
                echo "welcome Enseignant {$user['name']}";
            }
            else{
                echo "error in the login";
            }
        }

    }
}

// $test = new Enseignant("abid","abid@gmail.com","abid123");
// $test->register();
// $test->login("abid@gmail.com","abid123");