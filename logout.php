<?php 

include 'connection.php';
session_start();

    $sql = "UPDATE users SET log_in='Offline' WHERE user_id='".$_SESSION['user_id']."' ";       //if user logged out from system updated log_in value will we equal to offline
    if ($conn->query($sql) === TRUE) {
        session_destroy();          //current user and session destroys
        header("location:welcome_screen.php");
    }


 ?>