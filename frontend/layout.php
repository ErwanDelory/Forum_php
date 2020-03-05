<?php

function head(){
    echo <<< EOD
    <!DOCTYPE html>
    <html lang="fr">
    <head>
      <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/forum.css" />
        <link rel="stylesheet" type="text/css" href="css/simditor.css" />
        <link rel="stylesheet" type="text/css" href="node_modules/bootstrap/dist/css/bootstrap.css" />
        <link rel="stylesheet" type="txt/css" href="node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css" />
        <link href="node_modules\datatables.net-bs4\css\dataTables.bootstrap4.min.css" rel="stylesheet">
        
      <title>Forum Polytech</title>
    </head>
    <body>
    <nav class="navbar navbar-expand-xl navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">Forum Polytech</a>
    EOD;
        if ( isset( $_SESSION['user_id'] ) ) {
            // Grab user data from the database using the user_id
            // Let them access the "logged in only" pages
            echo <<< EOD
            <a href="logout.php">Logout</a>
            EOD;
        } else {
            // Redirect them to the login page
            
        }
        
    echo"</nav>";
}


function foot(){
    echo <<< EOD
    
    </body>
    </html>
    EOD;
}

?>