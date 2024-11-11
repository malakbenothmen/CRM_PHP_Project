<?php require "includes/header.php" ; 
require "../../CONTROLLERS/clientController.php";
require "../../CONTROLLERS/devisController.php";
require "../../CONTROLLERS/devisdetailsController.php";
require "../../CONTROLLERS/commandeController.php";
require "../../CONTROLLERS/factureController.php";


$clCtr = new ClientController();
$clients = $clCtr->getAllClient();
?>
<div class="container-scroller">
<!-- partial:partials/_navbar.php -->
<?php require "includes/_navbar.php" ; ?>

       <!-- partial -->
   <div class="container-fluid page-body-wrapper">
 <!-- partial -->
<!-- partial:partials/_sidebar.html -->
 <?php include "includes/_sidebar.php" ; ?>
 
 <!-- partial -->
 <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="ag-format-container">
                <div class="ag-courses_box">

                <div class="ag-courses_item" >
                  <a href="#" class="ag-courses-item_link" style =" background-image: url('../assets/images/bgbabole3.png');" >
                 

                    <div class="ag-courses-item_title">
                      Devis
                    </div>

                    <div class="ag-courses-item_date-box">
                    
                      <span class="ag-courses-item_date">
                        25
                      </span>
                    </div>
                  </a>
                </div>

                <div class="ag-courses_item">
                  <a href="#" class="ag-courses-item_link" style =" background-image: url('../assets/images/bgbabole2.png');" >
                 

                    <div class="ag-courses-item_title">
                     Commande
                    </div>

                    <div class="ag-courses-item_date-box">
                      
                      <span class="ag-courses-item_date">
                        15
                      </span>
                    </div>
                  </a>
                </div>

                <div class="ag-courses_item">
                  <a href="#" class="ag-courses-item_link" style =" background-image: url('../assets/images/bgbabole1.png');">
                    <div class="ag-courses-item_bg"></div>

                    <div class="ag-courses-item_title">
                      Facture
                    </div>

                    <div class="ag-courses-item_date-box">
                      
                      <span class="ag-courses-item_date">
                        10
                      </span>
                    </div>
                  </a>
                </div>

                </div>
              </div>

          <div class=row>
            <div class="col-12 col-sm-12 col-lg-7">
                <div class="card author-box card-primary">
                        
                </div>
            </div>
          </div>


          <div class="row">
            <div class="col-md-8 grid-margin stretch-card " >
              <div class="card card-danger ">
                              <div class="card-header" style="background-color: white; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                                <div>     
                                <div class="d-flex justify-content-between">
                                    <p class="card-title">Utilisateurs</p>
                                    <h6><a href="<?php echo APPURL ; ?>/Admin-panel/AdmnPages/utilisateur/gestionuser.php" class="bouton btn-danger " style="font-size : 12px;">Voir Tous <i class="fas fa-chevron-right" style="font-weight:bold ;"></i></a></h6>
                                    
                                </div>
                                </div>
                              </div>
                             
                              <div class="card-body">
                                <div class="owl-carousel owl-theme" id="users-carousel">
                                  <?php foreach($clients as $cl ) : ?>
                                  <div>
                                    <div class="user-item">
                                      <img alt="image" src="<?php echo APPURL ; ?>/assets/images/avatar/<?php echo $cl->profile ; ?>" class="img-fluid">
                                      <div class="user-details">
                                        <div class="user-name"><?php echo $cl->username ; ?></div>
                                        <div class="text-job text-muted"><?php echo $cl->position ; ?></div>
                                        <div class="user-cta">
                                          <a href ="<?php echo APPURL ; ?>/Admin-panel/AdmnPages/utilisateur/consulter_user.php?id=<?php echo $cl->client_id ; ?>" class="btn btn-primary" >Detail</a>
                                        </div>
                                      </div>  
                                    </div>
                                  </div>
                                  <?php  endforeach ?>

                                  <div>
                                    <div class="user-item">
                                      <img alt="image" src="../assets/images/avatar/avatar-2.png" class="img-fluid">
                                      <div class="user-details">
                                        <div class="user-name">PL</div>
                                        <div class="text-job text-muted">Assistant PL</div>
                                        <div class="user-cta">
                                          <button class="btn btn-primary follow-btn" data-follow-action="alert('user2 followed');" data-unfollow-action="alert('user2 unfollowed');">Detail</button>
                                        </div>
                                      </div>  
                                    </div>
                                  </div>

                                  <div>
                                    <div class="user-item">
                                      <img alt="image" src="../assets/images/avatar/avatar-3.png" class="img-fluid">
                                      <div class="user-details">
                                        <div class="user-name">Carmeuse</div>
                                        <div class="text-job text-muted">assistant Carmeuse</div>
                                        <div class="user-cta">
                                          <button class="btn btn-primary following-btn" data-unfollow-action="alert('user3 unfollowed');" data-follow-action="alert('user3 followed');">Detail</button>
                                        </div>
                                      </div>  
                                    </div>
                                  </div>

                                  <div>
                                    <div class="user-item">
                                      <img alt="image" src="../assets/images/avatar/avatar-4.png" class="img-fluid">
                                      <div class="user-details">
                                        <div class="user-name">Lind Gaz</div>
                                        <div class="text-job text-muted">Project Manager</div>
                                        <div class="user-cta">
                                          <button class="btn btn-primary follow-btn" data-follow-action="alert('user4 followed');" data-unfollow-action="alert('user4 unfollowed');">Detail</button>
                                        </div>
                                      </div>  
                                    </div>
                                  </div>

                                  <div>
                                    <div class="user-item">
                                      <img alt="image" src="../assets/images/avatar/avatar-5.png" class="img-fluid">
                                      <div class="user-details">
                                        <div class="user-name">vilavi</div>
                                        <div class="text-job text-muted">IT Support</div>
                                        <div class="user-cta">
                                          <button class="btn btn-primary follow-btn" data-follow-action="alert('user5 followed');" data-unfollow-action="alert('user5 unfollowed');">Detail</button>
                                        </div>
                                      </div>  
                                    </div>
                                  </div>

                                </div>
                              </div>
                            </div>

              
            </div>

            <div class="col-md-4 grid-margin stretch-card">
              <div class="card">
              <div class="card-header" style="background-color: white; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                 <div>     
                    <div class="d-flex justify-content-between">
                      <p class="card-title">les Meuilleurs Payes</p>
                    </div>
                 </div>
              </div>
                             
              <div class="card-body">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="text-title mb-2"></div>
                      <ul class="list-unstyled list-unstyled-border list-unstyled-noborder mb-0">
                        <li class="media">
                          <img class="img-fluid mt-1 img-shadow" src="admnassets/modules/flag-icon-css/flags/4x3/tn.svg" alt="image" width="40">
                          <div class="media-body ml-3">
                            <div class="media-title">Tunisie</div>
                            <div class="text-small text-muted">64,12% <i class="fas fa-caret-down text-success"></i></div>
                          </div>
                        </li>
                        <li class="media">
                          <img class="img-fluid mt-1 img-shadow" src="admnassets/modules/flag-icon-css/flags/4x3/dz.svg" alt="image" width="40">
                          <div class="media-body ml-3">
                            <div class="media-title">Algerie</div>
                            <div class="text-small text-muted">13,33% <i class="fas fa-caret-down text-success"></i></div>
                          </div>
                        </li>
                        <li class="media">
                          <img class="img-fluid mt-1 img-shadow" src="admnassets/modules/flag-icon-css/flags/4x3/fr.svg" alt="image" width="40">
                          <div class="media-body ml-3">
                            <div class="media-title">France</div>
                            <div class="text-small text-muted">5,40% <i class="fas fa-caret-up text-danger"></i></div>
                          </div>
                        </li>
                      </ul>
                    </div>
                    <div class="col-sm-6 mt-sm-0 mt-4">
                      <div class="text-title mb-2"></div>
                      <ul class="list-unstyled list-unstyled-border list-unstyled-noborder mb-0">
                        <li class="media">
                          <img class="img-fluid mt-1 img-shadow" src="admnassets/modules/flag-icon-css/flags/4x3/it.svg" alt="image" width="40">
                          <div class="media-body ml-3">
                            <div class="media-title">Italie</div>
                            <div class="text-small text-muted">6,62% <i class="fas fa-caret-up text-success"></i></div>
                          </div>
                        </li>
                        <li class="media">
                          <img class="img-fluid mt-1 img-shadow" src="admnassets/modules/flag-icon-css/flags/4x3/de.svg" alt="image" width="40">
                          <div class="media-body ml-3">
                            <div class="media-title">Germany</div>
                            <div class="text-small text-muted">8,22%<i class="fas fa-caret-up text-success"></i></div>
                          </div>
                        </li>
                        <li class="media">
                          <img class="img-fluid mt-1 img-shadow" src="admnassets/modules/flag-icon-css/flags/4x3/ma.svg" alt="image" width="40">
                          <div class="media-body ml-3">
                            <div class="media-title">Maroc</div>
                            <div class="text-small text-muted">2,31% <i class="fas fa-caret-down text-danger"></i></div>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            
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

        <?php include "includes/_footer.php" ; ?>
