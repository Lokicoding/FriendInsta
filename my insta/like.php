<?php
	session_start();
	if(isset($_POST["user_name"]))
	{	
			$user_id=$_SESSION['user_id'];
			$post_id=$_POST["post_id"];		
			require 'dbconnection.php';
			$q = "select * from likes where post_id='$post_id' and user_id='$user_id'";
			
			$run_sq=mysqli_query($dbc,$q);
			if(mysqli_num_rows($run_sq)>0)
			{
				require 'dbconnection.php';
				$q = "DELETE FROM `likes` WHERE user_id='$user_id' and post_id='$post_id'";
				$run = mysqli_query($dbc, $q);
				if($run)
				{
					return 'far fa-heart heart';
				}
				else
				{
					return 'fas fa-heart heart';
				}
			}
			else
			{
				require 'dbconnection.php';
				$q = "INSERT INTO `likes`(`post_id`, `user_id`) VALUES ('$post_id','$user_id')";
				$run = mysqli_query($dbc,$q);
				if($run)
				{
					return 'fas fa-heart heart';
				}
				else
				{
					return 'far fa-heart heart';
				}
			}	
	}
	
	
?>