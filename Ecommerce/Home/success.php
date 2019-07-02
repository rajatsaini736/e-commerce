<?php

include('db.php');
include('function.php');
session_start();

if(!empty($_GET["id"])){
        $_SESSION['first_name'] = "";
        $_SESSION['last_name'] = "";
        $_SESSION['email'] = "";
} 

$status=$_POST["status"];
$firstname=$_POST["firstname"];
$amount=$_POST["amount"];
$txnid=$_POST["txnid"];
$posted_hash=$_POST["hash"];
$key=$_POST["key"];
$productinfo=$_POST["productinfo"];
$email=$_POST["email"];
$salt="eZKpy19Z76";

// Salt should be same Post Request 

If (isset($_POST["additionalCharges"])) {
       $additionalCharges=$_POST["additionalCharges"];
        $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
  } else {
        $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
         }
		 $hash = hash("sha512", $retHashSeq);


     $pinfo = explode(" ",$productinfo);


?>	
<!DOCTYPE html>
<html>
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


<?php
      
      // $product

       if ($hash != $posted_hash) {
         echo "Invalid Transaction. Please try again";
       } else {


          $mail = $_SESSION["email"];

         foreach ($pinfo as $key) {

          $sq = "INSERT INTO `orders`(`pid`,`user_mail`,`tmst`) VALUES ('$key','$mail',CURDATE());";
          

          if(mysqli_query($conn,$sq))
          {

            $buySuc = "You buyed this product successfully";
          }  
          else{

          }
        }

        $quer = "UPDATE `user_info` SET `cart`='';";
        if(mysqli_query($conn,$quer)){

        }
        else{

        }

        // HEADER
        nav();

      
          $p_name = "";
          echo '
              <div class="container price-border" >
                <div  class="price-border-botom">
                <img src="./Images/logo.png" class="_1n-logo price-mar-top">
                <h3 class="price-right">Order Confirmation</h3>
               </div>
               <div class="container">
                <h3 class="price-clr-1" > Hello '.$_SESSION["first_name"].' ,</h3>
                <p> Your orders : </p>';
                     
                foreach ($pinfo as $key) {
                      $sq = "SELECT * FROM `product` WHERE `pid`='$key';";
                      $result = mysqli_query($conn,$sq);

                      if($result->num_rows>0)
                      {
                        
                        while($data=$result->fetch_array())
                        {   

                            $cprice = $data["c_price"];
                            $price = $data["price"];
                            $name = $data["product_name"];
                            $offer = (($cprice-$price)/$cprice)*100;
                            $p_name .= $name.", ";
                            
                           echo '<div class="container cart-lcon" >
                                   <a href="pro_des.php?pid='.$data["pid"].'" ><img class="_1-m-img " src="./Images/'.$data["image"].'" alt="item icon" ></a>
                                   <div class="cart-img"><h5>'.$data["product_name"].'</h5>
                                     <h5 ><strong> ₹'.$data["price"].'</strong> <strike class="clr-3"> ₹'.$data["c_price"].'</strike><span class="font_price"> '.round($offer).'% Off 2 Offers Available !</span>  </h5>
                                     <p >'.$data["product_description"].'</p>

                                    </div>

                                  </div>';
                        }
                      }
                    }
                echo '
                <p> Thank you for shoping with us. You ordered '.$p_name.'  . We will send a confirmation when your item ship.</p>
                <h3 class="price-clr-1"> Details</h3>
                <p> Order : '.$txnid.' </p>
               </div>
               <div class="container price-bg" >
                 <div class="col-md-6" >
                  <h3>Arriving</h3>
                  <p> Monday Jun 17</p>
                 </div>
                 <div class="col-md-6">
                  <h3>Ship to</h3>
                  <p>Address : '.$_SESSION["address"].'</p>
                  <p> Order Total : '.$amount.'</p>
                 </div>
              </div>
                 <div class="container">
                  <p>We hope to see you again soon </p>
                 </div>
              </div>
          ';


          // echo "<h3>Thank You. Your order status is ". $status .".</h3>";
          // echo "<h4>Your Transaction ID for this transaction is ".$txnid.".</h4>";
          // echo "<h4>We have received a payment of Rs. " . $amount . ". Your order will soon be shipped.</h4>";
       }
?>


<!-- Footer -->
  <?php 
   footer();
  ?>
  <!-- /.Footer -->

</body>
</html>