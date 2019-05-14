<?php
<form action = 'registration_handle.inc.php' method = 'past'>

	<input type = 'text' size = '15' maxlength = '20' name = 'first_name' value =
	placeholder = 'First Name Goes Here' required autofocus title = 'Write the Applicant's First Name Here'
	autocomplete pattern = '[A-Za-z] {2,20}' />
	
	<input type ='password' size = '15' maxlength= '20' name= 'first_password' id='first_password'
	placeholder = 'Pass' pattern= '[A-Za-z]{2,10}' />
	
	<input type='radio' name = 'radio_buttons' id='first_radio' value = 'First Radio Buttons' checked ='checked' />
	<input type='radio' name = 'radio_buttons' id='second_radio' value = 'Second Radio Buttons' />
	
	<input type='checkbox' name= 'my_checkbox[]' id='first_checkbox' value = 'First Checkbox' checked ='checked' />
	<input type='checkbox' name= 'my_checkbox[]' id='second_checkbox' value = 'Second Checkbox' />
	
	<label for='first_pull_down_menu'>Select An Option </label>
	<select name='first_pull_down' id='first_pull_down' size='1'>
				<optgroup label='Group 1'>
					<option value="About_Us">About Us</option>
					<option value="Contact_Us">Contact Us</option>
					<option value="Products_Services"selected= "selected">Products Services </option>
				</optgroup>
				<optgroup label='Group 2'>
					<option value="Select_Size">Select Size</option>
					<option value="Select_Color">Select Color</option>
					<option value="Select_Design">Select Desgin</option>
	</select>

?>	