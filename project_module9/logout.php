<?php include('modules/config.php') ?>

<?php 
    // 1. Distroy the session
    session_destroy(); //Unset $_SESSION and 'user'.

    // 2. Redirect to ligin page
    header("location: login.php");
