



<?php include "header.php";  ?>





<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 offset-lg-2 text-center">
        <div class="breadcrumb-text">
          <p>Show your friendship requests which you sent</p>
          <h1>Outgoing Friendship Requests</h1>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end breadcrumb section -->



<div class="contact-from-section mt-150 mb-150">
  <?php 

  if(@$_GET["status"]=="deletedFriendship"){?>
    <center><div class="col-lg-4"><b style="color: green;">User has been deleted from your friend reqeusts succesfully</b></div></center>


  <?php } ?>
  
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
              <th scope="col">Status</th>
              <th scope="col"><center>Actions</center></th>


            </tr>
          </thead>
          <tbody>

            <?php 

            
            
            while ($row = mysqli_fetch_array($resultOutgoingFriendship)){?>   <!-- printing outgoing request friendship of current user.Query of resultOutgoingFriendship existing in header part because every page counts how many friendship request there are and print it -->

              <tr>


                 <!--  print user information using with boostrap table  -->


                <th scope="row"><?php echo $row['friendship_id'] ?></th>
                <td><?php echo $row['user_name'] ?></td>
                <td><?php echo $row['user_surname'] ?></td>
                <td><img style="width:25%;" src="<?php echo $row['user_picture'] ?>"></td>
                <td><?php echo $row['user_email'] ?></td>
                <td><?php echo $row['created_date'] ?></td>
                <td><?php echo $row['is_okey'] ?></td>
                <td><center><a href="show-user-profile.php?user_id=<?php echo $row['user_id'] ?>" class="btn btn-primary"><span style="color:white;">Show</span></a>&emsp;<a href="actions.php?removeFriend=ok&friendshipId=<?php echo $row['friendship_id']; ?>&whichPage=outgoingFriendship" class="btn btn-danger">Delete</a></center></td>
              </tr>

            <?php } ?>


          </tbody>

        </table>



        <?php        //if there is no outgoing friendship request
        
          if(mysqli_num_rows($resultOutgoingFriendship)==0){?>
            <center><p style="color:red;">There is no sending friendship request.Sorry :(</p></center>

          <?php }  ?>




      </div>



    </div>
  </div>
</div>









<?php include "footer.php"; ?>