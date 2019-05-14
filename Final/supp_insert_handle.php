<?php
//phpinfo();
 
$error_messages = array();
 
if(isset($_POST['supplement_type'])){
    $game_type = $_POST['supplement_type'];
} else {
    $error_messages[] = "You did not select a supplement <br />";
}
 
if(isset($_POST['supplement_quantity'])){
    $supplement_quantity = $_POST['supplement_quantity'];
} else {
    $error_messages[] = "You did not select the supplement quantity <br />";
}
 
if(!empty($_POST['price'])){
    $price = $_POST['price'];
} else {
    $error_messages[] = "You did not enter the price for the supplement <br />";
}
 
if(!empty($error_messages)){
    foreach($error_messages as $value) {
        echo $value;
    }
} else {
    echo "Your supplement type is : $supplement_type <br />";
    echo "Supplement quantity is : $supplement_quantity <br/>";
    echo "Supplement price is : $price <br/>";
}
?>