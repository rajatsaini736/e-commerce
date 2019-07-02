<?php
  include ("db.php");



  $email = "";
  $password = "";
  $database = "e_commerce";
  $loginErr = "";

  if(!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['Login']))
  {
    $email = $_POST['email'];
    $password = $_POST['password'];


    mysqli_select_db($conn,$database);

    $quer = "SELECT `first_name`,`last_name`,`email`,`password`,`mobile` FROM `user_info` WHERE `email`='$email'";
    
    $result = $conn->query($quer);

    #matching password with database
    if($result->num_rows>0)
    {
        while($data = $result->fetch_assoc())
        {
        if($data["password"]===$password)
        {
          session_start();
          $_SESSION['first_name'] = "";
          $_SESSION['last_name'] = "";
          $_SESSION['email'] = "";
          $_SESSION['mobile'] = "";


          $_SESSION['first_name'] = $data["first_name"];
          $_SESSION['last_name'] = $data["last_name"];
          $_SESSION['email'] = $data["email"];
          $_SESSION['mobile'] = $data["mobile"];


          // STORING CURRENT PAGE
          $curr_page = $_SESSION["curr_page"];
          $name = $_SESSION['first_name'];
          $sq = "UPDATE  `user_info` SET `last_page` ='$curr_page' WHERE `first_name`='$name' ; ";
          

          if(mysqli_query($conn,$sq))
          {
            // echo "successfully added product";
          }

          // SHIFT TEMPORARY CART TO USER'S CART
        $session_name = session_id();

        $quer = "SELECT `cart` FROM `user_info` WHERE `first_name`='$session_name';";
        $result = mysqli_query($conn,$quer);
        if($result->num_rows>0)
        {
          while($data=$result->fetch_array())
          {
                $items = $data["cart"];
                $sq = "UPDATE  `user_info` SET `cart` =concat(ifnull(`cart`,''),' $items') WHERE `first_name`='$name' ; ";
                

                if(mysqli_query($conn,$sq))
                {
                  // echo "successfully added product";
                }  
          }
        }





        if(!empty($_SESSION['desti']) && !empty($_SESSION['source'])){
            $destination = $_SESSION['desti'];
            $_SESSION['desti'] = "";
            $_SESSION['source'] = "";
            header('location:'.$destination);
        }
        else{
          $first_name = $_SESSION["first_name"];
          $sq = "SELECT `last_page` FROM `user_info` WHERE `first_name`='$first_name';";
          $result = mysqli_query($conn,$sq);
          if($result->num_rows>0){
            while($data = $result->fetch_assoc()){
              $desti = $data["last_page"];
              header('location:'.$desti);
            }
          }
          
         }
          }
          else
          {
            $loginErr = "Incorrect Password";
          }
        }
    }
    else{
      $loginErr = "Please Sign-up first";
    }


  }

?>


<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Fashion - Login</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">
        <form method="POST">
          <p style="color: red;">
            <?php echo $loginErr ?>
          </p>
          <div class="form-group">
            <div class="form-label-group">
              <input type="email" name="email"  id="inputEmail" class="form-control" placeholder="Email address" required="required" autofocus="autofocus">
             <label for="inputEmail">Email address</label>

            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required="required">
              <label for="inputPassword">Password</label>
            </div>
          </div>
          <div class="form-group">
            <div class="checkbox">
              <label>
                <input type="checkbox" value="remember-me">
                Remember Password
              </label>
            </div>
          </div>
          <input type="submit" class="btn btn-primary btn-block" name="Login" value="Login">
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="sign_up.php">Register an Account</a>
          <a class="d-block small" href="forgot-password.html">Forgot Password?</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
