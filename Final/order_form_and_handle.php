<?php
require_once('../../../secure_files/mysql_connect.php');
$title ='Apex Predator Supplements Order Page';
include_once('header_user.php');
if(isset($_POST['hidden_field'])){  
    //function include order_handle.php
    include_once('order_handle.php');
     
}
//function include order_form.php
require_once('order_form.php');
include_once('footer_user.php');
?>