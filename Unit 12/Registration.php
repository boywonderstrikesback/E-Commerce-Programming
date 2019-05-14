<?php
$title = 'Registration';
require('./includes/mysql.inc.php');
$errors_array = array();
require('./includes/functions.inc.php');

if(!empty($_POST['form_submitted'])){
	require('./includes/registration_handle.inc.php');
}
include('./includes/header.inc.php');
require('./includes/registration.inc.php');

include('./includes/footer.inc.php');
?>