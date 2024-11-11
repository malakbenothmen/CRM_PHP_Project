<?php require "../../includes/header.php" ; 
require "../../../../CONTROLLERS/clientController.php";
require "../../../../CONTROLLERS/commandeController.php";
require "../../../../CONTROLLERS/devisdetailsController.php" ;



  $commandeCtr = new CommandeController();
  $AllCommande = $commandeCtr->getAllCommande();

  function getBadgeClass($etat) {
    switch ($etat) {
        case 'en evaluation':
            return 'badge badge-warning';
        case 'Terminé':
            return 'badge badge-success';
        case 'Annulée':
            return 'badge badge-danger';
        default:
            return 'badge badge-info';
    }
  }
?>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.php -->
    <?php require "../../includes/_navbar.php" ; ?>


    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_settings-panel.html -->
     
      <style>
  /* Styles pour le cercle */
  .plusicon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 35px;
    height: 30px;
    border-radius: 50%;
    background-color: transparent; /* Fond transparent */
    border: 2px solid #4B49AC;; /* Contour violet */
    color: #4B49AC; /* Couleur de l'icône */
  }

  /* Styles pour l'icône */
  .plusicon i {
    font-size: 25px; /* Taille de l'icône */
  }
</style>
 
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
                  <p class="card-title">les nouvellements</p>
                  <div class="row">
                    <div class="col-12">
                      ici vous pouvez trouver les Commandé que vous avez passé et vous pouvez suivi leur etats .
                
                    </div>
                  </div>
                  </div>
                </div>
            </div>
        </div>


        <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Les Commandes</h4>
                  <p class="card-description">
                    vous pouvez suivi l'etat de vos Commandes ici 
                  </p>
                  <div class="table-responsive">
                    <table id="myDataTable" class="table table-striped">
                      <thead style="background: #EC831B ; color:white ; " >
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
                            Code
                          </th>          
                          <th>
                            Date de validation
                          </th>
                          <th>
                            Etat
                          </th>
                          <th>
                            Montont_TTC
                          </th>
                          <th>
                            Date de livraison
                          </th>
                          <th>
                            Action
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($AllCommande as $commande) : ?>
                        <tr>
                          <td class="py-1">
                            <img src="<?php echo APPURL ?>/assets/images/avatar/<?php echo $commande->profile; ?>" alt="image"/>
                          </td>

                          <td>
                          <?php echo $commande->username; ?>
                          </td>

                          <td>
                          <?php echo $commande->entreprise; ?>
                          </td>

                          <td class="py-1">
                          <b>C-<?php echo $commandeCtr->generateComCode($commande->validate_at,$commande->commande_id); ?></b>
                          </td>

                          <td>
                          <?php echo $commande->validate_at; ?>
                          </td>

                          <td>
                          <label class="<?php echo  getBadgeClass($commande->etat); ?>" style="width: 90% ; color : white ;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"><?php echo $commande->etat; ?> </label>
                          </td>

                          <td>
                            <?php echo $commandeCtr->calculMontantTTC($commande->devis_id , 19); ?>DT
                          </td>

                          <td>
                          <?php echo $commande->date_livraison; ?>
                          </td>


                          <td>
                            <ul class="navbar-nav navbar-nav-right">
                             <li class="nav-item nav-profile dropdown" >
                                <a class="plusicon " href="#" data-toggle="dropdown" id="profileDropdown">
                                <i class="icon-ellipsis"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                                <a class="dropdown-item" >
                                                <i class="mdi mdi-file text-primary icon-space"></i>
                                                <span class="text-space">Consulter</span>
                                            </a>
                                            <a class="dropdown-item edit-link" href="<?php echo APPURL ; ?>/Admin-panel/admnPages/commande/terminer_com.php?id=<?php echo $commande->commande_id ; ?>" >
                                              <i class="mdi mdi-pencil text-primary icon-space"></i>
                                              <span class="text-space">Terminer</span>
                                            </a>
                                            <a class="dropdown-item edit-link" href="<?php echo APPURL ; ?>/Admin-panel/admnPages/commande/annuler_com.php?id=<?php echo $commande->commande_id ; ?>"  >
                                              <i class="fas fa-times text-primary icon-space"></i>
                                              <span class="text-space">Annuler</span>
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

  
        </div>  


<script>
    $(document).ready(function() {
        $('#myDataTable').DataTable();
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


