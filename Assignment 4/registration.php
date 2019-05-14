<?php

require('./includes/mysql.inc.php');

include('./includes/header.inc.php');

if(!empty($_POST['form_submitted'])){
	require('./includes/registration_handle.inc.php');
}else{
	require('./includes/registration.inc.php');
}

include('./includes/footer.inc.php');
?>