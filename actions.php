
<?php 

include "connection.php";			//make database connection
session_start();			//start session


$query = "SELECT * FROM users where user_id='".$_SESSION['user_id']."'";
$result = mysqli_query($conn, $query);
$rowUser = mysqli_fetch_assoc($result);				//fetch current user on site from users table



if (isset($_POST['user-profile-settings'])) {			//if user wants to update his/her profile
	
	// print_r($_POST);
	// exit();

	$isEnter=False;
	// File upload path
	$targetDir = "uploads/";
	$fileName = basename($_FILES["image"]["name"]);
	$targetFilePath = $targetDir . $fileName;					//defining image path to load
	$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

	if (!empty($_FILES["image"]["name"])) {
		$allowTypes = array('jpg','png','jpeg','gif');
		if(in_array($fileType, $allowTypes)){						//if image type is in allowed types
			if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)){		//upload file
				$isEnter=True;
				//$insert = $db->query("INSERT into images (file_name, uploaded_on) VALUES ('".$fileName."', NOW())");

			}else{
				$statusMsg = "Sorry, there was an error uploading your file.";
				
			}
		}else{
			header("location:user-profile-settings.php?status=exist");
			exit();
			$statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF,  files are allowed to upload.';
		}
	}
	if ($isEnter==False) {
		$targetFilePath=$rowUser['user_picture'];
		
	}

	



	$email=htmlspecialchars($_POST["email"]);			//getting data from form data
	$name=htmlspecialchars($_POST["name"]);
	$surname=htmlspecialchars($_POST["surname"]);
	$age=htmlspecialchars($_POST["age"]);
	$gender=htmlspecialchars($_POST["gender"]);
	$about=htmlspecialchars($_POST["aboutMe"]);
	$hobies=htmlspecialchars($_POST["hobies"]);

	$query = "select * from users";
	$result = mysqli_query($conn, $query);
	while ($row = mysqli_fetch_array($result)){

		if ($row['user_email']==$email && $row['user_id']!=$_SESSION['user_id'] ) {		//when user updating his profile if changed the email,this line controlling the if there is a exist same email.İf it is sending errror to user to define unique email adress
			header("location:user-profile-settings.php?status=exist");
			exit();
		}


	}
	$sql = "UPDATE users SET user_name='$name',user_surname='$surname',user_age='$age',user_gender='$gender',user_email='$email',user_picture='$targetFilePath',user_about='$about',user_hobies='$hobies' WHERE user_email='$email'";


		//if everything is fine,reach the user object and update

	if ($conn->query($sql) === TRUE) {
		echo "Record updated successfully";
		header("location:user-profile-settings.php?status=yes");
	} else {
		echo "Error updating record: " . $conn->error;
		header("location:user-profile-settings.php?status=no");
		exit();
	}



}


if (@$_GET["addFovourites"]=="ok") {		//if user wants to add someone to his/her favourites

	$second_user=@$_GET["second_user"];		//getting other user id which is added his favourites
	

	$insert="insert into favourites (first_user,second_user)
	values({$rowUser['user_id']},{$second_user})";					//insert the favourites table

	$query=mysqli_query($conn,$insert);
	header("location:show-user-profile.php?status=yes&user_id=$second_user");		//sending again same page
	exit();
}
if (@$_GET["removeFovourites"]=="ok") {		//if user wants to remove someone to his/her favourites

	$second_user=@$_GET["second_user"];		//getting other user id which is removed his favourites
	

	$sql = "DELETE FROM favourites WHERE first_user={$rowUser['user_id']} and second_user={$second_user}";		//delete the favourites table

	if ($conn->query($sql) === TRUE) {
		echo "Record deleted successfully";
		header("location:show-user-profile.php?status=deleted&user_id=$second_user");		//sending again same page
		exit();
	} else {
		echo "Error deleting record: " . $conn->error;
	}
	
}



if (@$_GET["beFriends"]=="ok") {				// if there is a request of friendship

	$second_user=@$_GET["second_user"];			//getting friends id which is added his friends
	

	$insert="insert into friendship (first_user,second_user,is_okey,created_date)		
	values({$rowUser['user_id']},{$second_user},'no',now())";			//insert the friendship table with is_okey=no because other if other user accepts request,is_okey value  will be equal yes

	$query=mysqli_query($conn,$insert);
	header("location:show-user-profile.php?status=sent&user_id=$second_user");		//sending again same page
	exit();	
}

if (@$_GET["acceptFriend"]=="ok") {			// if user  accepts friendship	 request

	$friendshipId=@$_GET["friendshipId"];		//getting friendship id 
	

	$sql = "UPDATE friendship SET is_okey='yes',created_date=now() WHERE friendship_id='$friendshipId'";			//updated is_okey value 

	if ($conn->query($sql) === TRUE) {
		echo "Record updated successfully";
		header("location:comingFriendship.php?status=accept");		//sending again same page with successfully
	} else {
		echo "Error updating record: " . $conn->error;
		header("location:comingFriendship.php?status=noaccept");		//sending again same page with error messages
		exit();
	}
}


if (@$_GET["removeFriend"]=="ok") {		// if user  wants remove friends	

	$friendshipId=@$_GET["friendshipId"];		//getting friendship id 
	$second_user=@$_GET["second_user"];		//getting other user id 

	$sql = "DELETE FROM friendship WHERE friendship_id='$friendshipId'";		//delete friendship

	if ($conn->query($sql) === TRUE) {
		echo "Record deleted successfully";
		if (@$_GET["second_user"]) {    //if page coming from user profile returns againn there
			header("location:show-user-profile.php?status=deletedFriendship&user_id=$second_user");
		}else if(@$_GET["whichPage"]=="comingFriendship"){		//if page coming from comingFriendship and returns there
			header("location:comingFriendship.php?status=deletedFriendship");
		}else if(@$_GET["whichPage"]=="outgoingFriendship"){		//if page coming from outgoingFriendship and returns there
			header("location:outgoingFriendship.php?status=deletedFriendship");
		}else{
			header("location:friends.php?status=deletedFriendship");
		}
		exit();
	} else {
		echo "Error deleting record: " . $conn->error;
	}
}



if(isset($_POST['password-change'])){			//password change area

	$new_password1=htmlspecialchars($_POST["new_password1"]);		//getting new password one
	$new_password2=htmlspecialchars($_POST["new_password2"]);		//getting new password two
	$old_password=htmlspecialchars($_POST["old_password"]);		//getting old password 
	$real_password=$rowUser['user_password'];		//fetch real password of current user with in an encrypted way
	$hashedOldPassword=hash("sha256",$old_password);		//encrypt the password old
	$hashedNewPassword=hash("sha256",$new_password1);			//encrypt the password new



	if($new_password1!=$new_password2){			//if new_password1 and new_password2 won^t be equal each other
		header("location:change-password.php?status=wrongPassword");		//sending error message to user
		exit();
	}
	if(strlen($new_password1)<6){			//if length of the new password less than 6 character
		header("location:change-password.php?status=missingPassword");		//sending error message to user
		exit();
	}


	if($real_password==$hashedOldPassword){		//if old password and real current password is equal each other and everthing is fine

		$sql = "UPDATE users SET user_password='$hashedNewPassword' WHERE user_id={$rowUser['user_id']}";		//update password with new password

		if ($conn->query($sql) === TRUE) {
			echo "Record updated successfully";
			header("location:change-password.php?status=successfully");	//sending success messages
		} else {
			echo "Error updating record: " . $conn->error;
			header("location:change-password.php?status=error");		//sending error messages
		}
		

	}else{
		header("location:change-password.php?status=passwordMissmatch");		//sending error messages
		exit();
	}

}










?>