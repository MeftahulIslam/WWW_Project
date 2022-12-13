<style>
.mycss{
	color: green;
   
    padding: 10px;
    margin-top: 5%;
    text-align: center;
    font-size: 50px;
}
</style>

<style>
.mycss_1{
	color: red;
   
    padding: 10px;
    margin-top: 5%;
    text-align: center;
    font-size: 50px;
}
</style>

<?php 
    $title = "Request Submitted";
     require_once "includes/header.php";
     require_once "db/db_config.php";
     if(isset($_POST['submit'])){
        $fullname = strip_tags($_POST['review_name']);
        $email = strip_tags($_POST['review_email']);
        $message = strip_tags($_POST['review_text']);
        $time = time();
        $file = "messages/".$fullname.$time.'.txt';
        $writeFile = fopen($file, "w") or die("Unable to open file!");
        fwrite($writeFile, $message);   //writes the message to txt file for reading it later
        fclose($writeFile);

         $isSuccess = $crud->insertClientRequest($fullname, $email, $file, $time);
         if($isSuccess){
            echo "<h1 class= 'mycss '> Your message has been registered in the system! Thank you! </h1>";
        }
        else{
           echo "<h1 class='mycss_1'> Process was not complete </h1>";
        }
     }
     else{
        echo "<h1 class='mycss_1'> Error! Process was not complete </h1>";
     }
?>

<div class="site_content">
			
			<div class="sidebar_container">
				
            <div class="sidebar">
					<h2>Updates</h2>
                    <span>16.10.2021</span>
					<p>We lauched a new course for Spanish </p>
					<a href="#">read more</a>
				</div>

				<div class="sidebar">
					<h2>Future Courses</h2>
					<ul>
						<li>Spanish course A1-B1</li>
						<li>Spanish course B1-C1</li>
					</ul>
				</div>

                <div class="sidebar">
					<h2>Search</h2>
					<form method="post" action="#" id="search_form" >
						<input type="search" name="search_field" placeholder="your request" />
						<input type="submit" class="btn" value="find" />
					</form>
				</div>

                <?php require_once "includes/sidebar.php";?>
				
				</div>
           

                <div class="posts">
					<hr>
		            <h2>Payment and prices</h2>
		            <div class="posts_content">
		              <p>Our prices range from 6o euro till 100 euro per a month. <br>You can pay via your credit card by simply having a monthly subscription.</p>
		            </div>
		        </div>

                <div class="posts">
					<hr>
					<h2> How we teach? </h2>
					<div class="posts_content">
						<p>You can choose to learn in small groups of under 7 people or take individual classes. <br>We use Whereby or Zoom for our virtual classrooms. <br>Our approach to teaching is to deliver value and easy learning. We love what we do!</p>
		            </div>
			    </div>

                <div class="posts">
					<hr>
					<h2> We are always here for you!! </h2>
					<div class="posts_content">
						<p>Our Top-Notch services have been appreciated by many and we will strive to make you <br> one of them. <br>The method of learning is rapidly changing join Us to experience change Now!!</p>
		            </div>
			    </div>
 </div>


<?php 
    require_once "includes/footer.php";
?>