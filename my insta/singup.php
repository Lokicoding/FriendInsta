<!DOCTYPE html>
<html>
	<head>
		<title>Friends</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
<?php
	
	if(isset($_POST['singup']))
	{
		session_start();	
		$name=$_POST['name'];
		$password=$_POST['password'];   
		
		$imgname = $_FILES["uploadimg"]["name"]; 
		
		$tempname = $_FILES["uploadimg"]["tmp_name"];     
		
		$folder = "DP/".$imgname;
		
		require 'dbconnection.php';
		
		$q="INSERT INTO `data`(`name`,`password`,`img`) VALUES ('$name','$password','$imgname')";
		$a=mysqli_query($dbc,$q);
		if($a)
		{
			
			if (move_uploaded_file($tempname, $folder))  
			{ 
				{echo "run";}
				$msg = "Image uploaded successfully"; 
				$_SESSION["user"]=$name;
				$_SESSION["img"]=$imgname;
				header('location:index.php');
			}
			else
			{ 
				echo "not run";
				$msg = "Failed to upload image"; 
			}
			
		}
	}
?>
	<style>
		*{
			margin:0px;
			padding:0px;
			font-family:arial;
		}
		
		.main_div{
			height:100vh;
			width:100vw;
			background-color:#fafafa;
			align-items:center;
			text-align:center;
			display:flex;
			justify-content:center;
		}
		
		.main_form_div{
			height: 345px;
			width: 350px;
			border: 1px solid #dbdbdb;
			margin-top: -10%; 	
			background-color: white;
		}
		
		.form_div
		{
			height: 345px;
			width: 350px;
			border: 1px solid #dbdbdb;
			/* margin-top: 1%; */	
			background-color: white;
		}
		
		.heading{
			height:17%;
			width:100%;
			background-color:;
			display:flex;
			justify-content:center;
			align-items:center;
		}
		
		.pera{
			height:15%;
			width:100%;
		}
		
		.pera h2{
			font-size: 17px; 
			font-weight: 600; 
			line-height: 20px; 
			text-align: center;
			color:#8e8e8e
		}
		
		.form{
			text-align:center;
		}
		
		.input{
			height:30px;
			width:80%;
			margin-top:5px;
			border:1px solid #dbdbdb;
			padding:5px;
		}
		
		.footer{
			
			height:10%;
			width:100%;
			margin-top:16px;
		}
		
		.footer p{
			color: #8e8e8e;
			font-size: 12px;
			line-height: 16px;
			margin: 10px 40px;
			text-align: center;
			
		}
		
		.input_btn{
			height:30px;
			width:83.5%;
			margin-top:7px;
			border:1px solid #dbdbdb;
			padding:5px;
			cursor:pointer;
			background-color:#0095f6;
			color:white;
		}
		
		.login_div{
			height:50px;
			width: 351px;
			background-color:white;
			border:1px solid #dbdbdb;
			margin-top:15px;
			display:flex;
			justify-content:center;
			align-items:center;
		}

		.login{
			color:#0095f6;
			text-decoration:none;
		}


	@media screen and (max-width: 425px) {
		.main_form_div {
			height: 70%;
			width: 82%;
			border: 1px solid #dbdbdb;
			background-color: white;
			margin-bottom: 18%;
			
		}
		.form_div {
		height: 100%;
		width:100%;
		border: 1px solid #dbdbdb;
		/* margin-top: 1%; */
		background-color: white;
		}

		.login_div {
		height: 50px;
		width: 339px;
		background-color: white;
		border: 1px solid #dbdbdb;
		margin-top: 15px;
		display: flex;
		justify-content: center;
		align-items: center;
		}

	}

	@media screen and (max-width: 375px) {
		.main_form_div {
			height: 70%;
			width: 82%;
			border: 1px solid #dbdbdb;
			background-color: white;
			margin-bottom: 18%;
			
		}
		.form_div {
		height: 100%;
		width:100%;
		border: 1px solid #dbdbdb;
		/* margin-top: 1%; */
		background-color: white;
		}
			
		.login_div {
		height: 50px;
		width: 308px;
		background-color: white;
		border: 1px solid #dbdbdb;
		margin-top: 15px;
		display: flex;
		justify-content: center;
		align-items: center;
		}
	}
	
	@media screen and (max-width: 375px){
	.login_div {
		height: 50px;
		width: 262px;
		background-color: white;
		border: 1px solid #dbdbdb;
		margin-top: 15px;
		display: flex;
		justify-content: center;
		align-items: center;
	}
}
	</style>
	<body>
		
		<div class="main_div">
		<div class="main_form_div">
			<div class="form_div">
				<div class="heading"><h1>Friends</h1></div>
				<div class="pera"><h2>Sign up to see photos and videos <br> from your friends.</h2></div>
				<form class="form" method="post" enctype="multipart/form-data">
					<input class="input" type="file" name="uploadimg">
					<input class="input" type="text" name="name" placeholder="Username" require>
					<input class="input" type="password" name="password" placeholder="Password" require>
					<input class="input_btn" type="submit" name="singup" value="Sing up">
				</form>
				<div class="footer"><p>By signing up, you agree to our Terms , Data Policy and Cookies Policy </p></div>
			</div>
			<div class="login_div">
				<h4>Have an account? &nbsp <a class="login" href="index.php">Log in</a></h4>
			</div>
		</div>
		</div>
	</body>
</html>