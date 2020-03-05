<?php 

require_once './frontend/layout.php';
require_once 'frontend/Mycourses.php';
require_once 'backend/auth.php';

session_verify();

head(); 

displayCourses();

foot();

?>
