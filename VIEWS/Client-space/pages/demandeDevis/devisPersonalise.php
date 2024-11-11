<?php require "../../partials/header.php" ; 
require "../../../../CONTROLLERS/clientController.php";
require "../../../../CONTROLLERS/devisController.php";
require "../../../../CONTROLLERS/devisdetailsController.php" ;

$client_id=$_SESSION['user_id'];

// Vérifiez si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Inclure le contrôleur et le modèle requis


    $etat="en attente";
    $info_supp = $_POST['infoSupp'];
   

    // Créez une nouvelle demande de devis
    $demandeDevis = new DemandeDevis($client_id,$etat,$info_supp, "Personalise");
    $demandeDevisController = new DemandeDevisController();
    $demandeDevisController->insertDemandeDevis($demandeDevis);

    // Récupérez l'ID du devis nouvellement créé
    $devis_id = $demandeDevisController->getLastInsertedId();

    // Insérez les détails de l'article du devis 
    $devisDetailsController = new DevisDetailsController();
        $title = $_POST['title'];
        $qte_total = $_POST['qte'];
        $logo = $_POST['image'];
        

        // Créez un nouveau détail de devis
        $devisDetails = new DevisDetails($devis_id, null, $qte_total, $logo, $title, null , null );
        $devisDetailsController->insertDevisDetails($devisDetails);
    
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
            <form method="POST" action = "devisPersonalise.php">
 
            <div class="col-12">
                <div class="card">
         
                  <div class="card-body">
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>
                      <div class="col-sm-12 col-md-7">
                        <input type="text" class="form-control" name= "title" placeholder="donner une libelle pour votre modele">
                      </div>
                    </div>
             
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Caracteristique</label>
                      <div class="col-sm-12 col-md-7">
                        <textarea class="summernote-simple" name="infoSupp"></textarea>
                      </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Image</label>
                      <div class="col-sm-12 col-md-7">
              
                        <div class="form-group">
                          <input type="file" name="image"  class="file-upload-default">
                          <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image clairifier votre modele">
                            <span class="input-group-append">
                              <button class="file-upload-browse btn btn-primary" type="button" >Upload</button>
                            </span>
                          </div>
                        </div>
                

                      </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Quantité</label>
                      <div class="col-sm-12 col-md-7">
                        <input type="number" class="form-control inputtags" name="qte" >
                      </div>
                    </div>

                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                      <div class="col-sm-12 col-md-7">
                        <button class="btn btn-primary" type="submit" >Submit</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </form>
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
            <form method="POST" action = "devisPersonalise.php">
 
            <div class="col-12">
                <div class="card">
         
                  <div class="card-body">
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>
                      <div class="col-sm-12 col-md-7">
                        <input type="text" class="form-control" name= "title" placeholder="donner une libelle pour votre modele">
                      </div>
                    </div>
             
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Caracteristique</label>
                      <div class="col-sm-12 col-md-7">
                        <textarea class="summernote-simple" name="infoSupp"></textarea>
                      </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Image</label>
                      <div class="col-sm-12 col-md-7">
              
                        <div class="form-group">
                          <input type="file" name="image"  class="file-upload-default">
                          <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image clairifier votre modele">
                            <span class="input-group-append">
                              <button class="file-upload-browse btn btn-primary" type="button" >Upload</button>
                            </span>
                          </div>
                        </div>
                

                      </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Quantité</label>
                      <div class="col-sm-12 col-md-7">
                        <input type="number" class="form-control inputtags" name="qte" >
                      </div>
                    </div>

                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                      <div class="col-sm-12 col-md-7">
                        <button class="btn btn-primary" type="submit" >Submit</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </form>
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