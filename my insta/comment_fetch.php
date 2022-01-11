<?php
    session_start();
	
			$post_id = $_SESSION["post_idd"];
            	require 'dbconnection.php';
									$q="SELECT * FROM `post` where post_id=$post_id";
									$run=mysqli_query($dbc,$q);
									if( mysqli_num_rows($run) >0)
									{
										while($rows=mysqli_fetch_array($run,MYSQLI_ASSOC))
										{
											$post_o_dp=$rows['post_o_dp'];
											$post_o_n=$rows['post_o_n'];
											$post_c=$rows['post_c'];
											$post=$rows['post'];
                                            $post_id=$_SESSION['post_id']=$rows['post_id'];
											$id=$_SESSION['user_id'];
                                        }
                                    }
                                    else
                                    {
                                        echo "not working";
                                    }

                                    
											function likes()
												{
													$user_id=$_SESSION['user_id'];
													$post_id = $_SESSION['post_id'];
													$name=$_SESSION['user_name'];
													require 'dbconnection.php';
													
													$q = "select * from likes where post_id='$post_id' and user_id='$user_id'";
													$run = mysqli_query($dbc,$q);
													if(mysqli_num_rows($run) >0)
													{
														return 'fas fa-heart heart';
													}
													else
													{
														return 'far fa-heart heart';
													}
												}
												
											function tl()
											{
												
												require 'dbconnection.php';
												$post_id=$_SESSION['post_id'];
												$q = "SELECT * FROM likes WHERE post_id='$post_id'";
												$run = mysqli_query($dbc,$q);
												if(mysqli_num_rows($run) >0)
												{
													$row = mysqli_num_rows($run);
													$total = $row;
													return $total;
												}	
											}
											
											function tc()
											{
												require 'dbconnection.php';
												$post_id=$_SESSION['post_id'];
												$q = "SELECT * FROM comments WHERE post_id='$post_id'";
												$run = mysqli_query($dbc,$q);
												if(mysqli_num_rows($run) >0)
												{
													$row = mysqli_num_rows($run);
													$total = $row;
													return $total;
												}
											}

?>
<!DOCTYPE html>
<?php
	
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
		
		<link rel='stylesheet' href='css/comment_fetch.css'>
		<style>
			.like_share_div{
				height:100%;
			}
		</style>
		
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
			 
			<div class='content_div'>
            <div class='main_content_div'>
            <div class='user_post_div'>
							
											<div class="profile_header">
												<div class="user_dp_div"> <img class="user_dp" src="DP/<?php echo $post_o_dp ?>"> </div>
												<div class="user_name_div"><a><?php echo $post_o_n ?></a></div>
												<!--- <div class="delete_btn_div"><button class="delete_btn" type="button" name="delete">Delete</button></div>--->
											</div>
											
											<div class="img_div">
												<img class="post_images" id="" src="post/<?php echo $post ?>">
											</div>
											
											<div class="post_option">
												<div class="like_share_div">
													<ul>
			<li><form method="post"><button type="button" class="like_btn" id="<?php echo $post_id ?>"><i class=" <?php echo likes() ?>" id=""></i></button></from></li>
													</ul>
													<div class="like_div"><span id="like_count"><?php echo tl(); ?></span></div>
                                                    <form method="post">
                                                        <input type="hidden" class="hidden_input" value="" name="hidden_input">
                                                     
				<button type="submit" name="comment_btn" class="comment_btn" value="<?php echo $post_id ?>" ><i class='far fa-comment'></i></button>                              </form> 
													<div class="comment_count_div"><span id="comment_count"><?php echo tc(); ?></span></div>
												</div>
											</div>
											
			</div>
			
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
			
<?php
	function comment_fetch()
	{
		$user_id=$_SESSION['user_id'];
		$post_id = $_SESSION['post_id'];
		$name=$_SESSION['user_name'];
		require 'dbconnection.php';
		
		$q = "select * from comments where post_id='$post_id'";
		$run = mysqli_query($dbc,$q);
		if(mysqli_num_rows($run) >0)
		{
			while($rows=mysqli_fetch_array($run,MYSQLI_ASSOC))
				{
					
					$user_id=$rows['user_id'];
					$comment=$rows['comment'];
					$user_name=$rows['user_name'];
					$user_dp=$rows['user_dp'];
					
							
							echo "<div class='comment_show_div'>
							<div class='user_dp_div'> <img class='user_dp' src='$user_dp'> </div>
							<div id='name_comment'>
							<div class='user_name_comment_div'><a>$user_name</a></div>
							<div class='user_comment_div'><a>$comment</a></div>
							</div>

							</div>";
						
					
					
					
				}
		}
	}
	
	 echo comment_fetch();
?>
			
			
			
    </div>
</div>

</body>
</html>