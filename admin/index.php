<?php
session_start();
if(!isset($_SESSION['admin_email'])){
    header("location: admin_login.php");
}else{
?>


<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Admin Panel</title>
        <link rel="stylesheet" href="admin_style.css" media="all">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div class="container">
            <div id="head">
                <a href="index.php"><img src="admin_logo.gif"></a>
            </div>
            <div id="sidebar">
                <h2>Manage Content:</h2>
                <ul id="menu">
                    <li><a href="index.php?view_users">View Users</a></li>
<!--                    <li><a href="index.php?view_posts">View Posts</a></li>
                    <li><a href="index.php?view_comments">View Comments</a></li>-->
                    <li><a href="admin_logout.php">Logout</a></li>
                    
                </ul>
                
            </div>
            <div id="content">
                <h2 style="color: blue;text-align: center; padding:10px;">Welcome Admin:Manage your content</h2>
                
                <?php  
                
                if(isset($_GET['view_users'])){
                    include("includes/view_users.php");
                }
                
                ?>
            </div>
            
            <div id="foot"></div>
        </div>
    </body>
</html>
<?php }?>