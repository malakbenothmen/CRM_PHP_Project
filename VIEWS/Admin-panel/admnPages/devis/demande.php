<?php require "../../includes/header.php" ;
require "../../../../CONTROLLERS/devisController.php";
require "../../../../CONTROLLERS/devisdetailsController.php" ;


$demandeCtr = new  DemandeDevisController();
$allDemandes = $demandeCtr-> getAllDemandeByEat("en attente");
$devisCtr = new DevisDetailsController();
 


?>

<style>
  .table-striped tbody tr:nth-child(odd) {
    background-color: #FDFBF6; /* Couleur de fond pour les lignes impaires */
}

.table-striped tbody tr:nth-child(even) {
    background-color: #ffffff; /* Couleur de fond pour les lignes paires */
}
</style>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.php -->
    <?php require "../../includes/_navbar.php" ; ?>


    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_settings-panel.html -->
     

 
      <!-- partial -->
      <!-- partial:../../partials/_sidebar.html -->
      <?php require "../../includes/_sidebar.php" ; ?>

        <!-- partial -->
        <div class="main-panel">          
        <div class="content-wrapper">
 
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">des demandes non repondue </p>
                  <div class="row">
                    <div class="col-12">
                      ici vous pouvez trouver les demandes d'offre de prix de produits.
                    </div>

                  </div>
                  </div>
                </div>
            </div>
        </div>


        <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"> Demande de devis </h4>
                  <p class="card-description">
                    repondez maintenant à votre client .
                  </p>
                  <div class="table-responsive">
                    <table id="myDataTable" class="table table-striped">
                      <thead style="background: #f7df0a ; color: dark ; height : 60px ; " >
                        <tr>

                          <th>
                            Profile
                          </th>
                          <th>
                            Username
                          </th>
                          <th>
                            Entreprise
                          </th>        
                          <th>
                            Date de demande
                          </th>
                          <th>
                           Type
                          </th>
                          <th>
                            Action
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php foreach ($allDemandes as $demande) : ?>
                        <tr>
                          <td class="py-1" style=" height : 60px ;">
                            <img src="<?php echo APPURL ?>/assets/images/avatar/<?php echo $demande->profile; ?>" alt="image"/>
                          </td>
                          <td>
                          <?php echo $demande->username; ?>
                          </td>
            
                          <td>
                          <?php echo $demande->entreprise; ?>
                          </td>
                          <td>
                          <?php echo $demande->created_at; ?>
                          </td>
                          <td>
                          <?php echo $demande->type; ?>
                          </td>

                          <td>
                            <?php 
                            $id = $demande->devis_id ;
              
                            $details = $devisCtr->getDevisDetailsById($id) ;?>
                            
                            <div class="edit-icon"  data-demande= "<?php echo  htmlspecialchars(json_encode($demande)) ;?>"  data-articles="<?php echo htmlspecialchars(json_encode($details)); ?>">
                              <i class="fas fa-edit" style="font-size: 20px; color: green;"></i>
                            </div>

                          </td>

                        </tr>
                        <?php  endforeach ; ?>

 
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

  
        </div>  




  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="editModalLabel">Informations du devis</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
      <div class="modal-body" id="devisInfo"></div>
      <div class="modal-footer">
        <a id="completeButton" class="btn btn-primary">Compléter</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>


<script>
    $(document).ready(function() {
        $('#myDataTable').DataTable();
    });

   
    document.addEventListener("DOMContentLoaded", function() {

const editModal = document.getElementById("editModal");

const editIcons = document.querySelectorAll(".edit-icon");

editIcons.forEach(icon => {
  icon.addEventListener("click", function() {
    const detail = JSON.parse(icon.dataset.articles);
    const  demande =  JSON.parse(icon.dataset.demande);
  

    // Afficher les détails du devis dans la boîte de dialogue modale
    showDevisDetails(detail, demande);
  });
});
});

function showDevisDetails(detail, demande) {
const devisInfo = document.getElementById("devisInfo");

devisInfo.innerHTML = ''; // Réinitialiser le contenu

// Vérifier le type de détail
if (demande.type === 'Normal') {
// Construire le contenu HTML dans une variable de chaîne
let htmlContent = `
<table class="table">
  <thead>
    <tr>
      <th>Désignation</th>
      <th>Quantité totale</th>
      <th>Logo</th>
    </tr>
  </thead>
  <tbody>
`;

detail.forEach(item => {
htmlContent += `
  <tr>
    <td>${item.designation}</td>
    <td>${item.qte_total}</td>
    <td>${item.logo}</td>
  </tr>
`;
});

htmlContent += `
  </tbody>
</table>
`;

// Assigner le contenu HTML à devisInfo.innerHTML une seule fois
devisInfo.innerHTML = htmlContent;
}
else if (demande.type === 'Personalise') {
// Afficher les détails personnalisés
console.log(detail);
detail.forEach(item => {
devisInfo.innerHTML += `
<table style="width: 100%;">
<tbody>
  <tr style="padding-top: 20px;">
    <td rowspan="3" style="vertical-align: top;"><img src="http://localhost/projetUniformeSte/VIEWS/assets/images/artPersonalise/${item.logo}" style="width: 250px; height: auto;" alt="image" /></td>
    <td style="vertical-align: top; padding-left: 20px;">
      <h3 style="font-family: Arial, sans-serif; color:#f34646;"><b>${item.title}</b></h3>
    </td>
  </tr>
  <tr>
    <td style="vertical-align: top; padding-left: 20px;">
      <h4 style="font-family: Arial, sans-serif; color: #666;"><b>- Quantité:</b> ${item.qte_total}</h4>
    </td>
  </tr>
  <tr>
    <td style="vertical-align: top; padding-left: 20px;">
      <h4 style="font-family: Arial, sans-serif; color: #666;"><b>- Caractéristiques:</></h4></br>
      <h4 style="font-family: Arial, sans-serif; color: #777; font-size : 80 px ;">${demande.info_supp}</h4>
    </td>
  </tr>


</tbody>
</table>
`;
});
}
const completeButton = document.getElementById("completeButton");
completeButton.href = "<?php echo APPURL ; ?>/Admin-Panel/admnPages/devis/editDevis.php?id=" + demande.devis_id;


// Afficher la boîte de dialogue modale
$('#editModal').modal('show');




}




</script>

        </div>
        </div>











  <!-- main-panel ends -->
  </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <?php include "../../includes/_footer.php" ; ?>



</body>

</html>
</body>

</html>


