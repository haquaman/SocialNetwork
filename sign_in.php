<?php

include("connection.php");

if(isset($_POST['sign_in'])){

    // getting info from html tags
    $email=htmlentities(mysqli_real_escape_string($conn,$_POST['email']));
    // password will be checked over the hashed one due to security.
    $password=hash("sha256",htmlentities(mysqli_real_escape_string($conn,$_POST['password'])));


    $user="select * from users where user_email='$email' AND user_password='$password'";

    $query=mysqli_query($conn,$user);
    
    // if there is a user who provide terms in the query
    if(mysqli_num_rows($query)==1){ 
            session_start();
            $_SESSION['user_email']=$email;
            $current_user = mysqli_fetch_assoc($query);
            $_SESSION['user_id']=$current_user['user_id'];
            $update_msg = mysqli_query($conn, "UPDATE users SET log_in='Online' WHERE user_id={$current_user['user_id']}");
            
            header("location:index.php");
    }
    else{
        echo "<script>alert('This account does not exist.')
        window.location.replace('welcome_screen.php');
        </script>";
    }
       
}


?>