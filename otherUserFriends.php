



<?php include "header.php";  

$user_id="";


if (isset($_GET['user_id'])) {
  $user_id=$_GET['user_id'];        //getting id of the user we want to look at the friend list
} else {
  header("location:404.php");
}




$query = "SELECT * FROM users where user_id=$user_id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result)        //reaching this user row




?>




<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 offset-lg-2 text-center">
        <div class="breadcrumb-text">
          <p>Show all <?php echo $row['user_name']." ".$row['user_surname'] ?> 's friends</p>
          <h1>Friends of <?php echo $row['user_name']." ".$row['user_surname'] ?></h1>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end breadcrumb section -->



<!-- products -->
<div class="product-section mt-150 mb-150">
  <div class="container">

    <div class="row">
      <div class="col-md-12">
        <div class="product-filters">
          <ul>
            <li class="active" data-filter="*">All Friends</li>
            <li data-filter=".Male">Male</li>
            <li data-filter=".Female">Female</li>

          </ul>
        </div>
      </div>
    </div>

    <div class="row product-lists">


      <?php 
      
      //fetch operations for friends of this user

      $queryFriends = "select * from friendship where (friendship.first_user='$user_id' or friendship.second_user='$user_id') and friendship.is_okey='yes' ";
      $resultFriends = mysqli_query($conn, $queryFriends);

      while ($rowfriends = mysqli_fetch_array($resultFriends)){

        $query="";
        if ($rowfriends['first_user']==$user_id) {
          $query = "SELECT * FROM users where user_id={$rowfriends['second_user']}";
        }else{
          $query = "SELECT * FROM users where user_id={$rowfriends['first_user']}";
        }


        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);     //get user informations


      ?>




      <!-- printing user informations -->



      <div class="col-lg-4 col-md-6 text-center <?php echo $row['user_gender']; ?> ">
        <div class="single-product-item">
          <div class="product-image">
            <a href="show-user-profile.php?user_id=<?php echo $row['user_id'] ?>"><img src="<?php echo $row['user_picture']; ?>" alt=""></a>
          </div>
          <h3><?php echo $row['user_name'].' '.$row['user_surname']; ?></h3>
          <p class="product-price"><span><?php echo $row['user_gender'] ?></span></p>
          <a href="show-user-profile.php?user_id=<?php echo $row['user_id'] ?>" class="cart-btn"><i class="fas fa-eye"></i>Show Profile</a><br><br>




          <?php 

            // while printing be friend button system controls the database if there is a friendship request between this user and me 


          $user_id=$row['user_id'];

          $queryFriendship = "SELECT * FROM friendship where (first_user={$rowUser['user_id']} and second_user={$user_id}) or (first_user={$user_id} and second_user={$rowUser['user_id']})";
          $resultFriendship = mysqli_query($conn, $queryFriendship);
          $rowFriendship= mysqli_fetch_assoc($resultFriendship);
          if(mysqli_num_rows($resultFriendship)>=1){

            if ($rowFriendship['is_okey']=="yes") {?>   <!-- if request is approved -->

            <a href="actions.php?removeFriend=ok&second_user=<?php echo $row['user_id'] ?>&friendshipId=<?php echo $rowFriendship['friendship_id']; ?>" style="background-color: red;" class="cart-btn"><i class="fas fa-user-friends"></i>Remove Friend</a>

            <?php }else{ ?>   <!-- if request is waiting -->

            <a href="" style="background-color: green;" class="cart-btn"><i class="fas fa-user-friends"></i>Waiting</a>

          <?php } ?>






        <?php }else{ 


          if ($rowUser['user_id']==$user_id) {?>    <!-- if user is  yourself href is blank-->

          <a href="" style="background-color: gray;" class="cart-btn"><i class="fas fa-user-friends"></i>Be Friend</a>

          <?php }else{ ?>  <!-- if user is not yourself -->
          <a href="actions.php?beFriends=ok&second_user=<?php echo $row['user_id'] ?>" style="background-color: blue;" class="cart-btn"><i class="fas fa-user-friends"></i>Be Friend</a>

        <?php } ?>


      <?php } ?>





    </div>




  </div>

<?php }?>


</div>


  <?php     //if user has no friends

       if(mysqli_num_rows($resultFriends)==0){?>
          <center><p style="color:red;">This user doesn't have any friends</p></center>
       <?php } ?>


<br><br>

<div class="row">
  <div class="col-lg-12 text-center">
    <div class="pagination-wrap">
      <ul>
        <li><a href="#">Prev</a></li>
        <li><a href="#">1</a></li>
        <li><a class="active" href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">Next</a></li>
      </ul>
    </div>
  </div>
</div>
</div>
</div>
<!-- end products -->

<!-- logo carousel -->
<div class="logo-carousel-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="logo-carousel-inner">
          <div class="single-logo-item">
            <img src="assets/img/company-logos/1.png" alt="">
          </div>
          <div class="single-logo-item">
            <img src="assets/img/company-logos/2.png" alt="">
          </div>
          <div class="single-logo-item">
            <img src="assets/img/company-logos/3.png" alt="">
          </div>
          <div class="single-logo-item">
            <img src="assets/img/company-logos/4.png" alt="">
          </div>
          <div class="single-logo-item">
            <img src="assets/img/company-logos/5.png" alt="">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end logo carousel -->


<?php  include "footer.php"; ?>