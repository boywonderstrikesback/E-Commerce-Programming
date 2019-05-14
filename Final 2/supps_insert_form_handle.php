<?php
require_once('../../../secure_files/mysql_connect.php');
$title = 'Insert the Supplement and Quantity';
include_once('header_admin.php');
if(isset($_POST['hidden_field'])) {
    include_once('supplement_insert_handle.php');
}
require_once('supplement_insert_form.php');
include_once('footer_admin.php');
 
?>