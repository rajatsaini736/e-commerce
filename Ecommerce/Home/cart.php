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

$_SESSION["curr_page"] = "cart.php";


$count = 0;
$save_for_later_count = 0;
if(!empty($_SESSION["first_name"]))
            {
              $name = $_SESSION["first_name"];
            }
            else
            {
              $name = session_id();
            }
 $sq = "SELECT `cart` FROM `user_info` WHERE `first_name`='$name'; ";
        $result = mysqli_query($conn,$sq);
          $myarr = array();
          if($result->num_rows>0)
          {
                  $data = $result->fetch_array();
                  $arr = $data["cart"];
                  $pros = explode(" ", $arr);
                  $total_price =0;
                  foreach ($pros as $key)
                   {  
                    if($key!=NULL)
                    {
                    if(!empty($myarr[$key])){
                      $myarr[$key] = $myarr[$key] +1;
                    }
                    else{
                    $myarr[$key] = 1;  
                    }
                  }
                }
                foreach ($myarr as $key => $value) {
                      $sq = "SELECT * FROM `product` WHERE `pid`='$key';";
                      $result = mysqli_query($conn,$sq);
                      if($result->num_rows>0)
                      {
                        
                        while($data=$result->fetch_array())
                        {
                          $count ++;
                        }
                      }
                    }
                  }
        else{
          $count=0;
        }








          $sq = "SELECT `save_for_later` FROM `user_info` WHERE `first_name`='$name'; ";
          $result = mysqli_query($conn,$sq);
          
          if($result->num_rows>0)
          {
                  $data = $result->fetch_array();
                  $arr = $data["save_for_later"];
                  $pros = explode(" ", $arr);
                  foreach ($pros as $key)
                   {  
                      if($key==NULL){
                        continue;
                      }
                      else
                      {
                        $save_for_later_count++;
                      }

                   }

          }
          else
          {
            $save_for_later_count=0;
          }      




          // WORKING OF BUTTON 'REMOVE' IN CART
          if(!empty($_POST['remove_from_cart']))
          {
            $pid = $_GET["pid"];
            if(!empty($_SESSION["first_name"]))
            {
              $name = $_SESSION["first_name"];
            }
            else
            {
              $name = session_id();
            }
          $sq = "SELECT `cart` FROM `user_info` WHERE `first_name`='$name'; ";
          $result = mysqli_query($conn,$sq);
          
          if($result->num_rows>0)
          {
                  $dupli_arr = "";
                  $data = $result->fetch_array();
                  $arr = $data["cart"];
                  $pros = explode(" ", $arr);
                  foreach ($pros as $key)
                   {  
                      if ($key===$pid) {
                        continue;
                      }
                      else
                      {
                        if($key!=NULL){
                        $dupli_arr .=$key." ";
                      }
                    }
                   }
                   
                   $quer = "UPDATE `user_info` SET `cart` = '$dupli_arr' WHERE `first_name`='$name' ;";
                   if(mysqli_query($conn,$quer))
          {
            // echo "successfully removed product";
          }

          }
          header("Refresh:0; url=cart.php");

          }

          // WORKING OF BUTTON 'REMOVE' IN SAVE FOR LATTER TABLE

          if(!empty($_POST['remove_from_save_for_later']))
          {
              $pid = $_GET["pid"];
            if(!empty($_SESSION["first_name"]))
            {
              $name = $_SESSION["first_name"];
            }
            else
            {
              $name = session_id();
            }
          $sq = "SELECT `save_for_later` FROM `user_info` WHERE `first_name`='$name'; ";
          $result = mysqli_query($conn,$sq);
          
          if($result->num_rows>0)
          {
                  $dupli_arr = "";
                  $data = $result->fetch_array();
                  $arr = $data["save_for_later"];
                  $pros = explode(" ", $arr);
                  foreach ($pros as $key)
                   {  
                      if ($key===$pid) {
                        continue;
                      }
                      else
                      {
                        if($key!=NULL){
                        $dupli_arr .=$key." ";
                      }
                    }
                   }
                   
                   $quer = "UPDATE `user_info` SET `save_for_later` = '$dupli_arr' WHERE `first_name`='$name' ;";
                   if(mysqli_query($conn,$quer))
          {
            // echo "successfully removed product";
          }

          }
          header("Refresh:0; url=cart.php");
          }

// WORKING OF BUTTON 'SAVE FOR LATTER BUTTON' in cart table  ::: first remove product from cart column and add product to save for later column
          if(!empty($_POST['save_for_later']))
          {
            $pid=$_GET["pid"];
            if(!empty($_SESSION["first_name"]))
            {
              $name = $_SESSION["first_name"];
            }
            else
            {
              $name = session_id();
            }
            $sq = "SELECT `cart` FROM `user_info` WHERE `first_name`='$name'; ";
          $result = mysqli_query($conn,$sq);
          
          if($result->num_rows>0)
          {
                  $dupli_arr = "";
                  $data = $result->fetch_array();
                  $arr = $data["cart"];
                  $pros = explode(" ", $arr);
                  foreach ($pros as $key)
                   {  
                      if ($key===$pid) {
                        continue;
                      }
                      else
                      {
                        if($key!=NULL){
                        $dupli_arr .=$key." ";
                      }
                    }
                   }
                   
                   $quer = "UPDATE `user_info` SET `cart` = '$dupli_arr' WHERE `first_name`='$name' ;";
                   if(mysqli_query($conn,$quer))
          {
            // echo "successfully removed product";
          }

          }


          // ADDING PRODUCT TO SAVE FOR LATER COLUMN
          $check =0;



     
    
      if(!empty($_SESSION["first_name"]) && !empty($_SESSION["last_name"])){

          $name = $_SESSION["first_name"];
          $sq = "UPDATE  `user_info` SET `save_for_later` =concat(ifnull(`save_for_later`,''),' $pid') WHERE `first_name`='$name' ; ";
          

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
          $sq = "UPDATE `user_info` SET `save_for_later` = concat(ifnull(`save_for_later`,''), ' $pid') WHERE `first_name`='$session_name' ;";

          if(mysqli_query($conn,$sq))
          {
            // echo "successfully added product";
          }

        }
        }
        else{

            $sq = "UPDATE `user_info` SET `save_for_later` = concat(ifnull(`save_for_later`,''), ' $pid') WHERE `first_name`='$session_name' ;";

          if(mysqli_query($conn,$sq))
          {
            // echo "successfully added product";
          }

        }
    }
      

 
          header("Refresh:0; url=cart.php");

          }



          // WORKING OF BUTTON 'MOVE TO CART BUTTON' in save for later table  ::: first remove product from save for later column and add product to cart column
          if(!empty($_POST['move_to_cart']))
          {
            $pid=$_GET["pid"];
            if(!empty($_SESSION["first_name"]))
            {
              $name = $_SESSION["first_name"];
            }
            else
            {
              $name = session_id();
            }
            $sq = "SELECT `save_for_later` FROM `user_info` WHERE `first_name`='$name'; ";
          $result = mysqli_query($conn,$sq);
          
          if($result->num_rows>0)
          {
                  $dupli_arr = "";
                  $data = $result->fetch_array();
                  $arr = $data["save_for_later"];
                  $pros = explode(" ", $arr);
                  foreach ($pros as $key)
                   {  
                      if ($key===$pid) {
                        continue;
                      }
                      else
                      {
                        if($key!=NULL){
                        $dupli_arr .=$key." ";
                      }
                    }
                   }
                   
                   $quer = "UPDATE `user_info` SET `save_for_later` = '$dupli_arr' WHERE `first_name`='$name' ;";
                   if(mysqli_query($conn,$quer))
          {
            // echo "successfully removed product";
          }

          }


          // ADDING PRODUCT TO cart COLUMN
          $check =0;



     
    
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
      

 
          header("Refresh:0; url=cart.php");

          }

if(!empty($_GET["id"])){
        $_SESSION['first_name'] = "";
        $_SESSION['last_name'] = "";
        $_SESSION['email'] = "";
} 

if(!empty($_POST["ctnshop"])){
  header('location: index.php');
}
           
if(!empty($_POST["Buy"])){
  $proinfo = $_GET["pinfo"];

  $_SESSION["pinfo"] = $proinfo;


  if(!empty($_SESSION["first_name"]) && !empty($_SESSION["last_name"])){

    header('location: buy.php');

  }
  else{
          $_SESSION["source"] = "";
          $_SESSION["desti"] = "";

          $_SESSION["source"] = "pro_des.php";
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
 <!-- cart table -->
<div class='container cart-con' >
	<h4 class="des-inline">MY CART (<?php echo $count ?>)</h4>
	<h4 class="cart-head"> Delivery </h4>
</div>

<?php 
      if(!empty($_SESSION["first_name"]) && !empty($_SESSION["last_name"]))
      {
          $name = $_SESSION["first_name"];
      }
      else{
        $name = session_id();
      }
      $sq = "SELECT `cart` FROM `user_info` WHERE `first_name`='$name'; ";
        $result = mysqli_query($conn,$sq);
          $myarr = array();


          if($result->num_rows>0 && !empty($result))
          {
                  $data = $result->fetch_array();
                  $arr = $data["cart"];
                  $pros = explode(" ", $arr);
                  $total_price =0;
                  foreach ($pros as $key)
                   {  
                    if($key!=NULL)
                    {
                    if(!empty($myarr[$key])){
                      $myarr[$key] = $myarr[$key] +1;
                    }
                    else{
                    $myarr[$key] = 1;  
                    }
                  }
                }
                $proinfo = "";

                foreach ($myarr as $key => $value) {
                      $proinfo .= $key." ";
                      $sq = "SELECT * FROM `product` WHERE `pid`='$key';";
                      $result = mysqli_query($conn,$sq);
                      if($result->num_rows>0)
                      {
                        
                        while($data=$result->fetch_array())
                        {   
                            $total_price = $total_price + $data["price"]*$value;
                            $cprice = $data["c_price"];
                            $price = $data["price"];
                            $offer = (($cprice-$price)/$cprice)*100;

                            $_SESSION["amount"] = $total_price;
                           echo '<div class="container cart-hcon" >
                                   <a href="pro_des.php?pid='.$data["pid"].'" ><img class="_1-m-img " src="./Images/'.$data["image"].'" alt="item icon" ></a>
                                   <div class="cart-img"><h5>'.$data["product_name"].' ( '.$value.' ) item</h5>
                                     <h5 ><strong> ₹'.$data["price"].'</strong> <strike class="clr-3"> ₹'.$data["c_price"].'</strike><span class="font_price"> '.round($offer).'% Off 2 Offers Available !</span>  </h5>
                                     <p >'.$data["product_description"].'</p>

                                      <form action="cart.php?pid='.$key.'" method="POST">
                                        <input type="submit" name="remove_from_cart" value="Remove">
                                        <input type="submit" name="save_for_later" value="Save for later">
                                      </form>

                                    </div>
                                    <p >Delivery by, Sat May 25 | Free<strike class="cor-3"> ₹40 </strike><br><br>10 Days Replacement Policy</p>
                                  </div>';
                        }
                      }
                }

          echo '
          <div class="container" style="border:1px solid gray;width: 90rem;">

            <form action="cart.php?pinfo='.$proinfo.'" method="POST">

                    <input class="btn btn-primary" type="submit" name="ctnshop" value="Continue Shoping" style="margin-top:10px; margin-bottom:10px;">
                    ';
                    if(!empty($myarr)){
                        echo    '<input class="btn btn-primary" type="submit" name="Buy" value="Buy" style="margin-top:10px; margin-bottom:10px;">
                    <h4 style="float: right;">Total Price = '.$total_price.'</h4>';
}
           echo '</form>

          </div>';


          }
          else
          {
            $total_price = 0;
          }

?>


<div class='container' style=' border:1px solid gray;width: 90rem;'>

  <form action="cart.php?pinfo='.$myarr.'">
    
  </form>

<!-- 	<button style="margin: 8px;" onclick="window.location.href='/Project/Home/index.php'" class="btn btn-primary"> CONTINUE SHOPING</button>
	<span><button class="btn btn-primary">PLACE ORDER</button></span>
  <h4 style="float: right;">Total Price = <?php echo $total_price ?></h4> -->
</div>

<!-- <p>Your saved items</p>
 --> <!-- save for later table -->
 <div class='container' style='margin-top: 40px; border:1px solid gray;width: 90rem;'>
  <h4 style="display: inline-block;">SAVE FOR LATER (<?php echo $save_for_later_count ?>)</h4>
  <!-- <h4 style="float: right;margin-right: 255px;"> Delivery </h4> -->
</div>
<?php 

      if(!empty($_SESSION["first_name"]) && !empty($_SESSION["last_name"]))
      {
          $name = $_SESSION["first_name"];
      }
      else{
        $name = session_id();
      }
      $sq = "SELECT `save_for_later` FROM `user_info` WHERE `first_name`='$name'; ";
        $result = mysqli_query($conn,$sq);
          
          if($result->num_rows>0)
          {
                  $data = $result->fetch_array();
                  $arr = $data["save_for_later"];
                  $pros = explode(" ", $arr);
                  foreach ($pros as $key)
                   {  
                      $sq = "SELECT * FROM `product` WHERE `pid`='$key';";
                      $result = mysqli_query($conn,$sq);
                      if($result->num_rows>0)
                      {
                        while($data=$result->fetch_array())
                        {
                            $cprice = $data["c_price"];
                            $price = $data["price"];
                            $offer = (($cprice-$price)/$cprice)*100;
                           echo '<div class="container" style="padding: 10px; border:1px solid gray;width: 90rem;background-color: white;">
  <img class="1_m_img" src="./Images/'.$data["image"].'" alt="item icon" style="width: 15rem;height: 15rem;float: left;margin-right: 40px;">
  <div style="float: left;margin-right: 50px;"><h5>'.$data["product_name"].'</h5>
    <h5 ><strong> ₹'.$data["price"].'</strong> <strike style="color: gray;"> ₹'.$data["c_price"].'</strike><span class="font_price">'.round($offer).'% Off 2 Offers Available !</span>  </h5>
    <p >'.$data["product_description"].'</p>

    <form action="cart.php?pid='.$key.'" method="POST">
      <input type="submit" name="remove_from_save_for_later" value="Remove">
      <input type="submit" name="move_to_cart" value="Move to cart">
    </form>

  </div>
  <p >Delivery by, Sat May 25 | Free<strike style="color: gray;"> ₹40 </strike><br><br>10 Days Replacement Policy</p>
</div>';
                        }
                      }

                   }
          }


?>


<div class='container' style=' border:1px solid gray;width: 90rem;'>
  <button style="margin: 8px;" onclick="window.location.href='/index.php'" class="btn btn-primary"> CONTINUE SHOPING</button>
  <span><button class="btn btn-primary">PLACE ORDER</button></span>
</div>


</body>
<!-- Footer -->
<?php 
   footer();
  ?>
</html>