



<?php include "header.php";  ?>





<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 offset-lg-2 text-center">
        <div class="breadcrumb-text">
          <p>Show your all friends</p>
          <h1>List Of Your Friends</h1>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end breadcrumb section -->


<!-- contact form -->
<div class="contact-from-section mt-150 mb-150">
  <?php 

  if(@$_GET["status"]=="deletedFriendship"){?>
    <center><div class="col-lg-4"><b style="color: green;">User has been deleted from your friends succesfully</b></div></center>


  <?php }?>
  
  <br><br>

  <div class="container">
    <div class="row">


      <div class="col-lg-12 mb-5 mb-lg-0">



        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Surname</th>
              <th scope="col">Image</th>
              <th scope="col">Email</th>
              <th scope="col">Coming Date</th>
              <th scope="col"><center>Actions</center></th>


            </tr>
          </thead>
          <tbody>

            <?php 



             
          //  printing friends of current user  usinsg with query of resultFriends existing in header part because every page counts how many friends user have and print it 
            while ($rowfriends = mysqli_fetch_array($resultFriends)){
            	$query="";
            	if ($rowfriends['first_user']==$rowUser['user_id']) {    //if in friendship table current user is first user get second user to print
            		$query = "SELECT * FROM users where user_id={$rowfriends['second_user']}";
            	}else{  //if in friendship table current user is second user get first user to print
            		$query = "SELECT * FROM users where user_id={$rowfriends['first_user']}";
            	}

            			
						$result = mysqli_query($conn, $query);
						$row = mysqli_fetch_assoc($result);

            	?>

              <tr>


              <!--   printing user informations -->

                <th scope="row"><?php echo $rowfriends['friendship_id'] ?></th>
                <td><?php echo $row['user_name'] ?></td>
                <td><?php echo $row['user_surname'] ?></td>
                <td><img style="width:25%;" src="<?php echo $row['user_picture'] ?>"></td>
                <td><?php echo $row['user_email'] ?></td>
                <td><?php echo $rowfriends['created_date'] ?></td>
                <td><center><a href="show-user-profile.php?user_id=<?php echo $row['user_id'] ?>" class="btn btn-primary"><span style="color:white;">Show</span></a>&emsp;<a href="actions.php?removeFriend=ok&friendshipId=<?php echo $rowfriends['friendship_id']; ?>" class="btn btn-danger">Delete</a></center></td>
              </tr>

            <?php } ?>


          </tbody>

        </table>



        <?php
        
        //if there is no friends print message

          if(mysqli_num_rows($resultFriends)==0){?>
            <center><p style="color:red;">There is no friends yet.Don't be sad.Send request anyone to be friend :(</p></center>

          <?php }  ?>




      </div>



    </div>
  </div>
</div>
<!-- end contact form -->








<?php include "footer.php"; ?>