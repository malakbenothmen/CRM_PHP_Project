<?php
class DevisDetails {
    private $devis_id, $article_id, $qte_total, $logo, $info_supp, $prix_HT, $TVA , $title;

    // Constructeur
    public function __construct($devis_id = "" , $article_id = Null , $qte_total = "", $logo = "" ,$title = "", $prix_HT = null, $TVA = null ) {
        $this->devis_id = $devis_id;
        $this->article_id = $article_id;
        $this->qte_total = $qte_total;
        $this->logo = $logo;
        $this->prix_HT = $prix_HT;
        $this->TVA = $TVA;
        $this->title = $title ;
    }

    // Getter pour $devis_id
    public function getDevisId() {
        return $this->devis_id;
    }

    // Setter pour $devis_id
    public function setDevisId($devis_id) {
        $this->devis_id = $devis_id;
    }

    // Getter pour $article_id
    public function getArticleId() {
        return $this->article_id;
    }

    // Setter pour $article_id
    public function setArticleId($article_id) {
        $this->article_id = $article_id;
    }

    public function getTitle() {
        return $this->title;
    }

    // Setter pour $article_id
    public function setTitle($title) {
        $this->title = $title;
    }

    // Getter pour $qte_total
    public function getQteTotal() {
        return $this->qte_total;
    }

    // Setter pour $qte_total
    public function setQteTotal($qte_total) {
        $this->qte_total = $qte_total;
    }

    // Getter pour $logo
    public function getLogo() {
        return $this->logo;
    }

    // Setter pour $logo
    public function setLogo($logo) {
        $this->logo = $logo;
    }

    // Getter pour $info_supp
    public function getInfoSupp() {
        return $this->info_supp;
    }

    // Setter pour $info_supp
    public function setInfoSupp($info_supp) {
        $this->info_supp = $info_supp;
    }

    // Getter pour $prix_HT
    public function getPrixHT() {
        return $this->prix_HT;
    }

    // Setter pour $prix_HT
    public function setPrixHT($prix_HT) {
        $this->prix_HT = $prix_HT;
    }

    // Getter pour $TVA
    public function getTVA() {
        return $this->TVA;
    }

    // Setter pour $TVA
    public function setTVA($TVA) {
        $this->TVA = $TVA;
    }
}
?>
