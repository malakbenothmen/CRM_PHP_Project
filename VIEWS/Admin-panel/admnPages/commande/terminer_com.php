<?php require "../../includes/header.php" ; 
require "../../../../CONTROLLERS/clientController.php";
require "../../../../CONTROLLERS/commandeController.php";
require "../../../../CONTROLLERS/factureController.php";


if (isset($_GET['id']))
{

    $com_id = $_GET['id'];
    $comCtr = new CommandeController();
    $comCtr->updateEtat($com_id,'Terminé');
    header("Location: gestCom.php");
    exit();

 // Affichage de la boîte de notification (alerte) en JavaScript
        echo '<script>
        // Attendre que le document soit prêt
        document.addEventListener("DOMContentLoaded", function() {
            // Afficher la boîte de notification (alerte)
            $.notify({
                // Le message à afficher
                message: "La commande a été terminée avec succès.",
            },{
                // Les options de la boîte de notification (alerte)
                // Ici, on indique que cest une notification de succès (success)
                type: "success",
                // Durée pendant laquelle la notification reste visible en millisecondes (ms)
                delay: 5000,
            });
        });
        </script>';


}