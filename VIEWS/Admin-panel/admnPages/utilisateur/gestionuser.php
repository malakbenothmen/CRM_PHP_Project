<?php require "../../includes/header.php" ; 
require "../../../../CONTROLLERS/clientController.php";





$clCtr = new ClientController();
$clients = $clCtr->getAllClient();


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
    border: 2px solid #EC831B;
    color: #EC831B; 
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
.table-striped tbody tr:nth-child(odd) {
    background-color: #FEFBF6; /* Couleur de fond pour les lignes impaires */
}

.table-striped tbody tr:nth-child(even) {
    background-color: #ffffff; /* Couleur de fond pour les lignes paires */
}
</style>

        <!-- partial -->
        <div class="main-panel">          
        <div class="content-wrapper">
 
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                <p class="card-title">Créer un nouveau utlisateur</p>
                      <div class="row">
                          <div class="col-6">
                              Ici, vous pouvez trouver vos clients.
                          </div>
                          <div class="col-6 text-right">
                          <button type="button"  data-toggle="modal" data-target="#createArticleModal" class="btn btn-warning btn-lg" style="font-size : 18px;"> <i class="fas fa-plus mr-2"></i><b>Créer client</b></button> <!-- Déplacez le bouton dans cette colonne -->
                          </div>
                      </div>
                </div>
            </div>
        </div>


        <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Mes Clients</h4>
                  <p class="card-description">
                    vous pouvez suivi votre clients
                  </p>
                  <div class="table-responsive">
                    <table id="myDataTable" class="table table-striped">
                      <thead style="background: #FFC100 ; color:dark ; height : 60px ;" >
                        <tr>
                          <th>
                           #
                          </th>
                          <th>
                            Username
                          </th>
                          <th>
                            Entreprise
                          </th>
                          <th>
                            Telephone
                          </th>
                          <th>
                            Email
                          </th>
                          <th>
                            Actoion
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($clients as $cl) : ?>
                        <tr style ="height : 80px;">
                            <td class="py-1">
                                <img src="<?php echo APPURL ; ?>/assets/images/avatar/<?php echo $cl->profile ; ?>"  width="400" height="200"/>
                            </td>
                            <td><b><?php echo $cl->username; ?></b></td> 

                            <td><?php echo $cl->entreprise ; ?></td> 

                            <td><?php echo $cl->tel ; ?> </td> 

                            <td><?php echo $cl->email ; ?> </td> 



                            <td>
                             <ul class="navbar-nav navbar-nav-right">
                              <li class="nav-item nav-profile dropdown">
                                  <a class="plusicon " href="#" data-toggle="dropdown" id="profileDropdown">
                                      <i class="icon-ellipsis"></i>
                                  </a>
                                  <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                                 
                            
                                 
                                          <a class="dropdown-item" href="<?php echo APPURL ;?>/Admin-panel/admnPages/utilisateur/consulter_user.php?id=<?php echo $cl->client_id ; ?>">
                                              <i class="fas fa-eye  icon-space" style="color : #EC831B"></i>

                                              <span class="text-space">Consulter</span>
                                          </a>

                                       
                                     
                                   
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

  <?php include "../../includes/_footer.php" ; ?>



</body>

</html>
</body>

</html>


