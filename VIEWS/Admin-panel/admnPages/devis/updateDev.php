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
   
    }
   


    ?>


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
    <p>Date d'expiration :</p>
  </div>
</div>
<form action="edit1.php" method="POST">
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
      <input type = "hidden"    name="articles[<?php echo $index; ?>][article_id]" value = <?php echo $item->article_id ; ?> />
      


    </tr>
 <?php endforeach ; ?>

  </tbody>
  
</table>
</div>
</div>

<button type ="submit" name="valider" class ="btn btn-primary"> Calculer</button>
     </form>

    </section>
    </html>
