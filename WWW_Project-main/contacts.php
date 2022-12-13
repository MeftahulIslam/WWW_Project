<?php 
	    $title = "Contacts";
		require_once "includes/header.php";
		require_once "db/db_config.php";
		include_once "includes/auth.php"
	
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

				 	<div class="sidebar">
			
						<h2>Future courses</h2>
						<ul>
							<li>Spanish course A1-B1</li>
							<li>Spanish course B1-C1</li>
						</ul>
					</div>

				</div>

			<div class="content">
				
				<h1>Contacts</h1>
				<p>Send your requests or questions to our online school </p>
	
				<div class="send send_contact">	
					<form id="contactForm" method = "POST" action="success.php">
						<input required type="text" name="review_name" id="review_name" placeholder="Enter your name">
						<input required type="email" name="review_email" id="review_email" placeholder="Your email">
						<textarea name="review_text" id="review_text" ></textarea>
						<input type="submit" name="submit" id="submit" class="btn" value="Submit" />
					</form>
				</div>

			</div>

		</div>
</body>
</html>