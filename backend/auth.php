<?php

include 'PDO.php';


function login(){
    global $PDO;
    
    // Always start this first
    session_start();

    if ( ! empty( $_POST ) ) {
        if ( isset( $_POST['username'] ) && isset( $_POST['password'] ) ) {
            // Getting submitted user data from database
            $stmt = $PDO->prepare("SELECT * FROM utilisateur WHERE login = ?");
            $stmt->execute([$_POST['username']]);
            $user = $stmt->fetch();        

            // Verify user password and set $_SESSION
            if ( $_POST['password'] == $user['password'] ) {
                $_SESSION['user_id'] = $user['userID'];
                header("Location: ../index.php");
            }
        }
    }
}


function session_verify(){
    // You'd put this code at the top of any "protected" page you create

    // Always start this first
    session_start();

    if ( isset( $_SESSION['user_id'] ) ) {
        // Grab user data from the database using the user_id
        // Let them access the "logged in only" pages
    } else {
        // Redirect them to the login page
        header("Location: login.php");
    }
}



?>

