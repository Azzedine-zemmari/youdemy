<?php 
require "./user.php";
class etudiant extends user{
    public function __construct($nom,$email,$password)
    {
        parent::__construct($nom,$email,$password,'Etudiant');
    }

    public function login($email,$password){
        $db = database::getInstance()->getConnection();
        $sql = "select * from user where email = ? and role = 'Etudiant' ";
        $stmt = $db->prepare($sql);
        if($stmt->execute([$email])){
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if($user && password_verify($password,$user['password'])){
                $this->id = $user['id'];
                $this->nom = $user['name'];
                echo "welcome Etudiant {$this->nom}";
                return true;
            }
            else{
                return false;
            }
        }
    }
}

$test = new etudiant("ilyass","ilyas@gmail.com","ilyass2000");
// $test->register();
$test->login("ilyas@gmail.com","ilyass2000");