<?php 
require('../../../secure_files/mysql_connect.php');
$title="List all registered users";
include_once("header_admin.php");
 
if(isset($_GET['$supplement_users_id'])){
    $supplement_users_id = $_GET['$supplement_users_id'];
    function rollback_die($msg){
            echo $msg;
            global $link;
            mysqli_query($link, "ROLLBACK");
            mysqli_free_result($exec_select_gui);
            mysqli_close($link);
            include("footer_admin.php");
            die();
    }
     
    function delete_records($array_refer){
        global $link;
        foreach($users as $key => $array_value){
        $table_name = substr($key, 0, -3);
            foreach($array_value as $value){
                $delete = "DELETE from $table_name where $key = $value";
                $exec_delete = @mysqli_query($link, $delete);
                if(!$exec_delete){
                    rollback_die("Records from $table_name could not be deleted because of :".mysqli_error($link));
                }
            }
        }
        return true;
    }
     
    @mysqli_query($link, "SET AUTOCOMMIT=0");
    $select_gui = "SELECT supplemment_users.supplement_users_id, supplement_users_types.supplement_users_types_id, supplement_orders.supplement_orders_id, supplement_shipping_addresses.supplement_shipping_addresses_id, supplement_billing_addresses.supplement_billing_addresses_id, supplement_credit_cards.supplement_credit_cards_id
    from
    supplement_users, supplement_users_types, supplement_orders, supplement_shipping_addresses, supplement_billing_addresses, supplement_credit_cards
    where
    supplement_users.supplemment_users_id = supplement_users_types.supplement_users_id and
    suppleent_users_types.supplement_orders_id = supplement_orders.supplement_orders_id and
    supplement_orders.supplement_shipping_addresses_id = supplement_shipping_addresses.supplement_shipping_addresses_id and
    supplement_orders.supplement_billing_addresses_id = supplement_billing_addresses.supplement_billing_addresses_id and
    supplement_orders.supplement_credit_cards_id = supplement_credit_cards.supplement_credit_cards_id and
    supplement_users.supplement_users_id = $supplement_users_id";
    $exec_select_gui = @mysqli_query($link, $select_gui);
    if(!$exec_select_gui){
            rollback_die("A problem when retrieving records from the database for that user has occurred : ".mysqli_error($link));
    }else{
        $users = $gut = $orders = $shipping = $billing = $credit = array();
        while($one_row = mysqli_fetch_assoc($exec_select_gui)){
            $users[] = $one_row['supplement_users_id'];
            $gut[] = $one_row['supplement_users_types'];
            $orders[] = $one_row['supplement_orders_id'];
            $shipping[] = $one_row['supplement_shipping_addresses_id'];
            $billing[] = $one_row['supplement_billing_addresses_id'];
            $credit[] = $one_row['supplement_credit_cards_id'];
        }
        $multi_array = array('supplement_users_id' => $users, 'supplement_users_types_id' => $gut, 'supplement_orders_id' => $orders, 'supplement_shipping_addresses_id' => $shipping, 'supplement_billing_addresses_id' => $billing, 'supplement_credit_cards_id' => $credit);
        delete_records($multi_array);
        echo "The records(s) of that user have been deleted";
        mysqli_query($link, "COMMIT");      
    }
}
 
(isset($_GET['sort']))?$sort=$_GET['sort']:$sort='ui';
(isset($_GET['bool']))?$bool=$_GET['bool']:$bool=true;
 
switch($sort){
    case 'ui': ($bool)?$sort="user_id ASC":$sort="user_id DESC";
        break;
    case 'fn': ($bool)?$sort = "first_name ASC":$sort = "first_name DESC";
        break;
    case 'ln': ($bool)?$sort = "last_name ASC":$sort = "last_name DESC";
        break;
    case 'em': ($bool)?$sort = "email ASC":$sort = "email DESC";
        break;
}
 
 $select_users = "select supplements_users_id, user_id, first_name, last_name, email from supplement_users order by $sort";
 $exec_select_users = @mysqli_query($link, $select_users);
 if(!$exec_select_users){
    echo"The user information could not be retrieved from the supplement_users table because of :".mysqli_error($link);
    mysqli_close($link);
    include('footer.php');
    die();
}else{
    echo"<div id='list_users'><table border='0'>";
        echo "<tr>";
            echo"<th><a href='".$_SERVER['PHP_SELF']."?sort=ui&bool=".!$bool."'>User Id</a></th>";
            echo"<th><a href='".$_SERVER['PHP_SELF']."?sort=fn&bool=".!$bool."'>First Name</a></th>";
            echo"<th><a href='".$_SERVER['PHP_SELF']."?sort=ln&bool=".!$bool."'>Last Name</a></th>";
            echo"<th><a href='".$_SERVER['PHP_SELF']."?sort=em&bool=".!$bool."'>Email</a></th>";
            echo"<th>Delete</th>";
        echo "</tr>";
    while($one_row= mysqli_fetch_assoc($exec_select_users)){
        echo "<tr>";
            echo"<td class='first'>".$one_row['user_id']."</td>";
            echo"<td class='second'>".$one_row['first_name']."</td>";
            echo"<td class='third'>".$one_row['last_name']."</td>";
            echo"<td class='fourth'>".$one_row['email']."</td>";
            echo"<td class='third'><a href='".$_SERVER['PHP_SELF']."?game_users_id=".$one_row['game_users_id']."'>Delete</td>";
        echo "</tr>";
    }
    echo "<tr><td colspan = '4' class='footer'>Total number of users : </td><td class='footer'>".mysqli_num_rows($exec_select_users)."</td></tr>";
    echo "</table></div>";  
}
mysqli_free_result($exec_select_users);
mysqli_close($link);
include("footer_admin.php");
die();
?>