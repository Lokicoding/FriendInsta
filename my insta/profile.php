<?php	
	session_start();
	if(!isset($_SESSION['user_name']))
	{
		header('location:index.php');
	}
	
	         if(isset($_POST["name"]))
				{
					$name = $_POST["name"];
					echo $name;
					header ('location:profile.php');
					require 'dbconnection.php';
					$q = "SELECT img FROM `data` WHERE name='$name'";
					$run = mysqli_query($dbc,$q);
					if($run)
					{
						while($rows=mysqli_fetch_array($run,MYSQLI_ASSOC))
						{
							$img=$rows['img'];
							echo $img;
						}
					}
					else
					{
						echo "not working";
					}
				}
				else
				{
					echo "query no run";
					header ('location:profile.php');
				}
	
?>
<html>
	<head>
		<title>Friends</title>
		<meta charset='utf-8'>
		<meta name='viewport' content='width=device-width, initial-scale=1'>
		<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css' integrity='sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==' crossorigin='anonymous' />
		<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
		<link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="css/profile.css">
	</head>
	<body>
<?php
			if(isset($_POST['logout']))
			{
				session_destroy();
				header('location:index.php');
			}
	?>
	
	
		<div class='body_div'>
			<div class='header_div'>
				<div class='header_main_div'>
					<div class='logo_div'><a href='main.php'><h2>Friends</h2></a></div>
					<div class='search_box'>
						<div class='input_div'>
							<input class='input' type='text' placeholder='search'>
						</div>
					</div>
					<div class='option_div'>
						<ul>
							<li><a  href="main.php" ><i class='fas fa-home' id="top"></i></a></li>
							<li><a href='message.php'><i class='fab fa-facebook-messenger'></i></a></li>
							<li><i class='fas fa-heart'></i></li>
							<li><i class='fas fa-users-cog' id="submenu"></i></li>
						</ul>
					</div>
				</div>
					<script>
						$(document).ready(function(){ 
							$('#top').click(function(){
								$('html').scrollTop(0);
							});
						});
					</script>
			</div>	
					
		<div class='content_div'>
				
			<!----------------------- post upload form ------------------------->
			
			<!----------------------- PROFILE SUB MENU ------------------------->
			<div class="submenu_div">
				<ul>
					<li><a href='profileedit.php'>Update Profile</a></li>
					<li>
						<form method='post'>
							<input type='submit' name='logout' value='logout' id='logout2'><br>
							<input type='button' value='close' class="close_btn">
						</form>
					</li>
				</ul>
			</div>
			<div class='blur'></div>
			<script>
			                        $( document ).ready(function() {
			                            $('#submenu').click(function(){
										$('.submenu_div').css('display', 'block');
										$('.blur').css('display', 'block');
										});

										$('.close_btn').click(function(){
										$('.submenu_div').css('display', 'none');
										$('.blur').css('display', 'none');
										});
			                        });
			</script>       
			<!----------------------- PROFILE SUB MENU END------------------------->
			
		</div>	
		</body>
</html>