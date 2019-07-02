<?php
  include("db.php");

  $fistName = $mobile = $lastName = $signupErr = $password = $confrmPassword = $email = "";
  $database = "e_commerce";
  

  if(!empty($_POST['email']) && !empty($_POST['mobile']) && !empty($_POST['password']) && !empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['confirmPassword']) &&!empty($_POST['Register']))
  {

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];
    $confrmPassword = $_POST['confirmPassword'];
    $check =0;

    mysqli_select_db($conn,$database);

    $quer = "SELECT * FROM `user_info` WHERE `email`='$email';";
    $result = mysqli_query($conn,$quer);

    #check wheeher the user is already register or not
    if($result->num_rows>0)
    {
      while($data = $result->fetch_array())
      {
        $check ++;
      }
    }

    #if user is new then insert it into databae
    if($check==0)
    { 
      $sq = "INSERT INTO `user_info` (`first_name`,`last_name`,`email`,`mobile`,`password`) VALUES ('$firstName','$lastName','$email','$mobile','$password')";

      if(mysqli_query($conn,$sq))
      {
        session_start();
        $_SESSION['first_name'] = "";
        $_SESSION['last_name'] = "";
        $_SESSION['email'] = "";
        $_SESSION['mobile'] = "";
    
        $_SESSION['first_name'] = $firstName;
        $_SESSION['last_name'] = $lastName;
        $_SESSION['email'] = $email;
        $_SESSION['mobile'] = $mobile;
    
        if(!empty($_SESSION['desti']) && !empty($_SESSION['source'])){
            $destination = $_SESSION['desti'];
            $_SESSION['desti'] = "";
            $_SESSION['source'] = "";
            header('location:'.$destination);
        }
        else{
               header('location: index.php');
         }
      }

    }
    else
    {
      $signupErr = "You are already register, plz log-in";
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

  <title>Fashion - Register</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Register an Account</div>
      <div class="card-body">
        <form method="POST">
          <p style="color: red;">
            <?php echo $signupErr ?>
          </p>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" name="firstName" id="firstName" class="form-control" placeholder="First name" required="required" autofocus="autofocus">
                  <label for="firstName">First name</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" name="lastName" id="lastName" class="form-control" placeholder="Last name" required="required">
                  <label for="lastName">Last name</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required="required">
                  <label for="inputEmail">Email address</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Mobile Number" required="required">
                  <label for="mobile">Mobile Number</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required="required">
                  <label for="inputPassword">Password</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="password" name="confirmPassword" id="confirmPassword" class="form-control" placeholder="Confirm password" required="required">
                  <label for="confirmPassword">Confirm password</label>
                </div>
              </div>
            </div>
          </div>
          <input type="submit" class="btn btn-primary btn-block" name="Register">
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="login.php">Login Page</a>
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
