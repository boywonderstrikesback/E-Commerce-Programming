<?php
$toggle = isset($_GET['toggle'])?$_GET['toggle']:TRUE;
$order_by = isset($_GET['order_by'])?$_GET['order_by']:'category';
$asc_desc = ($toggle)?'ASC':'DESC';

$select_producst = "SELECT category, description, matchnumber, keyword, code, price, stock_quantity, date_added, photo
	FROM bjj
	INNER JOIN bjj_categories USING (bjj_dvd_id)
	INNER JOIN bjj_sizes USING (bjj_numbers_id)
	
	ORDER BY $order_by $asc_desc";

$exec_select_product = @mysqli_query($link, $select_product);
if(!$exec_select_product){
	rollback('Product info could not be retrieved becase '.mysqli_error($link));
}elseif(mysqli_num_rows($exec_select_product) > 0){
	echo "<table class='product_info_table'>
		<tr class='header'>
			<th><a href='".$_SERVER['PHP_SELF']."?order_by=DVD&toggle=".!$toggle."'>DVD</a></th>
			<th><a href='".$_SERVER['PHP_SELF']."?order_by=description&toggle=".!$toggle."'>Description</a></th>
			<th><a href='".$_SERVER['PHP_SELF']."?order_by=numbers&toggle=".!$toggle."'>Number of Matches</a></th>
			<th><a href='".$_SERVER['PHP_SELF']."?order_by=keyword&toggle=".!$toggle."'>Color</a></th>
			<th><a href='".$_SERVER['PHP_SELF']."?order_by=price&toggle=".!$toggle."'>Price</a></th>
			<th><a href='".$_SERVER['PHP_SELF']."?order_by=stock_quantity&toggle=".!$toggle."'>Stock Quantity</a></th>
			<th><a href='".$_SERVER['PHP_SELF']."?order_by=date_added&toggle=".!$toggle."'>Date Added</a></th>
			<th>Photo</th>
		</tr>";
	while($one_record = mysqli_fetch_assoc($exec_select_product)){
		echo "<tr>
			<td>{$one_record['DVD']}</td>
			<td>{$one_record['description']}</td>
			<td>{$one_record['Number of Matches']}</td>
			<td style='background: {$one_record['code']}'>&nbsp;</td>
			<td>\${$one_record['price']}</td>
			<td>{$one_record['stock_quantity']}</td>
			<td>{$one_record['date_added']}</td>
			<td><img src='{$one_record['photo']}'></td>
		</tr>";
	}
	echo "<tr><td colspan='7'>Number of Products:</td><td>".mysqli_num_rows($exec_select_product)."</td></tr></table>";
	mysqli_free_result($exec_select_product);
}else{
	echo "No Product to Show";
}
?>