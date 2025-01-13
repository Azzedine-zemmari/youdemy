<?php
require "./database.php";
abstract class user{
    protected $id;
    protected $nom;
    protected $email;
    protected $password;
    protected $role;

    public function __construct($nom,$email,$password,$role = null)
    {
        $this->nom = $nom;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_BCRYPT);
        $this->role = $role;
    }

    public function register(){
        $db = database::getInstance()->getConnection();
        $sql = 'insert into user(name,email,password,role) values(?,?,?,?)';
        $stmt = $db->prepare($sql);
        if($stmt->execute([$this->nom,$this->email,$this->password,$this->role])){
            echo "{$this->nom} is registered";
        }
        else{
            echo "error";
        }

    }

    abstract public function login($email,$password);
}