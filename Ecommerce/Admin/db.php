<?php
	try
	{
		$conn = mysqli_connect("localhost","root","rajatsaini","e_commerce");
	}
	catch(mysqli_sql_exception $e)
	{
		echo $e;
	}
?>