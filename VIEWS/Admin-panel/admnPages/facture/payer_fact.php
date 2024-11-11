<?php require "../../includes/header.php" ; 

require "../../../../CONTROLLERS/factureController.php";


if (isset($_GET['id']))
{

    $fact_id = $_GET['id'];

    $factCtr = new FactureController();
    $factCtr->updateEtat($fact_id,'Payée');

    header("Location: gestFact.php");
    exit();

}
