<style>
.mycss_2{
	color: green;
   
    padding: 10px;
    margin-top: 5%;
    text-align: center;
    font-size: 50px;
}
</style>

<?php 
    $title = "Password Updated";
    require_once "includes/header.php";
    require_once "db/db_config.php";

    if(isset($_SESSION['username'])){       //if the user is not coming from updatePassword.php, ridirect
        echo "<h2  class = 'mycss_2'>Your Password has been updated please try to login again. Thank you!</h2>";
    }
    else{
        header("location: index.php");
    }
?>

    <p></p>
    <p></p>
    <p></p>
    <p></p>
    <p></p>
    <p></p>
    <p></p>
    <p></p>
    <p></p>

<?php 
	 require_once "includes/footer.php";
?>