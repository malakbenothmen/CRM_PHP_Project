<?php

class Commande {
    private $devis_id, $client_id, $acompte ,$etat , $date_livraison ;

    // Constructeur
    public function __construct($devis_id = "", $client_id="",  $acompte = "", $etat = "", $date_livraison = "") {
        $this->devis_id = $devis_id;
      
        $this->acompte = $acompte;
        $this->etat = $etat;
        $this->date_livraison = $date_livraison;
        $this->client_id = $client_id ;
    }

    // Getters
    public function getDevisId() {
        return $this->devis_id;
    }


    public function getAcompte() {
        return $this->acompte;
    }

    public function getEtat() {
        return $this->etat;
    }

    public function getDateLivraison() {
        return $this->date_livraison;
    }
    public function getClientId() {
        return $this->client_id;
    }

    // Setters 
    public function setClientId($client_id) {
        $this->client_id = $client_id;
    }

   
    public function setDevisId($devis_id) {
        $this->devis_id = $devis_id;
    }


    public function setAcompte($acompte) {
        $this->acompte = $acompte;
    }

    public function setEtat($etat) {
        $this->etat = $etat;
    }

    public function setDateLivraison($date_livraison) {
        $this->date_livraison = $date_livraison;
    }
}

