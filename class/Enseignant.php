<?php
require "./User.php";

class Enseignant extends User{
    public function __construct($nom,$email,$password)
    {
        parent::__construct($nom,$email,$password,"Enseignant");
    }
    public function login($email,$password){
        $db = Database::getInstance()->getConnection();

        $sql = 'select * from user where email = ? and role = "Enseignant"';
        $stmt = $db->prepare($sql);

        if($stmt->execute([$email])){
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if($user && password_verify($password,$user['password'])){
                $this->id = $user['id'];
                $this->nom = $user['name'];
                echo "welcome Enseignant {$this->nom}";
            }
            else{
                echo "error in the login";
            }
        }

    }
}

$test = new Enseignant("abid","abid@gmail.com","abid123");
// $test->register();
// $test->login("abid@gmail.com","abid123");