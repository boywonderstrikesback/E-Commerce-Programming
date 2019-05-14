<?php
DEFINE('HOST', 'localhost');
DEFINE('USER', 'mikeross');
DEFINE('PASS', 'Manyak25560');
DEFINE('DB', 'ecommerce_online');

$link = @mysqli_connect(HOST, USER, PASS, DB) or die('The following error occurred: '.mysqli_connect_error());
mysqli_set_charset($link, 'utf8');
?>