<?php
$title = 'Products';
require('./includes/mysql.inc.php');
$errors_array = array();
require('./includes/functions.inc.php');

include('./includes/header.inc.php');

require('./includes/view_products.inc.php');

include('./includes/footer.inc.php');
?>