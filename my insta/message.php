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
		<link rel='stylesheet' href='css/msg.css'>
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
								<div class='friend_name_div'><a class='friend_name_a'>".$rows['name']."</a></div>
							</div>";
					}
			}
	}
	
?>	
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
							<li><a href="profileedit.php"><i class='fas fa-users-cog'></i></a></li>
						</ul>
					</div>
				</div>
				
					
				
			</div>
			
			<div class='content_div'>
				<div class='main_content_div'>
					<div class="msg_container">
						<div class="friend_msg_div">
							<!--<div class="heading">
								<h2>chat</h2>
							</div>  --->
							<div class="friend_list">	
								<?php echo users();?>
							</div>
						</div>
						
						<div class="chat_div">
							<div class="heading">
							<div class="friend_dp_div">
								<img class="friend_dp" >
							</div>
								<div class="friend_name_div"><h2 class="friend">chat</h2></div>
								<div class="back_btn_div"><i class="fas fa-arrow-circle-left"  id="back"></i></div>
							</div>
							<div class="msg_show_div">
								<div id="righ_msg">
									<p class="sender_msg">hii bro</p>
								</div>
								
								<div id="left_msg">
									<p class="friend_msg">hii bro</p>
								</div>
							</div>
							<div class="msg_input_div">
								<input type="text" name="msg" class="input_msg" id="input_msg">
								<input type="button" name="send" value="send" id="send_btn">
							</div>
						</div>
						
					<div>
				</div>
			</div>
			<script>
				$('.friend_name_a').click(function()
				{
					var name = $(this).text();
					$.ajax({
					url: "name.php",
					
					type: "POST",
					data: { "name1": name},
					success: function (a) {
						$('.friend').html(a);
						var friend_name = a;
						//$(".friend_dp").attr("src","DP/");
					}});
					
					
					var name = $(this).text();
					$.ajax({
					url: "img.php",
					type: "POST",
					data: { "name1": name},
					success: function (a) {
						$(".friend_dp").attr("src","DP/"+a);
						
					}
					});
					
					
					$(".chat_div").css("display","block");
					
					
					$('#back').click(function(){
						$(".chat_div").css("display","none");
						$(".friend_msg_div").css("display","block");
					});
					
					
					$('#send_btn').click(function(){
					
					var name = $(".friend").text();
					var msg = $('#input_msg').val();
					$.ajax({
					url: "msg_insert.php",
					type: "POST",
					data: { "name1": name,"msg": msg},
					beforeSend:function(){$('#input_msg').val("");},
					success: function (a) {
						//$('.sender_msg').text(a);
						//$('.chat_box').html("");
						$('.msg_show_div').append("<div id='righ_msg' ><p class='sender_msg'>"+msg+"</p></div>");
						//$(".friend_msg").text(a);
					}
					});
					});
					
					
					function fetch(){
					$.ajax({
					url: "fetch.php",
					
					type: "POST",
					data: { "name1": name},
					success: function (a) {
						$('.msg_show_div').html("");
						$('.msg_show_div').append(a);
					}
					});
					}
					
					fetch();
					//setInterval(function(){fetch();},2000);
				});					
			</script>
	</div>
</body>
</html>