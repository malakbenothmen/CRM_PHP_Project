<?php require "../../partials/header.php" ; 
require "../../../../CONTROLLERS/clientController.php";
require "../../../../CONTROLLERS/devisController.php";
require "../../../../CONTROLLERS/devisdetailsController.php" ;

$client_id=$_SESSION['user_id'];


$demandeCtr = new DemandeDevisController();
$allDemandes = $demandeCtr->getAllDemandeByClient($client_id);

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
    <?php require "../../partials/_navbar.php" ; ?>


    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_settings-panel.html -->
      <?php require "../../partials/_settings-panel.php" ; ?>

      <!-- partial -->
      <!-- partial:../../partials/_sidebar.html -->
      <?php require "../../partials/_sidebar.php" ; ?>


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
                      ici vous pouvez trouver le dernier reponse de votre demande de devis et vous pouvez envoyer d'autre devis 
                
                    </div>
                  </div>
                  </div>
                </div>
            </div>
        </div>


        <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Mes Devis</h4>
                  <p class="card-description">
                    vous pouvez suivi l'etat de vos devis ici 
                  </p>
                  <div class="table-responsive">
                    <table id="myDataTable" class="table table-striped">
                      <thead style="background: #4B49AC; color:white ; " >
                        <tr>
                          <th>
                            code Devis
                          </th>
                          <th>
                            date de creation
                          </th>
                          <th>
                            Etat
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
                          <b>D- <?php echo generateDevisCode($demande->created_at, $demande->devis_id);  ?></b>
                          </td>
                          <td>
                          <?php echo $demande->created_at ; ?>
                          </td>
                          <td>
                          <label class="<?php echo  getBadgeClass($demande->etat); ?>" style="width: 65% ; color : white ;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"><?php echo $demande->etat ; ?> </label>
                          </td>
                          <td>
                          <ul class="navbar-nav navbar-nav-right">
                              <li class="nav-item nav-profile dropdown">
                                  <a class="plusicon " href="#" data-toggle="dropdown" id="profileDropdown">
                                      <i class="icon-ellipsis"></i>
                                  </a>
                                  <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                                      <?php if($demande->etat == "en attente") : ?>
                                        <a class="dropdown-item edit-link" href="#" data-devis-id="<?php echo $demande->devis_id ; ?>">
                                            <i class="mdi mdi-pencil text-primary icon-space"></i>
                                            <span class="text-space">Editer</span>
                                        </a>
                                      <?php else : ?>
                                          <a class="dropdown-item" href="devisDetails/devisItem.php?id=<?php echo $demande->devis_id ; ?>&code=<?php echo generateDevisCode($demande->created_at, $demande->devis_id); ?>">
                                              <i class="mdi mdi-file text-primary icon-space"></i>
                                              <span class="text-space">Consulter</span>
                                          </a>
                                          <a class="dropdown-item" target="_blank" href="devisDetails/gennew.php?id=<?php echo $demande->devis_id ; ?>&code=<?php echo generateDevisCode($demande->created_at, $demande->devis_id); ?>">
                                              <i class="mdi mdi-download text-primary icon-space"></i>
                                              <span class="text-space">Telecharger PDF</span>
                                          </a>
                                          <?php if($demande->etat == "valable") : ?>
                                              <a class="dropdown-item" href="#">
                                                  <i class="mdi mdi-check-circle text-primary icon-space"></i>
                                                  <span class="text-space">Confirmer</span>
                                              </a>
                                          <?php endif ; ?>
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

              <!-- Modal pour l'édition des demandes en attente -->
              <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                   <div class="modal-dialog" role="document">
                      <div class="modal-content">
                         <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Modifier la demande</h5>
                            <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>

                          </div>
                          <div class="modal-body">
                           <table>
                           
                           <?php var_dump($details);  foreach ($details as $detail) : ?>
                              <tr>
                                 <td><?php echo $detail->reference; ?></td>
                                 <td><?php echo $detail->qte_total; ?></td>
                              </tr>
                           <?php endforeach; ?>

                           </table>

                          </div>
                           <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                  <button type="button" class="btn btn-primary">Enregistrer les modifications</button>
                           </div>
                        </div>
                    </div>
                </div>
        </div>  


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('#myDataTable').DataTable();

    // Gestionnaire d'événements pour le clic sur le lien d'édition
    $('.edit-link').on('click', function(event) {
        event.preventDefault(); // Empêcher le comportement par défaut du lien

        // Récupérer l'ID du devis à partir de l'attribut de données
        var devisId = $(this).data('devis-id');

        // Charger les détails du devis via AJAX et ouvrir la modal
        $.ajax({
            url: 'charger_detials.php', // URL de votre script PHP pour charger les détails du devis
            type: 'GET',
            data: { id: devisId }, // Envoyer l'ID du devis à votre script PHP
            success: function(response) {
                // Afficher les détails du devis dans la modal
                $('#editModal .modal-body').html(response);
                $('#editModal').modal('show'); // Ouvrir la modal
            },
            error: function(xhr, status, error) {
                // Gérer les erreurs de requête
                console.error(error);
            }
        });
    });

    // Gestionnaire d'événements pour le clic sur le bouton de fermeture
    $('.close-modal').on('click', function(event) {
        $('#editModal').modal('hide'); // Fermer la modal
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

  <?php include "../../partials/_footer.php" ; ?>



</body>

</html>
</body>

</html>


