<?php

//mysqli_real_escape_string($link, $data);

$errors_array = array();

if(!empty($_POST['first_name'])&&is_string($_POST['first_name'])){
	$first_name = htmlspecialchars(add_slashes($_POST['first_name']));
}else{
	$errors_array['first_name'] = "Please enter a valid first name!";
}

if(!empty($_POST['last_name'])&&is_string($_POST['last_name'])){
	$last_name = htmlspecialchars(add_slashes($_POST['last_name']));
}else{
	$errors_array['last_name'] = "Please enter a valid last name!";
}

if(!empty($_POST['email'])&&filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
	$email = htmlspecialchars(add_slashes($_POST['email']));
}else{
	$errors_array['email'] = "Please enter a valid email!";
}

if(!empty($_POST['phone'])){
	$phone = htmlspecialchars(add_slashes($_POST['phone']));
}else{
	$errors_array['phone'] = "Please enter a valid phone!";
}

if(!empty($_POST['url'])&&filter_var($_POST['url'], FILTER_VALIDATE_URL)){
	$url = htmlspecialchars(add_slashes($_POST['url']));
}else{
	$errors_array['url'] = "Please enter a valid url!";
}

if(!empty($_POST['pass'])){
	$pass = htmlspecialchars($_POST['pass']);
}else{
	$errors_array['pass'] = "Please enter a valid password!";
}

if(!empty($_POST['re_pass'])){
	$re_pass = htmlspecialchars($_POST['re_pass']);
}else{
	$errors_array['re_pass'] = "Please enter a valid repeat password!";
}

if(!empty($_POST['birthdate'])){
	$date = htmlspecialchars(add_slashes($_POST['birthdate']));
}else{
	$errors_array['birthdate'] = "Please enter a valid date!";
}

if(!empty($_POST['color'])){
	$color = htmlspecialchars(add_slashes($_POST['color']));
}else{
	$errors_array['color'] = "Please enter a valid color!";
}


if(isset($_POST['about'])){
	$about = $_POST['about'];
}else{
	$errors_array['about'] = "Please enter a valid about option!";
}

if(isset($_POST['gender'])){
	$gender = $_POST['gender'];
}else{
	$errors_array['gender'] = "Please enter a valid age category!";
}

if(!empty($_POST['comment'])){
	$comment = htmlspecialchars(add_slashes($_POST['comment']));
}else{
	$errors_array['comment'] = "Please enter a valid comment!";
}

function add_slashes($data){
	if(get_magic_quotes_gpc()) $data = stripslashes($data);
	return addslashes($data);
}

function strip_slashes($data){
	return stripslashes($data);
}

//textfields, textarea, search, url, email, password, color, range, number, progress, date, time, datetime -> The user is able to type the value in. No selection by the user, but instead the user enters data ---> USE empty(). !empty() returns FALSE for empty string, white space, FALSE, 0. For all other values, !empty() returns TRUE.

//checkboxes, radiobuttons, pull-downs (select), scroll-down list -> The user makes selection. ---> isset() returns FALSE if the data coming from the input field is UNDEFINED, NULL. Otherwise, it will return TRUE. 


/*
filter_var($data, FILTER_VALIDATE_EMAIL);
filter_var($data, FILTER_VALIDATE_URL);
filter_var($data, FILTER_VALIDATE_BOOLEAN);
filter_var($data, FILTER_VALIDATE_INT);
filter_var($data, FILTER_VALIDATE_FLOAT);
filter_var($data, FILTER_VALIDATE_IP);
filter_var($data, FILTER_VALIDATE_MAC);
is_array()
is_string();
*/

if(count($errors_array) > 0){
	foreach($errors_array as $key => $var){
		echo $var."<br>";
	}
}else{
	echo "First Name: ".strip_slashes($first_name)." <br>
	Last Name: ".strip_slashes($last_name)." <br>
	Email: ".strip_slashes($email)." <br>
	Phone: ".strip_slashes($phone)." <br>
	URL: ".strip_slashes($url)." <br>
	Password: ".strip_slashes($pass)." <br>
	Re-Password: ".strip_slashes($re_pass)." <br>
	Birthdate: ".strip_slashes($date)." <br>
	Color: ".strip_slashes($color)." <br>
	About: ".strip_slashes($about)." <br>
	Comment: ".strip_slashes($comment); 
}




?>
