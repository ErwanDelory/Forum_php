<?php


require_once 'PDO.php';


ini_set('display_errors', 'On');
error_reporting(E_ALL);



function getCourses(){
    
    global $PDO;
    // definition de la requête
    $query = "SELECT * FROM cours WHERE coursID IN (SELECT coursID FROM inscription WHERE userID = ?)";

    // envoi et execution de la requête à la base
    $statement = $PDO->prepare( $query );// pr ́eparation
    $exec = $statement->execute([$_SESSION['user_id']]);// ex ́ecution

    // recuperation du resultat
    $resultats = $statement->fetchAll ( PDO::FETCH_ASSOC );
    
    return $resultats;
    
}


?>