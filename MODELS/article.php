<?php


class Article {
    private $reference, $designation, $image, $description;

    // Constructeur
    public function __construct($reference = "", $designation = "", $image = "", $description = "") {
        $this->reference = $reference;
        $this->designation = $designation;
        $this->image = $image;
        $this->description = $description;
    }

    // Getter pour $reference
    public function getReference() {
        return $this->reference;
    }

    // Setter pour $reference
    public function setReference($reference) {
        $this->reference = $reference;
    }

    // Getter pour $designation
    public function getDesignation() {
        return $this->designation;
    }

    // Setter pour $designation
    public function setDesignation($designation) {
        $this->designation = $designation;
    }

    // Getter pour $image
    public function getImage() {
        return $this->image;
    }

    // Setter pour $image
    public function setImage($image) {
        $this->image = $image;
    }

    // Getter pour $description
    public function getDescription() {
        return $this->description;
    }

    // Setter pour $description
    public function setDescription($description) {
        $this->description = $description;
    }
}
?>
