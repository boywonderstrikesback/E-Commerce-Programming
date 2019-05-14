<?php
$title = 'Account Info';
require('./includes/mysql.inc.php');
$errors_array = array();
$customers_id=1;
require('./includes/functions.inc.php');

include('./includes/header.inc.php');

require('./includes/account_info.inc.php');

include('./includes/footer.inc.php');
?>