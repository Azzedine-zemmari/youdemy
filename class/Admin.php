<?php 
session_start();
require_once __DIR__. "/User.php";

class Admin extends User{
    public function __construct($nom,$email,$password)
    {
        parent::__construct($nom,$email,$password,"Admin");
    }

    public static function login($email,$password){
        $db = Database::getInstance()->getConnection();
        $sql = "select * from user where email = ? and role = 'Admin'";
        $stmt = $db->prepare($sql);

        if($stmt->execute([$email])){
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if($user && password_verify($password,$user['password'])){
                $_SESSION['userId'] = $user['id'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['role'] = $user['role'];
                echo "hello Admin {$_SESSION['name']}";
                return true;
            }
            else{
                return false;
            }
        }
    }
    public static function showAllEnseignant(){
        $db = Database::getInstance()->getConnection();

        $sql = "select * from user where role = 'Enseignant'";

        $stmt = $db->prepare($sql);

        if($stmt->execute()){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    public static function activeEnseignant($userID){
        $db = Database::getInstance()->getConnection();

        $sql = "update user set status = 'active' where id = ?";
        $stmt = $db->prepare($sql);

        if($stmt->execute([$userID])){
            return true;
        }
        else{
            return false;
        }
    }

    public static function desactivEnseignant($userId){
        $db = Database::getInstance()->getConnection();

        $sql = "update user set status = 'suspended' where id = ?";
        $stmt = $db->prepare($sql);

        if($stmt->execute([$userId])){
            return true;
        }
        else{
            return false;
        }
    }
}

// $test = new Admin("Azzedine","azzedine@gmail.com","azzedine2004");
// $test->register();
// $test->login("azzedine@gmail.com","azzedine2004");