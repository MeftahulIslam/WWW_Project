<?php 
	    $title = "Forgot Password";
		require_once "includes/header.php";
		require_once "db/db_config.php";

        if(isset($_SESSION['id'])){
            header("location: index.php");
        }
        else{
            $flag = false;
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                //get the user name and password from the user
                $username = strip_tags($_POST['username']);
                $security1 = strip_tags($_POST['security1']);
                $security2 = strip_tags($_POST['security2']);
    
                $result = $userNew->validateUserSecurityQuestions($username,$security1,$security2);
                if(!$result){
                    $flag = true;
                }
                else{
                    $_SESSION['username'] = $username;
                    header("location: updatePassword.php");
                }
            }

?>	
 <div class="password_form">
    <form method="post" action= "<?php echo htmlentities($_SERVER['PHP_SELF'])?>" method="post">
        <p>Fill in your Username and Answer your Security Questions.</p>
        <input required type="text" class="input-box" placeholder="username" name="username" value="<?php if($_SERVER['REQUEST_METHOD']== 'POST') echo strip_tags($_POST['username']);?>">
        <input required type="text" class="input-box" placeholder="Security Question 1" name="security1"/>  
        <input required type="text" class="input-box" placeholder="Security Question 2" name = "security2"/>
        <?php if($flag) echo"<br/>Either the Username doesn't exist or the security questions don't match! Please try again!"?>
        <button type="submit"class="sign_btn" name="signup">Confirm</button>
    </form>
    </div>
    
    <p></p>
    <p></p>
    <p></p>
    <p></p>
    <p></p>
    <p></p>
    
    
<?php } include_once "includes/footer.php";?>