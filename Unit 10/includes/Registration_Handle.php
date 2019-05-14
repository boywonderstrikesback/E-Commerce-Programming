<?php

//mysqli_real_escape_string($link, $data);

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


if(count($errors_array)==0){
	mysqli_query($link, 'AUTOCOMMIT = 0');
	$insert_into_supplement_customers = "INSERT INTO supplement_customers (first_name, last_name, email, phone, password, address_1, address_2, city, supplement_states_id, zip, date_created) VALUES
	('$first_name', '$last_name', '$email', '$phone', '".password_hash($password, PASSWORD_BCRYPT)."', '$address_1', '$address_2', '$city', $hat_states_id, '$zip', '$date_created')";
	$exec_insert_into_supplement_customers = @mysqli_query($link, $insert_into_supplement_customers);
	if(!$exec_insert_into_supplement_customers){
		rollback("The following error occurred when inserting into supplement_customers: ".mysqli_error($link));
	}else{
		mysqli_query($link, 'COMMIT');
		header('refresh:2; url=./includes/login.inc.php');
		exit('You are successfully registered.. You are now being redirected to login page..');
	}
}




?>