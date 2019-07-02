<?php
  include("db.php");

  $fistName = "";
  $lastName = "";
  $database = "e_commerce";
  $signupErr = "";
  $password = "";
  $confrmPassword = "";
  $email = "";


  if(!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['confirmPassword']) &&!empty($_POST['Register']))
  {

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confrmPassword = $_POST['confirmPassword'];
    $check =0;

    mysqli_select_db($conn,$database);

    $quer = "SELECT * FROM `admin` WHERE `email`='$email';";
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
      $sq = "INSERT INTO `admin` (`first_name`,`last_name`,`email`,`password`) VALUES ('$firstName','$lastName','$email','$password')";

      if(mysqli_query($conn,$sq))
      {
        session_start();
        $_SESSION['admin_first_name'] = "";
        $_SESSION['admin_last_name'] = "";
        $_SESSION['admin_email'] = "";


        $_SESSION['admin_first_name'] = $firstName;
        $_SESSION['admin_last_name'] = $lastName;
        $_SESSION['admin_email'] = $email;
        header('location: admin.php');
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

  <title>Admin - Register</title>

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
            <div class="form-label-group">
              <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required="required">
              <label for="inputEmail">Email address</label>
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
          <input type="submit" class="btn btn-primary btn-block" name="Register" value="Register">
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
