<?php
require_once(__DIR__ . '/../MODELS/facture.php');
require_once(__DIR__ . '/../DATABASE/config.php');


class FactureController extends Connexion {
    function __construct() {
        parent::__construct();
    }


    public function createFacture($commande_id, $etat) {
        $query = "INSERT INTO facture (commande_id, etat_Fact) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$commande_id, $etat]);
        return $stmt->rowCount() > 0;

    }

    public function getFactureById($id)
    {
        $query = "SELECT * FROM facture f join commande c on c.commande_id = f.commande_id WHERE f.fact_id= ?  ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_OBJ); 

    }


    public function getAllFacture()
    {
        $query = "SELECT * FROM facture f join commande c on f.commande_id = c.commande_id join client cl on cl.client_id = c.client_id ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ); 
    }

    public function getAllFactureByClient($client_id)
    {
        $query = "SELECT f.etat_Fact , f.fact_id , f.commande_id ,f.created_at , c.date_livraison FROM facture f join commande c on c.commande_id = f.commande_id WHERE c.client_id= ?  ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$client_id]);
        return $stmt->fetchAll(PDO::FETCH_OBJ); 
    }


    public function countFacture($id)
    {
        $query = "SELECT count(*) as nb_facture FROM facture f join commande c on f.commande_id = c.commande_id where c.client_id = ? ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_OBJ); 

    }

    function generateFactCode($created_at, $fact_id) {
       
        $date_part = date('dmy', strtotime($created_at));
     
        $fact_id_part = str_pad($fact_id, 4, '0', STR_PAD_LEFT);
    
        $fact_code = $date_part . $fact_id_part;
      
        return $fact_code;
      }


      function getDevidIdC($com_id)
      {
        $query = "SELECT devis_id FROM commande where commande_id  = ? ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$com_id]);
        $res = $stmt->fetch(PDO::FETCH_OBJ); 
        return $res ;
  

      }
      

      
      function updateEtat($fact_id, $etat)
      {
          $query = "UPDATE facture SET etat_Fact = ? WHERE fact_id = ? ";
          $stmt = $this->conn->prepare($query);
          $stmt->execute([$etat, $fact_id]);
          return $stmt->rowCount();

      }

      
      function deleteFact($com_id)
      {
          $query = "DELETE FROM facture  WHERE commande_id = ? ";
          $stmt = $this->conn->prepare($query);
          $stmt->execute([ $com_id]);
          return $stmt->rowCount();

      }



    



}
?>
