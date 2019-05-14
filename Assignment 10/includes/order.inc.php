<form action='<? echo $_SERVER['PHP_SELF']; ?>' method='POST' name='order_form' id='order_form' enctype='multipart/form-data'>
	<fieldset><legend>Products</legend>
	<?php
	$toggle = isset($_GET['toggle'])?$_GET['toggle']:TRUE;
	$order_by = isset($_GET['order_by'])?$_GET['order_by']:'category';
	$asc_desc = ($toggle)?'ASC':'DESC';

	$select_producst = "SELECT id, category, description, size, keyword, code, price, stock_quantity, photo
		FROM hats
		INNER JOIN categories USING (hat_categories_id)
		INNER JOIN sizes USING (hat_sizes_id)
		INNER JOIN colors USING (hat_colors_id)
		ORDER BY $order_by $asc_desc";

	$exec_select_producst = @mysqli_query($link, $select_producst);
	if(!$exec_select_producst){
		rollback('Product info could not be retrieved becase '.mysqli_error($link));
	}elseif(mysqli_num_rows($exec_select_producst) > 0){
		echo "<table class='product_info_table'>
			<tr class='header'>
				<th><a href='".$_SERVER['PHP_SELF']."?order_by=category&toggle=".!$toggle."'>Category</a></th>
				<th><a href='".$_SERVER['PHP_SELF']."?order_by=description&toggle=".!$toggle."'>Description</a></th>
				<th><a href='".$_SERVER['PHP_SELF']."?order_by=size&toggle=".!$toggle."'>Size</a></th>
				<th><a href='".$_SERVER['PHP_SELF']."?order_by=keyword&toggle=".!$toggle."'>Color</a></th>
				<th><a href='".$_SERVER['PHP_SELF']."?order_by=price&toggle=".!$toggle."'>Price</a></th>
				<th><a href='".$_SERVER['PHP_SELF']."?order_by=stock_quantity&toggle=".!$toggle."'>Stock Quantity</a></th>
				<th>Photo</th>
				<th>Quantity</th>
			</tr>";
		while($one_record = mysqli_fetch_assoc($exec_select_producst)){
			$hats_id = $one_record['id'];
			$price = $one_record['price'];
			$max = $one_record['stock_quantity'];
			echo "<tr>
				<td>{$one_record['category']}</td>
				<td>{$one_record['description']}</td>
				<td>{$one_record['size']}</td>
				<td style='background: {$one_record['code']}'>&nbsp;</td>
				<td>\${$one_record['price']}</td>
				<td>{$one_record['stock_quantity']}</td>
				<td><img src='{$one_record['photo']}'></td>
				<td><input type='number' name='quantity[$hats_id][$price]' id='quantity' min='0' max='$max'";
					if(isset($quantity)&&!empty($quantity[$hats_id][$price])) echo "value='{$quantity[$hats_id][$price]}'";
				echo "></td></tr>";
		}
		echo "</table>";
		mysqli_free_result($exec_select_producst);
	}else{
		echo "No Product to Show";
	}
	?>
	</fieldset>	
	<fieldset><legend>Payment</legend>
		<?php create_checkbox_radio_drop_down('Credit Type: ', 'radio', 'credit_type', ['visa'=>'Visa', 'master'=>'Master', 'discover'=>'Discover'], $errors_array); ?>
		<?php create_form_field('Credit No: ', 'text', 'credit_no', 'credit_no', ['maxlength'=>'20', 'size'=>'16', 'title'=>'Type in your credit no', 'required'=>'required', 'pattern'=>'[0-9]{16,20}', 'placeholder'=>'XXXXXXXXXXXXXXXX'], $errors_array); ?>
	</fieldset>	
	<fieldset><legend>Shipping & Billing Address</legend>
	<?php
		$select_address = "SELECT address_1, address_2, city, hat_states_id, zip from hat_customers WHERE hat_customers_id=$hat_customers_id";
		$exec_select_address = @mysqli_query($link, $select_address);
		if(!$exec_select_address){
			rollback('The following error occurred.'.mysqli_error($link));
		}else{
			$one_record = mysqli_fetch_assoc($exec_select_address);
			$address_1 = $one_record['address_1'];
			$address_2 = $one_record['address_2'];
			$city = $one_record['city'];
			$hat_states_id = $one_record['states_id'];
			$zip = $one_record['zip'];
		}
	
		create_form_field('Address 1:', 'text', 'address_1', 'address_1', ['maxlength'=>'100', 'size'=>'50', 'tabindex'=>'6', 'title'=>'Home Address', 'required'=>'required', 'pattern'=>'[A-Za-z0-9_\.\#\' \-:=]{2,100}', 'placeholder'=>'100 Market Street'], $errors_array);
		create_form_field('Address 2:', 'text', 'address_2', 'address_2', ['maxlength'=>'100', 'size'=>'50', 'tabindex'=>'7', 'title'=>'Home Address', 'pattern'=>'[A-Za-z0-9_\.\#\' \-:=]{0,100}', 'placeholder'=>'Suite #9'], $errors_array);
		create_form_field('City:', 'text', 'city', 'city', ['maxlength'=>'50', 'size'=>'20', 'tabindex'=>'8', 'title'=>'City', 'pattern'=>'[A-Za-z]{2,50}', 'placeholder'=>'Youngstown'], $errors_array);
		/***************** Create function call for state drop down menu ********************************/
		$select_states = "SELECT states_id, state, abbr from states";
		$exec_select_states = @mysqli_query($link, $select_states);
		if(!$exec_select_states){
			exit("The following error occurred: ".mysqli_error($link));
			mysqli_close($link);
		}else{
			$multi_array = array();
			while($one_record = mysqli_fetch_assoc($exec_select_states)){
				$multi_array[] = $one_record;
			}
			create_drop_down_from_query('State: ', 'states_id', 'states_id', $multi_array, ['tabindex'=>'9', 'title'=>'State'], $errors_array);
		}
			
			/***************** End function call for state drop down menu ********************************/
			
			create_form_field('Zip:', 'text', 'zip', 'zip', ['maxlength'=>'5', 'size'=>'5', 'tabindex'=>'10', 'title'=>'Zip Code', 'placeholder'=>'44555'], $errors_array);	
	?>
	</fieldset>		
	<fieldset><legend>Shipping Method</legend>	
		<?php
		$select_carriers_methods = "SELECT carriers_methods_id, carrier, method, fee from hat_carriers_methods";
		$exec_select_carriers_methods = @mysqli_query($link, $select_carriers_methods);
		if(!$exec_select_carriers_methods){
			exit("The following error occurred: ".mysqli_error($link));
			mysqli_close($link);
		}else{
			$multi_array = array();
			while($one_record = mysqli_fetch_assoc($exec_select_carriers_methods)){
				$multi_array[] = $one_record;
			}
			create_drop_down_from_query('Shipping Method: ', 'carriers_methods_id', '
			carriers_methods_id', $multi_array, ['title'=>'Shipping Method'], $errors_array);
		}
		?>
	</fieldset>
	<fieldset>
	<p>
		<label>
			<input type='hidden' value='form_submitted' name='form_submitted' id='form_submitted' />
			<input type='submit' value='Submit' />
			<!--<input type='image' src='./Penguins.jpg' name='penguins' id='penguins' />-->
			<input type='reset' value='Reset' />
		</label>
	</p>
	</fieldset>

</form>