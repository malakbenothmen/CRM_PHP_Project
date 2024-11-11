<?php require "../../partials/header.php" ;
require "../../../../CONTROLLERS/clientController.php";
require "../../../../CONTROLLERS/commandeController.php";

$client_id=$_SESSION['user_id'];


$cmdCtr = new CommandeController();
$allCommandes = $cmdCtr->getCommandeByClient($client_id);

function generateComCode($created_at, $com_id) {
  // Obtenir les 6 premiers chiffres de la date de création au format 'ddmmyy'
  $date_part = date('dmy', strtotime($created_at));

  // Formater l'ID de devis avec 4 chiffres
  $com_id_part = str_pad($com_id, 4, '0', STR_PAD_LEFT);

  // Composer le code de devis en concaténant les parties de la date et de l'ID de devis
  $com_code = $date_part . $com_id_part;

  return $com_code;
}

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
    <?php require "../../partials/_navbar.php" ; ?>


    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_settings-panel.html -->
      <?php require "../../partials/_settings-panel.php" ; ?>
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
      <!-- partial:../../partials/_sidebar.html -->
      <?php require "../../partials/_sidebar.php" ; ?>

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
                  <h4 class="card-title">Mes Commandes</h4>
                  <p class="card-description">
                    vous pouvez suivi l'etat de vos Commandes ici 
                  </p>
                  <div class="table-responsive">
                    <table id="myDataTable" class="table table-striped">
                      <thead style="background: #EC831B ; color:white ; " >
                        <tr>
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
                        <?php foreach($allCommandes as $com) : ?>
                        <tr>
                          <td class="py-1">
                          <b>C-<?php echo generateComCode($com->validate_at , $com->commande_id) ; ?> </b>
                          </td>
                          <td>
                           <?php echo $com->validate_at ; ?>
                          </td>

                          <td>
                          <label class="<?php echo getBadgeClass($com->etat);?> " style="width: 80%; color: white ;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"><?php echo $com->etat;?></label>
                          </td>

                     
                          <td>
                            <?php echo $cmdCtr->calculMontantTTC($com->devis_id , 19); ?>DT
                          </td>

                          <td>
                          <?php echo $com->date_livraison ; ?>
                           
                          </td>


                          <td>
                          <ul class="navbar-nav navbar-nav-right">
                          <li class="nav-item nav-profile dropdown" >
                              <a class="plusicon " href="#" data-toggle="dropdown" id="profileDropdown">
                               <i class="icon-ellipsis"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                              <a class="dropdown-item" target="_blank" href="#">
                                 <i class="mdi mdi-file text-primary icon-space"></i>
                                    <span class="text-space">Consulter</span>
                                 </a>
                                  <a class="dropdown-item" target="_blank" href="#">
                                    <i class="mdi mdi-download text-primary icon-space"></i>
                                              <span class="text-space">Telecharger PDF</span>
                                          </a>
                                
                              </div>
                            </li>
                          </ul>

                          </td>
                        </tr>
                        <?php endforeach ?>

             

   
              
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

  <?php include "../../partials/_footer.php" ; ?>



</body>

</html>
</body>

</html>


