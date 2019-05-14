<?php
//phpinfo();
 
$error_messages = array();
 
function trim_escape($string){
    global $link;
    return trim(mysql_real_escape_string($link, $string));
}
 
function rollback_die($message){
        echo $message;
        mysqli_query($link, "ROLLBACK");
        mysqli_close($link);
        include("footer.php");
        die();
}
 
if (isset($_POST['day']) && isset($_POST['month']) && isset($_POST['year'])){
    $day = $_POST['day'];
    $month = $_POST['month'];
    $month_array = array(1 =>'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    $month_number = array_search($month, $month_array);
    $year = $_POST['year'];
} else {
    $error_messages[] = "You did not select an appropriate date <br/> ";
}
if (!empty($_POST['no']) && is_numeric($_POST['no'])){
    $no= $_POST['no'];
}else{
    $error_messages[] = "You did not enter a valid credit card number <br/>"; 
}
 
if (!empty($_POST['security_code']) && is_numeric($_POST['security_code'])){
    $security_code= $_POST['security_code'];
}else{
    $error_messages[] = "You did not enter a valid security code <br/>";  
}
 
if (!empty($_POST['instructions'])){
    $instructions= $_POST['instructions'];
}else{
    $error_messages[] = "You did not enter any instructions <br/>";   
}
 
if (isset($_POST['supplement_type'])){
    $game_type= $_POST['supplement_type'];
}else{
    $error_messages[] = "You did not select the supplement <br/>";    
}
 
if (!empty($_POST['type_quantity'])&& is_numeric($_POST['type_quantity'])){
    $type_quantity= $_POST['type_quantity'];
}else{
    $error_messages[] = "You did not enter a quantity for selected type <br/>";   
}
 
if (isset($_POST['type'])){
    $type= $_POST['type'];
}else{
    $error_messages[] = "You did not select a credit card type <br/>";    
}
 
if (!empty($_POST['shipping'])){
    $shipping= $_POST['shipping'];
}else{
    $error_messages[] = "You did not select a shipping carrier <br/>";    
}
 
if (isset($_POST['shipping_method'])){
    $shipping_method= $_POST['shipping_method'];
}else{
    $error_messages[] = "You did not select shipping method <br/>";   
}
 
if (!empty($_POST['house'])) {
    $house = trim_escape($_POST['house']);
    } else {
        $error_messages[] = "Enter your house number <br/>";
    }
 
if (!empty($_POST['street'])) {
    $street = trim_escape($_POST['street']);
    } else {
        $error_messages[] = "Enter your street name <br/>";
    }
 
if (!empty($_POST['city'])) {
    $city = trim_escape($_POST['city']);
    } else {
        $error_messages[] = "Enter your city name <br/>";
    }
 
if (!empty($_POST['state'])) {
    $state = $_POST['state'];
    } else {
        $error_messages[] = "Enter your state <br/>";
    }
     
if (!empty($_POST['zip'])) {
    $zip = trim_escape($_POST['zip']);
    } else {
        $error_messages[] = "Enter your zip code <br/>";
    }
     
if(!ini_get('magic_quotes_gpc')){   
    //we need to escape the data from the form
    $instructions= addslashes($instructions);
}
 
if(!empty($error_messages)){
    foreach($error_messages as $value){
        echo $value;    
    }
}else{
    mysqli_query($link, "SET AUTOCOMMIT = 0");
    $insert_sa = "insert into supplement_shipping_addresses (house, street, city, state, zip) values ('$house', '$street', '$city', '$state', '$zip')";
    $exec_insert_sa = @mysqli_query($link, $insert_sa);
    if(!$exec_insert_sa){
        rollback_die("The shipping address could not be inserted because: ".mysqli_error($link));
    }else {
        $game_shipping_addresses_id = mysql_insert_id($link);
        $insert_ba = "insert into supplement_billing_addresses (house, street, city, state, zip) values ('$house', '$street', '$city', '$state', '$zip')";
    $exec_insert_ba = @mysqli_query($link, $insert_ba);
    if(!$exec_insert_ba){
        rollback_die("The billing address could not be inserted because: ".mysqli_error($link));
        }else{
            $supplement_billing_addresses_id = mysql_insert_id($link);
            $select_gsmi =  "select supplement_shipping_methods_id from supplement_shipping_methods where shipping_method = '$shipping_method' and carrier = '$carrier' limit 1";
            $exec_select_gsmi = @mysqli_query($link, $select_gsmi);
            $num_row = mysql_num_rows($exec_select_gsmi);
            if($num_row != 1){
                rollback_die("The supplement shipping methods id could not be retrieved because: ".mysqli_error($link));
            }else{
                $one_row = mysqli_fetch_assoc($exec_select_gsmi);
                $game_shipping_methods_id = $one_row['$supplement_shipping_methods_id'];
                $insert_gcc = "insert into supplement_credit_cards (supplement_users_id, type, no, security_code) values (3, '$type', 'no', 'security_code')";
                $exec_insert_gcc = @mysqli_query($link, $insert_gcc);
                if(!$exec_insert_gcc) {
                    rollback_die("The supplement credit cards information could not be inserted because: ".mysqli_error($link));
                }else{
                    $game_credit_cards_id = mysqli_insert_id($link);
                    $select_supplement_type = "select supplement_types_id, supplement_quantity, price from suppleent_types where supplement_type = '$supplement_type'";
                    $exec_select_supplement_type = @mysqli_query($link, $select_supplement_type);
                    if(!$exec_select_supplement_type){
                        rollback_die("The supplement type information could not be retirieved because: ".mysqli_error($link));
                    }else{
                        $one_row = mysqli_fetch_assoc($exec_select_supplement_type);
                        $supplement_types_id = $one_row['supplement_types_id'];
                        $supplement_quantity = $one_row['supplement_quantity'];
                        $price = $one_row['price'];
                        $order_total = $price * $type_quantity;
                         
                        if($type_quantity > $supplement_quantity){
                            rollback_die("The number of supplements we have in the store is less than the number ordered.  Please change quantity.  Please select another supplement or order less than ".$supplement_quantity."copies of ".$supplement_type);
                        }else{
                            $payment_date = $year."-".$month_number."-".$day." "."12:00:00";
                            $insert_go = "insert into supplement_orders (order_total, payment_date, supplement_credit_cards_id, supplement_shipping_addresses_id, supplement_billing_addresses_id, supplement_shipping_methods_id) values ('$order_total', '$payment_date', '$supplement_credit_cards_id', '$supplement_shipping_addresses_id', '$supplement_billing_addresses_id', '$supplement_shipping_methods_id')";
                            $exec_insert_go = @mysqli_query($link, $insert_go);
                            if(!$exec_insert_go){
                                rollback_die("The insertion into game_orders was unsuccessful because : ".mysqli_error($link));
                            }else{
                                $supplement_orders_id = mysqli_insert_id($link);
                                $insert_gut = "insert into supplement_users_types (supplement_users_id, supplement_types_id, supplement_orders_id, type_quantity, type_total) value (3, '$supplement_types_id', '$supplement_orders_id', '$type_quantity', '$order_total')";
                                $exec_insert_gut = @mysqli_query($link, $insert_gut);
                                if(!exec_insert_gut){
                                    rollback_die("The insertion into supplement_users_types was unsuccessful because : ");
                                }else{
                                    echo "The order was successfully placed";
                                    mysqli_query($link, "COMMIT");
                                    mysqli_close($link);
                                    include("footer.php");
                                    die();
                                }
                            }
                        }
                    }                   
                }
            }
        }
    }
}
 
?>