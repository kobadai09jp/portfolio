<?php

$fname = "";
$lname = "";
$em = "";
$em2 = "";
$password = "";
$password2 = "";
$date = "";
$error_array = array();

if(isset($_POST['register_button'])){
	//Registration form values

	//firstname
	$fname = strip_tags($_POST['reg_fname']); //Remove html Tag
	$fname = str_replace(' ', '', $fname); //Remove Space
	$fname = ucfirst(strtolower($fname)); //Uppercase firstlater
	$_SESSION['reg_fname'] = $fname; //firstname into session

	//lastname
	$lname = strip_tags($_POST['reg_lname']); //Remove html Tag
	$lname = str_replace(' ', '', $lname);//Remove Space
	$lname = ucfirst(strtolower($lname)); 
	$_SESSION['reg_lname'] = $lname; //firstname into session

	//email
	$em = strip_tags($_POST['reg_email']); //Remove html Tag
	$em = str_replace(' ', '', $em);//Remove Space
	$em = ucfirst(strtolower($em)); //Uppercase firstlater	//Uppercase firstlater
	$_SESSION['reg_email'] = $em; //firstname into session	
	//email2
	$em2 = strip_tags($_POST['reg_email2']); //Remove html Tag
	$em2 = str_replace(' ', '', $em2); ///Remove Space
	$em2 = ucfirst(strtolower($em2)); //Uppercase firstlater
	$_SESSION['reg_email2'] = $em2; //firstname into session

	//password
	$password = strip_tags($_POST['reg_password']); //Remove html Tag

	//password2
	$password2 = strip_tags($_POST['reg_password2']); //Remove html Tag

	$date = date("Y-m-d");//getcrentdate

	if($em == $em2){

		if(filter_var($em, FILTER_VALIDATE_EMAIL)){

			$em = filter_var($em, FILTER_VALIDATE_EMAIL);

			//emailをすでに使っているか確認
			$e_check = mysqli_query($con,"SELECT email FROM users WHERE email = '$em'");

			//文字数を確認
			$num_rows = mysqli_num_rows($e_check);

			if($num_rows > 0){
				array_push($error_array, "Email already in use<br>");
			}

		}else{
			array_push($error_array,"Invalid email format<br>");
		}

	}else{
		array_push($error_array,"Email don't match<br>");
	}


	if(strlen($fname) > 25 || strlen($fname)<2){
		array_push($error_array,"Your first name must be betwwn 2 and 25 characters<br>");
	}
	if(strlen($lname) > 25 || strlen($lname)<2){
		array_push($error_array,"Your last name must be betwwn 2 and 25 characters<br>");
	}

	if($password != $password2){
		array_push($error_array,"Your password do not match<br>");
	} else if(preg_match('/[^A-Za-z0-9]/', $password)){
		array_push($error_array,"Your password can only contain english characters or numbers<br>");
	}
	if(strlen($password > 30 || strlen($password) < 5)){
		array_push($error_array,"Your password must be between 5 and 30 caharacters<br>");
	}

	if(empty($error_array)){
		$password =md5($password); 

		$username = strtolower($fname . "_" . $lname);
		$check_username_query = mysqli_query($con,"SELECT username FROM users WHERE username ='$username'");

		$i = 0;
		//if username exists add number to username
		while (mysqli_num_rows($check_username_query)!= 0) {
			$i++;
			$username = $username . "_" . $i;
			$check_username_query = mysqli_query($con,"SELECT username FROM users WHERE username ='$username'");
		}
		$rand = rand(1,5); 
		if($rand == 1)
		$profile_pic ="assets/images/profile_pics/defaults/head_wisteria.png";
		else if ($rand == 2)
		$profile_pic ="assets/images/profile_pics/defaults/head_wet_asphalt.png";
		else if ($rand == 3)
		$profile_pic ="assets/images/profile_pics/defaults/head_sun_flower.png";	
		else if ($rand == 4)
		$profile_pic ="assets/images/profile_pics/defaults/head_emerald.png";
		else if ($rand == 5)
		$profile_pic ="assets/images/profile_pics/defaults/head_red.png";

	$query = mysqli_query($con, "INSERT INTO users VALUES (null, '$fname', '$lname', '$username', '$em', '$password', '$date', '$profile_pic', '0', '0', 'no', ',')");



	array_push($error_array,"<span style='color : #14C800;'> You're all set! Goahead and login!</span><br>");

	//Clear seeeion valiables
	$_SESSION['reg_fname'] = "";
	$_SESSION['reg_lname'] = "";
	$_SESSION['reg_email'] = "";
	$_SESSION['reg_email2'] = "";

	}

}

?>