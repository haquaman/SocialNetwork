

<?php include "header.php";  ?>





<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 offset-lg-2 text-center">
				<div class="breadcrumb-text">
					<p>Set your profile</p>
					<h1>Profile Settings</h1>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end breadcrumb section -->


<!-- contact form -->
<div class="contact-from-section mt-150 mb-150">
	<?php 


			//print messages after some update operands


	if(@$_GET["status"]=="yes"){?>
		<center><div class="col-lg-4"><b style="color: green;">Your profile has been successfully saved...</b></div></center>


	<?php }elseif(@$_GET["status"]=="no"){?> 
		<center><div class="col-lg-4"><b style="color: red;">An error occurred...</b></div></center>

	<?php }elseif(@$_GET["status"]=="exist"){?> 
		<center><div class="col-lg-4"><b style="color: red;">We found another user with this email domain.Please try again...</b></div></center>

	<?php }?>
	
	<div class="container">
		<div class="row">


			<div class="col-lg-8 mb-5 mb-lg-0">
				


					<div class="contact-form">		

								<!-- printing form fields and sending this informations to actions.php  -->



						<form method="POST" action="actions.php" enctype="multipart/form-data">
							<label style="font-weight: bold;">Name</label>
							<p><input type="text" placeholder="Name" value="<?php echo $rowUser['user_name']; ?>" name="name"></p>
							
							<label style="font-weight: bold;">Surname</label>
							<p>
								<input type="text" placeholder="Surname" value="<?php echo $rowUser['user_surname']; ?>" 
								name="surname">
							</p>
							<label style="font-weight: bold;">Age</label>
							<p><input style="width: 355px; height: 55px;" type="number" placeholder="Age" value="<?php echo $rowUser['user_age'] ?>" name="age"></p>
							<label style="font-weight: bold;">Email</label>
							<p>
								<input  type="email" placeholder="Email" value="<?php echo $rowUser['user_email'];

							?>" name="email">
						</p>
						<label style="font-weight: bold;">Gender</label>
						<select style="width: 355px; height: 55px;" name="gender" class="form-control">
							<option <?php 
							if($rowUser['user_gender']=='Male'){
								echo 'selected';
							}
						?> value="Male">Male</option>
						<option <?php 
						if($rowUser['user_gender']=='Female'){
							echo 'selected';
						}
					?> value="Female">Female</option>
				</select>
				<br>

				<img style="width:30%;" src="<?php echo $rowUser['user_picture'] ?>">Current Image
				<br><br><br>
				<label style="font-weight: bold;">Image</label>
				<p>
					<input type="file" placeholder="Image" name="image" >
				</p>
				<br>

				<input type="submit" value="Submit" name="user-profile-settings">

			</div>
		</div>


		<div class="col-lg-4">
		


		<div class="form-group">
			<label for="exampleFormControlTextarea3">About Me</label>

			<textarea class="form-control" id="exampleFormControlTextarea3" name="aboutMe" rows="7"><?php echo $rowUser['user_about']; ?></textarea>
		</div>
		<br>
		<div class="md-form">
			<label for="form7">My Hobbies Are:</label>
			<textarea id="form7" class="md-textarea form-control" name="hobies" rows="4"><?php echo $rowUser['user_hobies']; ?></textarea>
		</div>

	</div>
</div>
</div>
</div>
<!-- end contact form -->

</form>




<?php include "footer.php"; ?>