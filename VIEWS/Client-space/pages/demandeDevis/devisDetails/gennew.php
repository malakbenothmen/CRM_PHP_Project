<?php
require "../../../../../CONTROLLERS/clientController.php";
require "../../../../../CONTROLLERS/devisController.php";
require "../../../../../CONTROLLERS/devisdetailsController.php" ;

require_once 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

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


$totalHT= sousTotal($items) ;
$fodec = fodec($totalHT, 1 );
$totva = totalTVA($totalHT, $fodec, 19);
$ttc =totalTTC($totalHT, $fodec, $totva , 1000);
  




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
// instantiate and use the dompdf class


ob_start();
require('devisPDF.php'); 
$html = ob_get_contents();
ob_get_clean();

$dompdf->loadHtml($html);



$dompdf->render();

$dompdf->stream("newtry.pdf");





?>
