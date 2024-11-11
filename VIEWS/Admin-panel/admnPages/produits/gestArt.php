<?php require "../../includes/header.php" ; 
require "../../../../MODELS/article.php";
require "../../../../CONTROLLERS/articleController.php";

    $artCtr = new ArticleController();
    $Allarticles = $artCtr->getAllArticles(); 
    function getBadgeClass($etat) {
        switch ($etat) {
            case 'en evaluation':
                return 'badge badge-warning';
            case 'Terminé':
                return 'badge badge-success';
            case 'Annuler':
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
        border: 2px solid #EC831B; /* Contour violet */
        color: #EC831B; /* Couleur de l'icône */
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
                      <p class="card-title">Créer un nouvel article</p>
                      <div class="row">
                          <div class="col-6">
                              Ici, vous pouvez trouver les articles que vous pouvez gérer.
                          </div>
                          <div class="col-6 text-right">
                          <a href="<?php echo APPURL ;?>/Admin-panel/admnPages/produits/createArt.php"  class="btn btn-warning btn-lg" style="font-size : 18px;"> <i class="fas fa-plus mr-2"></i><b>Créer Article</b></a>
                                </div>
         
                      </div>
                  </div>

                    </div>
                </div>
            </div>
    
    
            <div class="col-lg-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Mes Articles</h4>
                      <p class="card-description">
                        vous pouvez trouver tous vos article
                      </p>
                      <div class="table-responsive">
                        <table id="myDataTable"  class="table custom-table">
                          <thead style="background: #EC831B ; color:white ; height : 60px ;" >
                            <tr>
    
                              <th>
                                #
                              </th>
                              <th>
                                reference
                              </th>
                              <th>
                                designation
                              </th>
                              <th>
                                description
                              </th>          
                              <th>
                                Action
                              </th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach($Allarticles as $article) : ?>
                            <tr style ="height : 150px;">
                              <td class="py-1">
                                <img src="<?php echo APPURL ; ?>/assets/images/articles/<?php echo $article->image ; ?>"  width="400" height="200"/>
                              </td>
    
                              <td><b><?php echo $article->reference; ?></b></td>

                              <td><?php echo $article->designation ; ?></td>

                              <td><?php echo substr($article->description, 0, 25); ?>... </td>

    
              
    
    
                              <td>
                             <ul class="navbar-nav navbar-nav-right">
                              <li class="nav-item nav-profile dropdown">
                                  <a class="plusicon " href="#" data-toggle="dropdown" id="profileDropdown">
                                      <i class="icon-ellipsis"></i>
                                  </a>
                                  <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                                 
                                        <a class="dropdown-item edit-link" href="#" >
                                            <i class="mdi mdi-pencil  icon-space" style="color :  #EC831B ;"></i>
                                            <span class="text-space">Editer</span>
                                        </a>
                          
                                 
                                          <a class="dropdown-item" href="<?php echo APPURL ;?>/Admin-panel/admnPages/produits/showArt.php?id=<?php echo $article->article_id ; ?>">
                                              <i class="fas fa-eye icon-space" style="color :  #EC831B ;"></i>

                                              <span class="text-space">Consulter</span>
                                          </a>

                                       
                                     
                                   
                                  </div>
                              </li>
                             </ul>
                            </td>
                        </tr>
    
                              
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
    
    
    