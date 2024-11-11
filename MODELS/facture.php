<?php

class Facture {
    private $id;
    private $commande_id;
    private $etat;

    // Constructeur
    public function __construct($commande_id = "", $etat = "") {
        $this->commande_id = $commande_id;
        $this->etat = $etat;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getCommandeId() {
        return $this->commande_id;
    }

    public function getEtat() {
        return $this->etat;
    }

    // Setters
    public function setCommandeId($commande_id) {
        $this->commande_id = $commande_id;
    }

    public function setEtat($etat) {
        $this->etat = $etat;
    }
}

?>