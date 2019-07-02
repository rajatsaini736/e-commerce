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

$_SESSION["curr_page"] = "index.php";


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
<!-- /.Header -->

<!-- Image Slider -->
<div class="shadow-lg p-3 mb-5 bg-white rounded _1m-margin" >
<div class="container _1m-w" >
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <div class="item active">
       <a href="#" > <img src="./Images/ad_festival.jpg" alt="Women Fashion" class="s-img"></a>
      </div>

      <div class="item">
       <a href="#" > <img src="./Images/img_slider_coca.jpg" alt="electronic" class="s-img"></a>
      </div>
    
      <div class="item">
        <a href="#" ><img src="./Images/imgslider_camera.jpg" alt="Man Fashion" class="s-img"></a>
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
 
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>
</div><br>
<!-- /.Image Slider -->


<h2 class="_1m-h2"> Featured Category</h2>

<!-- Content -->
<div class="container _1m-catcon" >
<ul class="row _1m-catrow">
  <?php       
              $sql = "SELECT * FROM `category` ";
              $result = mysqli_query($conn,$sql);
              if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) {
                    echo '<li><div class="col-4-lg ml-2 _1m-cardbg" >
                            <div class="card _1m-cardw" ><br>
                            <h4 class="card-title _1m-title" ><a href="sub_category.php?cid='.$row["name"].'" class="_1m-titleh">'.$row["name"].'</a></h4>
                             <a href="sub_category.php?cid='.$row["name"].'" ><img src="./Images/'.$row["image"].'" alt="card Two" class="card-img-top _1m-cardimg" ></a>
                              <div class="card-body _1m-cardm">
                              <p class="a _1m-des">'.$row["description"].'</p><br>
                              </div>
                            </div>
                          </div></li>';
                          
                  }
              } else {
                  /*echo "0 results";*/
              }
?>

</ul>
</div>


<!-- ADVERTISMENT -->

<div class="container _1m-adAD" >
<!--   <h2 class="_1m-h2">Today's Deal</h2> -->
  <?php 
      $sql = "SELECT * FROM `advertisment`WHERE `aid` IN(SELECT `adID1` FROM `admin`) ;";
      $result = mysqli_query($conn,$sql);
      if($result->num_rows>0){
        while($row = $result->fetch_assoc()){
          echo '<a href="sub_category.php?cid='.$row["ad_category"].'" ><img src="./Images/'.$row["ad_img"].'" class="_1m-adimg"></a>';
        }
      }

  ?>

</div>

<div class="container">
    <h2 class="_1m-h2">From the best sellar's</h2>

  <div class="row">
    
    <div class="MultiCarousel" data-items="1,3,5,6" data-slide="6" id="MultiCarousel"  data-interval="1000">
            <div class="MultiCarousel-inner">
                <?php
          
                    $quer = "SELECT * FROM `admin`;";
                    $res = mysqli_query($conn,$quer);
                    if($res->num_rows>0){
                    while ($data = $res->fetch_assoc()) {
                        $catid = $data["catID"];
                        $qr = "SELECT * FROM `product` WHERE `category` IN (SELECT `name` FROM `category` WHERE `cid`='$catid');";
                        $result = mysqli_query($conn,$qr);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                              $pid = $row["pid"];
                              echo '<div class="item">
                                        <div class="pad15">
                                            <a href="pro_des.php?pid='.$pid.'"><img  href= "#" src="./Images/'.$row["image"].'" style="height: 17rem;width: 15rem;"></a>
                                           <a href="pro_des.php?pid='.$pid.'"><p style="font-weight:bold;color:black;">'.$row["product_name"].'</p></a>
                                        </div>
                                    </div>';
                                    
                            }
                        } else {
                            /*echo "0 results";*/
                        }

                      }
                    }



                    
              ?>

            </div>
            <button class="btn btn-primary leftLst"><</button>
            <button class="btn btn-primary rightLst">></button>
        </div>
  </div>
</div>


<!-- ADVERTISMENT -->

<div class="container _1m-adcon" >
<!--   <h2 class="_1m-h2"></h2> -->
  <?php 
      $sql = "SELECT * FROM `advertisment`WHERE `aid` IN(SELECT `adID2` FROM `admin`) ;";
      $result = mysqli_query($conn,$sql);
      if($result->num_rows>0){
        while($row = $result->fetch_assoc()){
          echo '<a href="sub_category.php?cid='.$row["ad_category"].'" ><img src="./Images/'.$row["ad_img"].'" class="_1m-adimg"></a>';
        }
      }

  ?>

</div>

<div class="container">
    <h2 class="_1m-h2">Based on your recent search </h2>

  <div class="row">
    
    <div class="MultiCarousel" data-items="1,3,5,6" data-slide="6" id="MultiCarousel"  data-interval="1000">
            <div class="MultiCarousel-inner">
                <?php

                    if(!empty($_SESSION["first_name"]) && !empty($_SESSION["last_name"]))
                    {
                        $name = $_SESSION["first_name"];
                    }
                    else{
                      $name = session_id();
                    }
                    $sq = "SELECT `cart` FROM `user_info` WHERE `first_name`='$name';";
                    $op = mysqli_query($conn,$sq);
                    if($op->num_rows>0){
                      while($data = $op->fetch_assoc()){
                        $cart = $data["cart"];
                      }
                    }
                    if($cart == NULL){
                          $sql = "SELECT * FROM `advertisment`WHERE `aid` IN(SELECT `adID2` FROM `admin`) ;";
                          $result = mysqli_query($conn,$sql);
                          if($result->num_rows>0){
                            while($row = $result->fetch_assoc()){
                                $cat = $row["ad_category"];
                              }
                          } 
                        $qr = "SELECT * FROM `product` WHERE `category`='$cat';";
                        $result = mysqli_query($conn,$qr);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                              $pid = $row["pid"];
                              echo '<div class="item">
                                        <div class="pad15">
                                            <a href="pro_des.php?pid='.$pid.'"><img  href= "#" src="./Images/'.$row["image"].'" style="height: 17rem;width: 15rem;"></a>
                                           <a href="pro_des.php?pid='.$pid.'"><p style="font-weight:bold;color:black;">'.$row["product_name"].'</p></a>
                                        </div>
                                    </div>';
                                    
                            }
                        }

                    }
                    else{
                      $items = explode(" ", $cart);
                      $subcat_names = "";
                      foreach ($items as $key) {
                        $sq = "SELECT `sub_category` FROM `product` WHERE `pid`='$key';";
                        $res = mysqli_query($conn,$sq);
                        if($result->num_rows>0){
                          while($row = $res->fetch_assoc()){
                              if(preg_match("/{$row["sub_category"]}/i", $subcat_names)) {
                                    continue;
                                }
                                else{
                                    $subcat_names .= $row["sub_category"]." ";
                                }
                          }
                        }
                      }
                      $subcatnames = explode(" ", $subcat_names);
                      foreach ($subcatnames as $key) {
                        $qr = "SELECT * FROM `product` WHERE `sub_category`='$key';";
                        $result = mysqli_query($conn,$qr);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                              $pid = $row["pid"];
                                    echo '<div class="item">
                                        <div class="pad15">
                                            <a href="pro_des.php?pid='.$pid.'"><img  href= "#" src="./Images/'.$row["image"].'" style="height: 17rem;width: 15rem;"></a>
                                           <a href="pro_des.php?pid='.$pid.'"><p style="font-weight:bold;color:black;">'.$row["product_name"].'</p></a>
                                        </div>
                                    </div>';
                                    
                              // if (preg_match("/{$pid}/i", $cart)) {
                              //   continue;
                              // }
                              // else{
                              //                 echo '<div class="item">
                              //           <div class="pad15">
                              //               <a href="pro_des.php?pid='.$pid.'"><img  href= "#" src="./Images/'.$row["image"].'" style="height: 17rem;width: 15rem;"></a>
                              //              <a href="pro_des.php?pid='.$pid.'"><p style="font-weight:bold;color:black;">'.$row["product_name"].'</p></a>
                              //           </div>
                              //       </div>';
                              // }


                                    
                            }
                        }
                      }
                    }









                    // $quer = "SELECT * FROM `admin`;";
                    // $res = mysqli_query($conn,$quer);
                    // if($res->num_rows>0){
                    // while ($data = $res->fetch_assoc()) {
                    //     $catid = $data["catID"];
                    //     $qr = "SELECT * FROM `product` WHERE `category` IN (SELECT `name` FROM `category` WHERE `cid`='$catid');";
                    //     $result = mysqli_query($conn,$qr);
                    //     if ($result->num_rows > 0) {
                    //         while($row = $result->fetch_assoc()) {
                    //           $pid = $row["pid"];
                    //           echo '<div class="item">
                    //                     <div class="pad15">
                    //                         <a href="pro_des.php?pid='.$pid.'"><img  href= "#" src="./Images/'.$row["image"].'" style="height: 17rem;width: 15rem;"></a>
                    //                        <a href="pro_des.php?pid='.$pid.'"><p style="font-weight:bold;color:black;">'.$row["product_name"].'</p></a>
                    //                     </div>
                    //                 </div>';
                                    
                    //         }
                    //     } else {
                    //         /*echo "0 results";*/
                    //     }

                    //   }
                    // }



                    
              ?>

            </div>
            <button class="btn btn-primary leftLst"><</button>
            <button class="btn btn-primary rightLst">></button>
        </div>
  </div>
</div>





<!-- /.Content -->

	</body>
<!-- Footer -->
  <?php 
   footer();
  ?>
  <!-- /.Footer -->
	</html>