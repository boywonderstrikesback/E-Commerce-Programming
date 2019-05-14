<?php
$toggle = isset($_GET['toggle'])?$_GET['toggle']:TRUE;
$order_by = isset($_GET['order_by'])?$_GET['order_by']:'category';
$asc_desc = ($toggle)?'ASC':'DESC';

$select_previous_orders = "SELECT bjj_orders_bjj.bjj_orders_id, CONCAT_WS(' ',bjj_shipping_addresses.address_1, bjj_shipping_addresses.address_2, bjj_shipping_addresses.city, state, bjj_shipping_addresses.zip) as 'Shipping Address', CONCAT_WS(' ',bjj_billing_addresses.address_1, bjj_billing_addresses.address_2, bjj_billing_addresses.city, state, bjj_billing_addresses.zip) as 'Billing Address', GROUP_CONCAT(dvd SEPARATOR '<br><hr>') as dvd, GROUP_CONCAT(numbers SEPARATOR '<br><hr>') as numbers, GROUP_CONCAT(keyword SEPARATOR '<br><hr>') as keyword, GROUP_CONCAT(bjj_orders_bjj.quantity SEPARATOR '<br><hr>') as quantity, GROUP_CONCAT(bjj_orders_bjj.price SEPARATOR '<br><hr>') as price, credit_no, credit_type, order_total, shipping_fee, order_date, shipping_date
	FROM bjj_customers
	INNER JOIN bjj_states USING (bjj_matches_id)
	INNER JOIN bjj_orders USING (bjj_customers_id)
	INNER JOIN bjj_shipping_addresses USING (bjj_shipping_addresses_id)
	INNER JOIN bjj_billing_addresses USING (bjj_billing_addresses_id)
	INNER JOIN bjj_orders_supplements USING (bjj_orders_id)
	INNER JOIN bjj USING (bjj_id)
	INNER JOIN bjj_categories USING (bjj_categories_id)
	INNER JOIN bjj_sizes USING (bjj_sizes_id)
	INNER JOIN bjj_colors USING (bjj_colors_id)
	WHERE bjj_customers_id = 1
	GROUP BY bjj_orders_bjj.bjj_orders_id
	ORDER BY $order_by $asc_desc";

$exec_select_previous_orders = @mysqli_query($link, $select_previous_orders);
if(!$exec_select_previous_orders){
	rollback('Previous orders could not be retrieved becase '.mysqli_error($link));
}elseif(mysqli_num_rows($exec_select_previous_orders) > 0){
	echo "<table class='product_info_table'>
		<tr class='header'>
			<th><a href='".$_SERVER['PHP_SELF']."?order_by=bjj_shipping_addresses.address_1&toggle=".!$toggle."'>Shipping Address</a></th>
			<th><a href='".$_SERVER['PHP_SELF']."?order_by=bjj_billing_addresses.address_1&toggle=".!$toggle."'>Billing Address</a></th>
			<th><a href='".$_SERVER['PHP_SELF']."?order_by=category&toggle=".!$toggle."'>Category</a></th>
			<th><a href='".$_SERVER['PHP_SELF']."?order_by=size&toggle=".!$toggle."'>Size</a></th>
			<th><a href='".$_SERVER['PHP_SELF']."?order_by=keyword&toggle=".!$toggle."'>Color</a></th>
			<th><a href='".$_SERVER['PHP_SELF']."?order_by=bjj_orders_bjj.quantity&toggle=".!$toggle."'>Quantity</a></th>
			<th><a href='".$_SERVER['PHP_SELF']."?order_by=bjj_orders_bjj.price&toggle=".!$toggle."'>Price</a></th>
			<th><a href='".$_SERVER['PHP_SELF']."?order_by=credit_no&toggle=".!$toggle."'>Credit No</a></th>
			<th><a href='".$_SERVER['PHP_SELF']."?order_by=credit_type&toggle=".!$toggle."'>Credit Type</a></th>
			<th><a href='".$_SERVER['PHP_SELF']."?order_by=order_total&toggle=".!$toggle."'>Order Total</a></th>
			<th><a href='".$_SERVER['PHP_SELF']."?order_by=shipping_fee&toggle=".!$toggle."'>Shipping Fee</a></th>
			<th><a href='".$_SERVER['PHP_SELF']."?order_by=order_date&toggle=".!$toggle."'>Order Date</a></th>
			<th><a href='".$_SERVER['PHP_SELF']."?order_by=shipping_date&toggle=".!$toggle."'>Shipping Date</a></th>
		</tr>";
	while($one_record = mysqli_fetch_assoc($exec_select_previous_orders)){
		echo "<tr>
			<td>{$one_record['Shipping Address']}</td>
			<td>{$one_record['Billing Address']}</td>
			<td>{$one_record['dvd']}</td>
			<td>{$one_record['number of matches']}</td>
			<td>{$one_record['keyword']}</td>
			<td>{$one_record['quantity']}</td>
			<td>\${$one_record['price']}</td>
			<td>{$one_record['credit_no']}</td>
			<td>{$one_record['credit_type']}</td>
			<td>\${$one_record['order_total']}</td>
			<td>\${$one_record['shipping_fee']}</td>
			<td>{$one_record['order_date']}</td>
			<td>{$one_record['shipping_date']}</td>
		</tr>";
	}
	echo "<tr><td colspan='12'>Number of Prior Orders:</td><td>".mysqli_num_rows($exec_select_previous_orders)."</td></tr></table>";
	mysqli_free_result($exec_select_previous_orders);
}else{
	echo "No Prior Orders to Show";
}
?>