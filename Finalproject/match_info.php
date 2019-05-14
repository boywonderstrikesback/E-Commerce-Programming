<?php
session_start();
$title = 'Match infro';
require('../../../secure_files/mysql.inc.php');
$errors_array = array();
require('./includes/functions.inc.php');
if(isset($_SESSION['bjj_matches_id']) && isset($_SESSION['full_name'])){
	$hat_customers_id = $_SESSION['bjj_matches_id'];
	include('./includes/header.inc.php');

	require('./includes/account_info.inc.php');

	include('./includes/footer.inc.php');
}else{
	redirect('You are nto an authentic user', 'login.php', 1);
}
?>