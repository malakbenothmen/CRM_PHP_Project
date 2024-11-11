<?php

include('User.php');

class Client extends User {
    private $entreprise;
    private $telephone;
    private $matriculeFiscale;
    private $adresse;
    private $pays;

    // Constructeur
    public function __construct($username = "", $email = "", $password = "", $role = "", $entreprise = "", $telephone = "", $matriculeFiscale = "", $adresse = "", $pays = "") {
        parent::__construct($username, $email, $password, $role);
        $this->entreprise = $entreprise;
        $this->telephone = $telephone;
        $this->matriculeFiscale = $matriculeFiscale;
        $this->adresse = $adresse;
        $this->pays = $pays;
    }

    // Getter pour $entreprise
    public function getEntreprise() {
        return $this->entreprise;
    }

    // Setter pour $entreprise
    public function setEntreprise($entreprise) {
        $this->entreprise = $entreprise;
    }

    // Getter pour $telephone
    public function getTelephone() {
        return $this->telephone;
    }

    // Setter pour $telephone
    public function setTelephone($telephone) {
        $this->telephone = $telephone;
    }

    // Getter pour $matriculeFiscale
    public function getMatriculeFiscale() {
        return $this->matriculeFiscale;
    }

    // Setter pour $matriculeFiscale
    public function setMatriculeFiscale($matriculeFiscale) {
        $this->matriculeFiscale = $matriculeFiscale;
    }

    // Getter pour $adresse
    public function getAdresse() {
        return $this->adresse;
    }

    // Setter pour $adresse
    public function setAdresse($adresse) {
        $this->adresse = $adresse;
    }

    // Getter pour $pays
    public function getPays() {
        return $this->pays;
    }

    // Setter pour $pays
    public function setPays($pays) {
        $this->pays = $pays;
    }
}
?>
