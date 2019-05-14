<?php
//phpinfo();
 
function trim_escape($string){
    global $link;
    return trim(mysql_real_escape_string($link, $string));
}
 
if (isset($_POST['day']) && !empty($_POST['month']) && isset($_POST['year'])){
    $day = $_POST['day'];
    $month = $_POST['month'];
    $month_array = array(1 =>'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    $month_number = array_search($month, $month_array);
    $year = $_POST['year'];
    $payment_date = $year."-".$month_number."-".$day;
    $where ="(DATE(payment_date) = '$payment_date')";
} 
 
if (!empty($_POST['supplement_orders_id']) && is_numeric(trim($_POST['supplement_orders_id']))){
    $supplement_orders_id= $_POST['supplement_orders_id'];
    (isset($where))?$where = $where." and supplement_orders.supplement_orders_id = $supplement_orders_id":$where = "supplement_orders.supplement_orders_id = $supplement_orders_id";
}
 
if (!empty($_POST['user_id'])){
    $user_id= trim_escape($_POST['user_id']);
    (isset($where))?$where = $where." and user_id = '$user_id'":$where = "user_id = '$user_id'";
}
 
if(isset($where)){
    $select_orders = "select supplement_orders.supplement_orders_id, payment_date, concat(first_name, ' ', last_name) as 'Full Name', game_type, type_quantity, type_total, concat(supplement_shipping_addresses.house, ' ', supplement_shipping_addresses.street, ',', supplement_shipping_addresses.city, ',', supplement_shipping_addresses.state, ' ', supplement_shipping_addresses.zip) as 'Shipping Address', concat(supplement_billing_addresses.house, ' ', supplement_billing_addresses.street, ',', supplement_billing_addresses.city, ',', supplement_billing_addresses.state, ' ', supplement_billing_addresses.zip) as 'Billing Address' from supplement_orders, supplement_users, supplement_types, supplement_users_types, supplement_shipping_addresses, supplement_billing_addresses 
where (supplement_users_types.supplement_users_id = supplement_users.supplement_users_id) and
    (supplement_users_types.supplement_orders_id = supplement_orders.supplement_orders_id) and
    (supplement_users_types.supplement_types_id = supplement_types.supplement_types_id) and
    (supplement_shipping_addresses.supplement_shipping_addresses_id= supplement_orders.supplement_shipping_addresses_id) and
    (supplement_billing_addresses.supplement_billing_addresses_id= supplement_orders.supplement_billing_addresses_id) and
    $where";
}else{
$select_orders = "select supplement_orders.supplement_orders_id, payment_date, concat(first_name, ' ', last_name) as 'Full Name', supplement_type, type_quantity, type_total, concat(supplement_shipping_addresses.house, ' ', supplement_shipping_addresses.street, ',', supplement_shipping_addresses.city, ',', supplement_shipping_addresses.state, ' ', supplement_shipping_addresses.zip) as 'Shipping Address', concat(supplement_billing_addresses.house, ' ', supplement_billing_addresses.street, ',', supplement_billing_addresses.city, ',', supplement_billing_addresses.state, ' ', supplement_billing_addresses.zip) as 'Billing Address' from supplement_orders, supplement_users, supplement_types, supplement_users_types, supplement_shipping_addresses, supplement_billing_addresses 
where (supplement_users_types.supplement_users_id = supplement_users.supplement_users_id) and
    (supplement_users_types.supplement_orders_id = supplement_orders.supplement_orders_id) and
    (supplement_users_types.supplement_types_id = supplement_types.supplement_types_id) and
    (supplement_shipping_addresses.supplement_shipping_addresses_id= supplement_orders.supplement_shipping_addresses_id) and
    (supplement_billing_addresses.supplemment_billing_addresses_id= supplement_orders.supplement_billing_addresses_id) ";
}
 $exec_select_orders = @mysqli_query($link, $select_orders);
 if(!$exec_select_orders){
    echo"The order information could not be retrieved because of :".mysqli_error($link);
    mysqli_close($link);
    include('footer_admin.php');
    die();
}else{
    echo"<div id='list_orders'><table border='0'>";
        echo "<tr>";
            echo"<th>Supplement Orders ID</th>";
            echo"<th>Payment Date</th>";
            echo"<th>Full Name</th>";
            echo"<th>Supplement Type</th>";
            echo"<th>Type Quantity</th>";
            echo"<th>Type Total</th>";
            echo"<th>Shipping Address</th>";
            echo"<th>Billing Address</th>";
        echo "</tr>";
    while($one_row= mysqli_fetch_assoc($exec_select_orders)){
        echo "<tr>";
            echo"<td class='first'>".$one_row['game_orders_id']."</td>";
            echo"<td class='second'>".$one_row['payment_date']."</td>";
            echo"<td class='third'>".$one_row['Full Name']."</td>";
            echo"<td class='fourth'>".$one_row['game_type']."</td>";
            echo"<td class='fifth'>".$one_row['type_quantity']."</td>";
            echo"<td class='sixth'>".$one_row['type_total']."</td>";
            echo"<td class='seventh'>".$one_row['Shipping Address']."</td>";
            echo"<td class='eighth'>".$one_row['Billing Address']."</td>";
        echo "</tr>";
    }
    echo "<tr><td colspan = '8' class='footer'>Total number of users : </td><td class='footer'>".mysqli_num_rows($exec_select_orders)."</td></tr>";
    echo "</table></div>";  
}
 
mysqli_free_result($link, $exec_select_orders);
mysqli_close($link);
include("footer_admin.php");
die();
?>