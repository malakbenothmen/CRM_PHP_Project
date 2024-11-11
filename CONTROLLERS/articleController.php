<?php
require_once(__DIR__ . '/../MODELS/article.php');
require_once(__DIR__ . '/../DATABASE/config.php');

class ArticleController extends Connexion {
    function __construct() {
        parent::__construct();
    }

    

    function insertArticle(Article $article) {
        $query = "INSERT INTO article (reference, designation, description,image) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$article->getReference(), $article->getDesignation(), $article->getDescription(), $article->getImage()]);
        return $stmt->rowCount();
    }


    function getArticleById($id)
    {
        $query = "SELECT * FROM article where reference = ?"; 
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_OBJ); 
    }
    function getAllArticles()
    {
        $query = "SELECT * FROM article "; 
        $stmt = $this->conn->prepare($query);
        $stmt->execute([]);
        return $stmt->fetchAll(PDO::FETCH_OBJ); 
    }
    

    function deleteArticle($reference) {
        $query = "DELETE FROM article WHERE reference = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$reference]);
        return $stmt->rowCount();
    }

    function notfound($ref)
    {   $query = "select * FROM article WHERE reference = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$ref]);
        return $stmt->rowCount()==0;
    }

    function editArticle(Article $article) 
    {   
        if ($this->notfound($article->getReference())) {
            $query = "UPDATE article SET reference = ? , designation = ?, image = ?, description = ? WHERE reference = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$article->getReference(),$article->getDesignation(), $article->getImage(), $article->getDescription(), $article->getReference()]);
            return $stmt->rowCount() > 0;
        } else {
            // La référence de l'article existe déjà, vous pouvez choisir de gérer ce cas en conséquence
            //on peut renvoyer une erreur
            return false; 
        }
    }










       /* function getArticles()
    {
        $query = "SELECT designation FROM articles"; // Sélectionnez la colonne "designation" plutôt que "article_id"
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $designations = array();
        // Utilisez fetch() à la place de fetchAll() pour obtenir une seule ligne à la fois
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $designations[] = $row["designation"];
        }
    
        // Vérifiez le nombre de désignations récupérées plutôt que de tester s'il y a plus de 1 ligne
        if (!empty($designations)) {
            // En-tête JSON déplacé avant l'echo
            header('Content-Type: application/json');
            echo json_encode($designations);
        } else {
            // Gérer le cas où aucune désignation n'est trouvée
            echo json_encode(array('message' => 'Aucune désignation trouvée.'));
        }
    }*/
    




}
?>
