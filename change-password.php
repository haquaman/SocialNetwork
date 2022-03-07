

<?php include "header.php";  ?>





<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 offset-lg-2 text-center">
				<div class="breadcrumb-text">
					<p>Set your password</p>
					<h1>Change Password</h1>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end breadcrumb section -->


<!-- contact form -->
<div class="contact-from-section mt-150 mb-150">
	<?php 

	//printing suitable messagaes with using this messageKey

	if(@$_GET["status"]=="successfully"){?>		
		<center><div class="col-lg-4"><b style="color: green;">Your password has been successfully saved...</b></div></center>


	<?php }elseif(@$_GET["status"]=="wrongPassword"){?> 
		<center><div class="col-lg-4"><b style="color: red;">Fields of new password didn't match...</b></div></center>

	<?php }elseif(@$_GET["status"]=="missingPassword"){?> 
		<center><div class="col-lg-4"><b style="color: red;">You entered less than 6 character.Your new password must longer than 6 character or equal it...</b></div></center>

	<?php }elseif(@$_GET["status"]=="error"){?> 
		<center><div class="col-lg-4"><b style="color: red;">An error was encountered while updating...</b></div></center>

	<?php }elseif(@$_GET["status"]=="passwordMissmatch"){?> 
		<center><div class="col-lg-4"><b style="color: red;">Your old password is incorrect..</b></div></center>

	<?php }?>



	



	<div class="container">
		<div class="row">


			<div class="col-lg-4 mb-5 mb-lg-0">



				<div class="contact-form">		


					<form method="POST" action="actions.php">			<!-- form area sending to actions.php and updated password at there and again comes this page -->
						<label style="font-weight: bold;">Old Password</label>
						<p><input class="form-control" type="password" name="old_password"></p>

						<label style="font-weight: bold;">New Password</label>
						<p>
							<input class="form-control" type="password" name="new_password1">
							
						</p>
						<label style="font-weight: bold;">New Password Again</label>
						<p><input class="form-control" type="password" name="new_password2"></p>

						<input type="submit" value="Submit" name="password-change">

					</div>
				</div>


			</div>
		</div>
	</div>

</form>



<?php include "footer.php"; ?>