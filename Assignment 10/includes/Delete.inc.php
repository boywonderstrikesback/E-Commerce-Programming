<?php

mysql_query($link, "SET AUTOMATIC =0");
$select_ = "SELECT _id, quantity from orders_hats WHERE oders_id=$orders_id";
$exec_select_ = @mysqli_query($link, $select_);
if(!$exec_select_){
    rollback('Previous orders could not be retrieved becase '.mysqli_error($link));
}else{
    while($one_record=mysqli_fetch_assoc($exec_select_previous_orders))
        $quantity=$one_record['quantiy'];
        $_id=$one_record['_id'];
        $update_="update at stock_quanity =(stock_quantity-$quantity) WHERE _id=$_id";
        $exec_update_ = @mysqli_query($link, $select_previous_orders);
        if(!$exec_select_previous_orders){
            rollback('Previous orders could not be retrieved becase '.mysqli_error($link));
    
    }
}
$delete_order="DELETE from billing_addresses.* ,transactions.*,
FROM customers
	INNER JOIN states USING (states_id)
	INNER JOIN orders USING (customers_id)
	INNER JOIN shipping_addresses USING (shipping_addresses_id)
	INNER JOIN billing_addresses USING (billing_addresses_id)
	INNER JOIN orders USING (orders_id)
	INNER JOIN shirts USING (shirts_id)
	INNER JOIN categories USING (categories_id)
	INNER JOIN sizes USING (sizes_id)
	INNER JOIN colors USING (colors_id)
    WHERE customers_id = 1 ";
    $exec_delete_order = @mysqli_query($link, $delete_order);
    if(!$exec_select_delete_order){
        rollback('Previous orders could not be retrieved becase '.mysqli_error($link));
    }else{
        mysql_query($link, "Commit");
        redirect('Delete is success.....', 'view_previous_orders.php',1);
    }


?>