<form action='<? echo $_SERVER['PHP_SELF']; ?>' method='POST' name='registration_form' id='registration_form' enctype='multipart/form-data'>
	<fieldset><legend>Bio</legend>
		<?php
			create_form_field('First Name:', 'text', 'first_name', 'first_name', ['maxlength'=>'20', 'size'=>'12', 'tabindex'=>'1', 'title'=>'Type in Your First Name Here', 'required'=>'required', 'pattern'=>'[A-Za-z]{2,20}', 'placeholder'=>'First Name']);
			create_form_field('Last Name:', 'text', 'last_name', 'last_name', ['maxlength'=>'20', 'size'=>'12', 'tabindex'=>'2', 'title'=>'Type in Your Last Name Here', 'required'=>'required', 'pattern'=>'[A-Za-z]{2,20}', 'placeholder'=>'Last Name']);
			create_form_field('Email:', 'email', 'email', 'email', ['maxlength'=>'20', 'size'=>'12', 'tabindex'=>'3', 'title'=>'Type in Your email Here', 'required'=>'required', 'placeholder'=>'email@you.com']);
			create_form_field('Phone:', 'tel', 'phone', 'phone', ['maxlength'=>'50', 'size'=>'30', 'tabindex'=>'4', 'title'=>'Type in Your Phone Number', 'placeholder'=>'(XXX)-XXX-XXXX']);
			create_form_field('Web Site:', 'url', 'url', 'url', ['maxlength'=>'50', 'size'=>'30', 'tabindex'=>'5', 'title'=>'Type in Your Web Site Address', 'placeholder'=>'http://www.you.com']);
			create_form_field('Password:', 'password', 'pass', 'pass', ['maxlength'=>'15', 'size'=>'10', 'tabindex'=>'6', 'title'=>'Type in Your Password', 'required'=>'required', 'placeholder'=>'xxxxxxxx']);
			create_form_field('Retype Password:', 'password', 're_pass', 're_pass',  ['maxlength'=>'15', 'size'=>'10', 'tabindex'=>'7', 'title'=>'Retype in Your Password', 'required'=>'required', 'placeholder'=>'xxxxxxxx']);
			create_form_field('Date:', 'date', 'date', 'date', ['maxlength'=>'12', 'size'=>'10', 'tabindex'=>'8', 'title'=>'Todays Date', 'placeholder'=>'MM/DD/YYYY']);
			create_form_field('Favorite Color:', 'color', 'color', 'color', ['maxlength'=>'20', 'size'=>'10', 'tabindex'=>'9', 'title'=>'Your Favorite Color', 'placeholder'=>'#ffffff']);
			create_form_field('ID:', 'number', 'user_id', 'user_id', ['maxlength'=>'3', 'size'=>'3', 'max'=>'999', 'min'=>'0', 'step'=>'2', 'tabindex'=>'10', 'title'=>'Your ID', 'placeholder'=>'999']);
		?>
	</fieldset>
	<fieldset><legend>Preferences</legend>
		<p>
			<label for='about'>How did you hear about us?</label>
			Internet: <input type='checkbox' name='about[]' id='internet' value='internet' 
			<?php if(isset($about) && in_array('internet',$about)) echo "checked='checked'"; ?>
			/>
			Friend: <input type='checkbox' name='about[]' id='friend' value='friend' 
			<?php if(isset($about) && in_array('friend',$about)) echo "checked='checked'"; ?>
			/>
			Phone: <input type='checkbox' name='about[]' id='phone' value='phone' 
			<?php if(isset($about) && in_array('phone',$about)) echo "checked='checked'"; ?>
			/>
			News: <input type='checkbox' name='about[]' id='news' value='news' 
			<?php if(isset($about) && in_array('news',$about)) echo "checked='checked'"; ?>
			/>
			Other: <input type='checkbox' name='about[]' id='other' value='other' 
			<?php if(isset($about) && in_array('other',$about)) echo "checked='checked'"; ?>
			/>
		</p>
		<p>
			<label for='payment'>Payment Method</label>
			Visa: <input type='radio' name='payment' id='visa' value='visa' 
			<?php if(isset($payment) && ($payment == 'visa')) echo "checked='checked'"; ?>
			/>
			Discover: <input type='radio' name='payment' id='discover' value='discover' 
			<?php if(isset($payment) && ($payment == 'discover')) echo "checked='checked'"; ?>
			/>
			Master: <input type='radio' name='payment' id='master' value='master' 
			<?php if(isset($payment) && ($payment == 'master')) echo "checked='checked'"; ?>
			/>
		</p>
		<p>
			<label for='age_category'>Age Category</label>
			<select name='age_category' id='age_category' size='1' />
				<optgroup label='younger'>
					<option value='15-25'
					<?php if(isset($age_category) && ($age_category == '15-25')) echo "selected='selected'"; ?>
					>15 to 25</option>
					<option value='25-35'
					<?php if(isset($age_category) && ($age_category == '25-35')) echo "selected='selected'"; ?>
					>25 to 35</option>
				</optgroup>
				<optgroup label='older'>
					<option value='35-50'
					<?php if(isset($age_category) && ($age_category == '35-50')) echo "selected='selected'"; ?>
					>35 to 50</option>
				</optgroup>
			</select>
		</p>
		<?php
		create_form_field('Comments:', 'textarea', 'comment', 'comment', ['rows'=>'10', 'cols'=>'50', 'placeholder'=>'Type your comment here:']);
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