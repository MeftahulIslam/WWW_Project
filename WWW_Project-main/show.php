<?php 
	    $title = "Language Courses";
		require_once "includes/header.php";
		require_once "db/db_config.php";
		require_once "includes/auth.php";	//Ajax is implemented on this page
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
			
			<div class="container">

				<h2> English from A1-B1 </h2>
				<a href="#"><img src="assets/img/english.png" height="200" width="350" > </a>
				<br>
				<?php if(!isset($_SESSION['id'] )){
					echo "<a onclick='pleaseLogin()' href='#'><img src='assets\img\button.png' alt= 'Complete English Course A1-A2' height='70px'></a>";
				 }
				 else{
					echo "<a onclick='increment()' href='downloads/Complete English Course A1-A2.pdf' download=''><img src='assets\img\button.png' alt= 'Complete English Course A1-A2' height='70px'></a>";
				}?>
				<br>
				<hr>
				<br>
			</div>
			<div class="container">
				<h2> English from B2-C1 </h2>
					<a href="#"><img src="assets/img/level EN.png" height="200" width="350" > </a>
					<br>
					<?php if(!isset($_SESSION['id'] )){
						echo "<a onclick='pleaseLogin()' href='#'><img src='assets\img\button.png' alt= 'English B1-C1' height='70px'></a>";
					}
					else{
						echo "<a onclick='increment()' href='downloads/Complete English Course B2- C1.pdf?id=1' download=''><img src='assets\img\button.png' alt= 'English B1-C1' height='70px'></a>";
					}?>
					<br>
					<hr>
					<br>
			</div>

			<div class="container">
				<h2> German from A1-B1 </h2>
					<a href="#"><img src="assets/img/de.png" height="200" width="350" > </a>
					<br>
					<?php if(!isset($_SESSION['id'] )){
						echo "<a onclick='pleaseLogin()' href='#'><img src='assets\img\button.png' alt= 'German A1-A2' height='70px'></a>";
					}
					else{
						echo "<a onclick='increment()' href='downloads/Learn German Language A1-A2 .pdf' download=''><img src='assets\img\button.png' alt= 'Learn German Language A1-A2' height='70px'></a>";
					}?>
					<br>
					<hr>
					<br>
			</div>
			
			<div class="container">
				<h2> German from  B2-C1 </h2>
						<a href="#"><img src="assets/img/level EN.png" height="200" width="350" > </a>
						<br>
						<?php if(!isset($_SESSION['id'] )){
							echo "<a onclick='pleaseLogin()' href='#'><img src='assets\img\button.png' alt= 'German A1-A2' height='70px'></a>";
						}
						else{
							echo "<a onclick='increment()' href='downloads/Learn German Language B2- C1.pdf' download=''><img src='assets\img\button.png' alt= 'Learn German Language B2- C1.pdf' height='70px'></a>";
						}?>
						<br>
						<hr>
						<br>
			</div>
		</div>
		<script>
			function pleaseLogin(){
				alert("Please Login to download!");
			}
		</script>

		<script>
			function increment() {
				$.ajax({
					type: "POST",
					url: 'increment.php',
					data:{id:<?php echo $_SESSION['id']?>},
					success:function(data) {
					}
      			});
 			}
		</script>

<?php include_once "includes/footer.php";?>