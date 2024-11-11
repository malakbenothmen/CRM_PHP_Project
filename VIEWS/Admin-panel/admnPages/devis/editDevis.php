<?php require "../../includes/header.php" ;
require "../../../../CONTROLLERS/clientController.php";
require "../../../../CONTROLLERS/devisController.php";
require "../../../../CONTROLLERS/devisdetailsController.php" ;


if (isset($_GET['id']))
    {
        $id = $_GET['id'];
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
   
    function expireDate($date) {
        // Convertir la date en objet DateTime
        $dateTime = new DateTime($date);
        
        // Ajouter un mois à la date
        $dateTime->modify('+1 month');
        
        // Retourner la date d'expiration au format "YYYY-MM-DD"
        return $dateTime->format('Y-m-d');
    }

    ?>
    


 



 <!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Facture</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="<?php echo APPURL ; ?>/assets/vendors/css/style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Calistoga&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&display=swap" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.css" rel="stylesheet">



</head>

<body>

<header class="container">
  <div class="row">

  <img src="<?php echo APPURL ;?>/assets/images/pdf/head.png" />
  </div>
</header>


<form action="edit1.php" method="POST">
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
    <p>code devis : <?php echo $devis->devis_id ; ?></p>
    <p>Type de devis : <?php echo $devis->type ; ?></p>
    <p> l'etat : <?php echo $devis->etat ; ?></p>
    <p>Date de creation : <?php echo $devis->created_at ; ?></p>
  
  </div>
</div>

<input type = "hidden"    name="devis_id" value = <?php echo $devis->devis_id ; ?> />

<table class="custom-table">
  <thead>
    <tr>
      <th>N°</th>
      <th>DESIGNATION</th>
      <th>QTE</th>
      <th>P.U.H.T</th>
      <th>TVA </th>
    </tr>
  </thead>
  <tbody>
        
      
   <?php foreach ($items as $index => $item) : ?>
    <tr>
      <td><?php echo $index +1 ; ?></td>
     <?php  if ($devis->type =='Normal' ) : ?>
      <td><?php echo $item->designation ; ?></td>
     <?php else : ?>
      <td><?php echo $item->title; ?></td>
      <?php endif ; ?>
      <td><?php echo $item->qte_total ; ?></td>
      <td><input type="text"  name="articles[<?php echo $index; ?>][prix_HT]"   /></td>
      <td><input type="text"     name="articles[<?php echo $index; ?>][TVA]"  value="19" />%</td>
      <input type = "hidden"    name="articles[<?php echo $index; ?>][article_id]" value ="<?php echo $item->article_id ; ?>" />
 
    </tr>
 <?php endforeach ; ?>

  </tbody>
  
</table>
</div>
</div>
<button type ="button" id="calculerBtn" name="calcul" class ="btn btn-" style="margin-top: 20px; margin-bottom: 20px; margin-right: 100px; font-size: 20px; background-color : #EE2121; color: #ffffff; padding: 10px 20px;"> calculer</button>


<table style="width: 100%;">
  <tr>
    <td style="width: 50%; vertical-align: top;">
      <h2 class="custom-h2">Termes et conditions :</h2>
      <hr class="custom-divider">
      <ul style="padding-left: 20px; margin-top: 20px; font-size: 18px;">
        <li style="margin-bottom: 10px;">Cette offre est disponible 1 mois à partir de la date en dessus et après ça va changer</li>
        <li style="margin-bottom: 10px;">Date d'expiration automatique : <?php echo expireDate($devis->created_at); ?></li>
        <li style="color: red; text-decoration: underline; margin-bottom: 10px;">NB : 50% à l'avance et 50% à la livraison</li>
      </ul>
    </td>
    <td id="totaux" style="width: 50%; vertical-align: top; display: none;">
      <table class="mini-table">
        <tr>
          <td>Sous-total :</td>
          <td><span id="totalHT"></span></td>
        </tr>
        <tr>
          <td>Fodec :</td>
          <td><span id="fodec"></span></td>
        </tr>
        <tr>
          <td>Total TVA :</td>
          <td><span id="totalTVA"></span></td>
        </tr>
        <tr>
          <td>Timbre :</td>
          <td>1.000</td>
        </tr> 
        <tr class="last-row">
          <td>Total TTC :</td>
          <td><span id="totalTTC"></span></td>
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

  <footer class="container">
  <div class="row">
    <img src="<?php echo APPURL ; ?>/assets/images/pdf/foot.png" />
  </div>
</foooter>
<div style="text-align: right;">

<button type ="submit" name="valider"   style="margin-top: 80px; margin-bottom: 60px; margin-right: 100px; font-size: 20px; background-color: #DEC949; color: #ffffff; padding: 18px 45px; border: none; border-radius: 5px;" class ="btn btn-primary"> Envoyer</button>
</form>

</div>



</body>

<script>
    document.addEventListener("DOMContentLoaded", function() {

    });


    document.getElementById("calculerBtn").addEventListener("click", function() {
            // Code pour calculer les résultats ici...

            // Afficher la notification Noty de succès
            new Noty({
                type: 'success',
                text: 'Calcul effectué avec succès !',
                timeout: 2000 // Durée d'affichage de la notification en millisecondes
            }).show();
        });


        document.querySelector("button[name='calcul']").addEventListener("click", function() {
            // Récupérer tous les champs de texte pour les prix HT
            var prixHTInputs = document.querySelectorAll("input[name^='articles'][name$='[prix_HT]']");

              // Récupérer tous les champs de texte pour les TVA
              var tvaInputs = document.querySelectorAll("input[name^='articles'][name$='[TVA]']");

              // Initialiser les totaux à zéro
              var totalHT = 0;
              var totalTVA = 0;
              var fodec = 0;
              var timbre = 1.000;
              var totalTTC = 0;

              // Parcourir tous les champs de texte pour les prix HT
              prixHTInputs.forEach(function(input, index) {
                  var prixHT = parseFloat(input.value) || 0; // Convertir la valeur en nombre ou utiliser 0 si NaN
                  var tva = parseFloat(tvaInputs[index].value) || 0; // Récupérer la TVA correspondante
                  var quantite = parseFloat(input.parentElement.previousElementSibling.textContent) || 0; // Récupérer la quantité

                  // Calculer le prix total HT de cet article
                  var prixTotalHT = prixHT * quantite;

                  // Calculer les totaux
                  totalHT += prixTotalHT;
                
                  
              });

              fodec = totalHT * 1/100 ;
              totalTVA += (totalHT + fodec) * (19 / 100);

              // Calculer le total TTC
              totalTTC = totalHT + totalTVA + fodec + timbre;

              // Afficher les totaux dans la section "totaux"
              document.getElementById("totalHT").textContent = totalHT.toFixed(2);
              document.getElementById("fodec").textContent = fodec.toFixed(2);
              document.getElementById("totalTVA").textContent = totalTVA.toFixed(2);
              document.getElementById("totalTTC").textContent = totalTTC.toFixed(2);

              // Afficher la section "totaux"
              document.getElementById("totaux").style.display = "block";

        });

</script>

</html>

