<?php
require('../../../secure_files/mysql_connect.php');
$title="Update Account";
include_once("header.php");
 
if(!isset($_REQUEST['supplement_users_id'])){
    echo "You are not an authentic user";
    header("Refresh: 3 URL=registration_form_and_handle.php");
    mysqli_close($link);
    die();  
}elseif(isset($_POST['supplement_users_id'])){
        $supplement_users_id = $_POST['supplement_users_id'];
         
        $error_messages = array();
        function trim_escape($string){
        global $link;
        return trim(mysql_real_escape_string($link, $string));
        }
     
     
        if (!empty($_POST['first_name'])){
        $first_name= trim_escape($_POST['first_name']);
        }else{
        $error_messages[] = "You did not enter your first name <br/>";    
        }
 
        if (!empty($_POST['last_name'])){
        $last_name= trim_escape($_POST['last_name']);
        }else{
        $error_messages[] = "You did not enter your last name <br/>"; 
        }
 
        if (!empty($_POST['email'])){
        $email= trim_escape($_POST['email']);
        }else{
        $error_messages[] = "You did not enter your email <br/>"; 
        }
 
        if (!empty($_POST['user_id'])){
        $user_id= trim_escape($_POST['user_id']);
        }else{
        $error_messages[] = "You did not enter your user id <br/>";   
        }
         
        if(!empty($error_messages)){
        foreach($error_messages as $value){
            echo $value;    
            header("Refresh: 8 URL=#?supplement_users_id=$supplement_users_id");
        }
            }else{
                $update_account= "UPDATE supplement_users set first_name = '$first_name', last_name= '$last_name', email= '$email', user_id= '$user_id' where supplement_users_id = $supplement_users_id limit 1";
                $exec_update_account = @mysqli_query($link, $update_account);
                if(mysqli_affected_rows($link)){
                    echo "The update was successful ";
                    header("Refresh: 3 URL=my_account.php?game_users_id=$supplement_users_id");   
                }else{
                    echo "The update was not successful ";
                    header("Refresh: 3 URL=my_account.php?supplement_users_id=$supplement_users_id");
                }
        }
     
     
 
     
     
     
}else{
    $supplement_users_id = $_GET['supplement_users_id'];
    $select_user_info = "SELECT first_name, last_name, email, user_id from supplement_users where supplement_users_id= $supplement_users_id";
     
    $exec_select_user_info = @mysqli_query($link, $select_user_info);
    $one_row = mysqli_fetch_assoc($exec_select_user_info);
     
    $first_name = $one_row['first_name'];
    $last_name = $one_row['last_name'];
    $email = $one_row['email'];
    $user_id = $one_row['user_id'];
?>
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
                <input type="hidden" name="supplement_users_id" value="<?php echo $supplement_users_id; ?>" />
        <input type="submit" value="Click to Submit"  />
        <input type="reset" value="Click to Reset"  />
      </div>        
    </form>
<?php    
}
?>