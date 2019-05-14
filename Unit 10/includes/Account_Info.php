<?php

$select_account_info = "SELECT CONCAT(first_name,' ',last_name) as 'Full Name', email, phone, CONCAT_WS(' ',address_1, address_2, city, abbr, zip) as address, date_created
	from hat_customers 
	INNER JOIN hat_states USING(hat_states_id)";

$exec_select_account_info = @mysqli_query($link, $select_account_info);
if(!$exec_select_account_info){
	rollback('Customer account info could not be retrieved becase '.mysqli_error($link));
}elseif(mysqli_num_rows($exec_select_account_info) > 0){
	echo "<table class='account_info_table'>
		<tr class='header'>
			<th>Full Name</th>
			
		</tr>";
	while($one_record = mysqli_fetch_assoc($exec_select_account_info)){
		echo "<tr>
			<td>{$one_record['Full Name']}</td>
		
	}
	echo "<tr><td colspan='4'>Number of Customers:</td><td>".mysqli_num_rows($exec_select_account_info)."</td></tr></table>";
	mysqli_free_result($exec_select_account_info);
}else{
	echo "No Customer to Report";
}

	
?>