 <table width="700" align="center">
                            
                          
                            <tr>
                                <th>Receiver</th>
                                <th>Message</th>
                                <th>Date</th>
                                <th>Reply</th>
                                
                            </tr>
                             <?php
                        
                            $select_msg="select * from messages where sender='$user_id' ORDER by 1 DESC";
                            $run_select_msg= mysqli_query($con, $select_msg);
                            $count_msg= mysqli_num_rows($run_select_msg);
                            while($row_msg= mysqli_fetch_array($run_select_msg)){
                                $msg_id=$row_msg['msg_id'];
                                $msg_receiver=$row_msg['receiver'];
                                $msg_sender=$row_msg['sender'];
                                $msg_content=$row_msg['msg_content'];
                                $msg_date=$row_msg['msg_date'];
                                $msg_reply=$row_msg['reply'];
                            
                                $get_receiver="select * from users where user_id='$msg_receiver'";
                                $run_receiver= mysqli_query($con, $get_receiver);
                                $row_receiver= mysqli_fetch_array($run_receiver);
                                $row_receiver_first_name=$row_receiver['user_first_name'];
                                $row_receiver_last_name=$row_receiver['user_last_name'];
                                $row_receiver_full_name="$row_receiver_first_name"." "."$row_receiver_last_name";
                            
                            ?>
                            
                            <tr align="center">
                                <td>
                                    <a href="user_profile.php?u_id=<?php echo $msg_receiver; ?>" target="blank">
                                    <?php echo $row_receiver_full_name; ?>
                                    </a>    
                                </td>
                                <td>
                                    <a href="my_messages.php?msg_id=<?php echo $msg_id; ?>">
                                    <?php echo $msg_content; ?>
                                    </a>
                                </td>
                                <td><?php echo $msg_date; ?></td>
                                <td><a href="my_messages.php?sent&msg_id=<?php echo $msg_id; ?>">View Reply</a></td>
                            </tr>
                            <?php
                            }
                        ?>
                        </table>
                        <hr>
                        
                        <?php
                        
                            if(isset($_GET['msg_id'])){
                                $get_msg_id=$_GET['msg_id'];
                                $sel_msg="select * from messages where msg_id='$get_msg_id'";
                                $run_sel_msg= mysqli_query($con, $sel_msg);
                                $row_sel_msg= mysqli_fetch_array($run_sel_msg);
                                
                                $sel_msg_content=$row_sel_msg['msg_content'];
                                $sel_msg_reply=$row_sel_msg['reply'];                                
                                
                                echo "<br/><center>"
                                . "<p>$sel_msg_content</p>"
                                        . "<p>Reply: $sel_msg_reply</p>"
                                      
                                        . "</center>";
                                
                            }
//                            if(isset($_POST['msg_reply'])){
//                                $user_reply=$_POST['reply'];
//                                if($sel_msg_reply!='no reply'){
//                                    echo "This message was already replied";
//                                    exit();
//                                }else{
//                                    $update_msg="update messages set reply='$user_reply' where msg_id='$get_msg_id'";
//                                    $run_update_msg= mysqli_query($con, $update_msg);
//                                    if($run_update_msg){
//                                        echo "Replied Successfully";
//                                    }
//                                }
//                                
//                            }
                        
                        ?>