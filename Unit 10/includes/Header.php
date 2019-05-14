<!doctype html>
<html>
<head>
	<title><?php if(isset($title)){ echo $title; }else{ echo 'E-Commerce'; } ?></title>
	<meta charset='utf-8'>
	<style>
		.product_info_table, .account_info_table {
			border-collapse: collapse;
			border: 1px solid maroon;
		}
		.product_info_table .header, .product_info_table td, .account_info_table .header, .account_info_table td{
			margin: 0;
			padding: 10px;
			border-spacing: 0px;
		}
		.product_info_table .header, .account_info_table .header{
			border: 2px solid black;
			background: olive;
			color: black;
		}
		.product_info_table td, .account_info_table td{
			border: 1px solid olive;
			background: black;
			color: olive;			
		}
	</style>
</head>
<body>