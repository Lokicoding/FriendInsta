<!DOCTYPE html>
<html>
	<head>
		<title>Friends</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<div class="container">
			<div class="left_div">
				<img class="iphone" src="images/main.png">
			</div>
			<div class="right_div">
				<div class="form_div">
					<div class="heading_div"><h1>Friends</h1></div>
					<div class="form">
						<form method="post">
							<input class="input" name="name" type="text" placeholder="Phone number, username, or email">
							<input class="input" name="password" type="password" placeholder="Password">
							<input class="input_btn" type="submit" value="Login" name="login">
						</form>
					</div>	
				</div>
				<div class="reg_div">
					<h4>Don't have an account?</h4> &nbsp <a href="singup.php" class="signup"> Sign up</a>
				</div>
			</div>
		</div>
		
		<?php
		
		session_start();
		
			if(isset($_POST["login"]))
			{
				
				$name=$_POST['name'];
				$password=$_POST['password'];
				require 'dbconnection.php';
				$q="Select * from data where name='$name' and password='$password'";
				$run=mysqli_query($dbc,$q);
				
				
				if( mysqli_num_rows($run) >0)
				{
					while($rows=mysqli_fetch_array($run,MYSQLI_ASSOC))
					{
						$_SESSION['user_name']=$rows["name"];
						$_SESSION['user_id']=$rows['id'];
						header('location:main.php');
					}
				}
				else
				{
					echo"wrong password";
				}
			}
		?>
	</body>
</html>