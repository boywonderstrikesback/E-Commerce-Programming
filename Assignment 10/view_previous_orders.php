<?php
$title = 'Prior Orders';
require('./includes/mysql.inc.php');
$errors_array = array();

$customers_id=1;
require('./includes/functions.inc.php');

if(isset($_GET['customers_id'])){
    $orders_id=$_Get['orders_id'];
    require('./includes/Delete.inc.php');
    }else{
include('./includes/header.inc.php');
require('./includes/view_previous_orders.inc.php');
}
include('./includes/footer.inc.php');
?>