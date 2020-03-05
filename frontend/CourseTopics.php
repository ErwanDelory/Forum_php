<?php
require_once 'backend/MysqlTopics.php';


function displayNav(){
    $nom = getCourseName();
    echo <<< EOD
    <div class="container">
    <br/>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Tous les cours</a></li>
            <li class="breadcrumb-item active" aria-current="page">$nom</li>
          </ol>
        </nav>
        <br/>
    </div>
    EOD;
}




function displayTopics(){
    $resultats = getTopics();
    
    echo <<< EOD
    <div class="container">
        <table id="tableTopics" class="table table-hover">
            <thead class="thead-light">
              <tr>
                <th scope="col">Nom</th>
                <th scope="col">#Posts</th>
                <th scope="col">Dernier Message</th>
              </tr>
            </thead>
            <tbody>
    EOD;
    
    $course_id = $_GET['course'];
    foreach($resultats as $un_resultat){
        $id = $un_resultat['sujetID'];
            
        echo <<< EOD
        <tr style="transform: rotate(0);">
        <td scope="row"><a href="topic.php?course=$course_id&topic=$id" class="stretched-link"></a>
        EOD;
        echo $un_resultat['nom'];
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
          $('#tableTopics').DataTable({
            "lengthMenu":[5,10,15,20,25],
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


function newTopicsButton(){
    echo <<< EOD
    <div class="container">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newTopic">
          Nouveau sujet
        </button>
        <!-- Modal -->
        <div class="modal fade" id="newTopic" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nouveau sujet</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body" id="modal_body">
                <h6>Saisissez un nouveau sujet :</h6>
                <input type="text" id="new_subject_name" class="form-control"/>
                <div id="alert_msg"></div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary" onclick="sendNewTopic();">Créer le sujet</button>
              </div>
            </div>
          </div>
        </div>
    </div>
    EOD;
}


function sendNewTopic(){
    $id = getCourseID();
    $user = $_SESSION['user_id'];
    echo <<< EOD
    <script>
        function sendNewTopic () {
            let course_id = $id;
            let user_id = $user;
            let topic = document.getElementById ("new_subject_name").value;
            $.ajax({
                url:'backend/saveNewTopic.php',
                type: "post",
                data: {
                    course_id : course_id,
                    new_topic : topic,
                    user_id : user_id
                },
                dataType:'json',
                success: function(reponse){ finalizeSendNewTopic(topic, reponse); }
            });
        }
        
        function finalizeSendNewTopic(topic, reponse) {
            if (reponse.statut === 'ok') {
                document.getElementById("alert_msg").setAttribute('class', 'alert alert-success');
                document.getElementById("alert_msg").setAttribute('role', 'alert');
                document.getElementById("alert_msg").innerHTML = "Le sujet a été correctement créé !";
                setTimeout(function(){
                    let newRow = "<tr style='transform: rotate(0);'><td scope='row'><a href='topic.php?course=$id&topic="+reponse.topic_id+"' class='stretched-link'></a>"+topic+"</td><td>0</td><td></td></tr>";
                    $('#tableTopics').DataTable().row.add($(newRow)).draw();
                    $('#newTopic').modal('hide');
                document.getElementById("alert_msg").removeAttribute('class');
                document.getElementById("alert_msg").removeAttribute('role');
                document.getElementById("alert_msg").innerHTML = "";
                ;}, 1000); 
                
            }
            else {
                document.getElementById("alert_msg").setAttribute('class', 'alert alert-danger');
                 document.getElementById("alert_msg").setAttribute('role', 'alert');
                document.getElementById("alert_msg").innerHTML = "Le sujet existe déjà !";
            }
        }
    </script>
    EOD;
}



?>