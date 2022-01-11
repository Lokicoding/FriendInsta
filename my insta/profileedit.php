<!DOCTYPE html>
<?php
	session_start();
	if(!isset($_SESSION['user_name']))
	{
		header('location:index.php');
	}
	$id=$_SESSION['user_id'];
?>
<html>
	<head>
		<title>Friends</title>
		<meta charset='utf-8'>
		<meta name='viewport' content='width=device-width, initial-scale=1'>
		<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css' integrity='sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==' crossorigin='anonymous' />
		<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
		<link rel='stylesheet' href='css/main.css'>

	</head>
	<body>
	<div class='body_div'>
			<div class='header_div'>
				<div class='header_main_div'>
					<div class='logo_div'><a href="main.php"><h2>Friends</h2></a></div>
					<div class='search_box'>
						<div class='input_div'>
							<input class='input' type='text' placeholder='search'>
						</div>
					</div>
					<div class='option_div'>
						<ul>
							<li><a class="home_btn" href="main.php"><i class='fas fa-home'></i></a></li>
							<li><a href="message.php"><i class='fab fa-facebook-messenger'></i></a></li>
							<li><i class='fas fa-heart'></i></li>
							<li><i class='fas fa-users-cog' id="submenu"></i></li>
						</ul>
					</div>
				</div>
			</div>
			
			<div class="submenu_div">
				<ul>
					<li>
						<form method='post'>
							<input type='submit' name='logout' value='logout' id='logout2'><br>
							<input type='button' value='close' class="close_btn">
						</form>
						<?php
							if(isset($_POST['logout']))
							{
								session_destroy();
								header('location:index.php');
							}	
						?>
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

			                         $( document ).ready(function() {
		                            $('.add_post_btn').click(function(){
									$('.post_form_div').css('display', 'block');
									$('.blur').css('display', 'block');
									});

									$('#close_div').click(function(){
									$('.post_form_div').css('display', 'none');
									$('.blur').css('display', 'none');
											});
		                        		});
			</script>  
			<div class='content_div'>
				<div class='main_content_div'>
					<div class="profile_update_div">
					<!-----------------------------------   dp left div ------------------------------------------>	
						<div class="dp_left_div">
							<div class="dp_div">
								<div class="dp_main_div">
								<?php
									$name=$_SESSION['user_name'];
									require 'dbconnection.php';
									$q="SELECT * FROM `data` WHERE name='$name'";
									$run=mysqli_query($dbc,$q);
									if( mysqli_num_rows($run) >0)
									{
										while($rows=mysqli_fetch_array($run,MYSQLI_ASSOC))
										{
											$userImage=$rows['img'];
										}
									}
										
									echo "<img class='dp' src='DP/".$userImage."'>";	
								?>
									
								</div>
							</div>
							
							<div class="dp_update_div">
								<div class="form_center_div">
									<form method="post" id="form" enctype="multipart/form-data">
										 <label for="files" class="btn">Select Image</label>
										<input id="files" style="visibility:hidden;" type="file" name="uploadimg">
										<input class="input_btn" type="submit" name="updatedp" value="Update">
										<?php
											if(isset($_POST["updatedp"]))
											{
												$name=$_SESSION['user_name'];
												$id=$_SESSION['user_id'];
												
												$imgname = $_FILES["uploadimg"]["name"]; 
						
												$tempname = $_FILES["uploadimg"]["tmp_name"];     
						
												$folder = "DP/".$imgname;
												
												require 'dbconnection.php';
												$q="UPDATE data SET img='$imgname' WHERE id='$id'";
												$run=mysqli_query($dbc,$q);
												if($run)
												{
														if (move_uploaded_file($tempname, $folder))  
														{ 
															$msg = "Image uploaded successfully"; 
														}
														else
														{ 
															$msg = "Failed to upload image"; 
														}
														$_SESSION["user"]=$name;
														$_SESSION["img"]=$imgname;
												}
											}		
												
										?>
										
									</form>
								</div>
							</div>
						</div>
					<!-----------------------------------   dp left div  end ------------------------------------------>	
						<div class="form_right_div">
							<div class="name_update_center_div">
								<div class="heading">
									<h2>Update your Name</h2><br>
								</div>
								
								<form method="post" class="name_update_form">
									<input type="text" name="newname" class="input_name" placeholder="Enter New Name" required><br>
									<input type="submit" name="name_update" value="Name Update" class="input_btn">
								</form>
								<form method="post" class="name_update_form">
									<input type="text" name="newpass" class="input_name" placeholder="Enter New password" required><br>
									<input type="submit" name="password_update" value="Password Update" class="input_btn">
								</form>
								<?php
											if(isset($_POST["name_update"]))
											{
												$name=$_SESSION['user_name'];
												$id=$_SESSION['user_id'];
												$newname=$_POST['newname'];
												
												require 'dbconnection.php';
												$q="UPDATE data SET name='$newname' WHERE id='$id'";
												$run=mysqli_query($dbc,$q);
												if($run)
												{
														$_SESSION["user_name"]=$newname;
														header('location:main.php');
														
												}
											}

											if(isset($_POST["password_update"]))
											{
												$name=$_SESSION['user_name'];
												$id=$_SESSION['user_id'];
												$newpass=$_POST['newpass'];
												
												require 'dbconnection.php';
												$q="UPDATE data SET password='$newpass' WHERE id='$id'";
												$run=mysqli_query($dbc,$q);
												if($run)
												{
													header('location:main.php');	
												}
											}											
												
										?>
							</div>
						</div>
					</div>
				</div>
			</div>
	</div>
</body>
</html>