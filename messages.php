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
                       
                        <?php
                        
                        
                        if(isset($_GET['u_id'])){
                            global $con;
                            $receiver_id=$_GET['u_id'];
                            $receiver_query="select * from users where user_id='$receiver_id'";
                            $run_receiver_query= mysqli_query($con,$receiver_query);
                            $receiver_row= mysqli_fetch_array($run_receiver_query);
                            $receiver_first_name=$receiver_row['user_first_name'];
                            $receiver_last_name=$receiver_row['user_last_name'];
                            $receiver_image=$receiver_row['user_image'];
                        } 
                        
                        ?>
                        
                        <h2>Send a message to <span style='color:red'><?php echo "$receiver_first_name $receiver_last_name" ;?></span></h2>
                        <form action="messages.php?u_id=<?php echo $receiver_id; ?>" method='post' id='message'>
                        
                            <textarea name='msg' cols='50' rows='5' placeholder='Write your message'></textarea><br/>
                            <input type='submit' name='message' value='Send Message'><br/>
                        </form>
                        <img alt="user_image" src="user/user_images/<?php echo $receiver_image;?>" style="border:2px solid blue;border-radius:5px; width:100px;height:100px; ">
                        <p><strong><?php echo "$receiver_first_name $receiver_last_name";?></strong></p>
                        
                        
                        
                    </div>
                    <!--content time line  ends-->
                    <?php
                    
                        if(isset($_POST['message'])){
                            $charlist="'";
                            $msg= addcslashes($_POST['msg'], $charlist) ;
                            $insert_msg="insert into messages (sender,receiver,msg_content,reply,status,msg_date) values ('$user_id','$receiver_id','$msg','no reply','not seen',NOW())";
                            $run_insert_msg= mysqli_query($con, $insert_msg);
                            if($run_insert_msg){
                                echo "Message was sent successfully to ".$receiver_first_name." ".$receiver_last_name;
                            }
                            
                        }
                    ?>
                    
                </div>
                <!--content area ends-->
	
	</body>



</html>
<?php } ?>