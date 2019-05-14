<?php 
require('../../../secure_files/mysql_connect.php');
$title="List all Available Supplements";
include_once("header_admin.php");
include('mysql_connect.php');
 
 $select_games = "select supplement_type, supplement_quantity, price, photo from supplement_types";
 $exec_select_supplements = @mysqli_query($link, $select_supplements);
 if(!$exec_select_supplements){
    echo"The game information could not be retrieved from the supplement_types table because of :".mysqli_error($link);
    mysqli_close($link);
    include('footer.php');
    die();
}else{
    echo"<div id='list_supplements'><table border='0'>";
        echo "<tr>";
            echo"<th>Supplement Type</th>";
            echo"<th>Supplement Quantity</th>";
            echo"<th>Price</th>";
            echo"<th>Photo</th>";
        echo "</tr>";
    while($one_row= mysqli_fetch_assoc($exec_select_supplements)){
        echo "<tr>";
            echo"<td class='first'>".$one_row['supplement_type']."</td>";
            echo"<td class='second'>".$one_row['supplement_quantity']."</td>";
            echo"<td class='third'>".$one_row['price']."</td>";
            echo"<td class='fourth'>".$one_row['photo']."</td>";
        echo "</tr>";
    }
    echo "<tr><td colspan = '3' class='footer'>Total number of supplement types : </td><td class='footer'>".mysqli_num_rows($exec_select_supplements)."</td></tr>";
    echo "</table></div>";  
}
 
mysqli_free_result($link, $exec_select_supplements);
mysqli_close($link);
include("footer_admin.php");
die();
?>