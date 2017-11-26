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
                            $user_email=$_SESSION['user_email'];
                            $get_users="select * from users where user_email='$user_email'";
                            $run_users= mysqli_query($con, $get_users);
                            $rows= mysqli_fetch_array($run_users);
                            
                            $user_f_name=$rows['user_first_name'];
                            $users_id=$rows['user_id'];
                            
                            ?>
				<ul id="menu">
					
                                        <li><a href="my_posts.php?u_id=<?php echo $users_id; ?>"><?php echo $user_f_name; ?></a></li>
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
                            $user=$_SESSION['user_email'];
                            $get_user="select * from users where user_email='$user'";
                            $run_user= mysqli_query($con, $get_user);
                            $row= mysqli_fetch_array($run_user);
                            
                            $user_id=$row['user_id'];
                            $user_first_name=$row['user_first_name'];
                            $user_last_name=$row['user_last_name'];
                            $user_image=$row['user_image'];
                            echo "
                                <p><img src='user/user_images/$user_image' width='200' height='200'></p>
                                <div id='user_mention'>
                                <p><strong>Name:</strong> $user_first_name $user_last_name</p>
                                <p><a href='my_messages.php?u_id=$user_id'>Messages($_SESSION[msg_num])</a></p>
                                <p><a href='edit_profile.php?u_id=$user_id'>Edit My Profile</a></p>
                                <p><a href='logout.php'>Logout</a></p>
                                </div>
                            ";
                            ?>
                        </div>
                    </div>
                    <!--user time line  ends-->
                    
                    <!--content time line  starts-->
                    <div id="content_timeline">
                    
                            <h3>Your Posts</h3>
                            <?php user_posts(); ?>
                    </div>
                    
                    
                    <!--content time line  ends-->
                    
                </div>
                <!--content area ends-->
	
	</body>



</html>
<?php } ?>