<?php
DEFINE('HOST', 'localhost');
DEFINE('USERNAME','gcottocruz');
DEFINE('PASS', 'Ironfist1992');
DEFINE('DB', 'e_commerce2016');
 
$link = @mysqli_connect(HOST, USERNAME, PASS, DB) OR DIE('A connection to MySSQL database could not be established because: '.mysqli_connect_error());
 
?>