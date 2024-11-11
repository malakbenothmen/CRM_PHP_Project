<?php
require_once(__DIR__ . '/../MODELS/demandedevis.php');
require_once(__DIR__ . '/../DATABASE/config.php');

class DemandeDevisController extends Connexion {
    function __construct() {
        parent::__construct();
    }

    function insertDemandeDevis(DemandeDevis $demande) {
        $query = "INSERT INTO demandedevis (client_id, etat, info_supp , type ) VALUES (?, ?, ? , ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$demande->getClientId(), $demande->getEtat() , $demande->getMsg() , $demande->getType()]);
        return $stmt->rowCount(); // Retourne le nombre de lignes insérées
    }

   /* function updateDemandeDevis(DemandeDevis $demande) {
        $query = "UPDATE demandedevis SET client_id = ?, etat = ? WHERE devis_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$demande->getClientId(), $demande->getEtat(), $demande->getDevisId()]);
        return $stmt->rowCount(); // Retourne le nombre de lignes mises à jour
    }*/

    function deleteDemandeDevis($devis_id) {
        $query = "DELETE FROM demandedevis WHERE devis_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$devis_id]);
        return $stmt->rowCount(); 
    }

    function updateEtat($etat , $id)
    {       $query = "UPDATE demandedevis SET etat = ? WHERE devis_id = ? ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$etat, $id]);
        return $stmt->rowCount();
     }

    function getDemandeDevisById($devis_id) {
        $query = "SELECT * FROM demandedevis d join client c on d.client_id = c.client_id WHERE devis_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(array($devis_id));
        return $stmt->fetch(PDO::FETCH_OBJ); 
    }
    function getLastInsertedId() {
        return $this->conn->lastInsertId();
    }

    function getAllDemandeDevis() {
        $query = "SELECT d.devis_id , d.type , d.created_at , d.etat , d.client_id , d.info_supp , u.username ,c.entreprise , c.profile FROM demandedevis d join client c on d.client_id = c.client_id join users u on u.user_id = c.client_id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $array=$stmt->fetchAll(PDO::FETCH_OBJ); 
        return $array ;

    }

    function getAllDemandeByClient($id) {
        $query = "SELECT * FROM demandedevis WHERE client_id = ?";
        $res = $this->conn->prepare($query);
        $res->execute(array($id));
        $array=$res->fetchAll(PDO::FETCH_OBJ); 
        return $array ;
    }
    function getAllDemandeByEat($ett)
    {  $query = "SELECT d.devis_id , d.type , d.created_at , d.client_id , d.info_supp , u.username ,c.entreprise , c.profile FROM demandedevis d join client c on d.client_id = c.client_id join users u on u.user_id = c.client_id WHERE etat = ?";
        $res = $this->conn->prepare($query);
        $res->execute(array($ett));
        $array=$res->fetchAll(PDO::FETCH_OBJ); 
        return $array ;}


        public function countDevis($id)
        {
            $query = "SELECT count(*) as nb_devis FROM demandedevis where client_id = ? ";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_OBJ); 

        }

        function generateDevisCode($created_at, $devis_id) {
            $date_part = date('dmy', strtotime($created_at));
            $devis_id_part = str_pad($devis_id, 4, '0', STR_PAD_LEFT);
    
            $devis_code = $date_part . $devis_id_part;
          
            return $devis_code;
          }

}
?>
