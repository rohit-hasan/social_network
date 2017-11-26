<?php

$con=mysqli_connect("localhost","root","","social_network") or die("Connection was not established");

function insertPost(){
    global $con;
    global $user_id;
    if(isset($_POST['post_to_timeline'])){
        
        $charlist="'";
        $content= addcslashes($_POST['content'], $charlist) ;
        $content= htmlspecialchars($content);
        
        if($content==''){
            echo "<h2>Please write something</h2>";
        }else{
            
            $insert="insert into posts (user_id,post_content,post_date) values ('$user_id','$content',NOW())";
            $run= mysqli_query($con, $insert) or die("query not executed");
            
            if($run){
            echo "Posted to timeline";
                $update="update users set posts='yes' where user_id='$user_id'";
                $run_update= mysqli_query($con, $update);
            }
        }  
        
    }
}
function single_post(){
     global $con;
          if(isset($_GET['post_id'])){
        $get_id=$_GET['post_id'];
        $_SESSION['post_id']=$get_id;
        $get_posts="select * from posts where post_id='$get_id'";
        $run_posts= mysqli_query($con, $get_posts);
        $row_posts= mysqli_fetch_array($run_posts);
        $post_id=$row_posts['post_id'];
        $user_id=$row_posts['user_id'];
        $content=$row_posts['post_content'];
        $post_date=$row_posts['post_date'];
    
    
        $user="select * from users where user_id='$user_id' AND posts='yes'";
        $run_user= mysqli_query($con, $user);
        $row_user= mysqli_fetch_array($run_user);
        $user_first_name=$row_user['user_first_name'];
        $user_last_name=$row_user['user_last_name'];
        $user_image=$row_user['user_image'];
    
    echo "<div id='posts'>
            <p><img src='user/user_images/$user_image' width='50' height='50'></p>
            <h3><a href='user_profile.php?user_id=$user_id'>$user_first_name $user_last_name</a></h3>
            <p>$post_date</p>
            <p>$content</p>
            </div>";
            
               echo "
            <form action='' method='post' id='reply'>
                <textarea cols='75' name='comment' placeholder='write your reply'></textarea><br>
                <input type='submit' name='reply' value='Reply'>
             </form>";
                 
                 if(isset($_POST['reply'])){
                 global $con;
                 $charlist="'";
                 $comment= addcslashes($_POST['comment'], $charlist);
                 $comment= htmlspecialchars($comment);
                 
                $post_id=$_SESSION['post_id'];
                $user_com=$_SESSION['user_email'];
                $get_user_com="select * from users where user_email='$user_com'";
                $run_user_com= mysqli_query($con, $get_user_com) or die("query not executed");
                $row= mysqli_fetch_array($run_user_com);
                            
                $user_id_com=$row['user_id'];
                $com_first_name=$row['user_first_name'];
                $com_last_name=$row['user_last_name'];
                 
                 
                 $insert="insert into comments (post_id,user_id,comment,comment_date,comment_first_name,comment_last_name) values ('$post_id','$user_id_com','$comment',NOW(),'$com_first_name','$com_last_name')";
                 $run_insert= mysqli_query($con,$insert) or die("query not executed");  
                } 
        
    }
    
            

}


function get_results(){
   global $con;
    if(isset($_POST['search'])){
       $name=$_POST['name'];
       $user="select * from users WHERE CONCAT(user_first_name,' ',user_last_name) LIKE '%$name%'";
       $get_user= mysqli_query($con,$user) or die("query did not run");
       
        if ($get_user->num_rows > 0) {
    // output data of each row
            while($row = $get_user->fetch_assoc()) {
            $user_id=$row["user_id"];
            $user_image=$row["user_image"];
        echo  "<div id='search_result'>"."<img src='user/user_images/$user_image'>"." <a href='user_profile.php?u_id=$user_id'>".$row["user_first_name"]." ".$row["user_last_name"]."<br/></div>";
            }
         }        else {
                    echo "0 results";
                }
       
       
        }
    
}
function user_posts(){
    global $con;
    global $user_id;
    
    
    if(isset($_GET['u_id'])){
        $u_id=$_GET['u_id'];
    }
    
    $get_posts="select * from posts where user_id=$u_id ORDER by 1 DESC LIMIT 5";
    $run_posts= mysqli_query($con, $get_posts);
    while($row_posts= mysqli_fetch_array($run_posts)){
        $post_id=$row_posts['post_id'];
        $user_id=$row_posts['user_id'];
        $content=$row_posts['post_content'];
        $post_date=$row_posts['post_date'];
    
    
    $user="select * from users where user_id='$u_id' AND posts='yes'";
    $run_user= mysqli_query($con, $user);
    $row_user= mysqli_fetch_array($run_user);
    $user_first_name=$row_user['user_first_name'];
    $user_last_name=$row_user['user_last_name'];
    $user_image=$row_user['user_image'];
    
    echo "<div id='posts'>
            <p><img src='user/user_images/$user_image' width='50' height='50'></p>
            <h3><a href='user_profile.php?u_id=$u_id'>$user_first_name $user_last_name</a></h3>
            <p>$post_date</p>
            <p>$content</p>
            <a href='functions/delete_post.php?post_id=$post_id' style='float:right;'><button>Delete</button></a>
            <a href='edit_post.php?post_id=$post_id' style='float:right;'><button>Edit</button></a>
            <a href='single.php?post_id=$post_id' style='float:right;'><button>Reply</button></a>
          </div><br>";
    
    }
}
function user_profile(){
    global $con;
    if(isset($_GET['u_id'])){
        $user_id=$_GET['u_id'];
        $select="select * from users where user_id='$user_id'";
        $run= mysqli_query($con, $select)or die("query did not run");
        $row=mysqli_fetch_array($run);
        
        $id=$row['user_id'];
        $image=$row['user_image'];
        $user_first_name=$row['user_first_name'];
        $user_last_name=$row['user_last_name'];
        $user_gender=$row['user_gender'];
        $user_birthday=$row['user_birthday'];
        
        if($user_gender=='male'){
            $msg="send him a message";
        }else{
            $msg="send her a message";
        }
        
        echo "<div id='user_profile'>"
        . "<img src='user/user_images/$image' width:'150' height='150'><br/>"
                . "<p><strong>Name:</strong> $user_first_name $user_last_name</p><br/>"
                . "<p><strong>Gender:</strong> $user_gender</p><br/>"
                . "<p><strong>Birthday:</strong>$user_birthday</p><br/>"
                . "<a href='messages.php?u_id=$id'><button>$msg</button></a>";
               
        echo "</div>";
        
        
    }
}


?>