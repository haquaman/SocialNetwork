


<?php  include "header.php"; 

$user_id="";


if (isset($_GET['user_id'])) {
	$user_id=$_GET['user_id'];			//the id of the user whose profile we will look at
} else {
	header("location:404.php");
}
?>






<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 offset-lg-2 text-center">
				<div class="breadcrumb-text">
					<p>See more Details</p>
					<h1>Single Product</h1>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end breadcrumb section -->

<!-- single product -->
<div class="single-product mt-150 mb-150">
	<div class="container">
		<div class="row">
			<div class="col-md-5">

				<?php 

				$query = "SELECT * FROM users where user_id=$user_id";
				$result = mysqli_query($conn, $query);
				$row = mysqli_fetch_assoc($result)			//reaching user row using with id
				?>

				<div class="single-product-img">
					<img src="<?php echo $row['user_picture']; ?>" alt="">
				</div>
				<br>
				<p>Hello guys my <span style="color:orange; font-weight: bold;">hobies</span> are: </p>
				<p style="font-weight:bold;"><?php echo $row['user_hobies']; ?></p>			<!-- print hobies of user -->
			</div>
			<div class="col-md-7">
				<div class="single-product-content">



					<!-- 	print other informations -->

					<h3><?php echo $row['user_name'].' '.$row['user_surname']; ?></h3>
					<p class="single-product-pricing"><span><?php echo $row['user_gender']; ?></span></p>
					<p><?php echo $row['user_about']; ?></p>
					<!-- <div class="single-product-form">
						<input type="number" id="showWords" placeholder="0">
						<a href="cart.html" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
						<p><strong>Categories: </strong>Fruits, Organic</p>
					</div> -->

					<?php 

					$query = "SELECT * FROM favourites where first_user={$rowUser['user_id']} and second_user={$user_id}";
					$result = mysqli_query($conn, $query);

					if(mysqli_num_rows($result)==1){?>

					<!-- 	if current user added this user to his favourites  -->

						<a style="background-color: red;" href="actions.php?removeFovourites=ok&second_user=<?php echo $row['user_id'] ?>" class="cart-btn"><i class="fas fa-eye"></i>Remove Favourites</a>&emsp;

					<?php }else{		//if user is yourself,button will be shown gray so you can  not yourself add favourites

						if ($rowUser['user_id']==$row['user_id']) {?>
							<a style="background-color: gray;" class="cart-btn"><i class="fas fa-eye"></i>Add Favourites</a>&emsp;
						<?php }else{ ?>		<!-- if current user didn't add this user to his favourites -->

							<a style="background-color: green;" href="actions.php?addFovourites=ok&second_user=<?php echo $row['user_id'] ?>" class="cart-btn"><i class="fas fa-eye"></i>Add Favourites</a>&emsp;
						<?php } ?>
						

						
					<?php }  ?>
					

					<?php 		// while printing be friend button system controls the database if there is a friendship request between this user and me 

					$queryFriendship = "SELECT * FROM friendship where (first_user={$rowUser['user_id']} and second_user={$user_id}) or (first_user={$user_id} and second_user={$rowUser['user_id']})";
					$resultFriendship = mysqli_query($conn, $queryFriendship);
					$rowFriendship= mysqli_fetch_assoc($resultFriendship);
					if(mysqli_num_rows($resultFriendship)>=1){

						if ($rowFriendship['is_okey']=="yes") {?>		<!-- if request is approved -->

						<a href="actions.php?removeFriend=ok&second_user=<?php echo $row['user_id'] ?>&friendshipId=<?php echo $rowFriendship['friendship_id']; ?>" style="background-color: red;" class="cart-btn"><i class="fas fa-user-friends"></i>Remove Friend</a>

						<?php }else{ ?>		<!-- if request is waiting -->

						<a href="" style="background-color: green;" class="cart-btn"><i class="fas fa-user-friends"></i>Waiting</a>

					<?php } ?>






				<?php }else{ 


					if ($rowUser['user_id']==$user_id) {?>		<!-- if user is yourself href is blank-->

					<a href="" style="background-color: gray;" class="cart-btn"><i class="fas fa-user-friends"></i>Be Friend</a>

					<?php }else{ ?>  <!-- if user is not yourself -->
					<a href="actions.php?beFriends=ok&second_user=<?php echo $row['user_id'] ?>" style="background-color: green;" class="cart-btn"><i class="fas fa-user-friends"></i>Be Friend</a>

				<?php } ?>


			<?php } ?>


			<br><br>
			<?php 

			//print messages after operands

			if ($rowUser['user_id']==$row['user_id']){?>
				<p style="color:red;">You can not add yourself to your favourites and can not be friend with yourself</p>
			<?php } ?>

			<?php 

			if(@$_GET["status"]=="yes"){?>
				<div class="col-lg-9"><b style="color: green;">User has been successfully added to your favourites...</b></div>


			<?php }elseif (@$_GET["status"]=="deleted") {?>
				<div class="col-lg-9"><b style="color: green;">User has been successfully deleted from your favourites...</b></div>

			<?php } elseif (@$_GET["status"]=="sent") {?>
				<div class="col-lg-9"><b style="color: green;">Friend request has been sent succesfully...</b></div>

			<?php } elseif (@$_GET["status"]=="deletedFriendship") {?>
				<div class="col-lg-9"><b style="color: green;">Friend deleted from your friends...</b></div>

			<?php } ?>


				</div>
			</div>
		</div>
	</div>
</div>
<!-- end single product -->



<!-- more products -->
<div class="more-products mb-150">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 offset-lg-2 text-center">
				<div class="section-title">	

					<h3><span class="orange-text">Some </span>Friend Of <span class="orange-text"><?php echo $row['user_name'] ?> 's</span></h3>
					<p>You can see some of the friends of <?php echo $row['user_name']." ".$row['user_surname'] ?> at the below.If you want to see more friends of <?php echo $row['user_name']." ".$row['user_surname'] ?> 's click the button which is located bottom of the users </p>
				</div>
			</div>
		</div>
		<div class="row">


			<?php 		//fetching friends of this user

			$querySomeFriends = "select * from friendship where (friendship.first_user='$user_id' or friendship.second_user='$user_id' ) and friendship.is_okey='yes' LIMIT 3";
			$resultSomeFriends = mysqli_query($conn, $querySomeFriends);


			while ($rowSomeFriends = mysqli_fetch_array($resultSomeFriends)){
				$querySomeUserFriends="";
				if ($rowSomeFriends['first_user']==$user_id) {
					$querySomeUserFriends = "SELECT * FROM users where user_id={$rowSomeFriends['second_user']}";
				}else{
					$querySomeUserFriends = "SELECT * FROM users where user_id={$rowSomeFriends['first_user']}";
				}


				$resultSomeUserFriends = mysqli_query($conn, $querySomeUserFriends);
				$rowSomeUserFriends = mysqli_fetch_assoc($resultSomeUserFriends);

				?>
					<!-- printing some friends of this user -->

				<div class="col-lg-4 col-md-6 text-center">
					<div class="single-product-item">
						<div class="product-image">
							<a href="single-product.html"><img src="<?php echo $rowSomeUserFriends['user_picture'] ?>" alt=""></a>
						</div>
						<h3><?php echo $rowSomeUserFriends['user_name']." ".$rowSomeUserFriends['user_surname'] ?></h3>
						<p class="product-price"><span><?php echo $rowSomeUserFriends['user_gender'] ?></span></p>
						


						<a href="show-user-profile.php?user_id=<?php echo $rowSomeUserFriends['user_id'] ?>" class="cart-btn"><i class="fas fa-eye"></i>Show Profile</a><br><br>
						


						<?php 

							// while printing be friend button system controls the database if there is a friendship request between this user and me 

						$queryFriendshipBottom = "SELECT * FROM friendship where (first_user={$rowUser['user_id']} and second_user={$rowSomeUserFriends['user_id']}) or (first_user={$rowSomeUserFriends['user_id']} and second_user={$rowUser['user_id']})";
						$resultFriendshipBottom = mysqli_query($conn, $queryFriendshipBottom);
						$rowFriendshipBottom= mysqli_fetch_assoc($resultFriendshipBottom);
						if(mysqli_num_rows($resultFriendshipBottom)>=1){

							if ($rowFriendshipBottom['is_okey']=="yes") {?>		<!-- if request is approved -->

							<a href="actions.php?removeFriend=ok&second_user=<?php echo $rowSomeUserFriends['user_id'] ?>&friendshipId=<?php echo $rowFriendshipBottom['friendship_id']; ?>" style="background-color: red;" class="cart-btn"><i class="fas fa-user-friends"></i>Remove Friend</a>

							<?php }else{ ?>		<!-- if request is waiting -->

							<a href="" style="background-color: green;" class="cart-btn"><i class="fas fa-user-friends"></i>Waiting</a>

						<?php } ?>

					<?php }else{ 


						if ($rowUser['user_id']==$rowSomeUserFriends['user_id']) {?>		<!-- if user is yourself href is blank-->

						<a href="" style="background-color: gray;" class="cart-btn"><i class="fas fa-user-friends"></i>Be Friend</a>

						<?php }else{ ?>  <!-- if user is not yourself -->
						<a href="actions.php?beFriends=ok&second_user=<?php echo $rowSomeUserFriends['user_id'] ?>" style="background-color: green;" class="cart-btn"><i class="fas fa-user-friends"></i>Be Friend</a>

					<?php } ?>


				<?php } ?>


			</div>
		</div>


	<?php } ?>



</div>
<?php if(mysqli_num_rows($resultSomeFriends)==0){?>    <!-- if in part of some friends,user doesn't have any friends -->

	<center><p style="color:red;">This user doesn't have any friends...</p></center>

<?php }  ?><br>
<center><a href="otherUserFriends.php?user_id=<?php echo $row['user_id']; ?>" class="btn btn-success">Show All Friends Of <?php echo $row['user_name'].' '.$row['user_surname']; ?> 's</a></center>			<!-- this button directed the page of friends of this user -->
</div>

</div>


	




<!-- logo carousel -->
<div class="logo-carousel-section">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="logo-carousel-inner">
					<div class="single-logo-item">
						<img src="assets/img/company-logos/1.png" alt="">
					</div>
					<div class="single-logo-item">
						<img src="assets/img/company-logos/2.png" alt="">
					</div>
					<div class="single-logo-item">
						<img src="assets/img/company-logos/3.png" alt="">
					</div>
					<div class="single-logo-item">
						<img src="assets/img/company-logos/4.png" alt="">
					</div>
					<div class="single-logo-item">
						<img src="assets/img/company-logos/5.png" alt="">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end logo carousel -->






<?php  include "footer.php"; ?>


