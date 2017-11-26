<?php

function get_members(){
        global $con;
        $per_page=20;
        if(isset($_GET['page'])){
        $page=$_GET['page'];
        }else{
        $page=1;
        }
        $start_from=($page-1)*$per_page;
        $get_members="select * from users LIMIT $start_from,$per_page";
         
         
         //$get_members="select * from users";
         $run_members= mysqli_query($con, $get_members);
                            
         while($row= mysqli_fetch_array($run_members)){
                            
          $user_id=$row['user_id'];
          $user_first_name=$row['user_first_name'];
          $user_last_name=$row['user_last_name'];
          $user_name="$user_first_name $user_last_name";
          $user_image=$row['user_image'];
          echo "
          <a href='user_profile.php?u_id=$user_id' style='text-decoration:none'>
          <img src='user/user_images/$user_image' width='50' height='50' title='$user_name'>
          $user_name</a><br/>
          ";
          }
          include("member_pagination.php");
}

?>