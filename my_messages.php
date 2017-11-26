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
                            //getting all info of the current logged in user
                            $user=$_SESSION['user_email'];
                            $get_user="select * from users where user_email='$user'";
                            $run_user= mysqli_query($con, $get_user);
                            $row= mysqli_fetch_array($run_user);
                            
                            //getting the first name the logged in user
                            $user_first_name=$row['user_first_name'];
                            //getting the id of the logged in user
                            $user_id=$row['user_id'];
                            
                            ?>
				<ul id="menu">
                                    
                                    <!--getting the user id and displaying user's name in a link-->
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
//                            $user=$_SESSION['user_email'];
//                            $get_user="select * from users where user_email='$user'";
//                            $run_user= mysqli_query($con, $get_user);
//                            $row= mysqli_fetch_array($run_user);
                            
//                            $user_id=$row['user_id'];
//                            $user_first_name=$row['user_first_name'];
                            
                            
                            //getting the last name of the logged in user
                            $user_last_name=$row['user_last_name'];
                            //getting the image of the logged in user
                            $user_image=$row['user_image'];
                            //displaying user information
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
                    <div id="msg">
                        
                        <p align="center">
                            <a href="my_messages.php?inbox">Inbox</a>||<a href="my_messages.php?sent">Sent Items</a>
                        </p>
                      <!--setting the sent items -->  
                      <?php 
                      
                      if(isset($_GET['sent'])){
                          include("sent.php");
                      }
                      if(isset($_GET['inbox'])){
                      ?>
                      <!-- creating the table with name of columns-->
                        <table width='600' align='center'>
                            <tr>
                                <th>Sender</th>
                                <th>Date</th>
                                <th>Message</th>
                                <th>Reply</th>
                            </tr>
                         <!-- getting the content for the messages table-->      
                        <?php
                        //get all messages for the user from database
                        $sel_msg="select * from messages where receiver='$user_id' ORDER BY 1 DESC";
                        //running the query
                        $run_sel_msg= mysqli_query($con, $sel_msg);
                        
                        while($row_msg= mysqli_fetch_array($run_sel_msg)){
                            //getting all values from an array
                            $msg_id=$row_msg['msg_id'];
                            $msg_receiver=$row_msg['receiver'];
                            $msg_sender=$row_msg['sender'];
                            $msg_content=$row_msg['msg_content'];
                            $message_date=$row_msg['msg_date'];
                            
                            
                            //getting all information of the message sender...mainly we want the name of the sender
                            $get_msg_sender="select * from users where user_id='$msg_sender'";
                            //run the query
                            $run_get_msg_sender=mysqli_query($con,$get_msg_sender);
                            //getting all information in an array
                            $row= mysqli_fetch_array($run_get_msg_sender);
                            $row_msg_sender_id=$row['user_id'];
                            $row_msg_sender_first_name=$row['user_first_name'];
                            $row_msg_sender_last_name=$row['user_last_name'];
                            $msg_sender_full_name="$row_msg_sender_first_name "."$row_msg_sender_last_name";
                        ?>
                            
                            <tr align='center'>
                                <td><a href='user_profile.php?u_id=<?php echo $row_msg_sender_id; ?>' target="blank"><?php echo $msg_sender_full_name;?></a></td>
                                <td><?php echo $message_date; ?></td>
                                <td><?php echo $msg_content; ?></td>
                                <td><a href='my_messages.php?inbox&msg_id=<?php echo $msg_id; ?>'>Reply</a></td>
                            </tr>
                         <?php }?>
                        </table>
                      <?php
                      
                      if(isset($_GET['msg_id'])){
                          //getting the msg id
                          $get_msg_id=$_GET['msg_id'];
                          //getting everything of that msg from the database
                          $get_msg="select * from messages where msg_id='$get_msg_id'";
                          $run_get_msg= mysqli_query($con, $get_msg);
                          $all_of_msg= mysqli_fetch_array($run_get_msg);
                          
                          $reply_msg_content=$all_of_msg['msg_content'];
                          $reply_content=$all_of_msg['reply'];
                          
                          echo "<center><hr>"
                          . "<p>Message:$reply_msg_content</p>"
                                  . "<p>Reply:$reply_content</p>"
                                  . "<form action='' method='post'>"
                                  . "<textarea cols='30' rows='5' name='reply'></textarea><br/>"
                                  . "<input type='submit' name='msg_reply' value='Reply'></form>"
                          . "</center>";
                      }
                      if(isset($_POST['msg_reply'])){
                          $charlist="'";
                          $user_reply= addcslashes($_POST['reply'], $charlist) ;
                          $user_reply= htmlspecialchars($user_reply);
                          
                          if($reply_content!="no reply"){
                              echo "This message was already replied";
                              exit();
                          }else{
                          
                          $update_msg="update messages set reply='$user_reply' where msg_id='$get_msg_id'";
                          $run_update_msg= mysqli_query($con, $update_msg);
                          
                          if($run_update_msg){
                              echo "<h3 align='center'>message was replied</h3>";
                          }
                          }
                      }
                      }
                      ?>
                    </div>
                </div>
                <!--content area ends-->
	
	</body>



</html>
<?php } ?>