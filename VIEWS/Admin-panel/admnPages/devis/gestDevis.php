<?php require "../../includes/header.php" ; 
require "../../../../CONTROLLERS/clientController.php";
require "../../../../CONTROLLERS/devisController.php";
require "../../../../CONTROLLERS/devisdetailsController.php" ;



$demandeCtr = new DemandeDevisController();
$allDemandes = $demandeCtr->getAllDemandeDevis();

function generateDevisCode($created_at, $devis_id) {
  // Obtenir les 6 premiers chiffres de la date de création au format 'ddmmyy'
  $date_part = date('dmy', strtotime($created_at));

  // Formater l'ID de devis avec 4 chiffres
  $devis_id_part = str_pad($devis_id, 4, '0', STR_PAD_LEFT);

  // Composer le code de devis en concaténant les parties de la date et de l'ID de devis
  $devis_code = $date_part . $devis_id_part;

  return $devis_code;
}

function getBadgeClass($etat) {
  switch ($etat) {
      case 'en attente':
          return 'badge badge-warning';
      case 'confirmé':
          return 'badge badge-success';
      case 'expiré':
          return 'badge badge-danger';
      default:
          return 'badge badge-info';
  }
}

if (isset($_GET['id'])) {
  // Récupérer l'ID du devis depuis les paramètres GET
  $devisId = $_GET['id'];
  $devCtr = new DevisDetailsController();
  $details = $devCtr->getDevisDetailsById($devisId);

}


?>


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


<style>
  /* Styles pour le cercle */
      .plusicon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 35px;
        height: 30px;
        border-radius: 50%;
        background-color: transparent; 
        border: 2px solid #4B49AC;
        color: #4B49AC; 
      }

      /* Styles pour l'icône */
      .plusicon i {
        font-size: 25px; /* Taille de l'icône */
      }


      .icon-space {
        margin-right: 10px; /* Espacement entre l'icône et le texte */
    }

    .text-space {
        display: inline-block; /* Permet de gérer l'espacement vertical */
        font-size: 14px; /* Taille du texte */
        padding: 5px 10px; /* Espacement autour du texte */
    }

</style>

        <!-- partial -->
        <div class="main-panel">          
        <div class="content-wrapper">
 
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">les nouvellement</p>
                  <div class="row">
                    <div class="col-12">
                      ici vous pouvez trouver tous les devis et vous pouvez les gestionners
                    </div>
                  </div>
                  </div>
                </div>
            </div>
        </div>


        <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">les Devis</h4>
                  <p class="card-description">
                    vous pouvez suivi l'etat des devis ici 
                  </p>
                  <div class="table-responsive">
                    <table id="myDataTable" class="table table-striped">
                      <thead style="background: #4B49AC; color:white ; " >
                        <tr>
                          <th>
                           #
                          </th>
                          <th>
                             username 
                          </th>
                          <th>
                             Entreprise
                          </th>
                          <th>
                            code Devis
                          </th>
                          <th>
                            Etat
                          </th>
                          <th>
                            date de creation
                          </th>

                          <th>
                             type
                          </th>
                          <th>
                            Actoion
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($allDemandes as $demande) : ?>
                        <tr>
                        <td class="py-1">
                            <img src="<?php echo APPURL ?>/assets/images/avatar/<?php echo $demande->profile; ?>" alt="image"/>
                          </td>
                          <td class="py-1"><?php echo $demande->username ; ?></td>
                          <td class="py-1"><?php echo $demande->entreprise ; ?></td>

                          <td class="py-1">
                          <b>D- <?php echo generateDevisCode($demande->created_at, $demande->devis_id);  ?></b>
                          </td>
                          <td>
                          <label class="<?php echo  getBadgeClass($demande->etat); ?>" style="width: 85% ; color : white ;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"><?php echo $demande->etat ; ?> </label>
                          </td>

                          <td>
                          <?php echo $demande->created_at ; ?>
                          </td>

                          <td>
                          <?php echo $demande->type ; ?>
                          </td>
                          <td>
                            <ul class="navbar-nav navbar-nav-right">
                                <li class="nav-item nav-profile dropdown">
                                    <a class="plusicon " href="#" data-toggle="dropdown" id="profileDropdown">
                                        <i class="icon-ellipsis"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">

                                            <a class="dropdown-item" href="<?php echo APPURL ?>/Client-space/pages/demandeDevis/devisDetails/devisItem.php?id=<?php echo $demande->devis_id ; ?>&code=<?php echo generateDevisCode($demande->created_at, $demande->devis_id); ?>">
                                                <i class="mdi mdi-file text-primary icon-space"></i>
                                                <span class="text-space">Consulter</span>
                                            </a>
                                            <a class="dropdown-item edit-link" href="#" data-devis-id="<?php echo $demande->devis_id ; ?>">
                                              <i class="mdi mdi-pencil text-primary icon-space"></i>
                                              <span class="text-space">Editer</span>
                                            </a>
                                          <a class="dropdown-item edit-link" href="<?php echo APPURL ; ?>/Admin-panel/admnPages/devis/supprimerDev.php?id=<?php echo $demande->devis_id ; ?>" >
                                              <i class="mdi mdi-pencil text-primary icon-space"></i>
                                              <span class="text-space">Supprimer</span>
                                          </a>
                                            <a class="dropdown-item" target="_blank" href="devisDetails/gennew.php?id=<?php echo $demande->devis_id ; ?>&code=<?php echo generateDevisCode($demande->created_at, $demande->devis_id); ?>">
                                                <i class="mdi mdi-download text-primary icon-space"></i>
                                                <span class="text-space">Telecharger PDF</span>
                                            </a>
                                            <?php if($demande->etat == "valable") : ?>
                                              <a class="dropdown-item confirm-link" href="#" data-devis-id="<?php echo $demande->devis_id ; ?>" data-confirm-id="<?php echo $demande->devis_id ; ?>">
                                                  <i class="mdi mdi-check-circle text-primary icon-space"></i>
                                                  <span class="text-space">Confirmer</span>
                                              </a>


                                            <?php endif ; ?>
                                      
                                    </div>
                                </li>
                            </ul>
                          </td>
                        </tr>
                        <?php endforeach ; ?>


   
              
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>



            <div id="confirmationModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Confirmation de commande</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                  <form id="confirmationForm">
                    <div class="form-group">
                      <label for="livraisonDate">Date de livraison :</label>
                      <input type="date" class="form-control" id="livraisonDate" required>
                    </div>
                    <div class="form-group">
                      <label for="acompte">Acompte :</label>
                      <input type="number" class="form-control" id="acompte" required>
                    </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" id="confirmOrder">Valider</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                </div>
              </div>
            </div>
          </div>



             
        </div>  


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('#myDataTable').DataTable();


    // Afficher la boîte de dialogue modale lors du clic sur le lien "Confirmer"
    $('.confirm-link').click(function(e) {
    e.preventDefault();
    var devisId = $(this).data('confirm-id');
    $('#confirmationModal').data('devis-id', devisId); // Stocker l'ID du devis dans le modal
    $('#confirmationModal').modal('show');
});
$('#confirmOrder').click(function() {
    var livraisonDate = $('#livraisonDate').val();
    var acompte = $('#acompte').val();
    var devisId = $('#confirmationModal').data('devis-id'); // Récupérer l'ID du devis depuis la modal

    console.log("Livraison Date:", livraisonDate);
    console.log("Acompte:", acompte);
    console.log("Devis ID:", devisId);

    // Envoyer les données au serveur via AJAX
    $.ajax({
        url: 'valideCom.php',
        method: 'POST',
        data: {
            livraisonDate: livraisonDate,
            acompte: acompte,
            devisId: devisId
        },
        success: function(response) {
          console.log(response);
            // Mettre à jour l'état du devis ou afficher un message de confirmation
            alert('La commande a été créée avec succès !');
           
            location.reload(); // Recharger la page pour mettre à jour l'affichage
        },
        error: function(xhr, status, error) {
            alert('Une erreur s\'est produite lors de la création de la commande.');
            console.error(error);
        }
    });

});

  });



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


