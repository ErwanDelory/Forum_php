<?php
require_once 'backend/MysqlPosts.php';
require_once 'backend/MysqlUsers.php';


function displayNav(){
    $topic = getTopicName();
    $course = getCourseName();
    $course_id = getCourseID();
    echo <<< EOD
    <div class="container">
    <br/>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Tous les cours</a></li>
            <li class="breadcrumb-item"><a href="course.php?course=$course_id">$course</a></li>
            <li class="breadcrumb-item active" aria-current="page">$topic</li>
          </ol>
        </nav>
        <br/>
    </div>
    EOD;
}




function displayPosts(){
    $resultats = getPosts();
    
    echo <<< EOD
    <div class="container">
        <table id="tablePosts" class="table table-hover tablePosts">
            <thead class="thead-light">
              <tr>
                <th scope="col">Posts</th>
              </tr>
            </thead>
            <tbody>
    EOD;

    foreach($resultats as $un_resultat){
        $id = $un_resultat['postID'];
        $user_id = $un_resultat['utilisateur'];
        $user = getUserName($user_id);
        $user_name = $user['nom'];
        $user_firstname = $user['prenom'];
        $date = $un_resultat['date'];
        $msg = $un_resultat['message'];
        echo <<< EOD
        <tr class="tablePosts"><td class="tablePosts">
        <div class="d-flex w-100 justify-content-between">
          <h6 class="mb-3">$user_name $user_firstname</h6>
          <small>le $date</small>
        </div>
        <div class="border-top border-secondary pt-2">$msg</div>
      </td></tr>
      EOD;
      
    }
    echo "</tbody></table></div>";
    
    echo <<< EOD
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="node_modules/datatables/media/js/jquery.dataTables.min.js"></script>   
    <script src="node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
      
    <script>
        $(document).ready(function () {
          $('#tablePosts').DataTable({
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

function newPostButton(){
    echo <<< EOD
    <div class="container">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newPostModal">nouveau post</button>
    <div id="newPostModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nouveau post</h5>
                    <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal_body">
                    <h6>Saisissez un nouveau post :</h6>
                    <textarea id="editor" placeholder="Blabla" autofocus></textarea>
                    <div id="alert_post"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="button" class="btn btn-primary" onclick="sendNewPost();">Sauvegarder le post</button>
                </div>
            </div>
        </div>
    </div>
    EOD;
}


function sendNewPost(){
    $id = getTopicID();
    $user = $_SESSION['user_id'];
    echo <<< EOD
    <script>
        function sendNewPost () {
            let sujet_id = $id;
            let user_id = $user;
            let post = document.getElementById ("editor").value;
            $.ajax({
                url:'backend/saveNewPost.php',
                type: "post",
                data: {
                    sujet_id : sujet_id,
                    new_post : post,
                    user_id : user_id
                },
                dataType:'json',
                success: function(reponse){ finalizeSendNewPost(post, reponse);}
            });
        }
        
        function finalizeSendNewPost(new_post, reponse) {
            if (reponse.statut === 'ok') {
                document.getElementById("alert_post").setAttribute('class', 'alert alert-success');
                document.getElementById("alert_post").setAttribute('role', 'alert');
                document.getElementById("alert_post").innerHTML = "Le post a été correctement créé !";
                setTimeout(function(){                
                    let newRow = "<tr class='tablePosts'><td class='tablePosts'><div class='d-flex w-100 justify-content-between'><h6 class='mb-3'>" + reponse.username +  " " + reponse.firstname + "</h6><small>le " + reponse.date + "</small></div><div class='border-top border-secondary pt-2'><p>" + new_post + "</p></div></td></tr>";
                    $('#tablePosts').DataTable().row.add($(newRow)).draw();
                    $('#newPostModal').modal('hide');
                    document.getElementById("alert_post").removeAttribute('class');
                    document.getElementById("alert_post").removeAttribute('role');
                    document.getElementById("alert_post").innerHTML = "";
                    editor.setValue("");
                ;}, 500); 
                
            }
        }
        
    </script>
    EOD;
}


?>