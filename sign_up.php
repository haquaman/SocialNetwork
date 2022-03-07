<?php
include("connection.php");

if(isset($_POST['sign_up'])){
    
    // getting info from html tags
    $name=htmlentities(mysqli_real_escape_string($conn,$_POST['user_name']));
    $age=htmlentities(mysqli_real_escape_string($conn,$_POST['user_age']));
    $gender=htmlentities(mysqli_real_escape_string($conn,$_POST['user_gender']));
    $email=htmlentities(mysqli_real_escape_string($conn,$_POST['user_email']));
    $password=htmlentities(mysqli_real_escape_string($conn,$_POST['user_password']));
    $hashedPassword=hash("sha256",$password);

    // route user to main page 
    if($name==''){    
        echo "<script>alert('Your name is invalid')
        window.location.replace('welcome_screen.php');   
        </script>";
        exit();
    }

    // route user to main page 
    if(strlen($password)<6){
        echo "<script>alert('Your password length must be longer than 6 characters')
        window.location.replace('welcome_screen.php');
        </script>";
        exit();
    }

    $check_email="select * from users where user_email='$email'";
    $run_email=mysqli_query($conn,$check_email);
    $check=mysqli_num_rows($run_email);

    // route user to main page 
    if($check==1){
        echo "<script>alert('Email is already taken')
        window.location.replace('welcome_screen.php');
        </script>";
        exit(); 
    }
    
    $imagePath="uploads/no-avatar.jfif";
    
    // insert user to db
    $insert="insert into users (user_name,user_age,user_gender,user_email,user_password,user_picture,user_created_date)
    values('$name','$age','$gender','$email','$hashedPassword','$imagePath',now())";

    $query=mysqli_query($conn,$insert);

    if($query){
        echo "<script>alert('Your account has been created')</script>";
    }

}

?>