<?php require "../../includes/header.php" ; 
require "../../../../CONTROLLERS/factureController.php";
require "../../../../CONTROLLERS/commandeController.php";


  $factCtr = new FactureController();
  $AllFact = $factCtr->getAllFacture();
  $comCtr = new CommandeController();


  function getBadgeClass($etat) {
    switch ($etat) {

        case 'Payée':
            return 'badge badge-success';
        case 'Paiement non recu':
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
                      ici vous pouvez trouver les factures .
                
                    </div>
                  </div>
                  </div>
                </div>
            </div>
        </div>


        <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Les Factures</h4>
                  <p class="card-description">
                    vous pouvez suivi l'etat des Factures ici 
                  </p>
                  <div class="table-responsive">
                    <table id="myDataTable" class="table table-striped">
                      <thead style="background: #F34646 ; color:white ; " >
                        <tr>

                          <th>
                            Entreprise
                          </th>
                          <th>
                            Code
                          </th>          
                          <th>
                            Etat
                          </th>
                          <th>
                            commande
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
                        <?php foreach($AllFact as $fact) : ?>
                        <tr>

                          <td>
                          <?php echo $fact->entreprise; ?>
                          </td>


                          <td class="py-1">
                          <b>F-<?php echo   $factCtr->generateFactCode($fact->created_at,$fact->fact_id); ?></b>
                          </td>

                          <td>
                          <label class="<?php echo  getBadgeClass($fact->etat_Fact); ?>" style="width: 85% ; color : white ;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"><?php echo $fact->etat_Fact ; ?> </label>
                          </td>
                        
                          </td>

                          <td class="py-1">
                          <b>C-<?php echo $comCtr->generateComCode($fact->created_at,$fact->commande_id); ?></b>
                          </td>

                          <td>
                          <?php $res = $factCtr->getDevidIdC($fact->commande_id);
                          echo $comCtr->calculMontantTTC($res->devis_id,19); ?>DT
                          </td>
                          
                          <td>
                          <?php echo $fact->created_at; ?>
                          </td>


                          <td>
                            <ul class="navbar-nav navbar-nav-right">
                            <li class="nav-item nav-profile dropdown" >
                                <a class="plusicon " href="#" data-toggle="dropdown" id="profileDropdown">
                                <i class="icon-ellipsis"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                                  
                                  <a class="dropdown-item" href="<?php echo APPURL ; ?>/Admin-panel/admnPages/facture/payer_fact.php?id=<?php echo $fact->fact_id ; ?>" >
                                  <i class="fas fa-coins text-primary icon-space"></i>
                                  <span class="text-space">Payer</span>
                                  </a>
                                  <a class="dropdown-item" href="#">
                                  <i class="mdi mdi-file text-primary icon-space"></i>
                                  <span class="text-space">Telechager PDF</span>
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


