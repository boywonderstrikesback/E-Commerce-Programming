<?php
$title = 'Order Product';
require('./includes/mysql.inc.php');
$hat_customers_id = 1;
$errors_array = array();
require('./includes/functions.inc.php');

if(isset($_POST['form_submitted'])){
	require('./includes/order_handle.inc.php');
}
include('./includes/header.inc.php');
require('./includes/order.inc.php');


include('./includes/footer.inc.php');
?>