<!-- Getting the information of the user's friends -->
<?php

$conn = mysqli_connect("localhost", "root", "","tinder");
    
    //Identifying the user's friends
    $queryFriends = "select * from friendship where (friendship.first_user='".$_SESSION['user_id']."' or friendship.second_user='".$_SESSION['user_id']."' ) and friendship.is_okey='yes' ";
    $resultFriends = mysqli_query($conn, $queryFriends);

    while($rowfriends = mysqli_fetch_array($resultFriends)){
        //Getting the information of the user's friends from users
        $query="";
        if ($rowfriends['first_user']==$_SESSION['user_id']) {
            $query = "SELECT * FROM users where user_id={$rowfriends['second_user']}";
        }else{
            $query = "SELECT * FROM users where user_id={$rowfriends['first_user']}";
        }	
		$result = mysqli_query($conn, $query);
		$row_user = mysqli_fetch_assoc($result);

        $user_id = $row_user['user_id'];
        $user_name = $row_user['user_name'];
        $login = $row_user['log_in'];
        //Printing user's friends information(name, image, online or offline)
        echo"
            <li>
                <br></br>
                <div class = 'chat-left-detail'>
                    
                    <img class='avatar' style='width: 90%' src = {$row_user['user_picture']}>
                
                <p><a href='home.php?user_id=$user_id'>$user_name</a></p>";
            if($login == "Online"){
                echo"<span>Online</span>";
            }
            else{
                echo"<span>Offline</span>";
            }
            "
                </div>
            </li>

            ";
            
    }

?>