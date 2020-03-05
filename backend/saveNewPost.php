<?php

    require_once 'PDO.php';

    
    ini_set('display_errors', 'On');
    error_reporting(E_ALL);

    
    $user_id = $_POST['user_id'];
    $sujet_id = $_POST['sujet_id'];
    $post = $_POST['new_post'];


    $query = "INSERT INTO post (postID, date, message, sujetID, utilisateur) VALUES (NULL, CURRENT_TIMESTAMP, '$post', $sujet_id, $user_id) ";

    $statement = $PDO->prepare($query);
    $exec = $statement->execute();


    $query = "SELECT nom, prenom FROM utilisateur WHERE userID = $user_id";

    $statement = $PDO->prepare($query);
    $exec = $statement->execute();
    $user = $statement->fetch();

    $query = "SELECT date FROM post ORDER BY date DESC";

    $statement = $PDO->prepare($query);
    $exec = $statement->execute();
    $date = $statement->fetch();

    $reponse = [
        'statut'=>'ok',
        'raison'=>'le post a été créé',
        'username' => $user['nom'],
        'userfirstname' => $user['prenom'],
        'date' => $date['date']
    ];

    

    
    
    echo json_encode ($reponse);
    
?>