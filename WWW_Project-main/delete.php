<?php
    require_once "includes/header.php";
    require_once "db/db_config.php";

    if(!isset($_SESSION['id'])){    //if session is not set redirect. is safe from no ridirect session hijack attacks
        header('location: index.php');
    }
    else{
        if(!isset($_GET['id'])){
            echo "<h1 class=''>Error</h1>";
        }
          //call delete function
        else{
            $id = $_GET['id'];
            $isSuceess = $crud->deleteUserById($id);
    
            if($isSuceess){
                $isSuceess = $userNew->deleteByUserId($id);
                if(!$isSuceess){
                    echo "<h1 class=''>Error</h1>";
                }
                else{
                    session_destroy();
                    header("location: index.php");
                }

            }
            else{
                echo "<h1 class=''>Error</h1>";
            }
          }
    }



?>