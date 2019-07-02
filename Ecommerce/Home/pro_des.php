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

$_SESSION["curr_page"] = "pro_des.php?pid=".$_GET["pid"];


$check =0;


     if (!empty($_POST['add_cart'])) {      
     $pid = $_GET["pid"];
    
      if(!empty($_SESSION["first_name"]) && !empty($_SESSION["last_name"])){

          $name = $_SESSION["first_name"];
          $sq = "UPDATE  `user_info` SET `cart` =concat(ifnull(`cart`,''),' $pid') WHERE `first_name`='$name' ; ";
          

          if(mysqli_query($conn,$sq))
          {
            // echo "successfully added product";
          }  
      }
      else{
        $session_name = session_id();

        $quer = "SELECT * FROM `user_info` WHERE `first_name`='$session_name';";
        $result = mysqli_query($conn,$quer);
        if($result->num_rows>0)
        {
          while($data=$result->fetch_array())
          {
            $check++;
          }
        }

        if($check==0)
        {
        $quer = "INSERT INTO `user_info`(`first_name`) VALUES('$session_name');";
        if(mysqli_query($conn,$quer))
        {
          $sq = "UPDATE `user_info` SET `cart` = concat(ifnull(`cart`,''), ' $pid') WHERE `first_name`='$session_name' ;";

          if(mysqli_query($conn,$sq))
          {
            // echo "successfully added product";
          }

        }
        }
        else{

            $sq = "UPDATE `user_info` SET `cart` = concat(ifnull(`cart`,' $pid'), ' $pid') WHERE `first_name`='$session_name' ;";

          if(mysqli_query($conn,$sq))
          {
            // echo "successfully added product";
          }

        }
    }         
  }

  if(!empty($_POST["buy_now"])){
      $pid = $_GET["pid"];
      
      if(!empty($_SESSION["first_name"]) && !empty($_SESSION["last_name"])){

          header('location: buy.php');

      }
      else{
          $_SESSION["source"] = "";
          $_SESSION["desti"] = "";

          $_SESSION["source"] = "cart.php";
          $_SESSION["desti"] = "buy.php";

          header('location: login.php');          
      }
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

<!-- /.Header -->



<!-- Content -->

<?php 
              $pid = $_GET["pid"];
              $sql = "SELECT * FROM `product` WHERE `pid`='$pid'; ";
              $result = mysqli_query($conn,$sql);
              if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) {

                    $cprice = $row["c_price"];
                    $price = $row["price"];
                    $offer = (($cprice-$price)/$cprice)*100;
                    $_SESSION["amount"] = "";
                    $_SESSION["pinfo"] = "";

                    $_SESSION["pinfo"] = $pid;
                    $_SESSION["amount"] = $price;
                          echo '<div class="container des-con" >
                                    <img class="des-img" src="./Images/'.$row["image"].'" alt="item icon" >
                                    <div class="des-name"><h5>'.$row["product_name"].'</h5>
                                       <h5 ><strong> ₹'.$row["price"].'</strong> <strike class="clr-3"> ₹'.$row["c_price"].'</strike><span class="font_price "> '.round($offer).'% Off 2 Offers Available !</span>  </h5>
                                       <p >'.$row["product_description"].'</p>
                                    <form action="pro_des.php?pid='.$row["pid"].'" method="POST" class="des-inline">
                                        <input class="btn btn-primary" type="submit" name="add_cart" value="Add To Cart">
                                        <input class="btn btn-primary" type="submit" name="buy_now" value="Buy Now">
                                    </form>
                                  </div>
                              <p >Delivery by, Sat May 25 | Free<strike style="color: gray;"> ₹40 </strike><br><br>10 Days Replacement Policy</p>
                            </div>';
                  }
              } else {
                  /*echo "0 results";*/
              }

?>
<!-- /.Content -->
	</body>
<!-- Footer -->
<?php 
   footer();
  ?>
	</html>