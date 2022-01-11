<!DOCTYPE html>
<?php	
	session_start();
	if(!isset($_SESSION['user_name']))
	{
		header('location:index.php');
	}
	
	if(isset($_POST['comment_btn']))
	{
		$post_id = $_SESSION['comment_btn'];
		header('location:comment_fetch.php');
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
	</head>
	<body>

<?php

	function users()
	{
		$name=$_SESSION['user_name'];
		require 'dbconnection.php';
		$q="Select * from data WHERE name!='$name'"; 		
		$run=mysqli_query($dbc,$q);
						
		if( mysqli_num_rows($run) >0)
			{
				while($rows=mysqli_fetch_array($run,MYSQLI_ASSOC))
					{
						$userImage=$rows['img'];
						
						
						echo "<div class='users'>
								<div class='friends_dp_div'> <img class='friends_dp' src='DP/$userImage'></div>
								<div class='friend_name_div'><a class='n'>".$rows['name']."</a></div>
								<div class='follow_div'><a>Follow</a></div>
							</div>";
					}
			}
	}
	
?>	
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
							<li><i class='fas fa-home' id="top"></i></li>
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
			
			<form method="post">
				<input type="hidden" name='names' value="prince" class="hidden_name_input">
			</form>
			
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
										
										$('.n').click(function(){
											var name = $(this).text();
											
											//$('.hidden_name_input').val(name);
											$.ajax({
											url: "profile.php",
											
											type: "POST",
											data: { "name": name.toString()},
											dataType:"text",
											
											success: function(d) {
												console.log(d);
												console.log(data);
												
												
										}});
										});
									
			                        });
									
									
									
			</script>       
			<!----------------------- PROFILE SUB MENU END------------------------->
			
			<div class='post_form_div'>
				
				<form class='form' method='post' enctype='multipart/form-data'>
					<input  type='file' name='uploadimg'>
					<input class='input_upload' type='text' name='caption' placeholder='caption'>
					<input class='input_btn' type='submit' name='uploadpost' value='Upload Post'><br>
					<input class='input_btn' id='close_div' type='button' name='singup' value='Not Now'>
				</form>

				<?php
						
						if(isset($_POST['uploadpost']))
						{	
							
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
										$name=$_SESSION['user_name'];
										$id=$_SESSION['user_id'];
										$caption=$_POST['caption'];
										
										$imgname = $_FILES['uploadimg']['name']; 
										
										$tempname = $_FILES['uploadimg']['tmp_name'];     
										
										$folder = 'post/'.$imgname;
										
										require 'dbconnection.php';
										
										$q="INSERT INTO `post`(`post_o_n`,`post_o_dp`,`post`,`post_c`) VALUES ('$name','$userImage','$imgname','$caption')";
										$a=mysqli_query($dbc,$q);

										if($a)
										{echo 'run';} 
										else 
										{echo 'not run';}
										if($a)
										{
											if (move_uploaded_file($tempname, $folder))  
											{ 
												$msg = 'Image uploaded successfully'; 
											}
											else
											{ 
												$msg = 'Failed to upload image'; 
											}
										}
						} 
						
					?>
				
			</div>
			<div class='blur'></div>
			<!----------------------- post upload form div end ------------------------->
				<div class='main_content_div'>
					<div class='post_div'>
						<!------------------ story div ------------------------------>
						<div class='story_div'>
							<div class='add_post_div'>
								<button class='add_post_btn' ><i class='far fa-plus-square'></i></button>
							</div>
						</div>
						
					
						<div class="post_dd">
							<h3>Are You Sure <br> Do You Want To Delete Your Post Permanently </h3>
							<form method="post">
								<input type="submit" name="delete" value="Delete Post" class="d_btn">
								<input type="button" value="Cancel" class="c_btn">
							</form>
						</div>
						
						<script>
                        $( document ).ready(function() {
                            $('.add_post_btn').click(function(){
							$('.post_form_div').css('display', 'block');
							$('.form').css('display', 'block');
							$('.blur').css('display', 'block');
							});

							$('#close_div').click(function(){
							$('.post_form_div').css('display', 'none');
							$('.blur').css('display', 'none');
							});
							
							$('.delete_btn').click(function(){
								$('.blur').css('display', 'block');
								$('.post_dd').css('display', 'block');
							});
							
							$('.c_btn').click(function(){
								$('.post_dd').css('display', 'none');
								$('.blur').css('display', 'none');
							});
							
                        });
							
						</script>
						
					<!------ post dives --------------->
						<?php	
						
								
						
								function post()
								{
									$name=$_SESSION['user_name'];
									require 'dbconnection.php';
									$q="SELECT * FROM `post`";
									$run=mysqli_query($dbc,$q);
									if( mysqli_num_rows($run) >0)
									{
										while($rows=mysqli_fetch_array($run,MYSQLI_ASSOC))
										{
											$post_o_dp=$rows['post_o_dp'];
											$post_o_n=$rows['post_o_n'];
											$_SESSION['post_o_n']= $post_o_n;
											$post_c=$rows['post_c'];
											$post=$rows['post'];
                                            $post_id=$_SESSION['post_id']=$rows['post_id'];
											$id=$_SESSION['user_id'];
											
											
											
											
											
											
											echo "<div class='user_post_div'>
							
											<div class='profile_header'>
												<div class='user_dp_div'> <img class='user_dp' src='DP/$post_o_dp'> </div>
												<div class='user_name_div'><a class='n'>$post_o_n</a></div>
												<div class='delete_btn_div'>".delete_post()."</div>
											</div>
											
											<div class='img_div'>
												<img class='post_images' id='' src='post/$post'>
											</div>
											
											<div class='post_option'>
												<div class='like_share_div'>
													<ul>
														<li><form method='post'><button type='submit' class='like_btn' id='".$post_id."'><i class='".likes()."' id=''></i></button></from></li>
													</ul>
													<div class='like_div'><span id='like_count'>".tl()."</span></div>
                                                    <form method='post'>
                                                        <input type='hidden' class='hidden_input' value='' name='hidden_input'>
                                                     
													<button type='submit' name='comment_btn' class='comment_btn' value='".$post_id."'><i class='far fa-comment'></i></button>                              </form> 
													<div class='comment_count_div'><span id='comment_count'>".tc()."</span></div>
												</div>
												<div class='comment_div'>
													<div class='comment_input_div'><input class='comment' name='comment' type='text' placeholder='Add a Comment' required ></div>
													<div class='comment_btn_div' alt='".$post_id."'><a href='#' id='comment_post' class=''>Post</a></div>
													
												</div>
											</div>
											</div>";
										}
									}
								}
								
								function delete_post()
								{
								if($_SESSION['user_name']==$_SESSION['post_o_n'])
									{
										return "<button class='delete_btn' type='button' name='delete'>Delete</button>";
									}
									else
									{
										
									}									
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
						<?php echo post();  ?>

                        <?php

                            if(isset($_POST["comment_btn"]))
                            {
                                $_SESSION["post_idd"] = $_POST['hidden_input'];
                                header ("location:comment_fetch.php");
                            }
                        ?>

                        <?php

                          if(isset($_POST['delete']))
                          {
                             $name=$_SESSION['user_name'];
                             $post_user=$_SESSION['post_o_n'];
                             $post_id=$_SESSION['post_id'];
							 
							 echo $post_user;
							 
                             if($name=$post_user)
                             {
                                 require 'dbconnection.php';
                                 $q="DELETE FROM post WHERE post_id='$post_id'";
                                 $run=mysqli_query($dbc,$q);
                                 if($run)
                                 {
                                     echo "post_deleted";
                                 }
                                 else{
                                     echo "not deleted";
                                 }
                             }
                          }
						  
						 

                        ?>
						<script>
								$(document).ready(function() {

                                   $('.comment_btn').click(function(){
                                           
                                    var x = $(this).val();
                                    $('.hidden_input').val(x);
                                   });

                                    function show(){
                                       var post_o_n = $('.user_name_div').text();
                                       var login_u = $('.friend_name_div1').text();
                                       if(post_o_n == login_u)
                                       {
                                           $('.delete_btn').css('display','none');
                                       }
                                       else
                                       {
                                           $('.delete_btn').css('display','block');
                                       }
                                    }


									/*
									$('.heart').click(function(){
										
									if ($('.heart').hasClass('far fa-heart')){
										$('.heart').removeClass('far fa-heart');
										$('.heart').addClass('fas fa-heart');
										} 
									else if($('.heart').hasClass('fas fa-heart'))
										{
											$('.heart').removeClass('fas fa-heart');
											$('.heart').addClass('far fa-heart');
										}
									});*/	
								});
								
								$('.like_btn').click(function()
								{
									var user_name = $('.name').text();
									var post_id = $(this).attr("id");
									$.ajax({
									url: "like.php",
									
									type: "POST",
									data: { "user_name": user_name, "post_id":post_id},
									success: function (a) {
										$(this).addClass(a);
										
								}});
								});
								
								
								$('.comment_btn_div').click(function()
								{
									
											var comment = $('.comment').val();
											var user_name = $('.name').text();
											var post_id = $(this).attr("alt");
											var user_dp = $('.main_user_dp').attr("src");
											$.ajax({	
											url: "comment_insert.php",
											type: "POST",
											data: { "comment": comment, "post_id":post_id, "user_name" : user_name,"user_dp" : user_dp},
											beforeSend:function(){$('.comment').val("");},
											success: function (a) {	
										}});
									
									
								});
								
                               
                                
								// $('.comment_btn').click(function(){
								// 	var user_name = $('.name').text();
								// 	var post_id = $(this).attr("value");
								// 	$.ajax({
								// 		url: "comment_fetch.php",
								// 		type: "POST",
								// 		data : {"post_id":post_id},
										
								// 		success : function (a){
								// 		//location.href = "comment_show.php";
								// 		alert(a);
								// 	}});
								// });
						</script>
						
					<!------ post dives  ends --------------->	
					</div>
					
					
					
					
					
					<!------ friends msg dives--------------->	
			<div class='msg_div'>
						
						<!----- main user profile ------> 
						
						<div class='profile_div'>
							<div class='main_user_dp_div'>

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
									
								echo "<img class='main_user_dp' src='DP/".$userImage."'>";	
							?>
							
							
							
							
							</div>
								<div class='friend_name_div1'><a class="name n" ><?php echo $_SESSION['user_name']; ?></a></div>
								<div class='follow_div'><form method='post'><input type='submit' name='logout' value='logout' id='logout'></form></div>
						</div>
						
						
						
						
					<!------ friends  msg  ends --------------->		
						
					<div class='friend_list'>	
						<?php echo users();?>
					</div>
			</div>
		</div>
		
	</body>
</html>