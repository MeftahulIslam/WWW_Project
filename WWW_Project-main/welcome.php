<style>
.mycss_2{
	color: green;  
    padding: 10px;
    margin-top: 5%;
    text-align: center;
    font-size: 20px;
}
</style>

<style>
.mycss_3{
	color: red;  
    padding: 10px;
    margin-top: 5%;
    text-align: center;
    font-size: 20px;
}
</style>

<?php
        $flag = false;
        $title = "Welcome!";

        require_once "includes/header.php";
        require_once "db/db_config.php";

        if(isset($_SESSION['fullname'])){

            echo "<h1 class = 'mycss_2'> You have been successfully registered as ".$_SESSION['fullname'].", Please login using your credentials. Thank you for registering!";
            session_destroy();?>
            
            <div class="site_content">
                <div class="sidebar_container">
                    <div class="sidebar">
                        <h2>Login</h2>
                        <form action="<?php echo htmlentities($_SERVER['PHP_SELF'])?>" method="POST"> 
                        
                        <input style="margin-right: 60px;" type="text"  placeholder="username" name="username" value="<?php if($_SERVER['REQUEST_METHOD']== 'POST') echo strip_tags($_POST['username']);?>"/>
                        <input type="password" name="password" placeholder="password" />
                        <input type="submit" class="btn" value="sign in" name="login"/>
                        <p><?php if($flag) echo "<h1 class = 'mycss_3'> Username or password incorrect! Please click Forgot Password"?></p>
                        <div class="lables_passreg_text">
                            <span><a href="#">Forgot your password?</a></span> | <span><a href="signup.php">Sign up</a></span>
                    </div>   
                </div>

                <div class="sidebar">
					<h2>Search</h2>
					<form method="post" action="#" id="search_form" >
						<input type="search" name="search_field" placeholder="your request" />
						<input type="submit" class="btn" value="find" />
					</form>
				</div>




             </div>

           

             


                

             

        <?php }
        else if(isset($_POST['login'])){  
            $username = strip_tags($_POST['username']);
            $password = strip_tags($_POST['password']);
            $salt = $userNew->getSalt();
            $encryptedPass = md5($password.$username.$salt);
            $result = $userNew->getUser($username,$encryptedPass);
            if(!$result){
                $flag = true;
            }
            else{
                $id = $result['user_id'];
                $_SESSION['id'] = $id;
                header("location: index.php");
            }  
        ?>
        
        <?php }
            else{
                header("location: signup.php");
            }
        ?>

                

        </div>

        <?php 
		    require_once "includes/footer.php";
        ?>
