<?php include('sign_up.php'); ?>
<?php include('sign_in.php'); ?>

<!DOCTYPE html>

<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Welcome Screen</title>
	<link rel="stylesheet" href="signin.css">
	<script src="script.js"></script>
</head>

<body>
	<div class='header'>
		<a href="#default" class="logo"><img src="images/logo.png" alt=""></a>
	</div>

	<div class='content-container'>
		<h1 class=content-text>MEET <br> WITH</h1>
		<div class="sign-in-container">
			<form action="" method="POST">
				<h1>Sign in</h1>
				<input type="email" placeholder="Email" name='email' />
				<input type="password" placeholder="Password" name='password'/>
				<button class='btn-sign-in' name='sign_in'>Sign In</button>
			</form>
		</div>

		<div class="sign-up-container">
			<form action="" method="POST">
				<h1>Create Account</h1>
				<input name="user_name" type="text" placeholder="Name" />
				<input name="user_email" type="email" placeholder="Email" />
				<input name="user_password" type="password" placeholder="Password" />
				<label for="gender">Gender:</label>

				<select name="user_gender" id="gender">
					<option value="Male">Male</option>
					<option value="Female">Female</option>

				</select>
				<label for="user_age">Age:</label>
				<select name="user_age">
					<?php
					for ($i = 18; $i <= 100; $i++) {
					?>
						<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
					<?php
					}
					?>
				</select>
				<button type="submit" name="sign_up">Sign Up</button>

			</form>
		</div>
		<h1 class=content-text>NEW <br> PEOPLE</h1>

	</div>



</body>

</html>