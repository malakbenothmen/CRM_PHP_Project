<?php
require_once(__DIR__ . '/../MODELS/user.php');
require_once(__DIR__ . '/../DATABASE/config.php');
class UserController extends Connexion{
function __construct() {
parent::__construct();
}

function insert(User $u){

        $existingUser = $this->getUserByEmail($u->getEmail());
        if ($existingUser) {
            echo "<script>alert('email exist deja veuillez connecter alos')</script>";
            exit();
        }
        else {
        $query="INSERT INTO users (username,email,password,role) values (?, ?, ?, ?)";
        $res=$this->conn->prepare($query);

        $aryy =array($u->getUsername(),$u->getEmail(),$u->getPassword(),$u->getRole()) ;
        //var_dump($aryy);
        return $res->execute($aryy);
        }

}

function getUserByEmail($email){
    $query="SELECT * FROM users WHERE email = ? ";
    $res = $this->conn->prepare($query);
    $res->execute(array($email));
    $array= $res->fetch(PDO:: FETCH_ASSOC);
    return $array;
}








}
?>