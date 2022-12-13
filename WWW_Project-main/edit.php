<?php 
	    $title = "Edit Profile";
		require_once "includes/header.php";
		require_once "db/db_config.php";
		if(!isset($_SESSION['id'])){		//is safe from no ridirect session hijack attacks, no information will be showed upon no ridirect
			header('location: index.php');
		}
		else{
			if(!isset($_GET['id'])){		//is safe from sql injection because of bind param with PDO
				echo "<h1 class=''>Error!</h1>";
			}
			else{
				$id = $_GET['id'];
				$username = $userNew->getUserNameById($id);
				$result = $userNew->getUserByUserName($username['username']);
		
				if(!$result){
					echo "<h1 class=''>Error!</h1>";
				}
				else{
?>	


			
		<div class="site_content">
			
			<div class="sidebar_container">
			


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

			</div>
            
            <div class="Edit_Form">
                <h1> Edit your profile </h1>
                <form method = "post" action="editsuccess.php" enctype="multipart/form-data">
					<input type="hidden" name = "userNum" value = "<?php echo $result['user_num']?>">
					<label for="fullname">Full name: </label>
                    <input type="name" class="input-box" value="<?php echo ''.$result['fullname']?> " name = "fullname" id="fullname">
					<label for="email">Email: </label>
                    <input type="email" class="input-box" value="<?php echo ''.$result['email']?> " name = "email" id="email">  
					<label for="email">Date of Birth: </label>
                    <input type="date" class="input-box" value="<?php echo ''.$result['dob']?> " name = "dob" id="dob">
					<br>
					<p>Security Questions
						<br>
						<label for="security1">What is your hobby? : </label>
                        <input type="question" class="input-box" value="<?php echo ''.$result['security_question1']?> " name = "security1" id="security1">
						<label for="security2">What is the name of your favourite professor? : </label>
                        <input type="question" class="input-box" value="<?php echo ''.$result['security_question2']?>" name = "security2" id="security2">
                    </p>
                    <p>Add another profile picture below: <input type="file" accept="Image/*" class="file-upload-input"  name="avatar" id="avatar"></p>

                    <button type="submit"class="Save_btn" name = "submit">Save</button>
                </form>
            </div>
			</div>

<?php
				}
			}
		}
 include_once "includes/footer.php"?>