<?php
$title = 'Registration';
require('./includes/mysql.inc.php');
require('./includes/functions.inc.php');

include('./includes/header.inc.php');

if(!empty($_POST['form_submitted'])){
	require('./includes/registration_handle.inc.php');
}
require('./includes/registration.inc.php');

include('./includes/footer.inc.php');
?>