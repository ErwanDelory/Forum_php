<?php

require_once 'backend/MysqlCourses.php';

function displayCourses(){
        
    $resultats = getCourses();
    
    echo <<< EOD
    <div class="container">
    <br/>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Liste des cours auxquels vous avez accès : </li>
          </ol>
        </nav>
        <br/>
        <table id="tableCourses" class="table table-hover">
            <thead class="thead-light">
              <tr>
                <th scope="col">Nom</th>
                <th scope="col">#Topics</th>
                <th scope="col">#Posts</th>
                <th scope="col">Dernier Message</th>
              </tr>
            </thead>
            <tbody>
    EOD;
    
    foreach($resultats as $un_resultat){
        $id = $un_resultat['coursID'];

        echo <<< EOD
        <tr style="transform: rotate(0);">
        <td><a href="course.php?course=$id" class="stretched-link"></a>
        EOD;

        echo $un_resultat['nom'];
        echo "</td>";

        echo "<td>";
        echo $un_resultat['nbSujets'];
        echo "</td>";

        echo "<td>";
        echo $un_resultat['nbPosts'];
        echo "</td>";

        echo "<td>";
        echo $un_resultat['last'];
        echo "</td></tr>";  
    }
    echo "</tbody></table></div>";
    
    echo <<< EOD
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="node_modules/datatables/media/js/jquery.dataTables.min.js"></script>   
    <script src="node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
      
    <script>
        $(document).ready(function () {
          $('#tableCourses').DataTable({
            lengthMenu:[5,10,15,20,25],
            "orderable": true,
            "searchable": true,
            "ordering": true,
            "visible": true,
            "order" : [[0, 'asc']],
            });
        });
    </script>
    EOD;
    
}


?>