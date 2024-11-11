<?php
class User {
    protected $username, $email, $password , $role;

    // Constructeur
    public function __construct($username = "", $email = "", $password = "", $role ="") {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role ;
    }

    // Getter pour $username
    public function getUsername() {
        return $this->username;
    }

    public function getRole() {
        return $this->role;
    }

    // Setter pour $username
    public function setUsername($username) {
        $this->username = $username;
    }

    // Getter pour $email
    public function getEmail() {
        return $this->email;
    }

    // Setter pour $email
    public function setEmail($email) {
        $this->email = $email;
    }

    // Getter pour $password
    public function getPassword() {
        return $this->password;
    }

    // Setter pour $password
    public function setPassword($password) {
        $this->password = $password;
    }

    public function setRole($role) {
        $this->role = $role;
    }
}
?>