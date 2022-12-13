<?php 
	    $title = "Index";
		require_once "includes/header.php";
		require_once "db/db_config.php";
		require_once "includes/auth.php";
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

				<?php require_once "includes/sidebar.php";?>

				<div class="sidebar">
					<h2>Updates</h2>
					<span>16.10.2021</span>
					<p>We launched a new course for Spanish </p>
					<a href="information.php">read more</a>
				</div>
	
		</div>

			
			<div class="posts">
					<hr>	
					<h2> Who we are?</h2>
					<div class="posts_content">
						<p> We are Owl online school. We teach Graphic Design from scratch or for professionals. <br> We also teach English and German languages for kids and for adults as well. Our online courses will help you develop real-world language skills and achieve your goals faster, wherever you are. No matter what online course you choose, you’ll get effective results. <br>All our online courses include support and guidance from  instructors, access to an <br>interactive student portal.</p>
			        </div>
			</div>
			<!-- Gallery section starts  -->


	
	<!-- Gallery section ends -->
			<div class="posts">
					<hr>
					<h2> How we teach? </h2>
					<div class="posts_content">
						<p>You can choose to learn in small groups of under 7 people or take individual classes. <br>We use Whereby or Zoom for our virtual classrooms. <br>Our approach to teaching is to deliver value and easy learning. We love what we do!</p>
		             </div>
			</div>	 
			<div class="posts">
					<hr>
		            <h2>Payment and prices</h2>
		            <div class="posts_content">
		              <p>Our prices range from 6o euro till 100 euro per a month. <br>You can pay via your credit card by simply having a monthly subscription.</p>
		    </div>
		</div>

	</div>


<?php include_once "includes/footer.php";?>