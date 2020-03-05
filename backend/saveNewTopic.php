<?php

    require_once 'PDO.php';

    
    ini_set('display_errors', 'On');
    error_reporting(E_ALL);

    
    $user_id = $_POST['user_id'];
    $course_id = $_POST['course_id'];
    $topic = $_POST['new_topic'];

    
    $query = "SELECT * FROM sujet WHERE coursID=$course_id AND nom='$topic'"; 
    $statement = $PDO->prepare($query);
    $exec = $statement->execute();
    $res = $statement->fetch();

    if($res['nom'] == ''){
        $query = "INSERT INTO sujet (sujetID, nom, coursID, utilisateur, nbPosts, last) VALUES (NULL, '$topic', $course_id, $user_id, '', CURRENT_TIMESTAMP)";
    
        $statement = $PDO->prepare($query);
        $exec = $statement->execute();
        
        $query = "SELECT sujetID FROM sujet WHERE nom='$topic' AND coursID=$course_id";
    
        $statement = $PDO->prepare($query);
        $exec = $statement->execute();
        $res = $statement->fetch();

        $reponse = [
            'statut'=>'ok',
            'raison'=>'le sujet a été créé',
            'topic_id' => $res['sujetID']
        ];

    }
    else{
        $reponse = [
            'statut'=>'error',
            'raison'=>'le sujet existe déjà'
        ];
    }
    

    
    
    echo json_encode ($reponse);
    
?>