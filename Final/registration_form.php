<!doctype html>
<html>
<head>
<title>Apex Predator Supplements</title>
</head>
<body>
 
<div id="registration_form">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div>
        First Name: <input type="text" name="first_name" id="first_name" size="30" maxlength="50" value="<?php if(isset($first_name)) echo $first_name; ?>" />
        </div>
        <div>
        Last Name: <input type="text" name="last_name" id="last_name" size="30" maxlength="50" value="<?php if(isset($last_name))  echo $last_name;?>" />
        </div>
        <div>
        E-mail:  <input type="text" name="email" id="email" size="30" maxlength="50" value="<?php if(isset($email)) echo $email; ?>" />
        </div>
        <div>
        User ID: <input type="text" name="user_id" id="user_id" size="30" maxlength="50" value="<?php if(isset($user_id)) echo $user_id; ?>" />
        </div>
        <div>
        Password: <input type="password" name="password" id="password" size="30" maxlength="50" />
        </div>
      <div>
        <input type="hidden" name="hidden_field" value="form submitted" />
        <input type="submit" value="Click to Submit"  />
        <input type="reset" value="Click to Reset"  />
      </div>        
    </form>
</div>
</body>
</html>