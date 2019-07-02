<?php
  include("db.php");
  session_start();

  if(!empty($_GET["id"])){
          $_SESSION['admin_first_name'] = "";
          $_SESSION['admin_last_name'] = "";
  }
  if(!empty($_GET["id"])){
          $_SESSION['admin_first_name'] = "";
          $_SESSION['admin_last_name'] = "";
  }


  $subcategory="";
  $catName = "";
  $ScatDes = "";
  $catImg = "";
  $subcatErr = "";
  $subcatSuc = "";
  $database = "e-commerce";

  // echo $_POST['catName'];
  // echo $_POST['catDes'];
  // echo $_POST['catImg'];
  // echo $_POST['addcat'];


  if(!empty($_POST['SubcatName']) && !empty($_POST['category_name']) && !empty($_POST['ScatDes']) && !empty($_POST['addcat']))
  { $subcategory=$_POST['SubcatName'];
    $catName = $_POST['category_name'];
    $ScatDes = $_POST['ScatDes'];
    $catImg = $_FILES["img"]["name"];
    $check = 0;
      echo "string";
    mysqli_select_db($conn,$database);

          $quer = "SELECT * FROM `sub_category` WHERE `name`='$subcategory';";
          $result = mysqli_query($conn,$quer);
          #check for same category
          if($result->num_rows>0)
          {
            while($data = $result->fetch_array())
            {
              $check ++;

            }
          }

          if($check===0)
          {
            $sq = "INSERT INTO `sub_category`(`name`,`category_name`,`description`,`image`) VALUES ('$subcategory','$catName','$ScatDes','$catImg') ; ";
            if(mysqli_query($conn,$sq))
            {
              $subcatSuc = "Sub-category successfully inserted";
            }
          }
          else
          {
            $subcatErr = "Sub-category already exists";
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

  <title>SB Admin - Dashboard</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">



</head>

<body id="page-top">

  <!-- navbaar -->
  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="admin.php">Admin</a>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
    
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search " aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
          <button class="btn btn-primary" type="button">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
      <li style="color: #468cfc;">
        <?php 
          if (!empty($_SESSION['admin_first_name'])) {
            echo $_SESSION['admin_first_name'].$_SESSION['admin_last_name']." | ";
            echo '<a href="admin.php?id=log_out"> Log-out</a>';
          }
          else
          {
            echo '<a href="login.php">Login |</a>
        <a href="register.php"> Register</a>';
          }
         ?>
        
      </li>
    </ul>

  </nav>


  <div id="wrapper">

    <!-- Sidebar -->
      <ul class="sidebar navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="admin.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
        <li class="nav-item">
        <a class="nav-link" href="addadvertisement.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Add Advertisement</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="addcat.php">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Add Category</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="addsubcategory.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Add Subcategory</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="addpro.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Add Product</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="removecat.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Remove Category</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="removesubcategory.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Remove Subcategory</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="removepro.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Remove Product</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="listcat.php">
          <i class="fas fa-fw fa-table"></i>
          <span>List Category</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="listpro.php">
          <i class="fas fa-fw fa-table"></i>
          <span>List Product</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="managecustomer.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Manages Cusomers</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="manageorders.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Manage Orders</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="managesellar.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Manages Sellars</span></a>
      </li>
    </ul>


    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Add  Sub-Category</a>
          </li>
        </ol>

    <form method="POST" enctype="multipart/form-data">
      <p style="color: red;">
            <?php echo $subcatErr ?>
      </p>
      <p style="color: green;">
            <?php echo $subcatSuc ?>
      </p> 
 
          <div class="form-group">

            <div class="form-label-group">
              <input type="text" name="SubcatName" id="SubcatName" class="form-control" placeholder="Subcategory Name" required="required">
              <label for="SubcatName">Subcategory Name</label>
            </div>
          </div>
          <div class="input-group mb-3">
           <select class="custom-select" id="inputGroupSelect03" name="category_name">
            <option selected>Category Name</option>
            <?php 
    $sql = "SELECT * FROM `category` ";
    $result = mysqli_query($conn,$sql);
    if($result->num_rows>0){

            while($data = $result->fetch_array())
            {
              echo '<option value="'.$data["name"].'">'.$data["name"].'</option>';

            }
          }
            ?>
          </select>
       </div>
          
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" name="ScatDes" id="ScatDes" class="form-control" placeholder="Sub Category Description" required="required">
                  <label for="ScatDes">SubCategory Description</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" name="img" id="img" class="form-control" placeholder="Category Image" required="required">
                  <label for="img">Image</label>
                </div>
              </div>
            </div>
          </div>
          <input type="submit" class="btn btn-primary btn-block" name="addcat">

    </form>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © Your Website 2019</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>


</body>

</html>
