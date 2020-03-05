<?php 

require_once 'frontend/layout.php';
require_once 'frontend/TopicPosts.php';
require_once 'backend/auth.php';

session_verify();

head();  

displayNav();

newPostButton();

displayPosts();
sendNewPost();

?>
<script type="text/javascript" src="js/module.js"></script>
<script type="text/javascript" src="js/hotkeys.js"></script>
<script type="text/javascript" src="js/uploader.js"></script>
<script type="text/javascript" src="js/simditor.js"></script>
<script>
    Simditor.locale ='fr-FR';
    var editor = new Simditor({
        textarea: $('#editor')
        //optional options
    });
</script>

<?php

foot();

?>
