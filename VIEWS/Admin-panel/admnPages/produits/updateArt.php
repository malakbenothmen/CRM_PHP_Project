<?php require "../../includes/header.php" ; 
require "../../../../MODELS/article.php";
require "../../../../CONTROLLERS/articleController.php";




if(isset($_POST['submit']))
    { 
    if(empty($_POST['designation']) || empty($_POST['description']) 
    || empty($_POST['reference']) || empty($_FILEST['image']['name'])){
        echo "<script>alert('one or more inputs are empty')</script>";
    }
    else
    {
        $ref=$_POST['reference'];
        $description =$_POST['description'];
        $designation=$_POST['designation'];
        $image =$_FILES['image']['name'];

        $dir="img/" . basename($image);

        $artCtr = new ArticleController();
        $article = new Article($ref,$designation,$description,$image);
        $artCtr->editArticle($article);
 


        if(move_uploaded_file($_FILES['image']['tmp_name'], $dir) &&  $artCtr->editArticle($article) )
       {
                
        header("location: gestProd.php");
        exit();
       }

    }
    }


    ?>


