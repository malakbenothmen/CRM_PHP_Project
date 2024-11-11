<?php require "../../includes/header.php" ;
require "../../../../CONTROLLERS/clientController.php";
require "../../../../CONTROLLERS/devisController.php";
require "../../../../CONTROLLERS/devisdetailsController.php";
require "../../../../CONTROLLERS/commandeController.php";
require "../../../../CONTROLLERS/factureController.php";


    if(isset($_GET['id']))
 {
    $client_id=$_GET['id'];

    $demandeCtr = new DemandeDevisController();
    $allDemandes = $demandeCtr->getAllDemandeByClient($client_id);
    $nb_dev = $demandeCtr->countDevis($client_id);

    $comCtr = new CommandeController() ;
    $nb_com = $comCtr->countCommande($client_id);
    $allCommandes = $comCtr->getCommandeByClient($client_id);
    
    $factCtr = new FactureController();
    $allFact = $factCtr-> getAllFactureByClient($client_id);
    $nb_fact = $factCtr->countFacture($client_id);

    $clCtr = new ClientController();
    $client = $clCtr->getClient($client_id);
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

        <!-- partial -->
    <div class="main-panel">          
        <div class="content-wrapper">

            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                    <p class="card-title">Salut, Admin!</p>
                    <div class="row">
                        <div class="col-12">
                        vous pouvez consulter les Historiques de vos clients  dans cette page .
                    
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

                                        <div class="profile-widget-item-value">.... City</div>
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
                                         <span>Devis</span>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">  
                                            <div class="table-responsive">
                                                <table id="myDataTable" class="table table-striped">
                                                <thead style="background: #ffff ; color:dark  ;" >
                                                    <tr>
                                                    <th>
                                                        code devis
                                                    </th>
                                                    <th>
                                                        date de creaton
                                                    </th>
                                                    
                                                    <th>
                                                        etat 
                                                    </th>

                                                    <th>
                                                        type
                                                    </th>
                                        
                                                    <th>
                                                        Action
                                                    </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($allDemandes as $demande) : ?>
                                                    <tr >

                                                        <td><b><?php echo $demandeCtr->generateDevisCode($demande->created_at ,$demande->devis_id); ?></b></td> 

                                                        <td><?php echo  $demande->created_at; ?></td> 

                                                        <td><?php echo $demande->etat; ?> </td> 

                                                        <td><?php echo $demande->type; ?> </td> 
                                                        <td>
                                                        <ul class="navbar-nav navbar-nav-right">
                                                        <li class="nav-item nav-profile dropdown">
                                                            <a class="plusicon " href="#" data-toggle="dropdown" id="profileDropdown">
                                                                <i class="icon-ellipsis"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                                                            
                                                                    <a class="dropdown-item edit-link" href="#" >
                                                                        <i class="mdi mdi-pencil  icon-space" style ="color : #EC831B ;"></i>
                                                                        <span class="text-space">Editer</span>
                                                                    </a>
                                                            
                                                                    <a class="dropdown-item" href="<?php echo APPURL ;?>/Client-space/pages/demandeDevis/devisDetails/devisItem.php?id=<?php echo $demande->devis_id ; ?>&code=<?php echo $demandeCtr->generateDevisCode($demande->created_at ,$demande->devis_id);?>">
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
                                </form>
                                </div>
                            </div> 

                        </div>

                        <div class="row mt-sm-4">
                
                                <div class="col-12 col-md-12 col-lg-6">
                                    <div class="card">
                                    <form  class="needs-validation" >
                                        <div class="card-header" style=" border-top-left-radius: 15px;border-top-right-radius: 15px; background-color : #D3DDF5 ; color : #7980F1 ; text-align : center ;  font-weight: bold; font-size : 20px; " >
                                        <span>Commande</span>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">  
                                                <div class="table-responsive">
                                                <table id="myDataTable" class="table table-striped">
                                                <thead style="background: #ffff ; color:dark  ;" >
                                                    <tr>
                                                    <th>
                                                        #
                                                    </th>
                                                    <th>
                                                        date de validation
                                                    </th>
                                                    
                                                    <th>
                                                        etat 
                                                    </th>
                                                    <th>
                                                    Montont_TTC
                                                    </th>

                                                    <th>
                                                        date de livraison
                                                    </th>
                                        
                                                    <th>
                                                        Action
                                                    </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($allCommandes as $com) : ?>
                                                    <tr >

                                                        <td><b><?php echo $comCtr->generateComCode($com->validate_at,$com->commande_id); ?></b></td> 

                                                        <td><?php echo  $com->validate_at; ?></td> 

                                                        <td><?php echo $com->etat; ?> </td> 

                                                        <td>
                                                            <?php echo $comCtr->calculMontantTTC($com->devis_id , 19); ?>DT
                                                        </td>
                                                        <td><?php echo  $com->date_livraison; ?></td> 
                                                        <td>
                                                            <ul class="navbar-nav navbar-nav-right">
                                                            <li class="nav-item nav-profile dropdown">
                                                                <a class="plusicon " href="#" data-toggle="dropdown" id="profileDropdown">
                                                                    <i class="icon-ellipsis"></i>
                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                                                                
                                                                        <a class="dropdown-item edit-link" href="#" >
                                                                            <i class="mdi mdi-pencil  icon-space" style ="color : #EC831B ;"></i>
                                                                            <span class="text-space">Editer</span>
                                                                        </a>
                                                                
                                                                        <a class="dropdown-item" href="#">
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
                                    </form>
                                    </div>
                                </div>    


                                <div class="col-12 col-md-12 col-lg-6">
                                    <div class="card">
                                    <form method="post" class="needs-validation" novalidate="">
                                        <div class="card-header" style=" border-top-left-radius: 15px;border-top-right-radius: 15px; background-color : #D3DDF5 ; color : #7980F1 ; text-align : center ;  font-weight: bold; font-size : 20px; " >
                                        <span>Facture</span>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">  
                                            <div class="table-responsive">
                                        <table id="myDataTable" class="table table-striped">
                                        <thead style="background: #ffff ; color:dark  ;" >
                                            <tr>
                                            <th>
                                                #
                                            </th>
                                            <th>
                                                staut
                                            </th>
                                            
                                            <th>
                                                Commande
                                            </th>

                                            <th> Montant TTC</th>
                                             
                                            <th>
                                                Action
                                            </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($allFact as $fact) : ?>
                                            <tr >

                                                <td><b><?php echo $factCtr->generateFactCode($fact->created_at,$fact->fact_id); ?></b></td> 

                                                <td><?php echo  $fact->etat_Fact; ?></td> 

                                                <td><?php echo $comCtr->generateComCode($fact->created_at,$fact->commande_id); ?> </td> 

                                                <td>
                                                <?php $res = $factCtr->getDevidIdC($fact->commande_id);
                                                echo $comCtr->calculMontantTTC($res->devis_id,19); ?>DT
                                                </td>
                                                <td>
                                                <ul class="navbar-nav navbar-nav-right">
                                                <li class="nav-item nav-profile dropdown">
                                                    <a class="plusicon " href="#" data-toggle="dropdown" id="profileDropdown">
                                                        <i class="icon-ellipsis"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                                                    
                                                            <a class="dropdown-item edit-link" href="#" >
                                                                <i class="mdi mdi-pencil  icon-space" style ="color : #EC831B ;"></i>
                                                                <span class="text-space">Editer</span>
                                                            </a>
                                                    
                                                            <a class="dropdown-item" href="#">
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
                                    </form>
                                    </div>
                                </div>                             

                        </div>

                    </div>
                </section>
            </div>
        </div>
    


      <script>

    $(document).ready(function() {
        $('#myDataTable').DataTable({
        "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Tous"]]});
    
    });

    </script>
    


  <?php include "../../includes/_footer.php" ; ?>
