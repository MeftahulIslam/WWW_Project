<?php
    include_once "db/db_config.php";
    if(isset($_POST['id'])) {
        $userId = $_POST['id'];
        $incrementDownloads = $crud->incrementDownloadsCount($userId); 
    }
?>