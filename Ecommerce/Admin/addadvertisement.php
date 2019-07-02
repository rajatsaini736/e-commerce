<?php
  include("db.php");
  session_start();
  if(!empty($_GET["id"])){
          $_SESSION['admin_first_name'] = "";
          $_SESSION['admin_last_name'] = "";
  }

  $catName = "";
  $catDes = "";
  $catImg = "";
  $adErr = "";
  $adSuc = "";
  $dadErr1 = "";
  $dadSuc1 = "";

  $dadErr2 = "";
  $dadSuc2 = "";

  $prErr = "";
  $prSuc = "";
  $database = "e-commerce";

  if(!empty($_POST['addcatID']) && !empty($_POST['category_id'])){
    $catID = $_POST['category_id'];

    mysqli_select_db($conn,$database);

    $quer = "UPDATE`admin` SET `catID`='$catID';";
    if(mysqli_query($conn,$quer)){
      $prSuc = "Category ID successfully inserted";
    }
    else{
      $prErr = "Failed to insert category ID";
    }

}
if(!empty($_POST['dsplAdd1']) && !empty($_POST['advertisment_id1'])){
  $adID1 = $_POST['advertisment_id1'];
  mysqli_select_db($conn,$database);

  $sql = "UPDATE`admin` SET `adID1`='$adID1';";
  if(mysqli_query($conn,$sql)){
    $dadSuc1 = "Advertisement will successfully displayed";
  }
  else{
    $dadErr1 = "Failed to display advertisment";
  }
}

if(!empty($_POST['dsplAdd2']) && !empty($_POST['advertisment_id2'])){
  $adID2 = $_POST['advertisment_id2'];
  mysqli_select_db($conn,$database);

  $sql = "UPDATE`admin` SET `adID2`='$adID2';";
  if(mysqli_query($conn,$sql)){
    $dadSuc2 = "Advertisement will successfully displayed";
  }
  else{
    $dadErr2 = "Failed to display advertisment";
  }
}


  if(!empty($_POST['addAdd']) && !empty($_POST['category_name'])){
    $catName = $_POST['category_name'];
    $img = $_FILES["img"]["name"];

    mysqli_select_db($conn,$database);


    $quer = "INSERT INTO `advertisment`(`ad_img`,`ad_category`)VALUES('$img','$catName') ; ";


    if(mysqli_query($conn,$quer)){
      $adSuc = "Advertisement successfully added";
    }
    else{
      $adErr = "Failded to add Advertisement";
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

  <title>Admin - Add Advertisment</title>

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
        <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
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
            <a href="#">Display Product Advertisement</a>
          </li>
        </ol>

    <form method="POST" enctype="multipart/form-data" style="margin-bottom: 10px;">
      <p style="color: red;">
            <?php echo $prErr ?>
      </p>
      <p style="color: green;">
            <?php echo $prSuc ?>
      </p>  
 
          <div class="input-group mb-3">
           <select class="custom-select" id="inputGroupSelect03" name="category_id">
            <option selected>Category ID</option>
            <?php 
                  $sql = "SELECT * FROM `category` ";
                  $result = mysqli_query($conn,$sql);
                  if($result->num_rows>0){

                          while($data = $result->fetch_array())
                          {
                            echo '<option value="'.$data["cid"].'">'.$data["cid"].' - '.$data["name"].'</option>';

                          }
                        }
                          ?>
              </select>
            </div>

          <input type="submit" class="btn btn-primary btn-block" name="addcatID" value="Add">

    </form>

<ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Display Advertisement 1</a>
          </li>
        </ol>

    <form method="POST" enctype="multipart/form-data">
      <p style="color: red;">
            <?php echo $dadErr1 ?>
      </p>
      <p style="color: green;">
            <?php echo $dadSuc1 ?>
      </p>  
 
          <div class="input-group mb-3">
           <select class="custom-select" id="inputGroupSelect03" name="advertisment_id1">
            <option selected>Select advertisment 1 </option>
            <?php 
                  $sql = "SELECT * FROM `advertisment` ";
                  $result = mysqli_query($conn,$sql);
                  if($result->num_rows>0){

                          while($data = $result->fetch_array())
                          {
                            echo '<option value="'.$data["aid"].'">'.$data["aid"].' - '.$data["ad_category"].'</option>';

                          }
                        }
                          ?>
              </select>
            </div>

          <input type="submit" class="btn btn-primary btn-block" name="dsplAdd1" value="Save">

    </form>


<ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Display Advertisement 2</a>
          </li>
        </ol>

    <form method="POST" enctype="multipart/form-data">
      <p style="color: red;">
            <?php echo $dadErr2 ?>
      </p>
      <p style="color: green;">
            <?php echo $dadSuc2 ?>
      </p>  
 
          <div class="input-group mb-3">
           <select class="custom-select" id="inputGroupSelect03" name="advertisment_id2">
            <option selected>Select advertisment 2 </option>
            <?php 
                  $sql = "SELECT * FROM `advertisment` ";
                  $result = mysqli_query($conn,$sql);
                  if($result->num_rows>0){

                          while($data = $result->fetch_array())
                          {
                            echo '<option value="'.$data["aid"].'">'.$data["aid"].' - '.$data["ad_category"].'</option>';

                          }
                        }
                          ?>
              </select>
            </div>

          <input type="submit" class="btn btn-primary btn-block" name="dsplAdd2" value="Save">

    </form>    


    <h4 style="text-align: center; margin-top: 10px; margin-bottom: 10px;">OR !</h4>
       <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Add Advertisement</a>
          </li>
        </ol>

       <form method="POST" enctype="multipart/form-data">
      <p style="color: red;">
            <?php echo $adErr ?>
      </p>
      <p style="color: green;">
            <?php echo $adSuc ?>
      </p>  
 
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
                  <input type="file" name="img" id="img" class="form-control" placeholder="Advertisement Image" required="required">
                  <label for="img">Image</label>
                </div>
              </div>
            </div>
          </div>
          <input type="submit" class="btn btn-primary btn-block" name="addAdd" value="Add">

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
