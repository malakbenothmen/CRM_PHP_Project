<?php
require_once "../../../../MODELS/commande.php";
require "../../../../CONTROLLERS/commandeController.php";
require "../../../../CONTROLLERS/devisController.php";
require "../../../../CONTROLLERS/factureController.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['livraisonDate'], $_POST['acompte'], $_POST['devisId'])) {
        // Récupérer les données envoyées par AJAX
        $livraisonDate = $_POST['livraisonDate'];
        $acompte = $_POST['acompte'];
        $devisId = $_POST['devisId'];
        $cmd = new Commande($devisId, 6, $acompte, 'en evaluation', $livraisonDate); // Utilisation des méthodes pour initialiser les propriétés
        $cmdCtr = new CommandeController();
        $devisCtr = new DemandeDevisController();
        $fact = new FactureController();
        $resultat = $cmdCtr->createCommande($cmd);
       
        if ($resultat) {
            echo json_encode(array("success" => true, "message" => "voilaaa!"));
            $commandeId = $cmdCtr->getLastInsertedId(); 

            $devisCtr->updateEtat('confirmé', $devisId);
        
            $fact->createFacture($commandeId, 'Paiement non recu');

        } else {
            echo json_encode(array("success" => false, "message" => "Une erreur s'est produite lors de la création de la commande."));
        }
    } else {
        // Si des données sont manquantes, renvoyer une réponse d'erreur
        echo json_encode(array("success" => false, "message" => "Certaines données sont manquantes."));
        exit();
    }
} else {
    echo json_encode(array("success" => false, "message" => "La requête doit être de type POST."));
}
?>
