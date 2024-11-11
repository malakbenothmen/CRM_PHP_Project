<?php require "../../../partials/header.php" ; 
require "../../../../../CONTROLLERS/clientController.php";
require "../../../../../CONTROLLERS/devisController.php";
require "../../../../../CONTROLLERS/devisdetailsController.php" ;
require "../../../../../CONTROLLERS/commandeController.php";
require "../../../../../CONTROLLERS/factureController.php";

if (isset($_GET['id']))
    {
        $id = $_GET['id'];
        $codeFact = $_GET['code'];
        $devisCtr = new DemandeDevisController();
       // $fact= $devisCtr->getFactureById($id);
       $comCtr = new CommandeController();
       //$comCtr->getCommandeByID($fact->commande_id);

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
        
    }



?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Facture</title>
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Calistoga&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&display=swap" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>



</head>
  <style>

      @page {
              margin: 5px;
          }
          body {
              margin: 0;
          }
          .container {
            display: inline-block; /* Permet à la section d'être centrée */
            text-align: left; 

          }
          @page {
          margin: 0px;
      }
      body {
          margin: 0;
          font-family: "Calistoga", serif;
          font-weight: 400;
          font-style: normal;
      }

      p {
          font-family: "Calistoga", serif;
          font-weight: 400;
          font-style: normal;
        }
        


      table {
      width: 100%;
      margin-top: 20px;
      }

      td {
          font-family: "Calistoga", serif;
          font-weight: 400;
          font-style: normal;
      }

      th {
      text-align: center;
      padding : 10px;
      }

      .container {
      padding: 20px;
      }

      .text-right {
      text-align: right;
      }



      .left-content {
      display: flex;
      align-items: center;
      justify-content: center;
      }



      .left-content h1 {
      font-size: 30px;
      font-weight: bold;
      }

      .right-content {
      display: flex;
      align-items: center;
      justify-content: center;
      }

      .large-text {
      font-size: 50px;
      }

      .underline {
      text-decoration: underline;
      color: white ;
      }

      .custom-h2 {
      font-size: 20px; 
      text-transform: uppercase; 
      font-family: Arial, sans-serif; 
      color: #251261; 
      }

      .custom-p {
      font-weight: bold; 
      text-transform: uppercase; 
      color: #DEC949; 
      font-size: 22px; 
      font-style: italic;
      }

      .custom-divider {
      border: none;
      border-top: 2px solid #DEC949; /* Couleur jaune */
      margin: 10px 0; /* Marge pour l'espace */
      width: 150px;
      }

      .custom-table {
      width: 100%;
      border-collapse: collapse;
      }

      .custom-table thead th {
      background-color: #DEC949; /* Couleur de fond jaune pour l'en-tête */
      color: black; /* Couleur du texte en gras noir */
      font-size: 15px;
      padding: 15px;
      font-family: "Alfa Slab One", serif;
      font-weight: 400;
      font-style: normal;
      }

      .custom-table tbody tr:nth-child(odd) {
      background-color: #f2f2f2c8;

      }

      .custom-table tbody tr:nth-child(even) {
      background-color: white; /* Couleur de fond des lignes paires */
      }

      .custom-table tbody td {
      border: 1px solid #ccc; /* Bordures des cellules */
      padding: 10px; /* Espacement interne des cellules */
      }

      .mini-table {
      width: 100%;
      border-collapse: collapse;
      border-radius: 8px; /* Ajout du rayon de bordure */
      overflow: hidden; /* Masquer les coins arrondis qui dépassent */
      }

      .mini-table td {
      border: 1px solid #ccc;
      padding: 8px;
      text-align: center;

      }

      .mini-table td:first-child {
          font-family: "Alfa Slab One", serif;
      }

      .last-row {
      background-color: #DEC949; 

      }

      .signature {
      border: none;
      border-top: 2px solid black; 
      width : 50% ;
      }


      .alfa-slab one-regular {
          font-family: "Alfa Slab One", serif;
          font-weight: 400;
          font-style: normal;
        }
        
      
  </style>
<body>

<header class="container">
  <div class="row">

  <img src="head.png" />
  </div>
</header>


  <section class="container">
  <table style="width: 100%;">
  <tr>
    <td style="width: 50%; vertical-align: top;">
      <h2 class="custom-h2">Facture à :</h2>
      <hr class="custom-divider"> <!-- Ligne de séparation -->
      <p class="custom-p"><?php echo $user->entreprise ; ?></p>
      <p>Téléphone : <?php echo $user->tel ; ?></p>
      <p>Payé : <?php echo $user->country ; ?></p>
      <p>Adresse : <?php echo $user->adresse ; ?></p>
    </td>
    <td style="width: 50%; vertical-align: top; text-align: right;">
      <h2 class="custom-h2">Informations de Devis:</h2>
      <hr class="custom-divider" style="margin-left: auto;"> <!-- Ligne de séparation -->
      <p>code Facture : <?php echo $codeFact ; ?></p>
      <p>code de commande : <?php echo $fact->commande_id ; ?></p>
      <p> l'etat de paiement: <?php echo $fact->etat_Fact ; ?></p>
      <p>Date d'emission : <?php echo $fact->created_at ; ?></p>
    </td>
  </tr>
</table>


<table class="custom-table">
  <thead>
    <tr>
      <th>N°</th>
      <th>DESIGNATION</th>
      <th>P.U.H.T</th>
      <th>QTE</th>
      <th>P.T.U.T</th>
      <th>T.V.A</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($items as $index => $item) : ?>
      <tr>
        <td><?php echo $index +1 ; ?></td>
        <td><?php echo $item->designation ; ?></td>
        <td><?php echo $item->prix_HT ; ?></td>
        <td><?php echo $item->qte_total ; ?></td>
        <td><?php echo calcPTHT($item->qte_total,$item->prix_HT) ; ?></td>
        <td><?php echo $item->TVA ; ?>%</td>
      </tr>
    <?php endforeach ; ?>
  </tbody>
</table>


<table style="width: 100%;">
  <tr>
    <td style="width: 50%; vertical-align: top;">
      <h2 class="custom-h2">Termes et conditions :</h2>
      <hr class="custom-divider">
      <ul style="padding-left: 20px; margin-top: 20px; font-size: 18px;">
        <li style="margin-bottom: 10px;">Cette offre est disponible 1 mois à partir de la date en dessus et après ça va changer</li>
        <li style="margin-bottom: 10px;">Date d'expiration automatique : 11/03/2024</li>
        <li style="color: red; text-decoration: underline; margin-bottom: 10px;">NB : 50% à l'avance et 50% à la livraison</li>
      </ul>
    </td>
    <td style="width: 50%; vertical-align: top;">
    <table class="mini-table" >
    <tr>
      <td>Sous-total :</td>
      <td><?php echo $totalHT ; ?></td>
    </tr>
    <tr>
      <td>Fodec :</td>
      <td><?php echo $fodec; ?></td>
    </tr>
    <tr>
      <td>Total TVA :</td>
      <td><?php echo $totva ; ?></td>
    </tr>
    <tr>
      <td>Timbre :</td>
      <td>1.000</td>
    </tr> 
    <tr class="last-row">
      <td>Total TTC :</td>
      <td><?php echo $ttc ; ?></td>
    </tr>
    </table>
    </td>
  </tr>
</table>


<table style="width: 100%;">
  <tr>
    <td style="width: 50%; vertical-align: top;">
      <p class="custom-p">Merci pour votre Confiance !</p>
    </td>
    <td style="width: 50%; vertical-align: top; text-align: right;">
      <br><br><br>
      <hr class="signature">
      <p style="font-family: Arial; text-align: center;">Votre nom et signature</p>
    </td>
  </tr>
</table>

  </section>

  <footer >
  <div class="row">
    <img src="foot.png" />
  </div>
</foooter>


</body>


</html>

