<?php

include('db.php');
$database = "e-commerce";
    mysqli_select_db($conn,$database);


$sq = "SELECT `image` FROM `category` WHERE `name`='Music'";
if($result = mysqli_query($conn,$sq))
	{
		$data = $result->fetch_assoc();
		$pic_file = $data["image"];
		echo $pic_file;
		
		// header("Content-type: ".$pic_file); 	
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<img src="<?php echo 'Images/'.$pic_file;?>">


</body>
</html>