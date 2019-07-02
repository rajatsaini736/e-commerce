<?php

include('db.php');
include('function.php');
$database = "e_commerce";
mysqli_select_db($conn,$database);
session_start();
$insrtErr = "";

if(!empty($_GET["id"])){
        $_SESSION['first_name'] = "";
        $_SESSION['last_name'] = "";
        $_SESSION['email'] = "";
} 

$mail = $_SESSION['email'];

$sq = "SELECT * FROM `user_info` WHERE `email`='$mail';";
$result = mysqli_query($conn,$sq);


if(!empty($_POST["submit"])){

  if(!empty($_POST["address"]) && !empty($_POST["pincode"])){

    $address = $_POST["address"];
    $pincode = $_POST["pincode"];

    $_SESSION["address"] = "";
    $_SESSION["address"] = $address;    

    $sq = "UPDATE `user_info` SET `address`='$address',`pincode`='$pincode' WHERE `email`='$mail';";
    if(mysqli_query($conn,$sq)){
      header('location: payment.php');
    }
    else{
      $insrtErr = "Failed to insert your details";
    }
  }
  header('location: payment.php');

}


?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="stylesheet.css">
  <script src="img_scroller.js"></script>

</head>
<body>

  <!-- Header -->

  <?php
nav();
?>
<div class="container _1m-catcon">  
  <div class="row _1m-catrow">
          <p style="color: red;">
            <?php echo $insrtErr ?>
          </p>


<?php

if($result->num_rows>0){

  $data = $result->fetch_assoc();

  echo ' <form method="POST">

          <div class="form-group">
            <div class="form-row">
                  <label for="firstName">First Name - </label>
                  <label for="firstName">'.$data["first_name"].'</label>
            </div>
          </div>

          <div class="form-group">
            <div class="form-row">
                  <label for="firstName">Last Name - </label>
                  <label for="firstName">'.$data["last_name"].'</label>
            </div>
          </div>

          <div class="form-group">
            <div class="form-row">
                  <label for="firstName">Email - </label>
                  <label for="firstName">'.$data["email"].'</label>
            </div>
          </div>

          <div class="form-group">
            <div class="form-row">
                  <label for="firstName">Mobile - </label>
                  <label for="firstName">'.$data["mobile"].'</label>
            </div>
          </div>';
          if(!empty($data["address"]) || !empty($data["pincode"])){
            $_SESSION["address"] = "";
            $_SESSION["address"] = $data["address"];
            echo '
           <div class="form-group">
            <div class="form-row">
                  <label for="firstName">Address - </label>
                  <label for="firstName">'.$data["address"].'</label>
            </div>
          </div>

          <div class="form-group">
            <div class="form-row">
                  <label for="firstName">Pincode - </label>
                  <label for="firstName">'.$data["pincode"].'</label>
            </div>
          </div>          
            ';
          }
          else{
          echo '
           <div class="form-group">
            <div class="form-row">
                  <label for="firstName">Address - </label>
                  <input type="text" name="address" id="inputAddress" placeholder="Address" required="required" size="35">
            </div>
          </div>

          <div class="form-group">
            <div class="form-row">
                  <label for="firstName">Pincode - </label>
                  <input type="text" name="pincode" id="inputPincode"  placeholder="Pincode" required="required" size="35">
            </div>
          </div>          
            ';
          }

          echo '
        <input type="submit" class="btn btn-primary" style="margin-bottom:10px;" name="submit"  value = "Continue to Payment...">
        </form>';
          





}



?>
</div>
</div>

<!-- /.Header -->



<!-- Content -->


<!-- /.Content -->
	</body>
<!-- Footer -->
<?php 
   footer();
  ?>oter -->
	</html>