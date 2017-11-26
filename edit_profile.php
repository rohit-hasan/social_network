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
                            $user=$_SESSION['user_email'];
                            $get_user="select * from users where user_email='$user'";
                            $run_user= mysqli_query($con, $get_user);
                            $row= mysqli_fetch_array($run_user);
                            
                            $user_id=$row['user_id'];
                            $user_first_name=$row['user_first_name'];
                            $user_last_name=$row['user_last_name'];
                            $user_image=$row['user_image'];
                            $user_pass=$row['user_password'];
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
                        
                        <h2>Edit your profile:-</h2>
                        <form method="post">
					<table class="edit_profile">
						
						
						<tr>    
                                                    <td>First Name:</td>
                                                    <td>
                                                        <input type="text" name="first_name" value="<?php echo "$user_first_name"; ?>" required="required"/>
                                                    </td>
							
						</tr>
						
                                                <tr>
                                                    <td>Last Name:</td>
                                                    <td>
                                                    <input type="text" name="last_name" value="<?php echo "$user_last_name"; ?>" required="required"/>
                                                    </td>
                                                </tr>
						
						<tr>
                                                    <td> Password:</td>
							<td><input type="password" name="password" value="<?php echo "$user_pass"; ?>" required="required"/></td>
						</tr>
						
						
							<tr>
							<td><button type="submit" name="update">Update</button></td>
							</tr>
						
						
						
					</table>
					
				</form>
                        <br/>
                        
                        <form id="upload_image" enctype="multipart/form-data" method="post">
                            <table>
                                   <tr>
                                        <td align="left" style="font-weight: bold">
                                        Photo
                                        </td>
                                   </tr>
                                   <tr>
                                        <td>
                                            <input type="file" name="u_image">
                                        </td>
                                   </tr>
                                   
                                   <tr>
					<td><button type="submit" name="update_picture">Update picture</button></td>
                                   </tr>
                              </table>
                        </form>
                        <?php
                        global $con;
                        if(isset($_POST['update'])){
                            $u_first_name=$_POST['first_name'];
                            $u_last_name=$_POST['last_name'];
                            $u_pass=$_POST['password'];
                            $update="update users set user_first_name='$u_first_name',user_last_name='$u_last_name',user_password='$u_pass' where user_id='$user_id'";
                            $run_update= mysqli_query($con, $update);
                            if($run_update){
                                echo "<script>alert('Your profile is updated')</script>";
                                echo "<script>window.open('home.php','_self')</script>";
                            }
                        }
                        
                        if(isset($_POST['update_picture'])){
                            $u_image=$_FILES['u_image']['name'];
                            $image_tmp=$_FILES['u_image']['tmp_name'];
                            
                            $div= explode('.',$u_image);
                            $file_ext= strtolower(end($div));
                            $unique_image= substr(md5(time()), 0,10).'.'.$file_ext;
                            $uploaded_image="user/user_images/".$unique_image;
                            
                            
                            move_uploaded_file($image_tmp, $uploaded_image);
                            $update_picture="update users set user_image='$unique_image' where user_id='$user_id' ";
                            $run_update= mysqli_query($con, $update_picture);
                            if($run_update){
                                echo "<script>alert('Your profile picture has been updated')</script>";
                                echo "<script>window.open('home.php','_self')</script>";
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