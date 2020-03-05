<?php


require_once 'PDO.php';


ini_set('display_errors', 'On');
error_reporting(E_ALL);

function getCourseName(){
    global $PDO;
    
    $id = $_GET['course'];
    $statement = $PDO->prepare("SELECT nom FROM cours WHERE coursID = $id");
    $exec = $statement->execute();// ex ́ecution
    $res = $statement->fetch();
    $nom = $res['nom'];
    
    return $nom;
}

function getCourseID(){
    global $PDO;
    
    $id = $_GET['course'];
    
    return $id;
}



function getTopics(){
    
    global $PDO;
    
    $id = $_GET['course'];
    
    // definition de la requête
    $query = "SELECT * FROM sujet WHERE coursID = ?";

    // envoi et execution de la requête à la base
    $statement = $PDO->prepare( $query );// pr ́eparation
    $exec = $statement->execute([$id]);// ex ́ecution

    // recuperation du resultat
    $resultats = $statement->fetchAll ( PDO::FETCH_ASSOC );
    
    return $resultats;
  
}


?>