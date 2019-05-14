<?php
session_start();
$title = 'Pending Orders';
require('../../../secure_files/mysql.inc.php');
$errors_array = array();
require('./includes/functions.inc.php');
if(isset($_SESSION['bjj_matches_id']) && isset($_SESSION['full_name'])){
	$supplement_customers_id = $_SESSION['bjj_matches_id'];
	if(isset($_GET['bjj_matches_id'])){
		$supplement_orders_id = $_GET['bjj_matches_id'];
		require('./includes/cancel_orders.inc.php');
	}else{
		include('./includes/header.inc.php');
		require('./includes/view_current_orders.inc.php');
	}
	include('./includes/footer.inc.php');
}else{
	redirect('You are nto an authentic user', 'login.php', 1);
}
?>