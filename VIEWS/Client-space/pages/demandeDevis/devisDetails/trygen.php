<?php require "../../../partials/header.php" ; 
require "../../../../../CONTROLLERS/clientController.php";
require "../../../../../CONTROLLERS/devisController.php";
require "../../../../../CONTROLLERS/devisdetailsController.php" ;

require_once 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Définir les options une seule fois
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true);
$options->set('tempDir', sys_get_temp_dir());
$options->set('chroot', realpath('.'));
$options->set('defaultPaperSize', 'a3');
$options->set('defaultPaperOrientation', 'portrait');
$options->set('dpi', 96);
$options->set('isPhpEnabled', true);

$dompdf = new Dompdf($options);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $codeDevis = $_GET['code'];
    $devisCtr = new DemandeDevisController();
    $devis = $devisCtr->getDemandeDevisById($id);
    $itemCtr = new DevisDetailsController();
    $items = $itemCtr->getDevisDetailsById($id);

    function calcPTHT($qte, $PUHT) {
        $PTHT = $qte * $PUHT;
        return $PTHT;
    }
    
    function sousTotal($items) {
        $sousTotal = 0;
        foreach ($items as $item) {
            $sousTotal += calcPTHT($item->qte_total, $item->prix_HT);
        }
        return $sousTotal;
    }

    function fodec($totalHT, $pourcentage) {
        return $totalHT * $pourcentage / 100;
    }
    
    function totalTVA($totalHT, $fodec, $pourcentage) {
        return ($totalHT + $fodec) * $pourcentage / 100;
    }
    
    function totalTTC($totalHT, $fodec, $totalTVA, $timbre) {
        return $totalHT + $fodec + $totalTVA + $timbre;
    }

    $totalHT = sousTotal($items);
    $fodec = fodec($totalHT, 1);
    $totva = totalTVA($totalHT, $fodec, 19);
    $ttc = totalTTC($totalHT, $fodec, $totva, 1000);
}

$html = '<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Facture</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-wdL6ph7Yag2/+FBfc5lgKgUBp30Mc0y3EobxXB1Bn2Y0vCQ5y53XTc4A9W5PLse6e0EaSt+4v65MW6ZGzB+FaQ==" crossorigin="anonymous" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Calistoga&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&display=swap" rel="stylesheet">
</head>
<body>

<header class="container">
  <div class="row">
    <img src="head.png" />
  </div>
</header>

<section class="container">
  <div class="row">
    <div class="col-md-6">
      <h2 class="custom-h2">Devis à :</h2>
      <hr class="custom-divider">
      <p class="custom-p">'. $devis->entreprise .'</p>
      <p>Téléphone : '.$devis->tel .'</p>
      <p>Payé : '. $devis->country .'</p>
      <p>Adresse : '. $devis->adresse .'</p>
    </div>
    <div class="col-md-6 text-right">
      <h2 class="custom-h2">Informations de Devis:</h2>
      <hr class="custom-divider" style="  margin-left: auto;">
      <p>code devis : '. $codeDevis .'</p>
      <p>Type de devis : '. $devis->type .'</p>
      <p>letat : '. $devis->etat .'</p><p>Date de creation : '. $devis->created_at .'</p>
    </div>
  </div>

  <table class="custom-table">
    <thead>
      <tr>
        <th>N°</th>
        <th>DESIGNATION</th>
        <th>P.U.H.T</th>
        <th>QTE</th>
        <th>P.T.U.T</th>
        <th>TVA </th>
      </tr>
    </thead>
    <tbody>';
    
foreach ($items as $index => $item) {
    $html .= '<tr>
      <td>'. ($index + 1) .'</td>
      <td>'. $item->designation .'</td>
      <td>'. $item->prix_HT .'</td>
      <td>'. $item->qte_total .'</td>
      <td>'. calcPTHT($item->qte_total,$item->prix_HT) .'</td>
      <td>'. $item->TVA .'%</td>
    </tr>';
}

$html .= '
    </tbody>
  </table>

  <div class="row">
    <div class="col-md-6">
      <br>
      <h2 class="custom-h2">Termes et conditions :</h2>
      <hr class="custom-divider">
      <ul style="padding-left: 20px; margin-top: 20px; font-size: 18px;">
        <li style="margin-bottom: 10px;">Cette offre est disponible 1 mois à partir de la date en dessus et après ça va changer</li>
        <li style="margin-bottom: 10px;">Date dexpiration automatique : 11/03/2024</li>
        <li style="color: red; text-decoration: underline; margin-bottom: 10px;">NB : 50% à lavance et 50% à la livraison</li>
      </ul>
    </div>
    <div class="col-md-6">
      <table class="mini-table" >
        <tr>
          <td>Sous-total :</td>
          <td>'. $totalHT .'</td>
        </tr>
        <tr>
          <td>Fodec :</td>
          <td>'. $fodec.'</td>
        </tr>
        <tr>
          <td>Total TVA :</td>
          <td>'. $totva .'</td>
        </tr>
        <tr>
          <td>Timbre :</td>
          <td>1.000</td>
        </tr> 
        <tr class="last-row">
          <td>Total TTC :</td>
          <td>'. $ttc .'</td>
        </tr>
      </table>
    </div>
  </div>

  <div class="row" style=" padding-top: 220px; padding-bottom: 5px;">
    <div class="col-md-6">
      <p class="custom-p">Merci pour votre Confience !</p>
    </div>

    <div class="col-md-6 text-right">
      <br><br><br>
      <hr class="signature">
      <p style="font-family: Arial; text-align: center;">Votre nom et signature</p>
    </div>
  </div>
</section>

<footer class="container">
  <div class="row">
    <img src="foot.png" />
  </div>
</footer>

</body>';

// Charger le contenu HTML dans Dompdf
$dompdf->loadHtml($html);

// Rendre le HTML en PDF
$dompdf->render();

// Générer le PDF (vous pouvez le télécharger ou l'enregistrer sur le serveur)
$dompdf->stream("dev.pdf");
?>
