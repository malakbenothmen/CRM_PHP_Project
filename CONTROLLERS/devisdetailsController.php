<?php
require_once(__DIR__ . '/../MODELS/devisDetails.php');
require_once(__DIR__ . '/../DATABASE/config.php');

class DevisDetailsController extends Connexion {
    function __construct() {
        parent::__construct();
    }

    function insertDevisDetails(DevisDetails $devisDetails) {

        $query = "INSERT INTO devisdetails (devis_id, article_id, qte_total, logo,title, prix_HT, TVA) VALUES (?, ? , ?, ?, ?, NULL , NULL)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$devisDetails->getDevisId(), $devisDetails->getArticleId(), $devisDetails->getQteTotal(), $devisDetails->getLogo(),$devisDetails->getTitle()]);
        return $stmt->rowCount(); 
    }
    
    function updatePricing($devis_id, $article_id, $prix_HT, $TVA ) {
        if ($article_id=="") {       
            $query = "UPDATE devisdetails SET prix_HT = ?, TVA = ?  WHERE devis_id = ? AND article_id IS NULL";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$prix_HT, $TVA, $devis_id]);
        } else {
            $query = "UPDATE devisdetails SET prix_HT = ?, TVA = ?  WHERE devis_id = ? AND article_id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$prix_HT, $TVA, $devis_id, $article_id]);
        }
        return $stmt->rowCount()>0; 
    }
    
    function updateEtat($etat , $id)
    {       $query = "UPDATE demandedevis SET etat = ? WHERE devis_id = ? ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$etat, $id]);
        return $stmt->rowCount();
     }

    function updateDevisDetails(DevisDetails $devisDetails) {
        $query = "UPDATE devisdetails SET qte_total = ?, logo = ?, info_supp = ? WHERE devis_id = ? AND article_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$devisDetails->getQteTotal(), $devisDetails->getLogo(), $devisDetails->getInfoSupp(), $devisDetails->getDevisId(), $devisDetails->getArticleId()]);
        return $stmt->rowCount(); 
    }


    function deleteDevisDetails($devis_id, $article_id) {
        $query = "DELETE FROM devisdetails WHERE devis_id = ? AND article_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$devis_id, $article_id]);
        return $stmt->rowCount(); 
    }


    function getDevisDetailsByArt($devis_id, $article_id) {
        $query = "SELECT * FROM devisdetails WHERE devis_id = ? AND article_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$devis_id, $article_id]);
        return $stmt->fetchAll(PDO::FETCH_OBJ); 
    }

    function getDevisDetailsById($devis_id) {
        $query = "SELECT * FROM devisdetails d left join article a on d.article_id= a.reference where devis_id = ? ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(array($devis_id));
        return $stmt->fetchAll(PDO::FETCH_OBJ); 
    }



   /* function getAllDevisDetails() {
        $query = "SELECT * FROM devisdetails";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_OBJ); 
    }*/
}

?>
