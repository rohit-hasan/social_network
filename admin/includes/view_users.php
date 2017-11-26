<table align="center" bgcolor="#41a6f4" width="800" >
    <tr bgcolor="orange">
        <th>Serial No</th>
        <th>Name</th>
        <th>Email</th>
        <th>Image</th>
        <th>Gender</th>
        <th>Delete</th>
    </tr>
    <?php 
    include 'includes/connection.php';
    $select_users="select * from users ORDER by 1";
    $run_select_users= mysqli_query($con, $select_users);
    while($row_users= mysqli_fetch_array($run_select_users)){
        
        $user_id=$row_users['user_id'];
        
        $user_first_name=$row_users['user_first_name'];
        $user_last_name=$row_users['user_last_name'];
        $user_name= "$user_first_name $user_last_name";
        
        $user_image=$row_users['user_image'];
        $user_gender=$row_users['user_gender'];
        $user_email=$row_users['user_email'];
        
        
    
    ?>
    <tr align="center">
        <td><?php echo $user_id; ?></td>
        <td><?php echo $user_name; ?></td>
        <td><?php echo $user_email; ?></td>
        <td> <img src="<?php echo "../user/user_images/$user_image"; ?>" width="50" height="50"> </td>
        <td><?php echo $user_gender;?></td>
        <td><a href="includes/delete_users.php?delete=<?php echo $user_id; ?>">Delete</a></td>
    </tr>
    <?php } ?>
</table>
