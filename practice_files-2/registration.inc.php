<!doctype html>
<html>
<head>
	<title>Registration</title>
</head>
<body>
	<form action='./display_errors.php' method='POST' name='registration_form' id='registration_form' enctype='multipart/form-data'>
		<fieldset><legend>Bio</legend>
			<?php
				create_form_field('First Name:', 'text', 'first_name', 'first_name', '', ['maxlength'=>'20', 'size'=>'12', 'tabindex'=>'1', 'title'=>'Type in Your First Name Here', 'required'=>'required', 'pattern'=>'[A-Za-z]', 'placeholder'=>'First Name']);
				create_form_field('Last Name:', 'text', 'last_name', 'last_name', '', ['maxlength'=>'20', 'size'=>'12', 'tabindex'=>'2', 'title'=>'Type in Your Last Name Here', 'required'=>'required', 'pattern'=>'[A-Za-z]', 'placeholder'=>'Last Name']);
				create_form_field('Email:', 'email', 'email', 'email', '', ['maxlength'=>'20', 'size'=>'12', 'tabindex'=>'3', 'title'=>'Type in Your email Here', 'required'=>'required', 'pattern'=>'[A-Za-z]', 'placeholder'=>'email@you.com']);
				create_form_field('Phone:', 'tel', 'phone', 'phone', '', ['maxlength'=>'50', 'size'=>'30', 'tabindex'=>'4', 'title'=>'Type in Your Phone Number', 'placeholder'=>'(XXX)-XXX-XXXX']);
				create_form_field('Web Site:', 'url', 'url', 'url', '', ['maxlength'=>'50', 'size'=>'30', 'tabindex'=>'5', 'title'=>'Type in Your Web Site Address', 'placeholder'=>'http://www.you.com']);
				create_form_field('Password:', 'password', 'pass', 'pass', '', ['maxlength'=>'15', 'size'=>'10', 'tabindex'=>'6', 'title'=>'Type in Your Password', 'required'=>'required', 'placeholder'=>'xxxxxxxx']);
				create_form_field('Retype Password:', 'password', 're_pass', 're_pass', '', ['maxlength'=>'15', 'size'=>'10', 'tabindex'=>'7', 'title'=>'Retype in Your Password', 'required'=>'required', 'placeholder'=>'xxxxxxxx']);
				create_form_field('Date:', 'date', 'date', 'date', '', ['maxlength'=>'12', 'size'=>'10', 'tabindex'=>'8', 'title'=>'Todays Date', 'placeholder'=>'MM/DD/YYYY']);
				create_form_field('Favorite Color:', 'color', 'color', 'color', '', ['maxlength'=>'20', 'size'=>'10', 'tabindex'=>'9', 'title'=>'Your Favorite Color', 'placeholder'=>'#ffffff']);
				create_form_field('ID:', 'number', 'user_id', 'user_id', '', ['maxlength'=>'3', 'size'=>'3', 'max'=>'999', 'min'=>'0', 'step'=>'2', 'tabindex'=>'10', 'title'=>'Your ID', 'placeholder'=>'999']);
				
				function create_form_field($label='', $type='text', $name='', $id='', $value='', $extras=array()){
					echo "<p>";
					if(!empty($label)) echo "<label for='$id'>$label</label>";
					if(($type=='text') || ($type=='email') || ($type=='tel') || ($type=='url') || ($type=='password') || ($type=='date') || ($type=='color') || ($type=='number')){
						echo "<input type='$type' id='$id' name='$name'";
						if(!empty($value)) echo "value='$value'";
							if(count($extras) > 0){
								foreach($extras as $key=>$var){
									echo "$key='$var'";
								}
							}
						echo ">";
					}elseif($type=='textarea'){
						echo "<textarea id='$id' name='$name'";
							if(count($extras) > 0){
								foreach($extras as $key=>$var){
									echo "$key='$var'";
								}
							}
						echo ">";
						if(!empty($value)) echo "$value";
						echo "</textarea>";
					}
					echo "</p>";
				}
			?>
		</fieldset>
		<fieldset><legend>Preferences</legend>
			<p>
				<label for='about'>How did you hear about us?</label>
				Internet: <input type='checkbox' name='about[]' id='internet' value='internet' checked='checked' />
				Friend: <input type='checkbox' name='about[]' id='friend' value='friend' checked='checked' />
				Phone: <input type='checkbox' name='about[]' id='phone' value='phone' />
				News: <input type='checkbox' name='about[]' id='news' value='news' />
				Other: <input type='checkbox' name='about[]' id='other' value='other' />
			</p>
			<p>
				<label for='payment'>Payment Method</label>
				Visa: <input type='radio' name='payment' id='visa' value='visa' />
				Discover: <input type='radio' name='payment' id='discover' value='discover' checked='checked' />
				Master: <input type='radio' name='payment' id='master' value='master' />
			</p>
			<p>
				<label for='age_category'>Age Category</label>
				<select name='age_category' id='age_category' size='1' />
					<optgroup label='younger'>
						<option value='15-25'>15 to 25</option>
						<option value='25-35' selected='selected'>25 to 35</option>
					</optgroup>
					<optgroup label='older'>
						<option value='35-50'>35 to 50</option>
					</optgroup>
				</select>
			</p>
			<?php
			create_form_field('Comments:', 'textarea', 'comment', 'comment', 'Type your comment here:', ['rows'=>'10', 'cols'=>'50']);
			?>
			<p>
				<label for='file_upload'>Upload</label>
				<input type='file' multiple name='file_upload' id='file_upload' />
			</p>
			
			<input type='hidden' value='user_id' name='hidden_field' id='hidden_field' />
		</fieldset>
		<fieldset>
		<p>
			<label>
				<input type='submit' value='Submit' />
				<!--<input type='image' src='./Penguins.jpg' name='penguins' id='penguins' />-->
				<input type='reset' value='Reset' />
			</label>
		</p>
		</fieldset>
	
	</form>
</body>
</html>