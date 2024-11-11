<?php require "../../partials/header.php" ; 
require "../../../../CONTROLLERS/clientController.php";


$client_id=$_SESSION['user_id'];

// Vérifiez si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Inclure le contrôleur et le modèle requis
    require "../../../../CONTROLLERS/devisController.php";
    require "../../../../CONTROLLERS/devisdetailsController.php" ;
    

    // Récupérez les données du formulaire
    $articles = $_POST['articles'];
    $info_supp = $_POST['info_supp'];
    $etat="en attente";


    // Créez une nouvelle demande de devis
    $demandeDevis = new DemandeDevis($client_id,$etat,$info_supp, "Normal");
    $demandeDevisController = new DemandeDevisController();
    $demandeDevisController->insertDemandeDevis($demandeDevis);

    // Récupérez l'ID du devis nouvellement créé
    $devis_id = $demandeDevisController->getLastInsertedId();

    // Insérez les détails du devis pour chaque article
    $devisDetailsController = new DevisDetailsController();
    foreach ($articles as $article) {
        $article_id = $article['article_id'];
        $qte_total = $article['qte'];
        $logo = $article['logo'];
        

        // Créez un nouveau détail de devis
        $devisDetails = new DevisDetails($devis_id, $article_id, $qte_total, $logo , null , null);
        $devisDetailsController->insertDevisDetails($devisDetails);
    }
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    echo '<script type="text/javascript">';
    echo 'document.addEventListener("DOMContentLoaded", function() {';
    echo '  Swal.fire({';
    echo '    icon: "success",';
    echo '    title: "Demande de devis soumise avec succès !",';
    echo '    showConfirmButton: false,';
    echo '    timer: 2000'; // Durée de l'alerte en millisecondes
    echo '  });';
    echo '});';
    echo '</script>';
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
          
            <div clas="row" >
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
              <div class="card-header" style="border-radius: 10px; font-weight: bold; text-align: center; background-color: #4B49AC; color: white ;">
                  Entrer les Détails de votre Devis
              </div>
 
                  <div class="card-body">
        
                  <h4>Nos Articles </h4>
                  <p class="card-description">
                    veuillez entrer les article que vous souhaitées 
                  </p>
                  <form method="POST" action = "devisNormal.php">

                  <div id="articles_container">
                   <div class="article">
                  <div class="form-group row">
                    <div class="col">
                      <label>Reference Article</label>
                      <div id="inputrech">
                        <input class="typeahead" type="text" name="articles[0][article_id]" placeholder="reference" required >
                      </div>
                    </div>
       
                    <div class="col">
                      <label>Quantité</label>
                      <div id="the-basics">
                        <input class="typeahead" type="number" name="articles[0][qte]" placeholder="Quantité total" required >
                      </div>
                    </div>
                    <div class="col">
                    <label>empreinté un logo ?</label>
                    <label>Emprunter un logo ?</label>
                      <div class="form-check">
                          <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="articles[0][logo]" id="optionsRadios1" value="oui" required>
                              Oui
                          </label>
                      </div>
                      <div class="form-check">
                          <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="articles[0][logo]" id="optionsRadios2" value="non" required>
                              Non
                          </label>
                      </div>


                        
                    </div>

                    <div class="col">
                    <label><br> </label>
                    <div id="#">
                    <span class="input-group-append">
                      
                          <button type="button" onclick="supprimerArticle(this)" class="btn btn-danger btn-fw">supprimer</button>
                    </span>
                    </div>
                    </div>
                    
    

                  </div>
                  </div>
                  </div>

                    <div class="col">
                    <label>Action </label>
                    <div>
                        <button type="button" onclick="ajouterArticle()" class="btn btn-outline-success btn-fw">Ajouter autre Article </button>
                    </div>
                    </div>
                    <br>

                    <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header"  style=" font-weight: bold;  background-color: #FF9933; color: white ;">
                    <h4>Info Supplimentaire</h4>
                  </div>
                  <div class="card-body">
           
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Caracteristique</label>
                      <div class="col-sm-12 col-md-7">
                        <textarea class="summernote-simple" name="info_supp" ></textarea>
                      </div>
                    </div>

                    <!--<div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Image</label>
                      <div class="col-sm-12 col-md-7">
              
                        <div class="form-group">
                          <input type="file" name="img[]" class="file-upload-default">
                          <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image clairifier votre modele">
                            <span class="input-group-append">
                              <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                            </span>
                          </div>
                        </div>
                

                      </div>
                    </div>-->


                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                      <div class="col-sm-12 col-md-7">
                        <button type ="submit" class="btn btn-primary">Envoyer </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>


                    


                  </form>
                </div>
              </div>
            </div>




    <script>
    



        let articleCount = 1;

        function ajouterArticle() {
            let articleHtml = `
            <div class="article">
                  <div class="form-group row">
                    <div class="col">
                      <label>Reference Article</label>
                      <div id="the-basics">
                        <input class="typeahead" type="text" name="articles[${articleCount}][article_id]" placeholder="reference" required >
                      </div>
                    </div>
       
                    <div class="col">
                      <label>Quantité</label>
                      <div id="the-basics">
                        <input class="typeahead" type="text" name="articles[${articleCount}][qte]" placeholder="Quantité total" required >
                      </div>
                    </div>
                    <div class="col">
                    <div class="col">
    <label>Emprunter un logo ?</label>
    <div class="form-check">
        <input type="radio" class="form-check-input" name="articles[${articleCount}][logo]" id="optionsRadios1" value="oui" required>
        <label class="form-check-label" for="optionsRadios1">Oui</label>
    </div>
    <div class="form-check">
        <input type="radio" class="form-check-input" name="articles[${articleCount}][logo]" id="optionsRadios2" value="non" required>
        <label class="form-check-label" for="optionsRadios2">Non</label>
    </div>
</div>


                    </div>

                    <div class="col">
                    <label><br> </label>
                    <div id="#">
                    <span class="input-group-append">
                      
                          <button type="button" onclick="supprimerArticle(this)" class="btn btn-danger btn-fw">supprimer</button>
                    </span>
                    </div>
                    </div>
                    

                  </div>
                  </div>


                </div>
            `;
            document.getElementById('articles_container').insertAdjacentHTML('beforeend', articleHtml);
            articleCount++;
        }

        function supprimerArticle(button) {
          let articleDiv = button.closest('.article');
          articleDiv.remove();
        }
    </script>
        </div>
        </div>
    </div>
</div>
</div>

</body>


  <!-- plugins:js -->
  <script src="../../../assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="../../../assets/vendors/typeahead.js/typeahead.bundle.min.js"></script>
  <script src="../../../assets/vendors/select2/select2.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="../../../assets/js/off-canvas.js"></script>
  <script src="../../../assets/js/hoverable-collapse.js"></script>
  <script src="../../../assets/js/template.js"></script>
  <script src="../../../assets/js/settings.js"></script>
  <script src="../../../assets/js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="../../../assets/js/file-upload.js"></script>
  <script src="../../../assets/js/typeahead.js"></script>
  <script src="../../../assets/js/select2.js"></script>
  <script src="../../js/scripts.js"></script>
  <!-- CSS de Summernote -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">
<!-- JS de Summernote -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>

  
</html>
