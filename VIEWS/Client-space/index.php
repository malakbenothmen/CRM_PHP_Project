<?php require "partials/header.php" ; 
require "../../CONTROLLERS/clientController.php";

if (!isset($_SESSION['username']))
{
  header("location: ". APPURL."");
    
}
    $user_id=$_SESSION['user_id'];
    $userCtr = new ClientController();
    $current_user = $userCtr->getClient($user_id);
    $date = $userCtr->getCurrentDate();



    

?>
   

    <body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.php -->
    <?php require "partials/_navbar.php" ; ?>
    
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
    
   
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <?php include "partials/_sidebar.php" ; ?>

      <!-- partial -->
      <div class="main-panel" >
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Bienvenu <?php echo $current_user->username ; ?> !</h3>
                  <h6 class="font-weight-normal mb-0"> Vous avez <span class="text-primary">3 notifications non lue !</span></h6>
                </div>
                <div class="col-12 col-xl-4">
                 <div class="justify-content-end d-flex">
                  <div class=" flex-md-grow-1 flex-xl-grow-0">
                    <button class="btn btn-sm btn-light bg-white " type="button"  aria-haspopup="true" aria-expanded="true">
                     <i class="mdi mdi-calendar"></i> aujourd'hui <?php echo $date['audDate']; ?>
                    </button>

                  </div>
                 </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card tale-bg" style=" background-image: url('../assets/images/dashboard/welcome.jpg'); background-size: cover; background-position: center; "> 
               
              </div>
            </div>
            
            <div class="col-md-6 grid-margin transparent">
           
                <div class="card profile-widget">
                  <div class="profile-widget-header">                     
                    <img alt="image" src="<?php echo APPURL ; ?>/assets/images/faces/avatar.png" class="rounded-circle profile-widget-picture">
                    <div class="profile-widget-items">
                      <div class="profile-widget-item">
                        <div class="profile-widget-item-label">Devis</div>
                        <div class="profile-widget-item-value">8</div>
                      </div>
                      <div class="profile-widget-item">
                        <div class="profile-widget-item-label">Commande</div>
                        <div class="profile-widget-item-value">6</div>
                      </div>
                      <div class="profile-widget-item">
                        <div class="profile-widget-item-label">Facture</div>
                        <div class="profile-widget-item-value">1</div>
                      </div>
                    </div>
                  </div>
                  <div class="profile-widget-description">
                    <div class="profile-widget-name"><?php echo $current_user->username ; ?> <div class="text-muted d-inline font-weight-normal"><div class="slash"></div> <?php echo $current_user->position ; ?></div></div>
                    
                    <div class="profile-widget-name">Entreprise</div>
                    <?php echo $current_user->entreprise ; ?> 
      

                  </div>
                  <div class="card-footer text-center">
                    <div class="profile-widget-items">
                      <div class="profile-widget-item">

                      </div>
                  
                      </div>
                    </div>
                  </div>
                </div>
              </div>
           
          </div>

          <div class="row">
                <div class="col-md-4 stretch-card grid-margin">
                  <div class="row">
            
                    <div class="col-md-12 stretch-card grid-margin grid-margin-md-0">
                      <div class="card data-icon-card-primary">
                        <div class="card-body">
                          <p class="card-title text-white">Nouveauté </p>                      
                          <div class="row">
                            <div class="col-8 text-white">
                              <h3>Devis</h3>
                              <p class="text-white font-weight-500 mb-0">Votre Devis D-40224003 est prets vous pouvez le consuter ici et le confirmer pour passer votre commande .</p>
                            </div>
                            <div class="col-4 background-icon">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>


                <div class="col-md-4 stretch-card grid-margin">
                  <div class="row">
            
                    <div class="col-md-12 stretch-card grid-margin grid-margin-md-0">
                      <div class="card data-icon-card-primary  card-light-blue">
                        <div class="card-body">
                          <div class="class-header">
                          <p class="card-title text-white">Nouveauté</p>     
                        </div>                 
                          <div class="row">
                            <div class="col-8 text-white">
                              <h3>Facture</h3>
                              <p class="text-white font-weight-500 mb-0">Cher Client !Votre Facture F-020224002 est préts vous pouvez maintenant le Consulter et Telecharger </p>
                            </div>
                            <div class="col-4 background-icon">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-4 stretch-card grid-margin">
                  <div class="row">
            
                    <div class="col-md-12 stretch-card grid-margin grid-margin-md-0">
                      <div class="card data-icon-card-primary">
                        <div class="card-body">
                          <p class="card-title text-white">Nouveauté </p>                      
                          <div class="row">
                            <div class="col-8 text-white">
                              <h3>Commande</h3>
                              <p class="text-white font-weight-500 mb-0">Votre Commande C-020224001 est en evalution  , vous devez payee le reste avant la date de livraison  .</p>
                            </div>
                            <div class="col-4 background-icon">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
          </div>

    
       

    

        <!-- content-wrapper ends -->    
        <!-- partial:partials/_footer.php -->       

        <?php include "partials/_footer.php" ; ?>


   