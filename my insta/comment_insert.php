<?php
	session_start();
	if(isset($_POST["user_name"]))
	{
		$post_id = $_POST["post_id"];
		$user_id = $_SESSION['user_id'];
		$comment = $_POST['comment'];
		$user_name = $_POST['user_name'];
		$user_dp = $_POST['user_dp'];
		require 'dbconnection.php';
		$q ="INSERT INTO `comments`(`post_id`, `user_id`, `comment`, `user_name`,`user_dp`) VALUES ('$post_id','$user_id','$comment','$user_name','$user_dp')";
		$run = mysqli_query($dbc,$q);
		if($run)
		{
			return 'inserted';
		}
		else
		{
			return 'not inserted';
		}
	}

?>