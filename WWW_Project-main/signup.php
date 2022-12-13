<?php 
	    $title = "Sign Up";
		require_once "includes/header.php";
		require_once "db/db_config.php";
        $flag=false;
        $weakPass = false;

        if($_SERVER['REQUEST_METHOD'] == "POST"){
                                                        //get the user name and password from the user
            $username = strip_tags($_POST['username']);
            $password = strip_tags($_POST['password']);
            $confirmPass = strip_tags($_POST['confirmPass']);

            // Validate password strength
            $uppercase = preg_match('@[A-Z]@', $password);
            $lowercase = preg_match('@[a-z]@', $password);
            $number    = preg_match('@[0-9]@', $password);
            $specialChars = preg_match('@[^\w]@', $password);
                                                        //check if the passwords match
            if(!($password == $confirmPass)){
                $flag = true;                           //if they don't, raise a flag
            }
            else if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8){
                $weakPass = true;
            }
            else{       
                              //if passwords match try to insert user in the user_login table
                $result = $userNew->insertUser($username,$password);
                if(!$result){                           //if the return is false, then there's already a user
                    echo "<p >User by this name already exists! Please try a different username</p>";
                }
                else{
                    $fullname = strip_tags($_POST['fullname']);
                    $email = strip_tags($_POST['email']);
                    $security1 = strip_tags($_POST['security1']);
                    $security2 = strip_tags($_POST['security2']);
                    $dob = $_POST['dob'];
                    $userId = $userNew->getUserId($username);

                    if(!is_uploaded_file($_FILES['avatar']['tmp_name'])){       //if avatar is not uploaded set a default one
                        $destination = "assets/img/2688063.png";           

                        $insertUserInfo = $crud->insertUserInfo($fullname,$email,$userId['user_id'],$dob,$security1,$security2,$destination); //insert user in user_info table
                        $_SESSION['fullname'] = $fullname;
                        header("Location: welcome.php");
                    }
                    else{
                        $imagefile = true;
                        $origFile = $_FILES["avatar"]["tmp_name"];
                        $targetDir = 'uploads/';
                        $ext = strtolower(pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION));
       
                        if(@getimagesize($_FILES["avatar"]["tmp_name"]) === true){      //check if the file has malicious codes and other regular stuff like
                            $input = file_get_contents($origFile);                      // //size and extension

                            if(preg_match('/(<\?php\s)/',$input)){                      //is safe from file upload vulnerability
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
                            echo "<p> Problem uploading avatar! </p>";
                            $delete = $userNew->deleteByUserId($userId['user_id']);
                        }
                        else{
                            $destination = $targetDir.$userId['user_id'].".$ext";   //save only in permitted formats
                            move_uploaded_file($origFile,$destination);

                            $insertUserInfo = $crud->insertUserInfo($fullname,$email,$userId['user_id'],$dob,$security1,$security2,$destination); //insert user in user_info table
                            $_SESSION['fullname'] = $fullname;
                            header("Location: welcome.php");

                        }
                    }
                }
            }
        }
?>	

			
		<div class="site_content">
			
			<div class="sidebar_container">


            <div class="sidebar">
					<h2>Search</h2>
					<form method="post" action="#" id="search_form" >
						<input type="search" name="search_field" placeholder="your request" />
						<input type="submit" class="btn" value="find" />
					</form>
				</div>

				<div class="sidebar">
					<h2>Updates</h2>
					<span>16.10.2021</span>
					<p>We lauched a new course for Spanish </p>
					<a href="information.php">read more</a>
				</div>

				<div class="sidebar">
					<h2>Future courses</h2>
					<ul>
						<li>Spanish course A1-B1</li>
						<li>Spanish course B1-C1</li>
					</ul>
				</div>

               

                <div class="sidebar">
					<h2>Updates</h2>
					<span>16.10.2021</span>
					<p>We are working on other Languages!! </p>
					<a href="information.php">read more</a>
				</div>

			</div>
            
            
            <div class="sign_up_form">
                <h1> Sign up now </h1>
                <form method="post" action= "<?php echo htmlentities($_SERVER['PHP_SELF'])?>" method="post" enctype="multipart/form-data">
                    <input required type="text" class="input-box" placeholder="Full Name" name="fullname" value="<?php if($_SERVER['REQUEST_METHOD']== 'POST') echo strip_tags($_POST['fullname']);?>">
                    <input required type="email" class="input-box" placeholder="Email" name="email" value="<?php if($_SERVER['REQUEST_METHOD']== 'POST') echo strip_tags($_POST['email']);?>">  
                    <input required type="date" class="input-box" placeholder="Date of birth" name = "dob" value="<?php if($_SERVER['REQUEST_METHOD']== 'POST') echo $_POST['dob'];?>">
                    <br>
                    <br>
                    <p>Security Questions
                        <input required type="question" class="input-box" placeholder="What's your favourite hobby?" name="security1" value="<?php if($_SERVER['REQUEST_METHOD']== 'POST') echo strip_tags($_POST['security1']);?>">
                        <input required type="question" class="input-box" placeholder="What's the name of your favourite professor?" name="security2" value="<?php if($_SERVER['REQUEST_METHOD']== 'POST') echo strip_tags($_POST['security2']);?>">
                    </p>
                    <p>
                        <input required type="username" class="input-box" placeholder="Create Username" name="username" value = "<?php if($_SERVER['REQUEST_METHOD']== 'POST') echo strip_tags($_POST['username']);?>"> 
                        <input required type="password" class="input-box" placeholder="Create Password" name="password">
                        <input required type="password" class="input-box" placeholder="Confirm Password" name="confirmPass">
                        <?php if($flag) echo "<br/>Please type in the same password";    if($weakPass) echo '<br/>Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';                     //if flag is raised prompt the user that passwords didn't match?> 
                    </p>
                    <p>Add a profile picture below: <input type="file" accept="Image/*" class="file-upload-input"  name="avatar" id="avatar"></p>
                    <p><span><input required type="checkbox"></span> I agree to the terms and conditions</p>
                    <button type="submit"class="sign_btn" name="signup">Sign up</button>
                </form>
            </div>
            </div>
<?php include_once "includes/footer.php"?>