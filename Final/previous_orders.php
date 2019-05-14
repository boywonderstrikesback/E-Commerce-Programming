<?php 
require('../../../secure_files/mysql_connect.php');
$title="List all Previous Orders";
include_once("header_user.php");
include('mysql_connect.php');
$game_users_id = 1;
 
    $select_prev_orders = "select supplement_orders.supplement_orders_id, order_total, payment_date, concat(first_name, ' ', last_name) as 'Full Name', concat(supplement_shipping_addresses.house, ' ', supplement_shipping_addresses.street, ',', supplement_shipping_addresses.city, ',', supplement_shipping_addresses.state, ' ', supplement_shipping_addresses.zip) as 'Shipping Address', concat(supplement_billing_addresses.house, ' ', supplement_billing_addresses.street, ',', supplement_billing_addresses.city, ',', supplement_billing_addresses.state, ' ', supplement_billing_addresses.zip) as 'Billing Address'
    from supplement_orders, supplement_users, supplement_users_types, supplement_shipping_addresses, supplement_billing_addresses 
where   (supplement_users_types.supplement_users_id = supplement_users.supplement_users_id) and
        (supplement_users_types.supplement_orders_id = supplement_orders.supplement_orders_id) and
        (supplement_shipping_addresses.supplement_shipping_addresses_id= supplement_orders.supplement_shipping_addresses_id) and
        (supplement_billing_addresses.supplement_billing_addresses_id= supplement_orders.supplement_billing_addresses_id) and
    supplement_users.supplement_users_id = $supplement_users_id group by supplement_orders.supplement_orders_id";
     
     
     
 $exec_select_prev_orders = @mysqli_query($link, $select_prev_orders);
 if(!$exec_select_prev_orders){
    echo"The previous information could not be retrieved because of :".mysqli_error($link);
    mysqli_close($link);
    include('footer.php');
    die();
}else{
    echo"<div id='list_supplements'><table border='0'>";
        echo "<tr>";
            echo"<th>Supplement Orders ID</th>";
            echo"<th>Order Total</th>";
            echo"<th>Payment Date</th>";
            echo"<th>Full Name</th>";
            echo"<th>Shipping Address</th>";
            echo"<th>Billing Address</th>";
        echo "</tr>";
    while($one_row= mysqli_fetch_assoc($exec_select_prev_orders)){
        echo "<tr>";
            echo"<td class='first'>".$one_row['game_orders_id']."</td>";
            echo"<td class='second'>".$one_row['order_total']."</td>";
            echo"<td class='third'>".$one_row['payment_date']."</td>";
            echo"<td class='fourth'>".$one_row['Full Name']."</td>";
            echo"<td class='fifth'>".$one_row['Shipping Address']."</td>";
            echo"<td class='sixth'>".$one_row['Billing Address']."</td>";
        echo "</tr>";
    }
    echo "<tr><td colspan = '6' class='footer'>Total number of previous orders : </td><td class='footer'>".mysqli_num_rows($exec_select_prev_orders)."</td></tr>";
    echo "</table></div>";  
}
 
mysqli_free_result($link, $exec_select_prev_orders);
mysqli_close($link);
include("footer_user.php");
die();
?>