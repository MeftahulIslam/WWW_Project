<?php 
	    $title = "Information";
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
					<p>We lauched a new course for Spanish </p>
					<a href="#">read more</a>
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
				
				<table>
					
					<tr>
						<th></th>
						<th>Courses</th>
						<th class="center">Duration</th>
						<th class="center">Age</th>
					</tr>
					<tr>
						<td class="center"><img src="assets/img/design.jpg"></td>
						<td> <a href="school.php">Graphic Design for beginners</a></td>
						<td class="center"> up  to 12 months </td>
						<td class="center rating">18-55</td>
					</tr>
					<tr>
						<td class="center"><img src="assets/img/design.jpg"></td>
						<td> <a href="school.php"> Graphic Design for Pro</a> </td>
						<td class="center">up to 6 months</td>
						<td class="rating center">18-55</td>
					</tr>
					<tr>
						<td class="center"><img src="assets/img/english.png"></td>
						<td> <a href="show.php">English A1-B1</a></td>
						<td class="center"> up to 12 months</td>
						<td class="rating center">5-55</td>
					</tr>
					<tr>
						<td class="center"><img src="assets/img/english.png"></td>
						<td> <a href="show.php">English B2-C1</a></td>
						<td class="center"> up to 12 months</td>
						<td class="rating center">7-55</td>
					</tr>
					<tr>
						<td class="center"><img src="assets/img/de.png"></td>
						<td> <a href="show.php">German A1-B1</a></td>
						<td class="center"> up to 12 months</td>
						<td class="rating center">7-55</td>
					</tr>
					<tr>
						<td class="center"><img src="assets/img/de.png"></td>
						<td> <a href="show.php">German B2-C1</a></td>
						<td class="center"> up to 12 months</td>
						<td class="rating center">7-55</td>
					</tr>

				</table>

			</div>

		</div>





		<?php include_once "includes/footer.php";?>