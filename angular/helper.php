<?php

if (isset ($_SERVER['HTTP_ORIGIN'])) {
  header("Access-Control-Allow-Origin: " . $_SERVER['HTTP_ORIGIN']);
}
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-type:application/json;charset=utf8');

ini_set ('include_path', ini_get('include_path') . ':..');


function sendMessage ($data) {
  echo json_encode ([ 'status' => 'ok',
                      'data'   => $data ]);
  die;
}

function sendError ($reason) {
  echo json_encode (['status' => 'error',
                     'data'   => ['reason' => $reason] ]);
  die;
}


// indiquer ici où se trouve le script du backend permettant de réalise
// l'authentification de l'utilisateur. Attention: ce script ne doit
// contenir qu'un session_start() suivi de déclarations de fonctions. Il ne
// doit pas exécuter d'autre code
require_once '../backend/auth.php';

// check qu'on est bien authentifié
if ( basename($_SERVER['SCRIPT_NAME']) != 'checkLogin.php' ) {
  // Modifiez la ligne ci-dessous de manière à ce qu'elle appelle votre
  // fonction qui vérifie l'existence du $_SESSION[...] qui indique que
  // l'utilisateur s'est déjà authentifié. 
  // Cette fonction doit renvoyer un booléen qui vaut true si l'utilisateur
  // a déjà été authentifié, et false sinon.
  if ( ! Auth::BackendAuthenticate () )
    sendError ('not authenticated');
}
  
?>