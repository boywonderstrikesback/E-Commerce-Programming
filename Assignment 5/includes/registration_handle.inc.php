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

if(!empty($_POST['date'])){
	$date = htmlspecialchars(add_slashes($_POST['date']));
}else{
	$errors_array['date'] = "Please enter a valid date!";
}

if(!empty($_POST['color'])){
	$color = htmlspecialchars(add_slashes($_POST['color']));
}else{
	$errors_array['color'] = "Please enter a valid color!";
}

if(!empty($_POST['user_id'])&&filter_var($_POST['user_id'], FILTER_VALIDATE_INT)){
	$user_id = htmlspecialchars(add_slashes($_POST['user_id']));
}else{
	$errors_array['user_id'] = "Please enter a valid user_id!";
}

if(isset($_POST['about'])&&is_array($_POST['about'])){
	$about = $_POST['about'];
}else{
	$errors_array['about'] = "Please enter a valid about option!";
}

if(isset($_POST['payment'])&&is_string($_POST['payment'])){
	$payment = $_POST['payment'];
}else{
	$errors_array['payment'] = "Please enter a valid payment option!";
}

if(isset($_POST['age_category'])){
	$age_category = $_POST['age_category'];
}else{
	$errors_array['age_category'] = "Please enter a valid age category!";
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
	Date: ".strip_slashes($date)." <br>
	Color: ".strip_slashes($color)." <br>
	User Id: ".strip_slashes($user_id)." <br>
	About: ";
	foreach($about as $var){
		echo $var.",";
	}
	echo "<br>
	Payment: $payment <br>
	Age Category: $age_category <br>
	Comment: ".strip_slashes($comment); 
}




?>