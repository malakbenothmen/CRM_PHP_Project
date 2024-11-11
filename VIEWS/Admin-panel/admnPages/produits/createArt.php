<?php 
require "../../includes/header.php";
require "../../../../MODELS/article.php";
require "../../../../CONTROLLERS/articleController.php";
var_dump($article);

if(isset($_POST['submit'])) { 
    if(empty($_POST['designation']) || empty($_POST['description']) || empty($_POST['reference']) || !isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        echo "<script>alert('one or more inputs are empty or file upload failed')</script>";
    } else {

        $ref = $_POST['reference'];
        $description = $_POST['description'];
        $designation = $_POST['designation'];
        $image = $_FILES['image']['name'];

        $dir = "imgArt/" . basename($image);

        $artCtr = new ArticleController();
        $article = new Article($ref,$designation,$description,$image);
        $artCtr->insertArticle($article);
        var_dump($article);

        if(move_uploaded_file($_FILES['image']['tmp_name'], $dir)) {
            echo "success"; 
        } else {
            echo "error"; 
        }
    }
}
?>


<body>
    <h2>Ajouter un Article</h2>
    <form action="createArt.php" method="POST" >
        <label for="reference">Référence :</label><br>
        <input type="text"  name="reference" required /><br><br>

        <label for="designation">Désignation :</label><br>
        <input type="text" name="designation" required /><br><br>

        <label for="description">Description :</label><br>
        <input type="text"  name="description" rows="4" required /><br><br>

        <label for="image">Image :</label><br>
        <input type="file"  name="image" accept="image/*" required><br><br>

        <input type="submit" name="submit" value="Ajouter">
    </form>
</body>
</html>