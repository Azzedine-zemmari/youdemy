<?php 
session_start();
require "./User.php";

class Admin extends User{
    public function __construct($nom,$email,$password)
    {
        parent::__construct($nom,$email,$password,"Admin");
    }

    public function login($email,$password){
        $db = Database::getInstance()->getConnection();
        $sql = "select * from user where email = ? and role = 'Admin'";
        $stmt = $db->prepare($sql);

        if($stmt->execute([$email])){
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if($user && password_verify($password,$user['password'])){
                $_SESSION['userId'] = $user['id'];
                $this->nom = $user['name'];
                $_SESSION['role'] = $user['role'];
                echo "hello Admin {$this->nom}";
                return true;
            }
            else{
                return false;
            }
        }
    }
}

$test = new Admin("Azzedine","azzedine@gmail.com","azzedine2004");
// $test->register();
// $test->login("azzedine@gmail.com","azzedine2004");