<?php
abstract class Connexion {
    protected $conn;
    function __construct()
    {
     try {
    $this->conn = new PDO('mysql:host=localhost;dbname=uniforme_db','root','');
    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         
        } 
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
     }
  
    function __destruct()
    {
    $this->conn=null;
    }
}
?>