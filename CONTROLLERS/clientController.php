<?php
require_once(__DIR__ . '/../MODELS/Client.php'); 
require_once(__DIR__ . '/../DATABASE/config.php');
require_once('UserController.php'); 

class ClientController extends UserController {
    function __construct() {
        parent::__construct();
    }

    function insertClient(Client $c) {
        parent::insert($c);

        // Récupérer l'ID de l'utilisateur nouvellement inséré
        $lastUserId = $this->conn->lastInsertId();

        // Insérer les informations spécifiques au client
        $query = "INSERT INTO client (client_id, entreprise, tel, siret, adresse, country) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $params = array(
            $lastUserId,
            $c->getEntreprise(),
            $c->getTelephone(),
            $c->getMatriculeFiscale(),
            $c->getAdresse(),
            $c->getPays()
        );
        return $stmt->execute($params);
    }


    function getClient($id)
    {
        $query = "SELECT * FROM client c INNER JOIN users u ON c.client_id = u.user_id WHERE c.client_id = ?";
        $res = $this->conn->prepare($query);
        $res->execute(array($id));
        $array= $res->fetch(PDO:: FETCH_OBJ);
        return $array;

    }

    function getCurrentDate()
    {
        $query =  "SELECT DATE_FORMAT(CURDATE(), '%d/%m/%Y') AS audDate";
        $result = $this->conn->prepare($query);
        $result->execute(); 
        $row = $result->fetch(PDO::FETCH_ASSOC);
        return $row ;
    }

    function getAllClient ()
{   
    $query="SELECT * FROM users u join client c on u.user_id = c.client_id ";
    $res = $this->conn->prepare($query);
    $res->execute([]);
    $array= $res->fetchAll(PDO:: FETCH_OBJ);
    return $array;
}



function payeeAnalyse()
{
    $query="SELECT DISTINCT country, COUNT(*) AS total_clients, ROUND((COUNT(*) * 100.0) / (SELECT COUNT(*) FROM client), 2) AS percentage
    FROM client
    GROUP BY country";
    $res = $this->conn->prepare($query);
    $res->execute(array());
    $array= $res->fetchAll(PDO:: FETCH_OBJ);
    return $array;

}

    

}
?>
