<form action='<? echo $_SERVER['PHP_SELF']; ?>' method='POST' name='registration_form' id='registration_form' enctype='multipart/form-data'>
	<fieldset><legend>Registration</legend>
		<?php
			create_form_field('First Name:', 'text', 'first_name', 'first_name', ['maxlength'=>'30', 'size'=>'20', 'tabindex'=>'1', 'title'=>'Type in Your First Name Here', 'required'=>'required', 'pattern'=>'[A-Za-z]{2,20}', 'placeholder'=>'First Name'], $errors_array);
			create_form_field('Last Name:', 'text', 'last_name', 'last_name', ['maxlength'=>'30', 'size'=>'20', 'tabindex'=>'2', 'title'=>'Type in Your Last Name Here', 'required'=>'required', 'pattern'=>'[A-Za-z]{2,20}', 'placeholder'=>'Last Name'], $errors_array);
			
			/***************** Create function call for state drop down menu ********************************/
			$select_states = "SELECT supplement_states_id, state, abbr from supplement_states";
			$exec_select_states = @mysqli_query($link, $select_states);
			if(!$exec_select_states){
				exit("The following error occurred: ".mysqli_error($link));
				mysqli_close($link);
			}else{
				$multi_array = array();
				while($one_record = mysqli_fetch_assoc($exec_select_states)){
					$multi_array[] = $one_record;
				}
				create_drop_down_from_query('State: ', 'hat_states_id', 'hat_states_id', $multi_array, ['tabindex'=>'9', 'title'=>'State'], $errors_array);
			}
			
			/***************** End function call for state drop down menu ********************************/
			
			
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