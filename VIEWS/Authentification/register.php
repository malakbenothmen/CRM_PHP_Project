<?php
require "../../CONTROLLERS/clientController.php";



        /*if (isset($_SESSION['username']))
        {header("location: ". APPURL."");
            
        }*/

         if(isset($_POST['submit']))
          { 
          if(empty($_POST['email']) || empty($_POST['username']) || empty($_POST['password'])){
              echo "<script>alert('one or more inputs are empty')</script>";
          }
          else
          {
            $username =$_POST['username'];
              $email=$_POST['email'];
              $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
              $entreprise = $_POST['entreprise'];
              $telephone = $_POST['tel'];
              $matricule_fiscale = $_POST['siret'];
              $adresse = $_POST['adresse'];
              $pays = $_POST['country'];
              $role ='client';
      
              $client=new Client ($username,$email,$password,$role,$entreprise,$telephone,$matricule_fiscale,$adresse,$pays);
              $clientCtr=new ClientController();
      
              $insert=$clientCtr->insertClient($client);
              if  ($insert)
                  { echo "<script>alert('register with success')</script>";
                   header("location: login.php");}
              else 
                 { exit();}
                
          }
          }

      ?>

<?php require "../Client-space/partials/header.php" ; ?>

<body>
<div class="container-scroller">
  <div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="content-wrapper d-flex align-items-center auth px-0">
      <div class="row w-100 mx-0 justify-content-center">
        <div class="col-md-8 grid-margin">
          <div class="card  auth-card-small">
            <div class="card-body">
              <img src="../assets/images/Frame 1 (1).png" alt="logo" class="brand-logo mx-auto d-block" style="height: 60px ; width : 270px;">
              <h4 class="card-title mt-4 text-center">Bienvenue ! Nous sommes ravis que vous envisagiez de vous inscrire</h4>
              <p class="card-description text-center"> Voici les étapes simples à suivre pour créer un compte </p>

              <form class="form-sample"   action ="register.php" method="POST">
                <p class="card-description">Info de Compte</p>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Username</label>
                      <input type="text" class="form-control" name="username" placeholder="entrer le nom que vous vouiellez utilisé lors de l'utilisation de cette application "/>
                    </div>
                  </div>

                </div>
                <div class="row">

                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Email</label>
                      <input class="form-control" name="email" placeholder="Email" />
                    </div>
                  </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label>Password</label>
                      <input class="form-control" name="password" placeholder="Password" />
                    </div>
                  </div>
                </div>
                
                <p class="card-description">Info de l' Entreprise </p>
                <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                      <label>Entreprise</label>
                      <input class="form-control" name="entreprise" placeholder="Entreprise" />
                    </div>
                  </div>
                  
                <div class="col-md-6">
                    <div class="form-group">
                      <label>Numero de Telephone </label>
                      <input class="form-control" name="tel" placeholder="phone Number" />
                    </div>
                  </div>
                </div>


                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Pays</label>
                      <input type="text" name="country" class="form-control" />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Ville</label>
                      <input type="text" name="city" class="form-control" />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Adresse </label>
                      <input type="text" name ="adresse" class="form-control" />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Siret </label>
                      <input type="text" name="siret" class="form-control" />
                    </div>
                  </div>
                </div>

                <div class="mt-3">
                <button type="submit" name="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">s'inscrire</button>
                </div>
    
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="../assets/js/off-canvas.js"></script>
  <script src="../assets/js/hoverable-collapse.js"></script>
  <script src="../assets/js/template.js"></script>
  <script src="../assets/js/settings.js"></script>
  <script src="../assets/js/todolist.js"></script>
  <!-- endinject -->
</body>

</html>
