



<?php include "header.php";  ?>





<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 offset-lg-2 text-center">
        <div class="breadcrumb-text">
          <p>Accept or reject your friendship requests</p>
          <h1>Coming Friendship Requests</h1>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end breadcrumb section -->


<!--printing suitable message to use messageKeywords-->
<div class="contact-from-section mt-150 mb-150">
  <?php 

  if(@$_GET["status"]=="accept"){?>
    <center><div class="col-lg-4"><b style="color: green;">User has been added to your friends succesfully</b></div></center>


  <?php }elseif(@$_GET["status"]=="no"){?> 
    <center><div class="col-lg-4"><b style="color: red;">An error occurred...</b></div></center>

  <?php }elseif(@$_GET["status"]=="deletedFriendship"){?> 
    <center><div class="col-lg-4"><b style="color: red;">User has been deleted from your friends succesfully...</b></div></center>

  <?php }?>
  
  <br><br>

  <div class="container">
    <div class="row">


      <div class="col-lg-12 mb-5 mb-lg-0">



        <table class="table table-striped">               <!-- creating table using boostrap -->
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Surname</th>
              <th scope="col">Image</th>
              <th scope="col">Email</th>
              <th scope="col">Coming Date</th>
              <th scope="col">Status</th>
              <th style="width:400px;" scope="col"><center>Actions</center></th>


            </tr>
          </thead>
          <tbody>

            <?php 

             
            
            while ($row = mysqli_fetch_array($resultComingFriendship)){?>       <!-- printing coming request friendship to current user.Query of resultComingFriendship existing in header part because every page counts how many friendship request there are and print it -->

              <tr>
                     <!--  printing user informations -->

                <th scope="row"><?php echo $row['friendship_id'] ?></th>
                <td><?php echo $row['user_name'] ?></td>
                <td><?php echo $row['user_surname'] ?></td>
                <td><img style="width:25%;" src="<?php echo $row['user_picture'] ?>"></td>
                <td><?php echo $row['user_email'] ?></td>
                <td><?php echo $row['created_date'] ?></td>
                <td><?php echo $row['is_okey'] ?></td>
                <td><center><a href="actions.php?acceptFriend=ok&friendshipId=<?php echo $row['friendship_id'] ?>" class="btn btn-success"><span style="color:white;">Accept</span></a>&emsp;<a href="show-user-profile.php?user_id=<?php echo $row['user_id'] ?>" class="btn btn-primary"><span style="color:white;">Show</span></a>&emsp;<a href="actions.php?removeFriend=ok&friendshipId=<?php echo $row['friendship_id']; ?>&whichPage=comingFriendship" class="btn btn-danger">Reject</a></center></td>
              </tr>

            <?php } ?>


          </tbody>

        </table>



        <?php
        
          if(mysqli_num_rows($resultComingFriendship)==0){?>    <!-- if there is no friendsip request -->
            <center><p style="color:red;">There is no friendship request.Sorry :(</p></center>

          <?php }  ?>




      </div>



    </div>
  </div>
</div>
<!-- end contact form -->








<?php include "footer.php"; ?>