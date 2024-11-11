<?php
require_once 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

/*// Définir les options une seule fois
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
*/


// instantiate and use the dompdf class
$dompdf = new Dompdf();

ob_start();
include 'devisPDF.php'; 
$html = ob_get_contents();
ob_get_clean();

$dompdf->loadHtml($html);

$dompdf->setPaper('A4', 'portrait');

$dompdf->render();

$dompdf->stream("newtry.pdf");




/*ob_start(); // Démarre la temporisation de sortie
include 'devisPDF.php'; // Inclut le fichier details.php
$html = ob_get_clean();
// Charger le contenu HTML dans Dompdf
$dompdf->loadHtml($html);

// Rendre le HTML en PDF
$dompdf->render();

// Générer le PDF (vous pouvez le télécharger ou l'enregistrer sur le serveur)
$dompdf->stream("dev.pdf");*/
?>
