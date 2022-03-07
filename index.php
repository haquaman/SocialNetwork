

<?php include 'header.php';?>





<?php include "slider.php"; ?>





<div class="product-section mt-150 mb-150">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 offset-lg-2 text-center">
				<div class="section-title">	
					<h3><span class="orange-text">The Last</span> Registered Users</h3>
					<p>Here shows the end users registered to the system</p>
				</div>
			</div>
		</div>

		<div class="row">


			<?php 
			$query = "SELECT * FROM users order by user_created_date desc LIMIT 3";		//showing the last 3 registired users of our site
			$result = mysqli_query($conn, $query);
			while ($row = mysqli_fetch_array($result)){?>

				<!-- print informations of these users -->

				<div class="col-lg-4 col-md-6 text-center">
					<div class="single-product-item">
						<div class="product-image">
							<a href="show-user-profile.php?user_id=<?php echo $row['user_id'] ?>"><img src="<?php echo $row['user_picture'] ?>" alt=""></a>
						</div>
						<h3><?php echo $row['user_name']." ".$row['user_surname'] ?></h3>
						<p class="product-price"><span><?php echo $row['user_gender'] ?></span> </p>
						<a href="show-user-profile.php?user_id=<?php echo $row['user_id'] ?>" class="cart-btn"><i class="fas fa-eye"></i>Show Profile</a><br><br>
						




						<?php // while printing be friend button system controls the database if there is a friendship request between this user and me 

						$user_id=$row['user_id'];

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






			</div>
		</div>

	<?php } ?>




</div>
<br>
<br>
<center><a href="allUsers.php" style="background-color: gray;" class="cart-btn"><i class="fas fa-user-friends"></i>Show All Users</a></center>
</div>
</div>

<div class="abt-section mb-150">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-12">
				<div class="abt-bg">
					<!-- <a href="https://www.youtube.com/watch?v=DBLlFWYcIGQ" class="video-play-btn popup-youtube"><i class="fas fa-play"></i></a> -->
					<img style="width:540px; height: 500px;" src="images/social-network.jfif">
				</div>
			</div>
			<div class="col-lg-6 col-md-12">
				<div class="abt-text">
					<p class="top-sub">Since Year 2021</p>
					<h2>We are <span class="orange-text">Social Network</span></h2>
					<p style = "font-size: 12px">Our project name is Social Network. So what is this? Social network is a site that allows people to meet ,make friends and build good relationships. You have to create account, to use our service. After that, users can enter their profile page and they can show their user informations. Also they can update informations and can change password. After set profile, you can click all users link. All users registered on our site are displayed on that page. You can click the image to go their profile page. In the profile page you can all user informations like about me, hobbies , friends…If you like someone or want to know her/him ,you can add your favourites page or directly can send a friendship request. After sending friendship request you can see sending and coming friendship request tab of friends. If other user accepts your request, your friendship will begin .After become friends, you can send message your friends You can search for the person you want by using the search button at the top the right of our site.</p>
					<!-- <a href="about.html" class="boxed-btn mt-4">know more</a> -->
				</div>
			</div>
		</div>
	</div>
</div>



<?php include 'footer.php';?>
