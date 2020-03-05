<?php

require_once 'PDO.php';


ini_set('display_errors', 'On');
error_reporting(E_ALL);

function getUserName($id){
    global $PDO;
    $statement = $PDO->prepare("SELECT nom, prenom FROM utilisateur WHERE userID=$id");
    $exec = $statement->execute();// ex ́ecution
    $res = $statement->fetch();
    
    return $res;
}


?>