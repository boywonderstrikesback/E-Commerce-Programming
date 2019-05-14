<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title> Mike's Forum  </title>
    </head>
    <body>
<form action='registration-handle.inc.php' method='POST' name='registration' id='action_page' enctype='multipart/form-data'>

	First name: <input type="text" name="first_name"><br>
	Last name: <input type="text" name="last_name"><br>
	Email: <input type="text" name="email"><br>
	Phone: <input type="text" name="phone"><br>
	URL: <input type="text" name="url"><br>
	User password: <input type="password" name="pass"><br>
	Retype password: <input type="password" name="re_pass"><br>
	Birthdate: <input type="date" name="birthdate"><br>
	Color: <input type="color" name="color"><br>
	About:
	<select name="about" id="about">
		<option value="freshman">Freshman</option>
		<option value="sophmore">Sophmore</option>
	</select>
	
	Gender:<br>
		<input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">Female
		<input type="radio" name="gender"<?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Male
	
	Comment: <textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
        
	<button type="submit" value="Submit">Submit</button>
	<button type="reset" value="Reset">Reset</button>
</form>       

    </body>
    
</html>
