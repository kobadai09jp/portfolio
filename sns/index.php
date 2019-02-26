


<?php
	include("includes/header.php");
	include("includes/classes/User.php");
	include("includes/classes/Post.php");

	if(isset($_POST['post'])){
		$post = new Post($con,$userLoggedIn);
		$post ->submitPost($_POST['post_text'], 'none');
	}
	// session_destroy();
?>
<div class="user_details colum">
	<a href="<?php echo $userLoggedIn; ?>"><img src="<?php echo $user['profile_pic'] ?>"></a>

	<div class="user_details_left_right">

		<a href="<?php echo $userLoggedIn; ?>">
			<?php 
				echo $user['first_name']. " ".$user['last_name'];
			?>
		</a>
		<br>
			<?php echo "Posts:" .$user['num_posts']."<br>";
			echo "Like: " .$user['num_likes'];
			 ?>
	 </div>

</div>
<div class="main_colum colum">
	<form class="post_form" action="index.php" method="POST">
		<textarea name="post_text" id="post_text" placeholder="What's on your mind?"></textarea>
		<input type="submit" name="post" id="post_button" value="Post">
		<hr>
	</form>
	

<?php
	$post = new Post($con,$userLoggedIn);
	$post->loadPostsFriends();
?>


</div>

</div>
</body>
</html>

