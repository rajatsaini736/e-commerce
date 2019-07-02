<?php 
session_start();
if(!empty($_GET["id"])){
          $_SESSION['admin_first_name'] = "";
          $_SESSION['admin_last_name'] = "";
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

  <title>Admin - Dashboard</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.html">Admin</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
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
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Charts</li>
        </ol>

        <!-- Area Chart Example-->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-chart-area"></i>
            Area Chart Example</div>
          <div class="card-body">
            <canvas id="myAreaChart" width="100%" height="30"></canvas>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>

      </div>
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

  <!-- Page level plugin JavaScript-->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-bar-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>
