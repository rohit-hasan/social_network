<?php
session_start();
include("includes/connection.php");
include("functions/functions.php");
if(!isset($_SESSION['user_email'])){
    header("location:index.php");
}else{
?>

<!DOCTYPE html>

<html>

	<head>
		<title>
			Welcome
			
		</title>
		<link rel="stylesheet" href="styles/home_style.css" media="all">
		
	</head>
	
	
	<body>
		<!--wrapper starts-->
		<div id="wrapper">
			<div id="header">
                            
                            <?php 
                            $user=$_SESSION['user_email'];
                            $get_user="select * from users where user_email='$user'";
                            $run_user= mysqli_query($con, $get_user);
                            $row= mysqli_fetch_array($run_user);
                            
                            $user_first_name=$row['user_first_name'];
                            $user_id=$row['user_id'];
                            
                            ?>
				<ul id="menu">
					
                                        <li><a href="my_posts.php?u_id=<?php echo $user_id; ?>"><?php echo $user_first_name; ?></a></li>
                                        <li><a href="home.php">Home</a></li>
					<li><a href="members.php">Members</a></li>
                                        
                                </ul>
                            <form method="post" action="results.php" id="form1">
                                <input type="text" name="name" id="search">
                                <input type="submit" name="search" value="Search">
                                
                            </form>
                            
                            
			</div>
		</div>
		<!--wrapper ends-->
                <!--content area starts-->
                <div class="content">
                    <!--user time line  starts-->
                    <div id="user_timeline">
                        <div id="user_details">
                            <?php
                            $user_email=$_SESSION['user_email'];
                            $get_the_user="select * from users where user_email='$user_email'";
                            $run_the_user= mysqli_query($con, $get_the_user);
                            $row_run= mysqli_fetch_array($run_the_user);
                            
                            $users_id=$row_run['user_id'];
                            $users_first_name=$row_run['user_first_name'];
                            $users_last_name=$row_run['user_last_name'];
                            $user_image=$row_run['user_image'];
                            echo "
                                <p><img src='user/user_images/$user_image' width='200' height='200'></p>
                                <div id='user_mention'>
                                <p><strong>Name:</strong> $users_first_name $users_last_name</p>
                                <p><a href='my_messages.php?u_id=$users_id'>Messages($_SESSION[msg_num])</a></p>
                                <p><a href='edit_profile.php?u_id=$users_id'>Edit My Profile</a></p>
                                <p><a href='logout.php'>Logout</a></p>
                                </div>
                            ";
                            ?>
                        </div>
                    </div>
                    <!--user time line  ends-->
                    
                    <!--content time line  starts-->
                    <div id="content_timeline">
                        <?php
                        
                         if(isset($_GET['post_id'])){
                             $get_id=$_GET['post_id'];
                             $get_post="select * from posts where post_id='$get_id'";
                             $run_post= mysqli_query($con, $get_post);
                             $row= mysqli_fetch_array($run_post);
                             $post_content=$row['post_content'];
                             
                             
                         }
                        
                        ?>
                        
                        
                        <h2>Edit your post:</h2>
                        <form action="" method="post" id="user_status">
                            <textarea name="content" style="height:100px;width:600px;"><?php echo $post_content; ?></textarea><br>
                            <input type="submit" name="update_post" value="Update Post">
                        </form>
                        <?php 
                        
                        if(isset($_POST['update_post'])){
                            
                            
                            $charlist="'";
                            $content= addcslashes($_POST['content'], $charlist) ;
                            
                            
                            $update_post="update posts set post_content='$content' where post_id='$get_id'";
                            
                            $run_update_post= mysqli_query($con, $update_post);
                            if($run_update_post){
                               
                                echo "<script>alert('Your post has been updated')</script>";
                                echo "<script>window.open('edit_post.php?post_id=$get_id','_self')</script>";
                                
                            }
                        }
                        
                        ?>
                           
                    </div>
                    
                    
                    <!--content time line  ends-->
                    
                </div>
                <!--content area ends-->
	
	</body>



</html>
<?php } ?>