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

    $sql = "SELECT `password`,`email`,`first_name`,`last_name` FROM `user_info` WHERE `email`= '$email'";    
    $result = $conn->query($sql);

    #matching password with database
    if($result->num_rows>0)
    {
        while($data = $result->fetch_assoc())
        {
        if($data["password"]===$password)
        {
        $firstname= $row["first_name"];
        $lastname = $row["last_name"];
        $email  = $row["email"];
        session_start();
        
        $_SESSION['first_name'] = "";
        $_SESSION['last_name'] = "";
        $_SESSION['email'] = "";
    
        $_SESSION['first_name'] = $firstname;
        $_SESSION['last_name'] = $lastname;
        $_SESSION['email'] = $email;
    
        header('location: index.php');
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

  <title>Admin - Login</title>

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
          <a class="d-block small mt-3" href="register.php">Register an Account</a>
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
