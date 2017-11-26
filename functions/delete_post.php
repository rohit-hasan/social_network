<?php
include("../includes/connection.php");
global $con;
if(isset($_GET['post_id'])){
    $post_id=$_GET['post_id'];
    $delete_post="delete from posts where post_id='$post_id'";
    $run= mysqli_query($con, $delete_post);
    if($run){
        echo "<script>alert('Your post has been deleted')</script>";
        echo "<script>window.open('../home.php','_self')</script>";
    }
}



?>