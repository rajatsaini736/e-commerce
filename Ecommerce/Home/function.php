<?php 
include('db.php');
$database = "e_commerce";
mysqli_select_db($conn,$database);



 function nav(){
     include('db.php');
$database = "e_commerce";
mysqli_select_db($conn,$database);
 	$count = 0;
  $check = 0;
// UPDATING CURRENT PAGE
      if(!empty($_SESSION["first_name"]) && !empty($_SESSION["last_name"])){

          $name = $_SESSION["first_name"];
          $curr_page = $_SESSION["curr_page"];
          $sq = "UPDATE  `user_info` SET `last_page` ='$curr_page' WHERE `first_name`='$name' ; ";
          

          if(mysqli_query($conn,$sq))
          {
            // echo "successfully added product";
          }  
      }
      else{
        $session_name = session_id();
        $curr_page = $_SESSION["curr_page"];

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
          $sq = "UPDATE  `user_info` SET `last_page` ='$curr_page' WHERE `first_name`='$session_name' ; ";

          if(mysqli_query($conn,$sq))
          {
            // echo "successfully added product";
          }

        }
        }
        else{

          $sq = "UPDATE  `user_info` SET `last_page` ='$curr_page' WHERE `first_name`='$session_name' ; ";

          if(mysqli_query($conn,$sq))
          {
            // echo "successfully added product";
          }

        }
    }  



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
  


 	echo '<nav class="navbar navbar-inverse _1n-bg border ">
   <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php"><img src="./Images/logo.png" class="_1n-logo"></a>
    </div>
    <ul class="nav navbar-nav">
      <li ><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
    </ul>
     <ul class="nav navbar-nav navbar-left">';
    
          $sql = "SELECT * FROM `category`";
          $result = mysqli_query($conn,$sql);
          if ($result->num_rows > 0) {

               while($row = $result->fetch_assoc()) {
                    echo '<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"> '.$row["name"].' <span class="caret"></span></a>
                    <ul class="dropdown-menu">';

                            $cat_name =$row["name"];
                            $sql1 = "SELECT `name` FROM `sub_category` WHERE `category_name`='$cat_name'";
                            $result1 = mysqli_query($conn,$sql1);
                            if ($result1->num_rows > 0) {

                                while($row1 = $result1->fetch_assoc()) {
                                  echo '<li><a href="product.php?subcatname='.$row1["name"].'" style="color: #565656;">'.$row1["name"].'</a></li>';
                                }
                            } else {
                                /*echo "0 results";*/
                            } 
                      echo '</ul>
                          </li>';
                     }
               }else {
                  /*echo "0 results";*/
              } 
        
      

echo'</ul>
    <ul class="nav navbar-nav navbar-right">
      <li class="_clr-1">';
      if(!empty($_SESSION["first_name"]) && !empty($_SESSION["last_name"])){
        echo '<li ><a href="#">'.$_SESSION["first_name"]." ".$_SESSION["last_name"].'</a></li>';
        echo '<li><a href="index.php?id=log_out"><span class="glyphicon glyphicon-log-out"></span> Log-out</a></li>';
      }
      else{
        echo'
        <li><a href="sign_up.php?status=signup"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      <li><a href="login.php?status=login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>';
    }
     
   echo'</li>
      <li ><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart" ></span> [<span class="cart-font">'. $count.'</span>]</a></li>
    </ul>

    <form class="navbar-form navbar-right" action="search.php" method="GET">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search" name="search">
        <div class="input-group-btn">
          <button class="btn btn-default" type="submit">
            <i class="glyphicon glyphicon-search"></i>
          </button>
        </div>
      </div>
    </form>
  </div>
</nav>
';
 }
 

 function footer(){
 	echo '<footer class="on-ftr">
    <div class="container">
      <div class="row ftr-header" >
        <div class="col-md-3" ><h3><span class="clr-2">Quick </span>Links</h3></div>
        <div class="col-md-3 ftr-margin-random" > <h3><span class="clr-2">Extra </span>Links</h3> </div>
        <div class="col-md-3 ftr-margin-random1" > <h3> <span class="clr-2">Address </span>Area</h3> </div>
        <div class="col-md-3 ftr-margin-random2" > <h3><span class="clr-2">Google </span>Map</h3> </div>
      </div>
      <div class="row  ftr-des" >
        <div class="col-md-3">
          <dd><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></dd>
          <dd class="ftr-margin"><a href="#"><span class="glyphicon glyphicon-info-sign"></span> About Us</a></dd>
          <dd class="ftr-margin"><a href="contact.php"><span class="glyphicon glyphicon-user"></span> Contact Us</a></dd>
        </div>
        <div class="col-md-3" >
          <dd>Term and Condition</dd>
          <dd class="ftr-margin">Privacy and Policy</dd>
          <dd class="ftr-margin">Use of Terms</dd>
        </div>
        <div class="col-md-3">
          <dd><span class="glyphicon glyphicon-map-marker"></span> Jaipur (Rajasthan).</dd>
          <dd class="ftr-margin"><span class="glyphicon glyphicon-user"></span> +91 8503875941</dd>
          <dd class="ftr-margin"><span class="glyphicon glyphicon-envelope"></span>  rakeskumarkumawat@gmail.com</dd>

        </div>
        <div class="col-md-3" >
          <dd><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3559.2804328735288!2d75.79466631498299!3d26.862829983149094!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x396db5db1de5ec71%3A0x88e389be10d1aa67!2sAUNICO+INDIA+-+A+Web+Design%2FDevelop+and+Hosting+Company%2C+Bulk+SMS%2C+LOGO+Design!5e0!3m2!1sen!2sin!4v1558451616957!5m2!1sen!2sin" width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen="" class="ftr-map"></iframe></dd>
        </div>
        
        
      </div>
    </div>
    <hr class="_hr">
    <div class="container">
      <a href="index.php"><img src="./Images/logo.png" class="lwr-ftr"></a>
      <p class="lwr-p">All Rights Reserved</p>
    </div>
  </footer>';
 }
 ?>