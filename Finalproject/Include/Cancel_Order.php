<?php
mysqli_query($link, "SET AUTOCOMMIT = 0");
$select_supplements = "SELECT bjj_id, quantity from bjj_orders_id WHERE bjj_orders_id = $bjj_orders_id";
$exec_select_supplements = @mysqli_query($link, $select_supplements);
if(!$exec_select_supplements){
	rollback('Order could not be retrieved '.mysqli_error($link));
}else{
	while($one_record = mysqli_fetch_assoc($exec_bjj_id)){
		$quantity = $one_record['quantity'];
		$hats_id = $one_record['bjj_id'];
		$update_supplements = "UPDATE bjj set stock_quantity = (stock_quantity+$quantity) WHERE bjj_matches_id = $bjj_matches_id";
		$exec_update_hats = @mysqli_query($link, $update_supplements);
		if(!$exec_select_supplements){
			rollback('Update was not successful becase '.mysqli_error($link));
		}
	}
	$delete_order = "DELETE bjj_shipping_addresses.*, bjj_billing_addresses.*, bjj_transactions.* FROM bjj_orders 
	INNER JOIN bjj_billing_addresses USING (bjj_billing_addresses_id)
	INNER JOIN bjj_shipping_addresses USING (bjj_shipping_addresses_id)
	INNER JOIN bjj_transactions USING (bjj_transactions_id)
	WHERE bjj_orders_id = $bjj_orders_id";
	$exec_delete_order = @mysqli_query($link, $delete_order);
	if(!$exec_delete_order){
		rollback('Delete was not successful becase '.mysqli_error($link));
	}else{
		mysqli_query($link, "COMMIT");
		redirect('successfully deleted...', 'view_current_orders.php', 1);
	}	
}
?>