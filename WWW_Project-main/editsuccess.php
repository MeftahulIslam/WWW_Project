<?php
    require_once "includes/header.php";
    require_once "db/db_config.php";
    if(!isset($_SESSION['id'])){
        header('location: index.php');
    }
    else{
        if(isset($_POST['submit'])){
            $fullname = strip_tags($_POST['fullname']);
            $email= strip_tags($_POST['email']);
            $dob = $_POST['dob'];
            $security1 = strip_tags($_POST['security1']);
            $security2 = strip_tags($_POST['security2']);
            $userId = $_SESSION['id'];
            if(!is_uploaded_file($_FILES['avatar']['tmp_name'])){
                $isSuccess = $crud->editUserInfo($fullname, $email, $dob, $security1, $security2, $userId);
            }
            else{
                $imagefile = true;
                        $origFile = $_FILES["avatar"]["tmp_name"];
                        $targetDir = 'uploads/';
                        $ext = strtolower(pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION));
       
                        if(@getimagesize($_FILES["avatar"]["tmp_name"]) === true){
                            $input = file_get_contents($origFile);

                            if(preg_match('/(<\?php\s)/',$input)){
                                echo "<p >The file is not an image!</p>";
                                $imagefile = false;
                            }
                            else{
                                $input = str_replace(chr(0),'',$input); //null byte insertion protection
                            }
                        }
                       if($_FILES["avatar"]["size"] > 500000){
                            echo "<p >File is too large!</p>";
                            $imagefile = false;
                        }
                        if($ext != "jpg" && $ext != "jpeg" && $ext != "png"){
                            echo "<p >Only jpg,jpeg and png files are accepted!</p>";
                            $imagefile = false;
                        }
    
                        if(!$imagefile){
                            $isSuccess = $crud->editUserInfo($fullname, $email, $dob, $security1, $security2, $userId);
                        }
                        else{
                            $destination = $targetDir.$userId.".$ext";
                            move_uploaded_file($origFile,$destination);

                            $isSuccess = $crud->editUserInfoAvatar($fullname, $email, $dob, $security1, $security2, $userId,$destination);
                        }
            }
            
        }
        if($isSuccess){
            header("Location: profile.php?id=$userId");
        }
        else{
            echo "<h1 class=''> Process was not complete! </h1>";
        }
    }
?>