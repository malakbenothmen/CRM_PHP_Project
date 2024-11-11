<?php require "../../includes/header.php" ; 
require "../../../../CONTROLLERS/clientController.php";
require "../../../../CONTROLLERS/commandeController.php";
require "../../../../CONTROLLERS/factureController.php";


if (isset($_GET['id']))
{

    $com_id = $_GET['id'];
    $comCtr = new CommandeController();
    $comCtr->updateEtat($com_id,'Annulée');
    $factCtr = new FactureController();
    $factCtr->deletefact($com_id);


     header("Location: gestCom.php");
     exit();

}
