<?php


require 'config/config.php';

if(isset($_SESSION['username'])){
	$userLoggedIn = $_SESSION['username'];

	$user_details_query = mysqli_query($con,"SELECT * FROM users WHERE username = '$userLoggedIn'");
	$user = mysqli_fetch_array($user_details_query);
}else{
	header("Location: register.php");
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>SwirlFeed</title>
	<!-- Javascript -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="assets/js/bootstrap.js"></script>

	<!-- css -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
	<div class="top_bar">
		<div class="logo">
				<a href="index.php">MySNS</a>
		</div>
		<nav>
			<a href="<?php echo $userLoggedIn; ?>"><?php echo $user['first_name']; ?></a>
			<a href="index.php"><i class="fas fa-home"></i></i></a>
			<a href="#"><i class="fas fa-mail-bulk"></i></i></a>
			<a href="#"><i class="fas fa-bell"></i></i></a>
			<a href="#"><i class="fas fa-users"></i></i></a>
			<a href="#"><i class="fas fa-cogs"></i></i></a>
			<a href="includes/handlers/logout.php"><i class="fas fa-sign-out-alt"></i></i></a>
		</nav>
	</div>

		

<div class="wrapper">
