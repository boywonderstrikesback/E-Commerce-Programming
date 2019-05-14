<?php
$title =' Apex Predator Supplements Registration Page';
include_once('header.php');
if(isset($_POST['hidden_field'])){  
    //function include order_handle.php
    include_once('registration_handle.php');    
} 
//function include order_form.php
require_once('registration_form.php');
include_once('footer.php');
 
?>