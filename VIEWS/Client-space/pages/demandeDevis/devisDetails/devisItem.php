<?php require "../../../partials/header.php" ; 
require "../../../../../CONTROLLERS/clientController.php";
require "../../../../../CONTROLLERS/devisController.php";
require "../../../../../CONTROLLERS/devisdetailsController.php" ;

if (isset($_GET['id']))
    {
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
        
    }



?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Facture</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
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
    <hr class="custom-divider"> <!-- Ligne de séparation -->
    <p class="custom-p"><?php echo $devis->entreprise ; ?></p>
    <p>Téléphone : <?php echo $devis->tel ; ?></p>
    <p>Payé : <?php echo $devis->country ; ?></p>
    <p>Adresse : <?php echo $devis->adresse ; ?></p>
    
  </div>
  <div class="col-md-6 text-right">
    <h2 class="custom-h2">Informations de Devis:</h2>
    <hr class="custom-divider" style="  margin-left: auto;"> <!-- Ligne de séparation -->
    <p>code devis : <?php echo $codeDevis ; ?></p>
    <p>Type de devis : <?php echo $devis->type ; ?></p>
    <p> l'etat : <?php echo $devis->etat ; ?></p>
    <p>Date de creation : <?php echo $devis->created_at ; ?></p>
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
  <tbody>
   <?php foreach ($items as $index => $item) : ?>
    <tr>
      <td><?php echo $index +1 ; ?></td>
      <?php if ($devis->type == 'Normal') : ?>
      <td><?php echo $item->designation ; ?></td>
      <?php else : ?>
        <td><?php echo $item->title ; ?></td>
      <?php endif ; ?>

      <td><?php echo $item->prix_HT ; ?></td>
      <td><?php echo $item->qte_total ; ?></td>
      <td><?php echo calcPTHT($item->qte_total,$item->prix_HT) ; ?></td>
      <td><?php echo $item->TVA ; ?>%</td>
    </tr>
 <?php endforeach ; ?>

  </tbody>
</table>


    <div class="row">
  <div class="col-md-6">
    <br>
    <h2 class="custom-h2">Termes et conditions :</h2>
    <hr class="custom-divider">
    <ul style="padding-left: 20px; margin-top: 20px; font-size: 18px;">
  <li style="margin-bottom: 10px;">Cette offre est disponible 1 mois à partir de la date en dessus et après ça va changer</li>
  <li style="margin-bottom: 10px;">Date d'expiration automatique : 11/03/2024</li>
  <li style="color: red; text-decoration: underline; margin-bottom: 10px;">NB : 50% à l'avance et 50% à la livraison</li>
</ul>


  </div>
  <div class="col-md-6">
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
</foooter>
<div style="text-align: right;">
<a target="_blank" href="gennew.php?id= <?php echo $id ;?>&code=<?php echo $codeDevis; ?>" class="btn btn-primary" style="margin-top: 80px; margin-bottom: 60px; margin-right: 100px; font-size: 40px; background-color: #DEC949; color: #ffffff; padding: 18px 45px; border: none; border-radius: 5px;"><span class="text-space">Télécharger PDF</span>  </a>
</div>



</body>


</html>

