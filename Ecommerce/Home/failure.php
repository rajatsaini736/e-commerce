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
$salt="";

// Salt should be same Post Request 

If (isset($_POST["additionalCharges"])) {
       $additionalCharges=$_POST["additionalCharges"];
        $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
  } else {
        $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
         }
		 $hash = hash("sha512", $retHashSeq);
  

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
nav();

          echo '
              <div class="container price-border" >
                <div  class="price-border-botom">
                <img src="./Images/logo.png" class="_1n-logo price-mar-top">
                <h3 class="price-right">Order Confirmation : Failed</h3>
               </div>
               <div class="container">
                <h3 class="price-clr-1" > Hello '.$_SESSION["first_name"].' ,</h3>
                <p>We are writing to let you know that the payment for the item listed below has been declined. Please revise your payment detail or select an alternative payent method within 1 day of receiving this email.  </p>
                <p>The issuing bank may have declined the change if the name or account details entered donot match the bank records.
                </p>
                <h3 class="price-clr-1"> Details</h3>
                <p> Order : '.$txnid.' </p>
                </div>
                </div>';

footer();
?>

</body>
</html>