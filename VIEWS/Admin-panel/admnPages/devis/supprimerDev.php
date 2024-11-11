<?php require "../../includes/header.php" ;
require "../../../../CONTROLLERS/devisController.php";
require "../../../../CONTROLLERS/devisdetailsController.php" ;

$id = $_GET['id'];

$demandeCtr = new  DemandeDevisController();
$devisCtr = new DevisDetailsController();
$demande = $demandeCtr->deleteDemandeDevis($id);

header("location: gestDevis.php");

echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
echo '<script type="text/javascript">';
echo 'document.addEventListener("DOMContentLoaded", function() {';
echo '  Swal.fire({';
echo '    icon: "success",';
echo '    title: "Demande de devis soumise avec succès !",';
echo '    showConfirmButton: false,';
echo '    timer: 2000'; // Durée de l'alerte en millisecondes
echo '  });';
echo '});';
echo '</script>';

?>