<?php require "../../partials/header.php" ; 
require "../../../../CONTROLLERS/clientController.php";
require "../../../../CONTROLLERS/devisController.php";
require "../../../../CONTROLLERS/devisdetailsController.php" ;


// Vérifier si l'ID du devis est fourni en tant que paramètre GET
if (isset($_GET['id'])) {
    // Récupérer l'ID du devis depuis les paramètres GET
    $devisId = $_GET['id'];
    $devCtr = new DevisDetailsController();
    $details = $devCtr->getDevisDetailsById($devisId);
   

} else {
    // Si l'ID du devis n'est pas fourni, afficher un message d'erreur
    echo "Erreur : ID de devis non fourni.";
}

?>

<table style="border : 1px solid">
                           
                           <?php foreach ($details as $detail) : ?>
                              <tr>
                                 <td><?php echo $detail->reference; ?></td>
                                 <td><?php echo $detail->qte_total; ?></td>
                              </tr>
                           <?php endforeach; ?>

                           </table>
