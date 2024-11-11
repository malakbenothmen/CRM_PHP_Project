<?php 
require "../Client-space/partials/header.php" ; 
require "../../CONTROLLERS/userController.php";


    if (isset($_SESSION['username']))
    {header("location: ". APPURL."/Client-space");
        
    }

if (isset($_POST['submit']))
        {
          if (empty($_POST['email']) || empty($_POST['password'])) {
            echo "<script>alert('one or more inputs are empty')</script>";
        }
        
        else
        {  
        $email=$_POST['email'];
        $password = $_POST['password'];

        $uctr=new UserController();

        $fetch=$uctr->getUserByEmail($email);

        if($fetch)
        {
            if (password_verify($password,$fetch['password']))
            {   
                $_SESSION['username']= $fetch['username'];
                $_SESSION['email']= $fetch['email'];
                $_SESSION['user_id']= $fetch['user_id'];
                echo "<script>alert('login with success')</script>";
                header("location: ".APPURL."/Client-space");
            }else{
                echo "<script>alert('password is wrong')</script>";
                
            }
        } else {
            echo "<script> alert('email is wrong')</script>";
        }
        }
        }

?>


<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo" style="text-align: center;">
                <img src="../assets/images/Frame 1 (1).png" alt="logo" style="width: 180px; height: 40px;">
              </div>
              <h4>Hello! let's get started</h4>
              <h6 class="font-weight-light">Sign in to continue.</h6>
              <form class="pt-3" method="POST" action="login.php">
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" id="exampleInputEmail1" name="email" placeholder="Email">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" name="password" placeholder="Password">
                </div>
                <div class="mt-3">
                <button type="submit" name="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
                </div>

                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Keep me signed in
                    </label>
                  </div>
                  <a href="#" class="auth-link text-black">Forgot password?</a>
                </div>


                <div class="text-center mt-4 font-weight-light">
                  Don't have an account? <a href="register.php" class="text-primary">Create</a>
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
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
