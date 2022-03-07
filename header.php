<?php 
include "connection.php";			//include connection in every page
date_default_timezone_set("Europe/Istanbul");		//for using datetime field define correct location
session_start();		//start session to use current user informations


if (!isset($_SESSION['user_id'])){		//if there is no logged user in our system,user has to log 
	header("location:welcome_screen.php");
}else{

	$query = "SELECT * FROM users where user_id='".$_SESSION['user_id']."'";
	$result = mysqli_query($conn, $query);
	$rowUser = mysqli_fetch_assoc($result);			//reaching current user informations
}
//query of coming frindship,it is calling at comingFriendship.php

$queryComingFriendship = "select * from friendship INNER JOIN users on friendship.first_user=users.user_id where friendship.second_user='".$_SESSION['user_id']."' and friendship.is_okey='no' ";
$resultComingFriendship = mysqli_query($conn, $queryComingFriendship);


//query of outgoing frindship,it is calling at outgoingFriendship.php

$queryOutgoingFriendship = "select * from friendship INNER JOIN users on friendship.second_user=users.user_id where friendship.first_user='".$_SESSION['user_id']."' and friendship.is_okey='no' ";
$resultOutgoingFriendship = mysqli_query($conn, $queryOutgoingFriendship);

//query of friends,it is calling at friends.php

$queryFriends = "select * from friendship where (friendship.first_user='".$_SESSION['user_id']."' or friendship.second_user='".$_SESSION['user_id']."' ) and friendship.is_okey='yes' ";
$resultFriends = mysqli_query($conn, $queryFriends);

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">

	<!-- title -->
	<title>Social Network</title>

	<!-- favicon -->
	<link rel="shortcut icon" type="image/png" href="assets/img/favicon.png">
	<!-- google font -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
	<!-- fontawesome -->
	<link rel="stylesheet" href="assets/css/all.min.css">
	<!-- bootstrap -->
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	<!-- owl carousel -->
	<link rel="stylesheet" href="assets/css/owl.carousel.css">
	<!-- magnific popup -->
	<link rel="stylesheet" href="assets/css/magnific-popup.css">
	<!-- animate css -->
	<link rel="stylesheet" href="assets/css/animate.css">
	<!-- mean menu css -->
	<link rel="stylesheet" href="assets/css/meanmenu.min.css">
	<!-- main style -->
	<link rel="stylesheet" href="assets/css/main.css">
	<!-- responsive -->
	<link rel="stylesheet" href="assets/css/responsive.css">

</head>
<body>
	
	<!--PreLoader-->
	<div class="loader">
		<div class="loader-inner">
			<div class="circle"></div>
		</div>
	</div>
	<!--PreLoader Ends-->
	





	<!-- header -->
	<div class="top-header-area" id="sticker">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-sm-12 text-center">
					<div class="main-menu-wrap">
						<!-- logo -->
						<div class="site-logo">
							<a href="index.php">
								<img src="images/logo.png" alt="">
							</a>
						</div>
						<!-- logo -->

						<!-- menu start -->
						<nav class="main-menu">
							<ul>
								<li><a href="index.php">Home</a>
									
								</li>
								<li><a href="favourites.php">Favourites</a></li>
								<li><a href="#">Friends</a>
									<ul class="sub-menu">
										<li><a href="friends.php">Friends <span style="color:green; font-weight: bold;">(<?php echo mysqli_num_rows($resultFriends); ?>)</span></a></li>
										<li><a href="comingFriendship.php">Coming Friendship Requests <span style="color:green; font-weight: bold;">(<?php echo mysqli_num_rows($resultComingFriendship); ?>)</span></a></li>
										<li><a href="outgoingFriendship.php">Outgoing Friendship Requests <span style="color:green; font-weight: bold;">(<?php echo mysqli_num_rows($resultOutgoingFriendship); ?>)</span></a></li>
									</ul>
								</li>
						
								<li><a href="home.php?user_id=<?php echo $rowUser['user_id']?>">Chat</a>
									
								</li>
								<li><a href="#">Profile (<span style="color:orange;"><?php echo $rowUser['user_name']." ".$rowUser['user_surname']."."  ?></span>)</a>

									<ul class="sub-menu">
										<li><a href="user-profile-settings.php">Profile Settings</a></li>
										<li><a href="change-password.php">Change Password</a></li>
										<li><a style="color:red;" href="logout.php">Logout</a></li>
										
									</ul>


								</li>
								<li><a href="allUsers.php">All Users</a>
									
								</li>
								

								<li>
									<div class="header-icons">

										<a class="mobile-hide search-bar-icon" href="#"><i class="fas fa-search"></i></a>
									</div>
								</li>
							</ul>
						</nav>
						<a class="mobile-show search-bar-icon" href="#"><i class="fas fa-search"></i></a>
						<div class="mobile-menu"></div>
						<!-- menu end -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end header -->



	<!-- search area -->
	<div class="search-area">
		<div class="container"> 	
			<div class="row">
				<div class="col-lg-12">
					<span class="close-btn"><i class="fas fa-window-close"></i></span>
					<div class="search-bar">
						<div class="search-bar-tablecell">
							<h3>Search For:</h3>
							<form method="POST" action="allUsers.php">
								<input type="text" name="searchKey" placeholder="Keywords">
								<button name="searchKeySubmit" value="searchKeySubmit" type="submit">Search <i class="fas fa-search"></i></button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end search area -->