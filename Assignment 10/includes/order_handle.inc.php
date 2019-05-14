<?php

//mysqli_real_escape_string($link, $data);

/**************** Shipping and Billing Address Handle ******************************/
if(!empty($_POST['address_1'])){
	$address_1 = htmlspecialchars(add_slashes($_POST['address_1']));
}else{
	$errors_array['address_1'] = "Please enter a valid home address!";
}

if(!empty($_POST['address_2'])){
	$address_2 = htmlspecialchars(add_slashes($_POST['address_2']));
}else{
	$address_2 = null;
}

if(!empty($_POST['city'])){
	$city = htmlspecialchars(add_slashes($_POST['city']));
}else{
	$errors_array['city'] = "Please enter a valid City!";
}

if(isset($_POST['states_id'])){
	$hat_states_id = $_POST['states_id'];
}else{
	$errors_array['states_id'] = "Please pick a state!";
}

if(!empty($_POST['zip'])){
	$zip = htmlspecialchars(add_slashes($_POST['zip']));
}else{
	$errors_array['zip'] = "Please enter a valid zip!";
}
/******************************************************************************/

/********************** Payment Method Handle ************************/
if(isset($_POST['credit_type'])){
	$credit_type = $_POST['credit_type'];
}else{
	$errors_array['credit_type'] = "Please pick a valid credit type!";
}

if(!empty($_POST['credit_no'])&&is_numeric(trim($_POST['credit_no']))){
	$credit_no = trim($_POST['credit_no']);
	$credit_no_four = substr($credit_no, -4);
}else{
	$errors_array['credit_no'] = "Please enter a valid credit no!";
}
/******************************************************************************/

/********************** Shipping Method Handle ************************/

if(isset($_POST['carriers_methods_id'])){
	$hat_carriers_methods_id = $_POST['carriers_methods_id'];
}else{
	$errors_array['carriers_methods_id'] = 'Please pick a shipping method';
}
$select_shipping_fee = "SELECT fee from hat_carriers_methods WHERE carriers_methods_id = $hat_carriers_methods_id";
$exec_select_shipping_fee = @mysqli_query($link, $select_shipping_fee);
if(!$exec_select_shipping_fee){
	rollback("The following error occurred when retrieving shipping fee: ".mysqli_error($link));
}else{
	$one_record = mysqli_fetch_assoc($exec_select_shipping_fee);
	$fee = $one_record['fee'];
}

/******************************************************************************/

/********************** Product Handle ************************/

if(isset($_POST['quantity'])&&is_array($_POST['quantity'])){
	$quantity = $_POST['quantity'];
}else{
	$errors_array['quantity'] = "Please enter a quantity for at least a product type!";
}

foreach($quantity as $_id=>$arr){
	foreach($arr as $price => $value){
		$order_total += ($price * $value);
		$shipping_fee += ($fee * $value);
	}
	$amount_charged = $order_total + $shipping_fee;
}

/******************************************************************************/

if(count($errors_array)==0){
	mysqli_query($link, 'AUTOCOMMIT = 0');
	$insert_shipping_addresses = "INSERT INTO shipping_addresses (address_1, address_2, city, hat_states_id, zip, date_created) 
		VALUES ('$address_1', '$address_2', '$city', $states_id, '$zip', now())";
	$exec_insert_shipping_addresses = @mysqli_query($link, $insert_shipping_addresses);
	if(!$exec_insert_shipping_addresses){
		rollback("The following error occurred when inserting into hat_shipping_addresses: ".mysqli_error($link));
	}else{
		$shipping_addresses_id = mysqli_insert_id($link);
		$insert_billing_addresses = "INSERT INTO billing_addresses (address_1, address_2, city, hat_states_id, zip, date_created) 
		VALUES ('$address_1', '$address_2', '$city', $hat_states_id, '$zip', now())";
		$exec_insert_billing_addresses = @mysqli_query($link, $insert_billing_addresses);
		if(!$exec_insert_billing_addresses){
			rollback("The following error occurred when inserting into billing_addresses: ".mysqli_error($link));
		}else{
			$billing_addresses_id = mysqli_insert_id($link);
			$insert_transactions = "INSERT into transactions (amount_charged, type, response_code, response_reason, response_text, date_created) VALUES ($amount_charged, 'credit', 'OK', '', 'Confirmed', now())";
			$exec_insert_transactions = @mysqli_query($link, $insert_transactions);
			if(!$exec_insert_transactions){
				rollback("The following error occurred when inserting into transactions: ".mysqli_error($link));
			}else{
				$transactions_id = mysqli_insert_id($link);
				$insert_orders = "INSERT into orders (customers_id, transactions_id, shipping_addresses_id, hat_carriers_methods_id, hat_billing_addresses_id, credit_no, credit_type, order_total, shipping_fee, order_date) VALUES($hat_customers_id, $hat_transactions_id, $hat_shipping_addresses_id, $hat_carriers_methods_id, $hat_billing_addresses_id, '$credit_no_four', '$credit_type', $order_total, $shipping_fee, now())";
				$exec_insert_orders = @mysqli_query($link, $insert_orders);
				if(!$exec_insert_orders){
					rollback("The following error occurred when inserting into hat_orders: ".mysqli_error($link));
				}else{
					$orders_id = mysqli_insert_id($link);
					foreach($quantity as $_id=>$arr){
						foreach($arr as $price => $value){
							if(!empty($value)){
							
							$type_total = $price * $value;
							$insert_orders_ = "INSERT into orders_ (orders_id, _id, quantity, price) VALUES ($orders_id, $_id, $value, $type_total)";
							$exec_insert_orders_hats = @mysqli_query($link, $insert_orders_hats);
							if(!$exec_insert_orders_hats){
								rollback('The following error ocurred when inserting into  orders'.mysqli_error($link));
							}else{
								$select_stock_quantity = "SELECT stock_quantity from hats where _id = $_id";
								$exec_select_stock_quantity = @mysqli_query($link, $select_stock_quantity);
								if(!$exec_select_stock_quantity){
									rollback('The following error ocurred when selecting stock quantity'.mysqli_error($link));
								}else{
									$one_record = mysqli_fetch_assoc($exec_select_stock_quantity);
									$stock_quantity = $one_record['stock_quantity'];
									$updated_quantity = $stock_quantity - $value;
									$update_hats = "UPDATE hats SET stock_quantity = $updated_quantity WHERE _id = $_id";
									$exec_update_ = @mysqli_query($link, $update_);
									if(!$exec_update_hats){
										rollback('The following error ocurred when updating stock quantity'.mysqli_error($link));
									}
								}
								}
							}
						}
					}
					mysqli_query($link, 'COMMIT');
					redirect('Your orders were placed...You are now being redirected to order page ...', 'order.php', 2);
				}
			}
		}
	}
}




?>