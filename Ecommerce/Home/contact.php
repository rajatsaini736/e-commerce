<?php

include('db.php');
include('function.php');
$database = "e_commerce";
mysqli_select_db($conn,$database);
session_start();

if(!empty($_GET["id"])){
        $_SESSION['first_name'] = "";
        $_SESSION['last_name'] = "";
        $_SESSION['email'] = "";
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

<div class="container _1m-catcon " style="margin-top: -20px;" >
<ul class="row _1m-catrow" >
 
                    <li><div class="col-4-lg ml-2 _1m-cardbg" >
                            <div class="card _1m-cardw" ><br>
                             <a href="#" ><img src="./Images/adTitanic.jpg" alt="card Two" class="card-img-top _1m-cardimg" ></a>
                              <div class="card-body _1m-cardm">
                              <p class="a _1m-des">Name:- Rakesh Kumawat</p>
                              <p class="a _1m-des">Email: rakeskumarkumawat@gmail.com</p>
                              <p class="a _1m-des">Contact:- 8503875941</p><br>
                              </div>
                            </div>
                          </div></li>
                        <li><div class="col-4-lg ml-2 _1m-cardbg" style="margin-left: -20px;">
                            <div class="card _1m-cardw" ><br>
                             <a href="#" ><img src="./Images/adTitanic.jpg" alt="card Two" class="card-img-top _1m-cardimg" ></a>
                              <div class="card-body _1m-cardm">
                              <p class="a _1m-des">Name:- Rajat Saini</p>
                              <p class="a _1m-des">Email: rajatsaini736@gmail.com</p>
                              <p class="a _1m-des">Contact:- 7073491568</p><br>
                              </div>
                            </div>
                          </div></li>
                          <li><div class="col-4-lg ml-2 _1m-cardbg" style="margin-left: -20px;">
                            <div class="card _1m-cardw" ><br>
                             <a href="#" ><img src="./Images/adTitanic.jpg" alt="card Two" class="card-img-top _1m-cardimg" ></a>
                              <div class="card-body _1m-cardm">
                              <p class="a _1m-des">Name:- Rakesh Kumawat</p>
                              <p class="a _1m-des">Email: rakeskumarkumawat@gmail.com</p>
                              <p class="a _1m-des">Contact:- 8503875941</p><br>
                              </div>
                            </div>
                          </div></li>
                          <li><div class="col-4-lg ml-2 _1m-cardbg" >
                            <div class="card _1m-cardw" ><br>
                             <a href="#" ><img src="./Images/adTitanic.jpg" alt="card Two" class="card-img-top _1m-cardimg" ></a>
                              <div class="card-body _1m-cardm">
                              <p class="a _1m-des">Name:- Rakesh Kumawat</p>
                              <p class="a _1m-des">Email: rakeskumarkumawat@gmail.com</p>
                              <p class="a _1m-des">Contact:- 8503875941</p><br>
                              </div>
                            </div>
                          </div></li>




</ul>
</div>

</body>
<!-- /.Header -->
<?php 
   footer();
  ?>
  </html>