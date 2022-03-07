<!DOCTYPE html>
<?php
session_start();
include("connection.php");
//Keep user email from sign_in
if(!isset($_SESSION['user_email'])){
    header("location: sign_in.php");
}
else { ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Screen</title>

    <!-- chatHomeScreen css -->
    <link rel="stylesheet" href="chatScreen.css">
</head>
<body>
   <div class="container">
       <div class="up box ">

           <div class="box left-box">
               <!-- Button for Add new Friends -->
               <a class="btn" href="index.php">Add New User</a>
           </div>
           <div class="box right-box">
                <!-- Get user information from sign_in -->
                <?php
                    $user = $_SESSION['user_email'];
                    $get_user = "select * from users where user_email ='$user'";
                    $run_user = mysqli_query($conn, $get_user);
                    $row = mysqli_fetch_array($run_user);

                    $user_id = $row['user_id'];
                    $user_name = $row['user_name'];
                ?>
                <!-- Getting the information of the person the user will chat with -->
                <?php
                    if(isset($_GET['user_id'])){

                        global $conn;

                        $get_userid = $_GET['user_id'];
                        $get_user = "select * from users where user_id='$get_userid'";

                        $run_user = mysqli_query($conn, $get_user);

                        $row_user = mysqli_fetch_array($run_user);

                        $userid = $row_user['user_id'];
                        $username = $row_user['user_name'];
                            
                    }
                    //Finding the total number of messages with the people the user is talking to
                    $total_messages = "select * from users_chat where (sender_id='$user_id' AND receiver_id='$userid') OR (receiver_id='$user_id' AND sender_id='$userid')";
                    $run_messages = mysqli_query($conn, $total_messages);
                    $total = mysqli_num_rows($run_messages);
                ?>
                <!-- Printing the information of the people with whom the user is messaging to the upper screen -->
                <div class="right-header">
                    <div class="right-header-img">
                        <img src="<?php echo $row_user['user_picture']?>">
                    </div>
                    <div class = "right-header-detail">
                        <form method="post">
                            <p><?php echo "$username";?></p>
                            <span><?php echo $total; ?> messages</span>&nbsp &nbsp
                            <button name="logout" class="btn">Logout</button>
                        </form>
                        <!-- Log out -->
                        <?php
                        if(isset($_POST['logout'])){
                            $update_msg = mysqli_query($conn, "UPDATE users SET log_in='Offline' WHERE user_id='$user_id'");
                            header("Location:welcome_screen.php");
                            exit();
                        }
                        ?>
                    </div>
                </div>
           </div>
       </div>
       <div class="down box">
           <!-- Printing the user's friend list to the screen -->
            <div class="box left-box scr">
                <ul class="chat-list">
                    <!-- Getting the information of the user's friends -->
                    <?php include("get_users_data.php"); ?>
                    <!-- Retrieving the user's information after printing the friend list -->
                    <?php
                    $user = $_SESSION['user_email'];
                    $get_user = "select * from users where user_email ='$user'";
                    $run_user = mysqli_query($conn, $get_user);
                    $row = mysqli_fetch_array($run_user);

                    $user_id = $row['user_id'];
                    $user_name = $row['user_name'];
                    ?>

                </ul>
            </div>
            <div class="box right-box r2">
                <div class="box chat-sc">
                    <!-- Chat Screen -->
                    <?php
                        //Marking read messages as read
                        $update_msg = mysqli_query($conn, "UPDATE users_chat SET msg_status='read' WHERE sender_id='$userid' AND receiver_id='$user_id'");
                        
                        //Retrieving messages from user_chat table, which are people the user is talking to
                        $sel_msg = "select * from users_chat where (sender_id='$user_id' AND receiver_id='$userid') OR(receiver_id='$user_id' AND sender_id='$userid') ORDER by 1 ASC";
                        $run_msg = mysqli_query($conn, $sel_msg);

                        while($row = mysqli_fetch_array($run_msg)){
                            $sender_id = $row['sender_id'];
                            $receiver_id = $row['receiver_id'];
                            $msg_content = $row['msg_content'];
                            $msg_date = $row['msg_date'];
                            
                        
                        ?>
                        <!-- Printing messages -->
                        <ul>
                            <?php

                                if($user_id == $sender_id AND $userid == $receiver_id){

                                    echo"
                                        <li>
                                            <div class = 'rightside-left-chat'>
                                                <span> $user_name <small>$msg_date</small></span><br></br>
                                                <p>$msg_content</p>
                                            </div>
                                        </li>
                                    ";
                                }

                                else if($user_id == $receiver_id AND $userid == $sender_id){

                                    echo"
                                        <li>
                                            <div class = 'rightside-right-chat'>
                                                <span> $username <small>$msg_date</small></span><br></br>
                                                <p>$msg_content</p>
                                            </div>
                                        </li>
                                    ";
                                }
                                    
                            ?>
                        </ul>
                        <?php
                            }
                        ?>  
                </div>
                <!-- Writing messages -->
                <div class="box write">
                    <form method="post">
                        <input autocomplete="off" type="text" name="msg_content" placeholder="Write your message......" class="w">
                        <button class="wbtn" name="submit">Send message</button>
                    </form>
                    <!-- Writing the messages written by the user to the users_chat table by passing certain warnings -->
                    <?php
        
                            if(isset($_POST['submit'])){
                                
                                $msg = htmlentities($_POST['msg_content']);

                                if($msg == ""){

                                    echo "<script>alert('Message was unable to send.You can't send empty message')
                                    </script>";
                                }

                                else if(strlen($msg) > 100){

                                    echo "<script>alert('Message is too long .Use max 100 characters')
                                    </script>";
                                }

                                else{
                                    //insert messages to users_chat 
                                    $insert = "insert into users_chat(sender_id,receiver_id,msg_content,msg_status,msg_date) values('$user_id', '$userid', '$msg', 'unread', NOW())";
                                    $run_insert = mysqli_query($conn, $insert);
                                    echo "<script>
                                    window.location.replace('home.php?user_id=$userid');
                                    </script>";
                                }
                            }
                        ?>
                </div>

            </div>
       </div>
   </div>
   
</body>
</html>
<?php } ?>