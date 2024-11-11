<?php require "../../partials/header.php" ; 
require "../../../../CONTROLLERS/factureController.php";
require "../../../../CONTROLLERS/commandeController.php";

function getBadgeClass($etat) {
  switch ($etat) {
      case 'Paiement non recu':
          return 'badge badge-danger';
      case 'Payée':
          return 'badge badge-success';
 
      default:
          return 'badge badge-info';
  }
}

$client_id=$_SESSION['user_id'];





  $comCtr = new CommandeController();

$factCtr = new FactureController();
$allFact = $factCtr->getAllFactureByClient($client_id);

function generateFactCode($created_at, $fact_id) {
  // Obtenir les 6 premiers chiffres de la date de création au format 'ddmmyy'
  $date_part = date('dmy', strtotime($created_at));

  // Formater l'ID de devis avec 4 chiffres
  $fact_id_part = str_pad($fact_id, 4, '0', STR_PAD_LEFT);

  // Composer le code de devis en concaténant les parties de la date et de l'ID de devis
  $fact_code = $date_part . $fact_id_part;

  return $fact_code;
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
        <div class="main-panel">          
        <div class="content-wrapper">
 
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">les nouvellements</p>
                  <div class="row">
                    <div class="col-12">
                      ici vous pouvez trouver les Commandes que vous avez passé et vous pouvez suivi leur etats .
                
                    </div>
                  </div>
                  </div>
                </div>
            </div>
        </div>


        <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Mes Factures</h4>
                  <p class="card-description">
                    vous pouvez suivi l'etat de vos Facture s ici 
                  </p>
                  <div class="table-responsive">
                    <table id="myDataTable" class="table table-striped">
                      <thead style="background: #E7BED2 ; color:white ; " >
                        <tr>
                          <th>
                            Numero de Facture
                          </th>
                          <th>
                            Date d'emission
                          </th>
                          <th>
                            Statut
                          </th>
                          <th>
                            Montant_TTC
                          </th>
                          <th>
                              Action
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($allFact as $fact ) : ?>
                        <tr>
          
                          <td class="py-1">
                          <b>F-<?php echo generateFactCode($fact->created_at,$fact->fact_id) ; ?></b>
                          </td>
                          <td>
                           <?php echo $fact->created_at ; ?>
                          </td>

                          <td>
                          <label class="<?php echo getBadgeClass($fact->etat_Fact);?>" style="width: 80% " aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"><?php echo $fact->etat_Fact ; ?></label>
                          </td>

                          <td>
                          <?php $res = $factCtr->getDevidIdC($fact->commande_id);
                          echo $comCtr->calculMontantTTC($res->devis_id , 19) ; ?>DT
                          </td>


                          <td>
                          <ul class="navbar-nav navbar-nav-right">
                          <li class="nav-item nav-profile dropdown" >
                              <a class="plusicon " href="#" data-toggle="dropdown" id="profileDropdown">
                               <i class="icon-ellipsis"></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                              <a class="dropdown-item" href="#">
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


