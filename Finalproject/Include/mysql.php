<?php
DEFINE('HOST', 'localhost');
DEFINE('USER', 'mjross03');
DEFINE('PASS', 'Leglock@90');
DEFINE('DB', 'ecommerce');

$link = @mysqli_connect(HOST, USER, PASS, DB) or die('The following error occurred: '.mysqli_connect_error());
mysqli_set_charset($link, 'utf8');
?>