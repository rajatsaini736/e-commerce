<!-- code for saving product to order table -->

         $pid = $_GET["pid"];

      if(!empty($_SESSION["first_name"]) && !empty($_SESSION["last_name"])){
          $mail = $_SESSION["email"];
          $name = $_SESSION["first_name"];
          $sq = "INSERT INTO `orders`(`pid`,`user_mail`,`tmst`) VALUES ('$pid','$mail',CURDATE());";
          

          if(mysqli_query($conn,$sq))
          {
            // echo "successfully added product";
            $buySuc = "You buyed this product successfully";
          }  
          else{
            $buyErr = "Failed ";
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
          $sq = "INSERT INTO `orders`(`pid`,`user_mail`,`tmst`) VALUES ('$pid','$session_name',CURDATE());";

          if(mysqli_query($conn,$sq))
          {
            $buySuc = "You buyed this product successfully";
          }
          else{
            $buyErr = "Failed";
          }

        }
        }
        else{

          $sq = "INSERT INTO `orders`(`pid`,`user_mail`,`tmst`) VALUES ('$pid','$session_name',CURDATE());";

          if(mysqli_query($conn,$sq))
          {
            $buySuc = "You buyed this product successfully";
          }
          else{
                        $buyErr = "Failed";
          }

        }
    } 