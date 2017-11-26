<?php
             
             session_start();
             $get_id=$_SESSION['post_id'];
             $con=mysqli_connect("localhost","root","","social_network") or die("Connection was not established");
             $get_comments="select * from comments where post_id='$get_id' ORDER BY 1 DESC";
             $run_comments= mysqli_query($con, $get_comments);
     
             while($row= mysqli_fetch_array($run_comments)){
               $comment=$row['comment'];
               $comment_first_name=$row['comment_first_name'];
               $comment_last_name=$row['comment_last_name'];
               $comment_date=$row['comment_date'];
         
               echo "<div id='comments'>
                <h3>$comment_first_name $comment_last_name</h3><span>commented on $comment_date</span>
                <p>$comment</p>
               </div>";
      
     }




?>