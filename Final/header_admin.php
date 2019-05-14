<html>
<head>
    <title><?php echo $title; ?></title>
<style type ="text/css">
    #registration_form {
        margin: 0px auto 0px auto;
        background-color: #008080;
        width: 640px;
        color: #ffffff;
    }
    #list_users table tr th, #list_users table tr td.footer, #list_supplements table tr th, #list_supplements table tr td.footer, #list_orders table tr th, #list_orders table tr td.footer{
        background: maroon;
        color: white;
    }
    #list_users table tr td.first, #list_users table tr td.third, #list_supplements table tr td.first, #list_supplements table tr td.third, #list_supplements table tr td.fifth,#list_orders table tr td.first, #list_orders table tr td.third, #list_orders table tr td.fifth, #list_orders table tr td.seventh{
        background: purple;
        color: white;
    }
    #list_users table tr td.second, #list_users table tr td.fourth, #list_supplements table tr td.second, #list_supplements table tr td.fourth, #list_supplements table tr td.sixth, #list_orders table tr td.second, #list_orders table tr td.fourth, #list_orders table tr td.sixth, #list_orders table tr td.eighth {
        background: olive;
        color: white;
    }
    #ORDER_FORM {
        margin: 0px auto 0px auto;
        background-color: #008080;
        width: 640px;
        color: #ffffff;
        padding: 1em;
    }
    #top_links {
        margin: 0px auto 0px auto;
        background-color: yellow;
        width: 640px;
    }
    #top_links ul li{
        display:inline;
    }
    #top_links a:link {
        color: blue;
    }
    #top_links a:visited {
        color: red;
    }
    #top_links a:hover {
        color: yellow;
        background-color: blue;
    }
    #admin_main_menu, #user_main_menu, #list_users, #list_orders, #list_supplements {
        margin: 0px auto 0px auto;
        background-color: #008080;
        width: 640px;
        color: #ffffff;
        padding: 1em;
    }
    #admin_main_menu ul, #users_main_menu ul {
        padding: 0;
        margin: 0;
        display: inline;
    }
    #admin_main_menu ul li, #admin_main_menu ul li {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }
    #admin_main_menu a:link, #admin_main_menu a:link {
        color: #ffffff;
        background: #008080;
    }
    #admin_main_menu a:visited, #admin_main_menu a:visited {
        color: yellow;
    }
    #admin_main_menu a:hover, #admin_main_menu a:hover {
        color: 008080;
        background:#ffffff;
    }
</style>  
</head>
 
<body>
<div id="top_links">
<ul>
<li><a href="list_users.php">List Users</a></li>
<li><a href="list_order_form_and_handle.php">List Orders</a></li>
<li><a href="list_supplements.php">List Available Supplements </a></li>
<li><a href="supplement_insert_form_and_handle.php">Add Supplements</a></li>
</ul>
</div>