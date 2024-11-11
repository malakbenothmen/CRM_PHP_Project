<?php require "../../partials/header.php" ;
require "../../../../CONTROLLERS/clientController.php";
require "../../../../CONTROLLERS/devisController.php";
require "../../../../CONTROLLERS/devisdetailsController.php";
require "../../../../CONTROLLERS/commandeController.php";
require "../../../../CONTROLLERS/factureController.php";


    if(isset($_SESSION['user_id']))
 {
    $client_id=$_SESSION['user_id'];

    $demandeCtr = new DemandeDevisController();
    $nb_dev = $demandeCtr->countDevis($client_id);

    $comCtr = new CommandeController() ;
    $nb_com = $comCtr->countCommande($client_id);
    
    $factCtr = new FactureController();
    $nb_fact = $factCtr->countFacture($client_id);

    $clCtr = new ClientController();
    $client = $clCtr->getClient($client_id);
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

        <!-- partial -->
        <div class="main-panel">          
        <div class="content-wrapper">

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Salut, Malak!</p>
                  <div class="row">
                    <div class="col-12">
                       vous pouvez changer votre information personnels  dans cette page .
                
                    </div>
                  </div>
                  </div>
                </div>
            </div>
        </div>

     <!-- Main Content -->
     <div class="main-content">
        <section class="section">

          <div class="section-body">
            
            <div class="row mt-sm-4">

              <div class="col-12 col-md-12 col-lg-5">
                <div class="card profile-widget">
                    <div class="profile-widget-header">                     
                       <img alt="image" src="<?php echo APPURL ; ?>/assets/images/avatar/<?php echo $client->profile ; ?>" class="rounded-circle profile-widget-picture">
                          <div class="profile-widget-items">
                            <div class="profile-widget-item">
                                <div class="profile-widget-item-label">Devis</div>
                                <div class="profile-widget-item-value"><?php echo $nb_dev->nb_devis ; ?></div>
                              </div>
                              <div class="profile-widget-item">
                                  <div class="profile-widget-item-label">Commande</div>
                                   <div class="profile-widget-item-value"><?php echo $nb_com->nb_commande ; ?></div>
                              </div>

                              <div class="profile-widget-item">
                                  <div class="profile-widget-item-label">Facture</div>
                                  <div class="profile-widget-item-value"><?php echo $nb_fact->nb_facture ; ?></div>
                              </div>
                            </div>
                          </div>
                                
                          <div class="profile-widget-description">
                            <table width= 100%   >
                                        <tr>
                                            <td><div class="profile-widget-name">Nom d'utilisateur</div></td>
                                            <td><?php echo $client->username ; ?></td>
                                        </tr>
                                        <tr>
                                            <td><div class="profile-widget-name">Position</div></td>
                                            <td><?php echo $client->position ; ?></td>
                                        </tr>
                                        <tr>
                                            <td><div class="profile-widget-name">Entreprise</div></td>
                                            <td><?php echo $client->entreprise ; ?></td>
                                        </tr>
                                        <tr>
                                            <td><div class="profile-widget-name">Email</div></td>
                                            <td><?php echo $client->email ; ?></td>
                                        </tr>
                                        <tr>
                                            <td><div class="profile-widget-name">SIRET</div></td>
                                            <td><?php echo $client->siret ; ?></td>
                                        </tr>
                                        <tr>
                                            <td><div class="profile-widget-name">Téléphone</div></td>
                                            <td><?php echo $client->tel ; ?></td>
                                        </tr>
                                        <tr>
                                            <td><div class="profile-widget-name">Site Web</div></td>
                                            <td><?php echo $client->website ; ?></td>
                                        </tr>
                            </table>
                          </div>


                                <div class="card-footer text-center">
                                    <div class="profile-widget-items">
                                    <div class="profile-widget-item">

                                        <div class="profile-widget-item-value"><?php echo $client->country; ?></div>
                                    </div>
                      
                                    <div class="profile-widget-item">
                                        <div class="profile-widget-item-value"><?php echo $client->adresse ; ?></div>
                                    </div>
                                    </div>
                                </div>
                                </div>
              </div>

              <div class="col-12 col-md-12 col-lg-7">
                <div class="card">
                  <form method="post" class="needs-validation" novalidate="">
                    <div class="card-header" style=" border-top-left-radius: 15px;border-top-right-radius: 15px; background-color : #D3DDF5 ; color : #7980F1 ; text-align : center ;  font-weight: bold; font-size : 20px; " >
                      <span>Modifier Compte</span>
                    </div>
                    <div class="card-body">
                        <div class="row">                               
                          <div class="form-group col-md-6 col-12">
                            <label>Nom utilisateur</label>
                            <input type="text" class="form-control" value="<?php echo $client->username ; ?>" required="">
                            <div class="invalid-feedback">
                              entrer votre nom utilisateur
                            </div>
                          </div>
                          <div class="form-group col-md-6 col-12">
                            <label>Email</label>
                            <input type="text" class="form-control" value="<?php echo $client->email ; ?>" required="">
                            <div class="invalid-feedback">
                             entrer votre email
                            </div>
                          </div>
                        </div>
                        <div class="row">
                        <div class="form-group col-md-6 col-12">
                            <label>numero de telephone</label>
                            <input type="tel" class="form-control" value="<?php echo $client->tel ; ?>">
                          </div>
                          <div class="form-group col-md-6 col-12">
                            <label>site Web</label>
                            <input type="text" class="form-control" value="<?php echo $client->website ; ?>" required="">
                            <div class="invalid-feedback">
                              saisir votre site web
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-md-4 col-12">
                            <label>Entreprise</label>
                            <input type="text" class="form-control" value="<?php echo $client->email ; ?>" required="">
                            <div class="invalid-feedback">
                              entrer le nom de votre entreprise
                            </div>
                          </div>
                          <div class="form-group col-md-4 col-12">
                            <label>SIRET</label>
                            <input type="text" class="form-control" value="<?php echo $client->siret ; ?>">
                          </div>
                          <div class="form-group col-md-4 col-12">
                            <label>Position</label>
                            <input type="text" class="form-control" value="<?php echo $client->position ; ?>" required="">
                            <div class="invalid-feedback">
                              entrer votre position dans l'entreprise
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-md-4 col-12">
                            <label>Paye</label>
                            <input type="Text" class="form-control" value="<?php echo $client->country ; ?>" required="">
                            <div class="invalid-feedback">
                              saisir votre pays
                            </div>
                          </div>
                  
                          <div class="form-group col-md-4 col-12">
                            <label>Adresse</label>
                            <input type="text" class="form-control" value="<?php echo $client->adresse ; ?>" required="">
                            <div class="invalid-feedback">
                              entrer votre adresse 
                            </div>
                          </div>
                        </div>
  
 
                    </div>
                    <div class="card-footer text-right">
                      <button type= "submit" name="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>


  <?php include "../../partials/_footer.php" ; ?>
