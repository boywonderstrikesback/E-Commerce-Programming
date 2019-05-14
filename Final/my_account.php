<?php 
require('../../../secure_files/mysql_connect.php');
$title="My Account";
include_once("header_user.php");
include('mysql_connect.php');
$game_users_id = 1;
 
    $select_my_account = "select supplement_users_id, first_name, last_name, email, user_id 
    from supplement_users where supplement_users_id = $supplement_users_id";
     
 $exec_select_my_account = @mysqli_query($link, $select_my_account);
 if(!$exec_select_my_account){
    echo"The previous information could not be retrieved because of :".mysqli_error($link);
    mysqli_close($link);
    include('footer.php');
    die();
}else{
    echo"<div id='list_supplements'><table border='0'>";
        echo "<tr>";
            echo"<th>Supplement Users ID</th>";
            echo"<th>First Name</th>";
            echo"<th>Last Name</th>";
            echo"<th>Email</th>";
            echo"<th>User ID</th>";
        echo "</tr>";
    while($one_row= mysqli_fetch_assoc($exec_select_my_account)){
        echo "<tr>";
            echo"<td class='first'><a href='update_account.php?supplement_users_id=".$one_row['supplement_users_id']."'>".$one_row['supplement_users_id']."</a></td>";
            echo"<td class='second'>".$one_row['first_name']."</td>";
            echo"<td class='third'>".$one_row['last_name']."</td>";
            echo"<td class='fourth'>".$one_row['email']."</td>";
            echo"<td class='fifth'>".$one_row['user_id']."</td>";
        echo "</tr>";
    }
    echo "</table></div>";  
}
 
mysqli_free_result($link, $exec_select_my_account);
mysqli_close($link);
include("footer_user.php");
die();
?>