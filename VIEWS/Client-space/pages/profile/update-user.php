<?php require "../../partials/header.php" ; 
require "../../../../MODELS/article.php";
require "../../../../CONTROLLERS/articleController.php";




if(isset($_POST['submit']))
    { 
    if(empty($_POST['username']) || empty($_POST['postion']) || empty($_POST['entreprise']) || empty($_POST['siret'])
    || empty($_POST['email']) || empty($_POST['tel']) || empty($_POST['website']) || empty($_POST['country']) || empty($_POST['adresse']) || empty($_FILEST['profile']['name'])){
        echo "<script>alert('one or more inputs are empty')</script>";
    }
    else
    {
        $username=$_POST['username'];
        $position =$_POST['postion'];
        $entreprise= $_POST['entreprise'];
        $email=$_POST['email'];
        $image =$_FILES['profile']['name'];
        $country = $_POST['country'] ;
        $tel = $_POST['tel'];
        $website = $_POST['website'] ;
        $siret = $_POST['siret'];
        $adr = $_POST['adresse']; 

        $dir="profile/" . basename($image);

        $clientCtr = new ClientController();
       // $client ($username,$email,$,$image);
      
 


        if(move_uploaded_file($_FILES['profile']['tmp_name'], $dir) )
       {
                
        header("location: gestProd.php");
        exit();
       }

    }
    }


    ?>


