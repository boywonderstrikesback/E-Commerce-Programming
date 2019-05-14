<?php
require_once('../../../secure_files/mysql_connect.php');
$title ='List of Supplements';
include_once('header_admin.php');
if(isset($_POST['hidden_field'])){  
    include_once('list_order_handle.php');
     
}
require_once('list_order_form.php');
include_once('footer_admin.php');
?>