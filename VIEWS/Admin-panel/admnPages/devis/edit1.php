<?php require "../../includes/header.php" ;
require "../../../../CONTROLLERS/clientController.php";
require "../../../../CONTROLLERS/devisController.php";
require "../../../../CONTROLLERS/devisdetailsController.php" ;


        if (isset($_POST['valider'])) {
            
            $articles = $_POST['articles'];
            $id = $_POST['devis_id'];

            $itemCtr = new DevisDetailsController();
            $items = $itemCtr->getDevisDetailsById($id);

            foreach($articles as $art)
            {
                $prix = $art['prix_HT'];
                $tva = $art['TVA'];
                $articleId = $art['article_id'];
                $itemCtr->updatePricing($id, $articleId, $prix, $tva);
                $itemCtr->updateEtat('valable',$id);
            }

            echo '<script>';
            echo 'console.log("$_POST : ", ' . json_encode($_POST) . ');';
            echo '</script>';

            header("location: demande.php");
            exit();
        }

    ?>