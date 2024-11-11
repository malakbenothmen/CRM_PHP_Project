<?php

class DemandeDevis {
    private $client_id, $etat , $msg , $type ;

    // Constructeur
    public function __construct($client_id = "", $etat = "", $msg= "" , $type = "") {
        $this->client_id = $client_id;
        $this->etat = $etat;
        $this->msg = $msg;
        $this->type = $type;

    }


    // Getter pour $client_id
    public function getClientId() {
        return $this->client_id;
    }

    // Setter pour $client_id
    public function setClientId($client_id) {
        $this->client_id = $client_id;
    }

    // Getter pour $etat
    public function getEtat() {
        return $this->etat;
    }

    // Setter pour $etat
    public function setEtat($etat) {
        $this->etat = $etat;
    }

    public function getMsg()
    {
        return $this->msg ;
    }

    public function getType() {
        return $this->type;
    }

    public function setMsg($msg) {
        $this->msg = $msg;
    }

    public function setType($type) {
        $this->type = $type;
    }
}
?>
