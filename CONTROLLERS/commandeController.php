<?php
require_once(__DIR__ . '/../MODELS/commande.php');
require_once(__DIR__ . '/../DATABASE/config.php');

class CommandeController extends Connexion {
    function __construct() {
        parent::__construct();
    }

        // Insertion
        public function createCommande(Commande $commande) {
            $query = "INSERT INTO commande (devis_id,client_id ,acompte, etat, date_livraison) VALUES (?, ?, ?,?, ?)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$commande->getDevisId(), $commande->getClientId(), $commande->getAcompte(), $commande->getEtat(), $commande->getDateLivraison()]);
            return $stmt->rowCount() > 0;
        }
    
        
        public function getCommandeByClient($id) {
            $query = "SELECT * FROM commande  WHERE client_id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$id]);
            return $stmt->fetchAll(PDO::FETCH_OBJ); 
        }
                
        public function getAllCommande() {
            $query = "SELECT * FROM commande c join client cl on c.client_id = cl.client_id join users u on u.user_id = cl.client_id  ";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ); 
        }

        public function getCommandeByEtat($etat)
        {
            $query = "SELECT * FROM commande where etat = ? ";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$etat]);
            return $stmt->fetchAll(PDO::FETCH_OBJ); 
        }
        public function getLastInsertedId() {
          
            return $this->conn->lastInsertId();
        }

        public function countCommande($id)
        {
            $query = "SELECT count(*) as nb_commande FROM commande where client_id = ? ";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_OBJ); 

        }

        function generateComCode($created_at, $com_id) {
           
            $date_part = date('dmy', strtotime($created_at));

            $com_id_part = str_pad($com_id, 4, '0', STR_PAD_LEFT);

            $com_code = $date_part . $com_id_part;
          
            return $com_code;
          }

        function calcultotalHT($devis_id)
        {
            $query = "SELECT SUM(qte_total * prix_ht) AS total_ht FROM devisdetails WHERE devis_id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$devis_id]);
            return $stmt->fetch(PDO::FETCH_OBJ); 
            
        }

        function calculMontantTTC($devis_id,$tva)
        {
            $totalht = $this->calcultotalHT($devis_id)->total_ht ;
            $ttc= $totalht+ ($totalht * 0.01 ) + ($tva*($totalht * 1.01)/100) + 1.000 ;
            return $ttc ;
        }

        function updateEtat($com_id, $etat)
        {
            $query = "UPDATE commande SET etat = ? WHERE commande_id = ? ";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$etat, $com_id]);
            return $stmt->rowCount();

        }


    




}