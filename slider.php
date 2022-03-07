

<?php 
$query = "SELECT * FROM slider";	
$result = mysqli_query($conn, $query);

?>

<!-- home page slider -->
<div class="homepage-slider">
	<!-- single home slider -->



	<?php 
	
	$rowNumber=0;

	while ($row = mysqli_fetch_array($result)) {				//fetching sliders from database

		$firstClass="";
		$secondClass="";

		if ($rowNumber==0) {						//defining slider class
			$firstClass="single-homepage-slider homepage-bg-1";
			$secondClass="col-md-12 col-lg-7 offset-lg-1 offset-xl-0";
		}elseif ($rowNumber==1) {
			$firstClass="single-homepage-slider homepage-bg-2";
			$secondClass="col-lg-10 offset-lg-1 text-center";
		}elseif ($rowNumber==2) {
			$firstClass="single-homepage-slider homepage-bg-3";
			$secondClass="col-lg-10 offset-lg-1 text-right";
			$rowNumber=-1;
		}
		$rowNumber++;


	 ?>

	 			<!-- 	print sliders -->


		<div  class="<?php echo $firstClass ?>">
			<div class="container">
				<div class="row">
					<div class="<?php echo $secondClass ?>">
						<div class="hero-text">
							<div class="hero-text-tablecell">	
								<p class="subtitle"><?php echo $row['title1']; ?></p>
								<h1><?php echo $row['title2']; ?></h1>
								<div class="hero-btns">
									<a class="search-bar-icon boxed-btn">Search User</a>
									<a href="allUsers.php" class="bordered-btn">Show All Users</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>




	<?php } ?>

</div>
	<!-- end home page slider -->