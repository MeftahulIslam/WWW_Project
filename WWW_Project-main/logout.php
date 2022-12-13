<?php 
    require_once "includes/session.php";    //destroys the current session
    session_destroy();
    header("location: index.php");
?>