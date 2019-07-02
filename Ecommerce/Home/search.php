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

$_SESSION["curr_page"] = "search.php?search=".$_GET["search"];


	$query = $_GET["search"];
	$query = preg_replace("#[^0-9a-z]i#","",$query);




?>
<!DOCTYPE html>
<html lang="en">

<html>
<head>
	<title></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="stylesheet.css">
</head>
<body>
  <?php
nav();
?>
<?php
echo '<div class="container _1m-catcon" >
<ul class="row _1m-catrow">';
  $sql = "SELECT * FROM product
            WHERE (`category` LIKE '%$query%') OR (`sub_category` LIKE '%$query%') OR (`product_name` LIKE '%$query%');";
    $result = mysqli_query($conn,$sql);

    if($result->num_rows>0){
      while($row=$result->fetch_assoc()){
                           $pid = $row["pid"];
                    $cprice = $row["c_price"];
                    $price = $row["price"];
                    $offer = (($cprice-$price)/$cprice)*100;
                    echo '<li><div class="col-4-lg ml-2 _1m-cardbg" >
                            <div class="card _1m-cardw" ><br>
                            <h4 class="card-title _1m-title" ><a href="pro_des.php?pid='.$pid.'" class="_1m-titleh">'.$row["product_name"].'</a></h4>
                             <a href="pro_des.php?pid='.$pid.'" ><img src="./Images/'.$row["image"].'" alt="card Two" class="card-img-top _1m-cardimg" ></a>
                              <div class="card-body _1m-cardm" >
                              <p class="a _1m-des">'.$row["product_description"].'</p>
                              <p class="card-text off-font" ><strong> ₹'.$row["price"].'</strong> <strike class="clr-3"> ₹'.$row["c_price"].'</strike><span class="font_price"> '.round($offer).'% Off!</span> </p><br>
                              
                              </div>
                            </div>
                          </div></li>';
                          
      }
    }
    else{
      echo '<div class="container" style=" border:1px solid gray;width: 90rem;">
      <h4>No results found.</h4>
    <form action="index.php" method="POST" style="margin-bottom:10px;">
      <input type="submit" class="btn btn-primary" name="ctnshop" value="Continue shoping . . ">
    </form>
</div>
          ';
    }

echo '</ul>
</div>';    
?>
</body>
<?php 
   footer();
  ?>
</html>