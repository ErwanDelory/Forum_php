<?php 

require_once 'frontend/layout.php';
require_once 'frontend/CourseTopics.php';
require_once 'backend/auth.php';

session_verify();

head();    

displayNav();

newTopicsButton();

displayTopics();

sendNewTopic();

foot();

?>
